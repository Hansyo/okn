<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'Genres';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * 自分の親要素に当たるジャンルを取得
     */
    public function parent()
    {
        return $this->belongsToMany('App\Genre', 'GenreClassifications', 'child', 'parent');
    }

    /**
     * 自分の子要素に当たるジャンルを取得
     */
    public function child()
    {
        return $this->belongsToMany('App\Genre', 'GenreClassifications', 'parent', 'child');
    }
}
