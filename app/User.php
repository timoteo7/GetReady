<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Customer;
use App\Provider;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function customer()
    {
        return $this->hasOne('App\Customer');
    }
    
    public function provider()
    {
        return $this->hasOne('App\Provider');
    }
    
    public function isCustomer ()
    {
        return (Customer::where ('user_id', $this->id)->count() > 0);
    }
    
    public function isProvider ()
    {
        return (Provider::where ('user_id', $this->id)->count() > 0);
    }
}
