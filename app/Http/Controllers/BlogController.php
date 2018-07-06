<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $articles = Article::select(['id', 'title', 'title_trans', 'created_at', 'type', 'cover', 'abstract', 'view_count', 'like_count', 'comment_count'])
            ->whereType(1)
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $hots = Article::whereType(1)
            ->orderBy('view_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get(['id', 'title', 'title_trans', 'created_at', 'type']);
        return view('blog.index', compact('articles', 'hots', 'q'));
    }

    /**
     * 显示详情
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $article = Article::whereType(1)->where('id', $id)->firstOrFail();
        $article->view_count += 1;
        $article->save();
        $q = $request->q;
        $comment_cache = json_decode($request->cookie('comment'));
        $preArticle = $article->pre;
        $nextArticle = $article->next;
        return view('blog.show', compact('article', 'q', 'comment_cache', 'preArticle', 'nextArticle'));
    }

    /**
     * 保存评论
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function commentStore(Request $request)
    {
        $this->validate($request, [
            'aid'      => 'required|integer',
            'username' => 'required|string|max:100',
            'email'    => 'required|email',
            'content'  => 'required',
            'captcha'  => 'captcha'
        ], [
            'captcha.captcha' => '验证码错误，请重试！'
        ]);
        $comment = new ArticleComment($request->all());
        $comment->website = (string)$request->get('website', '');
        $comment->save();

        Article::where('id', $request->aid)->increment('comment_count');

        $comment->content = '';
        \Cookie::queue('comment', $comment, time());
        return redirect(url()->previous() . '#' . $comment->username);
    }
}
