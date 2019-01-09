<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentRemind;
use App\Common\MyFunction;
use App\Comment;
use App\User;
use App\Blacklist;
use Auth;
use Validator;

class CommentController extends Controller
{
    //保存评论
    public function store(Request $request)
    {
        $ip = $request->ip();
        if (Blacklist::check($ip)) {
            return ['code' => 200, 'msg' => '该IP短时间访问次数过多!'];
        }
        $rules = [
            'article_id' => 'required|integer',
            'content' => 'required|string',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'browser' => 'nullable|string',
            'os' => 'nullable|string',
            'real_ip' => 'nullable|string',
            "city" => 'nullable|string',
        ];
        $message = [
            'article_id.required' => '文章ID缺失',
            'article_id.integer' => '文章类型错误',
            'content.required' => '内容缺失',
            'content.string' => '内容类型错误',
            'name.string' => '昵称型错误',
            'email.email' => 'email类型错误',
            'website.url' => '链接类型错误',
            'browser.string' => '浏览器类型错误',
            'os.string' => '系统类型错误',
            'real_ip.string' => 'ip类型错误',
            "city.string" => '城市类型错误',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['code' => 200, 'msg' => $errors->first()];
        }
        $content = $request->content;
        if (!preg_match('/[\x{4e00}-\x{9fa5}]/u', $content) && preg_match('/http:\/\/|https:\/\//u', $content)) {
            return ['code' => 200, 'msg' => '包含敏感字符!'];
        }
        $comment = new Comment;
        $comment->article_id = $request->article_id;
        $comment->content = $content;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->website = $request->website;
        $comment->ip = $ip;
        $comment->city = $request->city;
        $comment->os = $request->os;
        $comment->browser = $request->browser;
        $comment->user_id = Auth::id() ? Auth::id() : 0;
        if ($request->parent_id) {
            $comment->parent_id = $request->parent_id;
            $comment->target_id = $request->target_id;
        } else {
            $comment->parent_id = 0;
            $comment->target_id = 0;
        }
        $comment->save();
        return ['code' => 200, 'msg' => '留言成功!'];
//        //发送邮件
//        if ($request->parent_id) {
//            $commentTarget = Comment::findOrFail($request->target_id);
//            $url = url("/articles/{$comment->article->id}#comment{$comment->id}");
//            if (setting('reply_email')) {
//                try {
//                    Mail::to($commentTarget->email)
//                        ->send(new CommentRemind($commentTarget->content, $comment, $url));
//                } catch (\Exception $e) {
//                }
//            }
//        } else {
//            $url = url("/articles/{$comment->article->id}#comment{$comment->id}");
//            if (setting('comment_email')) {
//                try {
//                    Mail::to(User::findOrFail(1))
//                        ->send(new CommentRemind($comment->article->title, $comment, $url));
//                } catch (\Exception $e) {
//                }
//            }
//        }
//        return back()->with('message', '留言成功！');
    }
}
