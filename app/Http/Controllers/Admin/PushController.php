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
use Illuminate\Support\Facades\Storage;

class PushController extends Controller
{
    /**
     *
     */
    public function push()
    {
        if(env('PUSH_STATE') == 'on'){
            $pushData = $this->getPushData();
            $result = $this->baiduPush($pushData);
            if($result){
                return 'push success';
            }else{
                return 'push fail';
            }
        }else{
            return '自动推送未打开';
        }
    }

    public function getPushData()
    {
        $articleData = [];
        $cateData = [];
        $tagData = [];
        $siteMap = [];

        $articles = Article::select('id')->get();
        foreach ($articles as $article) {
            $articleData[] = env('APP_URL') . '/articles/' . $article->id;
            $siteMap[] = env('APP_URL') . '/articles/' .$article->id."\r\n";
        }

        $cates = Cate::select('id')->get();
        foreach ($cates as $cate) {
            $cateData[] = env('APP_URL') . '/cates/' . $cate->id;
            $siteMap[] = env('APP_URL') . '/cates/' .$cate->id."\r\n";
        }

        $tags = Tag::select('id')->get();
        foreach ($tags as $tag) {
            $tagData[] = env('APP_URL') . '/tags/' . $tag->id;
            $siteMap[] = env('APP_URL') . '/tags/' .$tag->id."\r\n";
        }
        $pushData = array_merge($articleData, $cateData, $tagData);
        Storage::disk('public')->put('sitemap.txt', $siteMap);
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
