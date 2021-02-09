<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preset extends Model
{
    protected $table = 'Presets';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }
}
