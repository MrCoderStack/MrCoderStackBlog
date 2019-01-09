<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cate;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{

    //标签列表
    public function list()
    {
        $query = Tag::groupby('id');
        $tags = $query->get();
        $total = Tag::all()->count();

        $articleCount = Article::all()->count();
        $catesCount = Cate::all()->count();
        $tagsCount = Tag::all()->count();
        return view('tags.list', compact('tags', 'total','articleCount','catesCount','tagsCount'));
    }

    //标签详情
    public function show($tid)
    {
        $articles = Tag::findOrFail($tid)->articles()->where('is_hidden', 0)->orderBy('created_at', 'desc')->paginate(10);
        for ($i = 0; $i < sizeof($articles); $i++) {
            $articles[$i]->content = str_limit(strip_tags($articles[$i]->content), 150);
            $articles[$i]->created_at_date = $articles[$i]->created_at->toDateString();
            $articles[$i]->updated_at_diff = $articles[$i]->updated_at->diffForHumans();
        }
        $tagName = Tag::find($tid)->name;
        $articleCount = Article::all()->count();
        $catesCount = Cate::all()->count();
        $tagsCount = Tag::all()->count();
        return view('tags.show', compact('articles', 'tagName','articleCount','catesCount','tagsCount'));
    }
}
