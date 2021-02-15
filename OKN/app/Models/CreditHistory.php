<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditHistory extends Model
{
    protected $table = 'CreditHistories';
    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }

}
