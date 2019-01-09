<?php

namespace App\Http\Controllers\Admin;

use App\Cate;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Article;
use App\Comment;
use App\Visit;
use App\Tag;
use Auth;

class PushController extends Controller
{
    /**
     *
     */
    public function push()
    {
        $pushData = $this->getPushData();
        $result = $this->baiduPush($pushData);
        dd($result);
    }

    public function getPushData()
    {
        $articleData = [];
        $cateData = [];
        $tagData = [];

        $articles = Article::select('id')->get();
        foreach ($articles as $article) {
            $articleData[] = env('APP_URL') . '/articles/' . $article->id;
        }

        $cates = Cate::select('id')->get();
        foreach ($cates as $cate) {
            $cateData[] = env('APP_URL') . '/cates/' . $cate->id;
        }

        $tags = Tag::select('id')->get();
        foreach ($tags as $tag) {
            $tagData[] = env('APP_URL') . '/tags/' . $tag->id;
        }
        $pushData = array_merge($articleData, $cateData, $tagData);
        return $pushData;
    }

    public function baiduPush($pushData)
    {
        $baiduPushApi = 'http://data.zz.baidu.com/urls?site=www.wrsee.com&token=KZfBgcgRj2NcnKYn';
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $baiduPushApi,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $pushData),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        return $result;
    }
}
