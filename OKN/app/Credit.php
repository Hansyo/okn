<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function history()
    {
        return $this->hasMany('App\CreditHistory');
    }
}
