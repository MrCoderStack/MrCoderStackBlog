<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use App\Cate;
use Illuminate\Support\Facades\DB;

class CateController extends Controller
{
    //分类首页
    public function list()
    {
        $query = Cate::select(DB::RAW('count(ca.id) as num, ca.name,ca.id'))->from('cates as ca')->leftjoin('articles as ar', 'ca.id', '=', 'ar.cate_id')->groupby('ca.id');
        $cates = $query->get();
        $total = Cate::all()->count();

        $articleCount = Article::all()->count();
        $catesCount = Cate::all()->count();
        $tagsCount = Tag::all()->count();
        return view(env('BLOG_THEME') . '.cates.list', compact('cates', 'total', 'articleCount', 'catesCount', 'tagsCount'));
    }

    //分类详情
    public function show($cid)
    {
        $articles = Article::select(['ar.*', 'ca.name'])->from('articles as ar')->where('ar.is_hidden', 0)->leftjoin('cates as ca', 'ar.cate_id', '=', 'ca.id')->where('ar.cate_id', $cid)->orderBy('ar.created_at', 'desc')->paginate(10);
        $cateName = '';
        foreach ($articles as $article) {
            $cateName = $article->name;
            $article->cover = imageURL($article->cover);
            $article->content = str_limit(strip_tags($article->content_html), 150);
            $article->created_at_date = $article->created_at->toDateString();
            $article->updated_at_diff = $article->updated_at->diffForHumans();
        }
        $articleCount = Article::all()->count();
        $catesCount = Cate::all()->count();
        $tagsCount = Tag::all()->count();
        return view(env('BLOG_THEME') . '.cates.show', compact('articles', 'cateName', 'articleCount', 'catesCount', 'tagsCount'));
    }
}
