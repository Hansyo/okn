<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    /***
     *
     * 各モデルとの接続情報の記述
     *
     * 基本的に(ユーザー)1対多(各モデル)の関係
     */
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    public function incomes() {
        return $this->hasMany(Income::class);
    }

    public function incomeGenres(){
        return $this->hasMany(IncomeGenre::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function paymentGenres(){
        return $this->hasMany(PaymentGenre::class);
    }

    public function presets(){
        return $this->hasMany(Preset::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function targets(){
        return $this->hasMany(Target::class);
    }
}
