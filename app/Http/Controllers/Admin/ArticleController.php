<?php

namespace App\Http\Controllers\Admin;

use App\Cate;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Common\MyUpload;
use League\HTMLToMarkdown\HtmlConverter;
use App\Article;
use App\Comment;
use App\Visit;
use App\Tag;
use Auth;

class ArticleController extends Controller
{
    //所有文章
    public function index(Request $request)
    {
        $order = $request->order;
        $status = $request->status;
        $top = $request->top;
        $search = $request->search;
        $articles = Article::when(isset($status), function ($query) use ($status) {
            return $query->where('is_hidden', $status);
        })->when(isset($top), function ($query) use ($top) {
            return $query->where('is_top', $top);
        })->when(isset($search), function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->when(isset($order), function ($query) use ($order) {
            return $query->orderBy($order, 'desc');
        })->paginate($request->pagesize);

        for ($i = 0; $i < sizeof($articles); $i++) {
            $articles[$i]->key = $articles[$i]->id;
            $articles[$i]->content_html = str_limit(strip_tags($articles[$i]->content_html), 60);
            $articles[$i]->updated_at_diff = $articles[$i]->updated_at->diffForHumans();
        }
        return $articles;
    }

    //文章详情
    public function show($id)
    {
        $article = Article::findOrFail($id);
        for ($i = 0; $i < sizeof($article->tags); $i++) {
            $article->tags[$i] = $article->tags[$i]->name;
        }
        if ($article->cate_id) {
            $article->cates = Cate::where('id', $article->cate_id)->first()->name;
        }

        $tags = Tag::all();
        for ($i = 0; $i < sizeof($tags); $i++) {
            $tags[$i] = $tags[$i]->name;
        }
        $cates = Cate::all();
        $catesArr = array();
        foreach ($cates as $cate) {
            $cate->key = $cate->id;
            array_push($catesArr, $cate->name);
        }
        return response()->json([
            'article' => $article,
            'tagsArr' => $tags,
            'catesArr' => $catesArr,
        ]);
    }

    //保存文章
    public function store(Request $request)
    {
        if ($request->id) {
            $article = Article::findOrFail($request->id);
            $message = '保存成功！';
        } else {
            $article = new Article;
            $message = '创建成功！';
        }
        $article->title = $request->title;
        $article->cover = $request->cover;
        $article->is_markdown = $request->is_markdown;
        if ($request->is_markdown) {
            $article->content_markdown = $request->content_markdown;
        } else {
            $article->content_raw = $request->content_raw;
        }

        $parse = new \Parsedown();
        $article->content_html = $parse->text($request->content_markdown);
        //$article->content_html = $request->content_html;
        if ($request->cates) {
            $cateId = Cate::where('name', $request->cates)->first()->id;
            $article->cate_id = $cateId;
        }

        $article->save();
        //处理标签
        //先删除文章关联的所有标签
        //遍历标签，如果标签存在则添加关联，如果标签不存在先创建再添加关联
        $article->tags()->detach();
        for ($i = 0; $i < sizeof($request->tags); $i++) {
            $tag = Tag::where('name', $request->tags[$i])->first();
            if ($tag) {
                $article->tags()->attach($tag->id);
            } else {
                $tag = new Tag;
                $tag->name = $request->tags[$i];
                $tag->save();
                $article->tags()->attach($tag->id);
            }
        }
        return response()->json([
            'message' => $message
        ]);
    }

    //删除文章
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json([
            'message' => '删除成功!'
        ]);
    }

    public function publish($id)
    {
        $article = Article::findOrFail($id);
        if ($article->is_hidden) {
            $article->is_hidden = 0;
            $article->save();
            return response()->json([
                'message' => '文章已发表！'
            ]);
        } else {
            $article->is_hidden = 1;
            $article->save();
            return response()->json([
                'message' => '文章已切换为笔记！'
            ]);
        }
    }

    /**
     * 置顶文章 [API]
     *
     * @return \Illuminate\Http\Response
     */
    public function top($id)
    {
        $article = Article::findOrFail($id);
        if ($article->is_top) {
            $article->is_top = 0;
            $article->save();
            return response()->json([
                'message' => '文章已取消置顶！'
            ]);
        } else {
            $article->is_top = 1;
            $article->save();
            return response()->json([
                'message' => '文章已置顶！'
            ]);
        }
    }

    /**
     * html 转 markdown [API]
     *
     * @return \Illuminate\Http\Response
     */
    public function markdown(Request $request)
    {
        $converter = new HtmlConverter();
        return $converter->convert($request->content);
    }

    /**
     * API直接存储文件
     */
    public function uploadFileApi(Request $request)
    {
        return MyUpload::uploadFile($request->file);
    }

    /**
     * 导入其他数据库文章
     */
    public function import(Request $request)
    {
        $inputs = $request->all();

        $articles = DB::table($inputs['table'])->get();
        unset($inputs['table']);

        foreach ($articles as $article) {
            $newArticle = new Article;
            $newArticle->id = $article->id;
            foreach ($inputs as $key => $value) {

                if ($key == 'is_top' || $key == 'is_hidden') {
                    $arr = explode('|', $value);
                    $arr0 = $arr[0];//字段名
                    $arr1 = $arr[1];//true值
                    $newArticle->$key = $article->$arr0 == $arr1 ? 1 : 0;
                } elseif ($key == 'content') {
                    $newArticle->content_raw = $newArticle->content_html = $article->$value;
                } elseif ($key == 'cover') {
                    $arr = explode('/', $article->$value);
                    if (sizeof($arr)) {
                        $newArticle->$key = $arr[sizeof($arr) - 1];
                    } else {
                        $newArticle->$key = $article->$value;
                    }
                } else {
                    $newArticle->$key = $article->$value;
                }
            }
            $newArticle->save();
        }

        return response()->json([
            'message' => '导入成功！'
        ]);
    }
}
