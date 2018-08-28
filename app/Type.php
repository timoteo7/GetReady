<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	
	protected $fillable = ['description','url_image'];
	protected $guarded = ['id', 'created_at', 'update_at'];
	
    public function providers()
    {
        return $this->hasMany('App\Provider');
    }
    
    public function subtypes()
    {
        return $this->hasMany('App\Subtype');
    }

}
