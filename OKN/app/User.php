<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'Users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * UserXxxxRelation
     * To many, many, many and many.
     */
    public function genre()
    {
        return $this->hasMany('App\Genre');
    }

    public function store()
    {
        return $this->hasMany('App\Store');
    }

    public function target()
    {
        return $this->hasMany('App\Target');
    }

    public function paymentGenre()
    {
        return $this->hasMany('App\PaymentGenre');
    }

    public function incomeGenre()
    {
        return $this->hasMany('App\IncomeGenre');
    }

    public function receipt()
    {
        return $this->hasMany('App\Receipt');
    }

    public function preset()
    {
        return $this->hasMany('App\Preset');
    }

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }

    public function income()
    {
        return $this->hasMany('App\Income');
    }

}
