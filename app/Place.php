<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Place extends Model
{

    use Geographical;

    protected $guarded = ['id', 'created_at', 'update_at'];
    
    public function providers()
    {
        return $this->belongsTo('App\Provider');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    
}
