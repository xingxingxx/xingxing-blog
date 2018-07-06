<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $articles = Article::select(['id', 'title', 'title_trans', 'created_at', 'updated_at','type', 'cover', 'abstract', 'view_count', 'like_count', 'comment_count'])
            ->when($title, function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.blog.index', compact('articles', 'title'));
    }

    /**
     * 显示新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * 保存新增
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Article::create($request->all());
        return redirect(route('admin.blog.index'));
    }

    /**
     * 显示编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.blog.edit', compact('article'));
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
        return redirect(route('admin.blog.index'));
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
        return redirect(route('admin.blog.index'));
    }


    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        Article::destroy($id);
        return redirect(route('admin.blog.index'));
    }

}
