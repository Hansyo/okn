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
        return $this->belongsTo('App\Models\Genre');
    }
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
    public function history()
    {
        return $this->belongsTo('App\Models\CreditHistory');
    }
}
