<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class MarkdownController extends Controller
{
    static $_errors = array();
    static $_url = array();
    static $real_path;


    protected static function addError($message)
    {
        if (!empty($message)) {
            self::$_errors[] = $message;
        }
    }

    public function __construct()
    {
        if (config('app.debug')) {
            config('debugbar.inject', false);
        }
    }

    protected static function getLastError()
    {
        return empty(self::$_errors) ? '' : array_pop(self::$_errors);
    }

    /**
     * 文件上传
     * @return array
     */
    public static function upload()
    {
        try {
            if (Request::hasFile('editormd-image-file')) {
                $pic = Request::file('editormd-image-file');
                if ($pic->isValid()) {
                    $path = config('markdowneditor.connections.local.prefix', 'uploads');
                    $newName = date('Ymd-His') . '-' . rand(100, 999) . '.' . $pic->getClientOriginalExtension();
                    //本地保存
                    $pic->move($path, $newName);
                    self::$_url['local'] = asset($path . '/' . $newName);
                    //本地保存绝对路径
                    self::$real_path = $path . '/' . $newName;
                } else {
                    self::addError('The file is invalid');
                }
            } else {
                self::addError('Not File');
            }
        } catch (\Exception $e) {
            self::addError($e->getMessage());
        }

        $data = array(
            'success' => empty(self::getLastError()) ? 1 : 0,
            'message' => self::getLastError() ?: 'success',
            'url'     => isset(self::$_url[config('markdowneditor.default')])
            && empty(self::getLastError())
                ? self::$_url[config('markdowneditor.default')] : ''
        );
        return $data;
    }

}
