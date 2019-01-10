<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;

class CatesController extends Controller
{

    public function index()
    {
        $cates = Cate::all();
        $catesArr = array();
        foreach ($cates as $cate) {
            $cate->key = $cate->id;
            array_push($catesArr, $cate->name);
        }
        return response()->json([
            'cates' => $cates,
            'catesArr' => $catesArr,
        ]);
    }

    public function destroy($id)
    {
        $cate = Cate::findOrFail($id);
        Article::where('cate_id', $id)->update(['cate_id' => null]);
        $cate->delete();
        return response()->json([
            'message' => '删除成功！'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'cate_name' => 'required|string|unique:cates,name',
        ];
        $message = [
            'cate_name.required' => '分类名称缺失',
            'cate_name.string' => '分类名称类型错误',
            'cate_name.unique' => '分类名称已存在',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['code' => 400, 'message' => $errors->first()];
        }


        $cateModel = Cate::create(['name' => $request->cate_name]);
        if ($cateModel) {
            $code = 200;
            $msg = '添加成功！';
        } else {
            $code = 400;
            $msg = '添加失败！';
        }
        return response()->json([
            'code' => $code,
            'message' => $msg
        ]);
    }
}
