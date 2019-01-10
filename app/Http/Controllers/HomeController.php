<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Tag;
use Illuminate\Http\Request;
use App\Article;
use App\Visit;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //主页
    public function home(Request $request)
    {
        $articles = Article::select(['ar.*', 'ca.name as cates'])->from('articles as ar')->where('is_hidden', 0)->leftjoin('cates as ca', 'ar.cate_id', '=', 'ca.id')->orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->paginate(10);//->offset($offset)->limit(10)->get();
        $articleCount = Article::all()->count();
        $catesCount = Cate::all()->count();
        $tagsCount = Tag::all()->count();
        foreach ($articles as $article) {
            $article->cover = imageURL($article->cover);
            $article->content = str_limit(strip_tags($article->content_html), 500);
            $article->created_at_date = $article->created_at;//->toDateString();
            $article->updated_at_diff = $article->updated_at;//->diffForHumans();
            $article->comments = $article->comments()->count();
            $article->words = mb_strlen(strip_tags($article->content_html), 'UTF8');
            $article->read = ceil($article->words / 1000);
        }

        return view(env('BLOG_THEME') . '.home', compact('articles', 'articleCount', 'catesCount', 'tagsCount'));
    }
}
