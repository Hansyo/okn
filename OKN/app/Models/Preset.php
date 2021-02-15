<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preset extends Model
{
    protected $table = 'Presets';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
