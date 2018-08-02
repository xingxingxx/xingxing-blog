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
        $data = BookArticle::whereBookId($book_id)->get(['id', 'title', 'book_id', 'parent_id', 'sort']);
        $id = $request->id;
        if ($id) {
            $article = BookArticle::findOrFail($id);
        } else {
            $article = BookArticle::whereBookId($book_id)->first();
        }
        $menus = $this->displayData($data, $article->id);
        return view('book.show', compact('book', 'menus', 'article'));
    }


    private function displayData($data, $curentId, $pid = 0, $level = 0)
    {
        $body = '';
        $paddingLeft = 10 + $level * 10;
        $level++;
        foreach ($data as $item) {
            $showUrl = route('book.show', ['book_id' => $item->book_id, 'id' => $item->id]);
            $active = $item->id == $curentId ? 'font-weight:bold; ' : '';
            $activeId = $item->id == $curentId ? 'id="activeArticle"' : '';
            if ($item->parent_id == $pid) {
                $body .= <<<EOF
               <a {$activeId} href="{$showUrl}"
                                   style="color:#505050; display: block;padding:10px 10px 10px {$paddingLeft}px;
                                   {$active}">{$item->title}</a>
EOF;
                $body .= $this->displayData($data, $curentId, $item->id, $level);
            }
        }
        return $body;
    }
}
