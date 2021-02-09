<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    //
    protected $table = 'Targets';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
