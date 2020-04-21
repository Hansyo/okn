<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preset extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
}
