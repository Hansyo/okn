<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Payments';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function paymentGenre(){
        return $this->belongsTo(PaymentGenre::class);
    }

    public function credits()
    {
        return $this->hasOne(Credit::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
