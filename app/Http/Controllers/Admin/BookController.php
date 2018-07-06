<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.book.index', compact('books'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.book.create');
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
        return redirect(route('admin.book.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.book.edit', compact('book'));
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
        return redirect(route('admin.book.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        Book::destroy($id);
        return redirect(route('admin.book.index'));
    }
}
