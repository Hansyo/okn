<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGenre extends Model
{
    //
    protected $table = 'PaymentGenres';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * 自分の親要素に当たるジャンルを取得
     */
    public function parent()
    {
        return $this->belongsToMany('App\Models\PaymentGenre', 'PaymentGenreClassifications', 'child', 'parent');
    }

    /**
     * 自分の子要素に当たるジャンルを取得
     */
    public function child()
    {
        return $this->belongsToMany('App\Models\PaymentGenre', 'PaymentGenreClassifications', 'parent', 'child');
    }
}
