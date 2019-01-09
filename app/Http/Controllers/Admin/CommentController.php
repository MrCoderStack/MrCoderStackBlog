<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\MyFunction;
use App\Comment;
use Auth;

class CommentController extends Controller
{

    //评论列表
    public function index(Request $request)
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate($request->pagesize);
        foreach ($comments as $comment) {
            $comment->key = $comment->id;
            $comment->article_name = $comment->article->title;
            $comment->location = '/articles/' . $comment->article_id . '#comment' . $comment->id;
        }
        return $comments;
    }

    //删除评论
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        //TODO 删除评论下的回复
        $comment->delete();
        return response()->json([
            'message' => '删除成功!'
        ]);
    }
}
