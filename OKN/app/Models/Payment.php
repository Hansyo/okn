<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Payments';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function credit()
    {
        return $this->hasMany('App\Models\Credit');
    }
}
