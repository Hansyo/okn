<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeGenre extends Model
{
    protected $table = 'IncomeGenres';
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * 自分の親要素に当たるジャンルを取得
     */
    public function parent()
    {
        return $this->belongsToMany('App\Models\IncomeGenre', 'IncomeGenreClassifications', 'child', 'parent');
    }

    /**
     * 自分の子要素に当たるジャンルを取得
     */
    public function child()
    {
        return $this->belongsToMany('App\Models\IncomeGenre', 'IncomeGenreClassifications', 'parent', 'child');
    }
}
