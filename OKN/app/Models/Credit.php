<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'Credits';
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function histories()
    {
        return $this->hasMany(CreditHistory::class);
    }
}
