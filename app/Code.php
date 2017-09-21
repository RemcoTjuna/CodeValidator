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
    }

    public function getCode(){
        return $this->code;
    }

    public function getContent(){
        return $this->content;
    }

    public function validUntil(){
        return $this->valid_until;
    }

    public function canUse(){
        return !$this->trashed() && $this->isValid() && $this->hasValidUUID($this);
    }

    public function generateUUID(){
        return $this->generate('UUIDv4');
    }

    public function isValid(){
        if(!is_null($this->valid_until)){
            $now = Carbon::now();
            return $now->lt(new Carbon($this->valid_until));
        }
        return true;
    }

}
