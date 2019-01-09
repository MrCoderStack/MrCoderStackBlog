<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'article_num', 'search_num'
    ];

    /**
     * 获得此分类下的文章
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
