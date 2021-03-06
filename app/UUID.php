<?php
/**
 * Created by PhpStorm.
 * User: Tjuna
 * Date: 20/09/17
 * Time: 16:52
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

trait UUID
{

    /* This is juist a normal builder now */

    private static $uuid_v4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
    private static $uuid_custom = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{1}$/i';

    public static function hasValidUUID(Model $model)
    {
        return static::valid($model->uuid);
    }

    public static function valid($uuid)
    {
        if (strlen($uuid) == 37) {
            return preg_match(static::$uuid_v4, $uuid);
        } else if (strlen($uuid) == 17) {
            return preg_match(static::$uuid_custom, $uuid);
        }
        return false;
    }

    public static function generate($type)
    {
        switch (strtoupper($type)) {
            default:
            case "UUIDV4":
                return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                    mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                    mt_rand(0, 0xffff),
                    mt_rand(0, 0x0fff) | 0x4000,
                    mt_rand(0, 0x3fff) | 0x8000,
                    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
                );
            case "UUIDV1":
                return uniqid();
        }
    }

}