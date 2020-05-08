<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $table = 'Receipts';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
    public function history()
    {
        return $this->belongsTo('App\CreditHistory');
    }
}
