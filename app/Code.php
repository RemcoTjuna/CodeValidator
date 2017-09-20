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

    protected static function boot(){
        parent::boot();
        static::addGlobalScope(new CodeScope());
    }

    public function getCode(){
        return $this->code;
    }

    public function validUntil(){
        return $this->valid_until;
    }

    public function scopeCanUse(){
        return !$this->trashed() && $this->isValid() && $this->hasValidUUID($this);
    }

    public function isValid(){
        if(!is_null($this->valid_until)){
            $now = Carbon::now();
            if($this->valid_until instanceof Carbon){
                return $now->lt($this->valid_until);
            }
            return $now->lt(new Carbon($this->valid_until));
        }
        return true;
    }

}
