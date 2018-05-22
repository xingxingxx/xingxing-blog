<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
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

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        Article::create(request()->all());
        return redirect('/');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->type = $request->type;
        $article->content = $request->input('content');
        $article->save();
        return redirect(route('show', ['id' => $id]));
    }
}
