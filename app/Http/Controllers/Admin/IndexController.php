<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Book;
use App\Special;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $blog_count = Article::count();
        $special_count = Special::count();
        $book_count = Book::count();
        $user_count = User::count();
        return view('admin.index', compact('user', 'blog_count', 'special_count', 'book_count', 'user_count'));
    }

    /**
     * 更新用户信息
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateAdmin(Request $request)
    {
        $user = $request->user();
        $user->avatar = (string)$request->avatar;
        $user->name = (string)$request->name;
        $user->email = (string)$request->email;
        $user->weibo = (string)$request->weibo;
        $user->sign = (string)$request->sign;
        $user->github = (string)$request->github;
        $user->wechat = (string)$request->wechat;
        $user->qq = (string)$request->qq;
        $user->save();
        return redirect(route('admin.index'));
    }
}
