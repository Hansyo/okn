<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'Credits';
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

    public function history()
    {
        return $this->hasMany('App\Models\CreditHistory');
    }
}
