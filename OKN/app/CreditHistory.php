<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditHistory extends Model
{
    public function credit()
    {
        return $this->belongsTo('App\Credit');
    }

}
