<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use SoftDeletes, UUID;

    protected $fillable = ['code', 'valid_until'];
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'can_use' => "boolean"
    ];

    protected static function boot(){
        parent::boot();
    }

    public function getCode(){
        return $this->code;
    }

    public function getCanUseAttribute(){
       return !$this->trashed() && $this->isValid();
    }

    public static function generateUUID(){
        return static::generate('UUIDv4');
    }

    public function isValid(){
        if(!is_null($this->valid_until)){
            $now = Carbon::now();
            return $now->lt(new Carbon($this->valid_until));
        }
        return true;
    }

}
