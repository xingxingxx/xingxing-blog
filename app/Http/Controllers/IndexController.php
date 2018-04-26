<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::select('*')->orderBy('created_at', 'desc')->paginate(10);
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
