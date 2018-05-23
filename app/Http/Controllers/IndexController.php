<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (\Auth::guest()) {
            $articles = Article::select(\DB::raw('id,title,created_at,type,left(content COLLATE utf8mb4_general_ci, 200) as abstract'))
                ->where('type', 1)
                ->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $articles = Article::select(\DB::raw('id,title,created_at,type,left(content COLLATE utf8mb4_general_ci, 200) as abstract'))
                ->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('index', compact('articles'));
    }

    /**
     * 显示新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('create');
    }

    /**
     * 保存新增
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $article = Article::create(request()->all());
        return redirect($article->info_url);
    }

    /**
     * 显示详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        if (\Auth::guest()) {
            $article = Article::where('type', 1)->where('id', $id)->firstOrFail();
        } else {
            $article = Article::findOrFail($id);
        }
        return view('show', compact('article'));
    }

    /**
     * 显示编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('edit', compact('article'));
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
