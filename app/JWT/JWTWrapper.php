<?php

namespace App\JWT;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Claim\Basic;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Hmac\Sha384;
use Lcobucci\JWT\Signer\Hmac\Sha512;
use Lcobucci\JWT\ValidationData;

class JWTWrapper implements JWTCredentials
{
    public $data = array();

    public function getAlgorithm()
    {
        if (JWTAlghoritms::isValidName(getenv('JWT_ALGHORITM'))) {
            return JWTAlghoritms::valueOf(getenv('JWT_ALGHORITM'));
        }
        return JWTAlghoritms::$default;
    }

    public function getSecret()
    {
        return getenv('JWT_SECRET');
    }

    public function isBase64Encoded()
    {
        return boolval(getenv('JWT_BASE64'));
    }

    public function getAbsoluteCredentials()
    {
        return [
            'algorithm' => self::getAlgorithm(),
            'secret' => self::getSecret(),
            'base64' => self::isBase64Encoded(),
            'issuer' => self::getIssuer(),
            'audience' => self::getAudience(),
            'id' => self::getID(),
            'expiration' => self::getExpiration()
        ];
    }

    public function getIssuer()
    {
        return getenv('JWT_ISSUER');
    }

    public function getAudience()
    {
        return getenv('JWT_AUDIENCE');
    }

    public function getID()
    {
        return getenv('JWT_ID');
    }

    public function getExpiration()
    {
        return intval(getenv('JWT_EXPIRATION'));
    }

    public function build()
    {
        $builder = (new Builder())->setIssuer(self::getIssuer())
        ->setAudience(self::getAudience())
        ->setId(self::getID())
            ->setIssuedAt(time())
            ->setExpiration(time() + self::getExpiration());

        foreach (array_keys($this->data) as $key) {
            $builder->set($key, $this->data[$key]);
        }

        return $builder;
    }

    public function buildValidationData(){
        $data = new ValidationData();
        $data->setIssuer(self::getIssuer());
        $data->setAudience(self::getAudience());
        $data->setId(self::getID());
        return $data;
    }

    public static function verify($token, JWTWrapper $wrapper)
    {
        $verify = $token->verify($wrapper->toTester(), $wrapper->isBase64Encoded() ? base64_encode($wrapper->getSecret()) : $wrapper->getSecret());
        $validate = $token->validate($wrapper->buildValidationData());
        if ($verify) {
            return [
                'verify' => $verify,
                'validate' => $validate,
                'content' => array_map(function ($key) use ($token) {
                    if(is_array($key->getValue())){
                        return $key->getValue();
                    }
                    return $key->getValue();
                }, $token->getClaims())
            ];
        }
    }

    public function sign()
    {
        return self::build()->sign(self::toTester(), self::isBase64Encoded() ? base64_encode(self::getSecret()) : self::getSecret())
            ->getToken();
    }

    public function addData($key, $value)
    {
        array_push($this->data, [$key => $value]);
    }

    function toTester()
    {
        switch (self::getAlgorithm()) {
            case "HS256":
                return new Sha256();
            case "HS384":
                return new Sha384();
            default:
            case "HS512":
                return new Sha512();
        }
    }
}
