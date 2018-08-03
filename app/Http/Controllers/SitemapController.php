<?php

namespace App\Http\Controllers;

use App\Article;
use App\Book;
use App\BookArticle;
use App\Special;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $article = Article::whereType(1)->orderBy('updated_at', 'desc')->first();
        $special = Special::orderBy('updated_at', 'desc')->first();
        $book = Book::orderBy('updated_at', 'desc')->first();
        $bookArticle = BookArticle::orderBy('updated_at', 'dec')->first();

        return response()->view('sitemap.index',
            compact('article', 'special', 'book', 'bookArticle'))
            ->header('Content-Type', 'text/xml');
    }

    public function articles()
    {
        $articles = Article::whereType(1)->orderBy('updated_at', 'desc')
            ->get(['id', 'title', 'title_trans', 'created_at', 'type', 'updated_at']);
        return response()->view('sitemap.articles',
            compact('articles'))
            ->header('Content-Type', 'text/xml');
    }

    public function specials()
    {
        $specials = Special::orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.specials',
            compact('specials'))
            ->header('Content-Type', 'text/xml');
    }

    public function books()
    {
        $books=Book::orderBy('updated_at','desc')->get();
        return response()->view('sitemap.books',
            compact('books'))
            ->header('Content-Type', 'text/xml');
    }

    public function bookArticles()
    {
        $bookArticles=BookArticle::orderBy('updated_at','desc')->get(['id','title','book_id']);
        return response()->view('sitemap.book_articles',
            compact('bookArticles'))
            ->header('Content-Type', 'text/xml');
    }
}
