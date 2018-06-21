<?php

namespace App\Http\Controllers;

use App\BookArticle;
use Illuminate\Http\Request;

class BookArticleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $book_id = $request->book_id;
        if ($book_id) {
            return view('book.article.create', compact('book_id'));
        } else {
            abort(404);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $body = new BookArticle();
        $body->title = $request->title;
        $body->book_id = $request->book_id;
        $body->parent_id = 0;
        $body->content = $request->input('content');
        $body->save();
        return redirect(route('book.show', ['book_id' => $body->book_id,'id'=>$body->id]));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = BookArticle::findOrFail($id);
        return view('book.article.edit', compact('article'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $article = BookArticle::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->input('content');
        $article->save();
        return redirect(route('book.show', ['book_id' => $article->book_id, 'id' => $article->id]));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $article = BookArticle::findOrFail($id);
        BookArticle::destroy($id);
        return redirect(route('book.show', ['book_id' => $article->book_id]));
    }
}
