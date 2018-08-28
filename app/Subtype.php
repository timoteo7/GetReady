<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtype extends Model
{

    protected $table = 'subtypes';

    protected $fillable = ['type_id','description','url_image'];
	protected $guarded = ['id', 'created_at', 'update_at'];


	public function types()
    {
        return $this->belongsTo('App\Type');
    }
    
    public function activities()
    {
        return $this->hasMany('App\Activities');
    }

    public function providers()
    {
        return $this->belongsToMany('App\Provider')->withPivot('provider_id', 'subtype_id')
            ->withTimestamps();
    }
	
}
