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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function creditHistory()
    {
        return $this->hasOne(CreditHistory::class);
    }
}
