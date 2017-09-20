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

    private $uuid_v4 =  '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
    private $uuid_custom =  '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{1}$/i';

    public function hasValidUUID(Model $model){
        return $this->valid($model->uuid);
    }

    protected function valid($uuid){
        if(strlen($uuid) == 37) {
            return preg_match($this->uuid_v4, $uuid);
        }else if(strlen($uuid) == 17){
            return preg_match($this->uuid_custom, $uuid);
        }
        return false;
    }

}