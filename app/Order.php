<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $guarded = ['id', 'created_at', 'update_at'];
    
    public function customer()
    {
        return $this->belongsTo('App\Customer','customer_id');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity','activitie_id');
    }

    public function place()
    {
        return $this->hasOne('App\Place');
    }
}
