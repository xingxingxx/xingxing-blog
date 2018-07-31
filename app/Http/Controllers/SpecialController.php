<?php

namespace App\Http\Controllers;

use App\Article;
use App\Special;
use Illuminate\Http\Request;

class SpecialController extends Controller
{
    public function index()
    {
        $specials = Special::orderBy('created_at', 'desc')->paginate();
        return view('special.index', compact('specials'));
    }

    public function show($special_id)
    {
        $special = Special::findOrFail($special_id);
        $articles = Article::whereSpecialId($special_id)
            ->whereType(1)->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('special.show', compact('articles','special'));
    }
}
