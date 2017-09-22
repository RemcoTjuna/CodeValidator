<?php

namespace App\JWT;

interface JWTCredentials
{

    public function getAlgorithm();
    public function getSecret();
    public function isBase64Encoded();

    public function getIssuer();
    public function getAudience();
    public function getID();
    public function getExpiration();

    function getAbsoluteCredentials();
    function toTester();

}
