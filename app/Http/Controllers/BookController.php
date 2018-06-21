<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookArticle;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate();
        return view('book.index', compact('books'));
    }

    /**
     * @param $book_id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($book_id, Request $request)
    {
        $book = Book::findOrFail($book_id);
        $menus = BookArticle::where('book_id', $book_id)->get(['id', 'title', 'book_id']);
        $id = $request->id;
        if ($id) {
            $article = BookArticle::findOrFail($id);
        } else {
            $article = BookArticle::where('book_id', $book_id)->first();
        }
        return view('book.show', compact('book', 'menus', 'article'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->cover = $request->cover;
        $book->description = $request->description;
        $book->save();
        return redirect(route('book.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('book.edit', compact('book'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->title = $request->title;
        $book->cover = $request->cover;
        $book->description = $request->description;
        $book->save();
        return redirect(route('book.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        Book::destroy($id);
        return redirect(route('book.index'));
    }
}
