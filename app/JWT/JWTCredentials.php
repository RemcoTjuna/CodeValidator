<?php

namespace App\JWT;

interface JWTCredentials
{

    function getAlgorithm();
    function getSecret();
    function isBase64Encoded();

    function getAbsoluteCredentials();

}
