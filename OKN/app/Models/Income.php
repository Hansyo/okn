<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'Incomes';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function incomeGenre()
    {
        return $this->belongsTo('App\Models\IncomeGenre', 'incomeGenre');
    }

    public function history()
    {
        return $this->belongsTo(CreditHistory::class, 'creditHistory');
    }

}
