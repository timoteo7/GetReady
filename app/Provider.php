<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['name','email','home_phone','mobile_phone','rg','cpf', 'main_place_id', 'url_image', 'user_id', 'gender', 'bank' , 'ag' , 'account', 'variation'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'providers';
    
    public function places()
    {
        return $this->hasMany('App\Place');
    }
    
    public function subtypes()
    {
        return $this->belongsToMany('App\Subtype')->withPivot('provider_id', 'subtype_id')
            ->withTimestamps();
    }
    
    public function activity()
    {
        return $this->hasMany('App\Activity');
    }

}
