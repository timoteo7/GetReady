<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    public $timestamps = true;

    public function subtype()
    {
        return $this->belongsTo('App\Subtype');
    }
    
    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }
}
