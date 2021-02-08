<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'Incomes';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function genre()
    {
        return $this->belongsTo('App\Models\IncomeGenre', 'incomeGenre_id');
    }

}
