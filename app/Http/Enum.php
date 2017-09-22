<?php
/**
 * Created by PhpStorm.
 * User: Tjuna
 * Date: 22/09/17
 * Time: 10:47
 */

namespace App\Http;

use ReflectionClass;

//Contributor: Brian Cline on StackOverflow
//Source: https://stackoverflow.com/questions/254514/php-and-enumerations

abstract class Enum
{
    private static $constCacheArray = NULL;

    private static function values() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::values();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true) {
        $values = array_values(self::values());
        return in_array($value, $values, $strict);
    }

    public static function valueOf($key){
        $values = array_values(self::values());
        return $values[$key];
    }

}