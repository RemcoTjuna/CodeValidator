<?php

namespace App\JWT;

class JWTCredentialWrapper implements JWTCredentials
{
    function getAlgorithm()
    {
        if(JWTAlghoritms::isValidName(getenv('JWT_ALGHORITM'))){
            return JWTAlghoritms::valueOf(getenv('JWT_ALGHORITM'));
        }
        return JWTAlghoritms::$default;
    }

    function getSecret()
    {
        return getenv('JWT_SECRET');
    }

    function isBase64Encoded()
    {
        return boolval(getenv('JWT_BASE64'));
    }

    function getAbsoluteCredentials()
    {
        return [
            'algorithm' => self::getAlgorithm(),
            'secret' => self::getSecret(),
            'base64' => self::isBase64Encoded()
        ];
    }
}
