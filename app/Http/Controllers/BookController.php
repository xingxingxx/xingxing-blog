<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookArticle;
use App\BookArticleComment;
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
        $comment_cache = json_decode($request->cookie('comment'));
        return view('book.show', compact('book', 'menus', 'article', 'comment_cache'));
    }


    private function displayData($data, $curentId, $pid = 0, $level = 0)
    {
        $body = '';
        $paddingLeft = $level * 20;
        $level++;
        foreach ($data as $item) {
            $showUrl = route('book.show', ['book_id' => $item->book_id, 'id' => $item->id]);
            $active = $item->id == $curentId ? 'color:#008cff;' : 'color:#505050;';
            $activeId = $item->id == $curentId ? 'id="activeArticle"' : '';
            if ($item->parent_id == $pid) {
                $body .= <<<EOF
               <a {$activeId} href="{$showUrl}"
                                   style="display: block;padding:5px 10px 5px {$paddingLeft}px;
                                   {$active}">{$item->title}</a>
EOF;
                $body .= $this->displayData($data, $curentId, $item->id, $level);
            }
        }
        return $body;
    }

    /**
     * 保存评论
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function commentStore(Request $request)
    {
        $this->validate($request, [
            'aid'      => 'required|integer',
            'username' => 'required|string|max:100',
            'email'    => 'required|email',
            'content'  => 'required',
            'captcha'  => 'captcha',
        ], [
            'username.required' => '请填写您的姓名',
            'username.max'      => '姓名长度不能超过100个字符',
            'email.required'    => '请填写您的邮箱',
            'email.email'       => '邮箱地址格式不正确',
            'content.required'  => '请填写评论内容',
            'captcha.captcha'   => '验证码错误，请重试！',
        ]);
        $comment = new BookArticleComment($request->all());
        $comment->website = (string)$request->get('website', '');
        $comment->save();

        $data = $comment->toArray();
        $comment->content = '';
        \Cookie::queue('comment', $comment, time());
        return response()->json($data);
    }
}
