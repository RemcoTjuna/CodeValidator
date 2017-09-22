<?php
/**
 * Created by PhpStorm.
 * User: Tjuna
 * Date: 22/09/17
 * Time: 10:44
 */

namespace App\JWT;

use App\Http\Enum;

abstract class JWTAlghoritms extends Enum
{

    const HS256 = "HS256";
    const HS384 = "HS384";
    const HS512 = "HS512";

    public static $default = JWTAlghoritms::HS512;
}
