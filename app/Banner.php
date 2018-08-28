<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['name','url_image','status','type_id','subtype_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
}
