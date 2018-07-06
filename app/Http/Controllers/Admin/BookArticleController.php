<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\BookArticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookArticleController extends Controller
{
    /**
     * @param $book_id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($book_id, Request $request)
    {
        $book = Book::findOrFail($book_id);
        $articles = BookArticle::whereBookId($book_id)->get(['id', 'title', 'book_id', 'created_at', 'updated_at']);
        return view('admin.book.article.index', compact('book', 'articles'));
    }

    /**
     * @param int $book_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($book_id)
    {
        if ($book_id) {
            return view('admin.book.article.create', compact('book_id'));
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
        return redirect(route('admin.book.article.index', ['book_id' => $body->book_id]));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = BookArticle::findOrFail($id);
        return view('admin.book.article.edit', compact('article'));
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
        return redirect(route('admin.book.article.index', ['book_id' => $article->book_id]));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $article = BookArticle::findOrFail($id);
        BookArticle::destroy($id);
        return redirect(route('admin.book.article.index', ['book_id' => $article->book_id]));
    }
}
