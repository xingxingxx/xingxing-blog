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
        $menus = BookArticle::whereBookId($book_id)->get(['id', 'title', 'book_id']);
        $id = $request->id;
        if ($id) {
            $article = BookArticle::findOrFail($id);
        } else {
            $article = BookArticle::whereBookId($book_id)->first();
        }
        $preArticle = $article->pre;
        $nextArticle = $article->next;
        return view('book.show', compact('book', 'menus', 'article', 'preArticle', 'nextArticle'));
    }
}
