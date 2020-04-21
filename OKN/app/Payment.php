<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function credit()
    {
        return $this->hasMany('App\Credit');
    }
}
