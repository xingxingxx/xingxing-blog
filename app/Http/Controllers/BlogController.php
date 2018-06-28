<?php

namespace App\Http\Controllers;

use App\Article;
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
        $articles = Article::select(['id', 'title', 'title_trans', 'created_at', 'type', 'cover', 'abstract','view_count','like_count'])
            ->when(\Auth::guest(), function ($query) {
                $query->where('type', 1);
            })
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $hots = Article::when(\Auth::guest(), function ($query) {
            $query->where('type', 1);
        })
            ->orderBy('view_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get(['id', 'title', 'title_trans', 'created_at', 'type']);
        return view('blog.index', compact('articles', 'hots', 'q'));
    }

    /**
     * 显示新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * 保存新增
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return redirect($article->info_url);
    }

    /**
     * 显示详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        if (\Auth::guest()) {
            $article = Article::whereType(1)->where('id', $id)->firstOrFail();
        } else {
            $article = Article::findOrFail($id);
        }
        $article->view_count += 1;
        $article->save();
        $q = $request->q;
        return view('blog.show', compact('article', 'q'));
    }

    /**
     * 显示编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('blog.edit', compact('article'));
    }

    /**
     * 保存编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->input('content');
        $article->save();
        return redirect($article->info_url);
    }

    /**
     * 设置是否发布
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function settingType(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->type = $request->type;
        $article->save();
        return back();
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        Article::destroy($id);
        return back();
    }
}
