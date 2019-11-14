<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * 图片上传上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function image(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240',
        ]);
        $path = $request->file('file')->store('file');
        return response()->json([
            'path' => $path,
            'code' => 200,
        ]);
    }

    /**
     * markdown图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markdown(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'editormd-image-file' => 'required|image|max:10240',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'success' => 0,
                'message' => $errors->first('editormd-image-file'),
                'url'     => '',
            ]);
        }
        $path = $request->file('editormd-image-file')->store('markdown');
        return response()->json([
            'success' => 1,
            'message' => 'success',
            'url'     => \Storage::url($path),
        ]);
    }

    /**
     * 删除图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);
        \Storage::delete($request->path);
        return response()->json([
            'msg'  => '删除成功',
            'code' => 200,
        ]);
    }
}
