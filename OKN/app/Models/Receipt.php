<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $table = 'Receipts';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
    public function creditHistory()
    {
        return $this->belongsTo(CreditHistory::class, 'creditHistory');
    }
}
