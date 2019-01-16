<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Common\SphinxClient;
use Illuminate\Http\Request;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Support\Facades\DB;
use League\HTMLToMarkdown\HtmlConverter;
use App\Common\MyUpload;
use App\Article;
use App\Comment;
use App\Visit;
use App\Tag;
use App\User;
use Auth;

class ArticleController extends Controller
{
    //文章列表
    public function list()
    {
        $articles = Article::where('is_hidden', 0)->orderBy('created_at', 'desc')->paginate(10);
        foreach ($articles as $article) {
            $article->cover = imageURL($article->cover);
            $article->content = str_limit(strip_tags($article->content_html), 150);
            $article->created_at_date = $article->created_at->toDateString();
            $article->updated_at_diff = $article->updated_at->diffForHumans();
        }

        $tags = Tag::all();
        return view(env('BLOG_THEME') . '.articles.list', compact('articles', 'tags'));
    }

    //搜索
    public function search(Request $request)
    {
        $keyword = urldecode(trim(strip_tags($request->key)));
        $indexName = '*';
        $sphinx = new SphinxClient ();
        // 建立连接
        $sphinx->SetServer('127.0.0.1', 9312);
        $sphinx->SetConnectTimeout(3);
        $sphinx->SetMaxQueryTime(2000);
        $orgDatas = $sphinx->Query($keyword, $indexName);
        $errors = $sphinx->GetLastError();
        $articles = array();
        if ($orgDatas['total'] > 0) {
            $field = 'ar.id, ar.content_html, ar.title, ca.name';
            $articles = Article::select(DB::RAW($field))->from('articles as ar')
                ->leftjoin('cates as ca', 'ar.cate_id', '=', 'ca.id')
                ->whereIn('ar.id', array_keys($orgDatas['matches']))->get();
        }
        foreach ($articles as $k => $article) {
            $article->content_html = mb_substr($this->cutstr_html($article->content_html), 0, 100, 'utf-8');
        }
        return $result = ['code' => 200, 'data' => $articles];
    }

    function cutstr_html($string)
    {
        $string = strip_tags($string);
        $string = trim($string);
        $string = preg_replace("/\t/", "", $string);
        $string = preg_replace("/\r\n/", "", $string);
        $string = preg_replace("/\r/", "", $string);
        $string = preg_replace("/\n/", "", $string);
        $string = preg_replace("/ /", "", $string);
        $string = preg_replace("//", "", $string);
        return trim($string);
    }

    //文章详情
    public function show(Request $request, $id)
    {
        $articleIdArr = array_column(Article::select(['id'])->where('is_hidden', 0)->orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->get()->toArray(), 'id');
        $currId = array_search($id, $articleIdArr);

        if (!isset($articleIdArr[$currId - 1])) {
            $preId = '';
        } else {
            $preId = $articleIdArr[$currId - 1];
        }

        if (!isset($articleIdArr[$currId + 1])) {
            $bacId = '';
        } else {
            $bacId = $articleIdArr[$currId + 1];
        }

        $articleCount = Article::all()->count();
        $catesCount = Cate::all()->count();
        $tagsCount = Tag::all()->count();
        $article = Article::findOrFail($id);
        $article->increment('view');
        $article->created_at_date = $article->created_at->toDateString();
        $article->updated_at_date = $article->updated_at->toDateString();
        $comments = $article->comments()->where('parent_id', 0)->orderBy('created_at', 'desc')->get();
        $field = 'id, title';
        $preArticle = Article::select(['id', 'title'])->where('id', $preId)->first();
        $bacArticle = Article::select(['id', 'title'])->where('id', $bacId)->first();
        $count = $article->comments()->count();
        $article->words = mb_strlen(strip_tags($article->content_html), 'UTF8');
        $article->read = ceil($article->words / 1000);
        $article->description = mb_substr($this->formatContent($this->cutstr_html($article->content_html)), 0, 80, 'utf-8');
        if ($article->cate_id) {
            $article->cates = Cate::where('id', $article->cate_id)->first()->name;
        }
        //处理评论，关联回复
        foreach ($comments as $comment) {
            $comment->created_at_diff = $comment->created_at->diffForHumans();
            if ($comment->name) {
                $comment->avatar = mb_substr($comment->name, 0, 1, 'utf-8');
            } else {
                $comment->avatar = '匿';
                $comment->name = '一位不愿意透露姓名的网友' . $comment->id . '#';

            }
            if ($comment->user_id == 1) {
                $comment->master = User::select('name', 'avatar')->findOrFail(1);
                $comment->master->avatar = imageURL($comment->master->avatar);
            }

            foreach ($comment->replys as $reply) {
                $reply->created_at_diff = $reply->created_at->diffForHumans();
                $commentModel = Comment::find($reply->target_id);
                $reply->target_name = empty($commentModel->name) ? '一位不愿意透露姓名的网友' . $commentModel->id . '#' : $commentModel->name;
                if ($reply->name) {
                    $reply->avatar = mb_substr($reply->name, 0, 1, 'utf-8');
                } else {
                    $reply->avatar = '匿';
                    $reply->name = '一位不愿意透露姓名的网友' . $reply->id . '#';
                }
                if ($reply->user_id == 1) {
                    $reply->master = User::select('name', 'avatar')->findOrFail(1);
                    $reply->master->avatar = imageURL($reply->master->avatar);
                }
            }
        }

        //自动填写
        $input = (object)[];
        if (Auth::id()) {
            $input = User::select('name', 'email', 'website')->findOrFail(Auth::id());
        } else {
            $comment = Comment::where('ip', $request->ip())->orderBy('created_at', 'desc')->select('name', 'email', 'website')->first();
            $input = $comment ? $comment : $input;
        }

        preg_match_all('#<h2>(.*)</h2>#', $article->content_html, $outline);
        $out = $outline[1];
        $outline = [];
        foreach ($out as $k => $v) {
            $outline[$k]['name'] = $v;
            $outline[$k]['id'] = $this->formatContent($v);
        }

        $preg = "#<h([0-9])>(.*)</h([0-9])>#";
        $replace = '<h$1 id="$2">$2</h$1>';
        $content = preg_replace_callback($preg, function ($matches) {
            $title = $matches[2];
            $title = $this->formatContent($title);
            $h2 = '<h' . $matches[1] . ' id= \'' . $title . '\'>' . $matches[2] . '</h' . $matches[1] . '>';
            return $h2;
        }, $article->content_html);

        $article->content_html = $content;
        $tags = $article->tags;
        $article->keywords = implode(',', array_column($tags->toArray(), 'name'));
        return view(env('BLOG_THEME') . '.articles.show', compact('article', 'comments', 'input', 'count', 'outline', 'tags', 'articleCount', 'catesCount', 'tagsCount', 'preArticle', 'bacArticle'));
    }


    public function formatContent($content)
    {
        // Filter 英文标点符号
        $content = preg_replace("/[[:punct:]]/i", " ", $content);
        // Filter 中文标点符号
        mb_regex_encoding('utf-8');
        $char = "。、！？：；﹑•＂…‘’“”〝〞∕¦‖—　〈〉﹞﹝「」‹›〖〗】【»«』『〕〔》《﹐¸﹕︰﹔！¡？¿﹖﹌﹏﹋＇´ˊˋ―﹫︳︴¯＿￣﹢﹦﹤‐­˜﹟﹩﹠﹪﹡﹨﹍﹉﹎﹊ˇ︵︶︷︸︹︿﹀︺︽︾ˉ﹁﹂﹃﹄︻︼（）";
        $content = mb_ereg_replace("[" . $char . "]", " ", $content, "UTF-8");
        // Filter 连续空格
        $content = preg_replace('# #', '', $content);
        return $content;
    }

}
