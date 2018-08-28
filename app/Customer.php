<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id', 'created_at', 'update_at'];
    
    public function place()
    {
        return $this->hasMany('Place');
    }
}
