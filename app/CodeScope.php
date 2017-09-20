<?php
/**
 * Created by PhpStorm.
 * User: Tjuna
 * Date: 20/09/17
 * Time: 16:14
 */

namespace App;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CodeScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $model::onlyTrashed();
    }
}