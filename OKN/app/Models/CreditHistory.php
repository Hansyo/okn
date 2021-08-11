<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditHistory extends Model
{
    protected $table = 'CreditHistories';
    public function credits()
    {
        return $this->belongsTo(Credit::class, 'credit');
    }

    public function receipt(){
        return $this->hasOne(Receipt::class, 'creditHistory');
    }

}
