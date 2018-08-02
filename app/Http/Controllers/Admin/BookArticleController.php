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
        $articles = BookArticle::whereBookId($book_id)->get(['id', 'title', 'sort', 'parent_id', 'book_id', 'created_at', 'updated_at']);
        $displayData = $this->displayData($articles);
        return view('admin.book.article.index', compact('book', 'displayData'));
    }

    private function displayData($data, $pid = 0, $level = 0)
    {
        $body = '';
        $paddingLeft = $level * 20;
        $level++;
        foreach ($data as $item) {
            $showUrl = route('book.show', ['book_id' => $item->book_id, 'id' => $item->id]);
            $editUrl = route('admin.book.article.edit', ['id' => $item->id]);
            $addUrl = route('admin.book.article.create', ['book_id' => $item->book_id, 'parent_id' => $item->id]);
            $deleteUrl = route('admin.book.article.delete', ['id' => $item->id]);
            $csrf = csrf_field();
            $method = method_field('DELETE');
            if ($item->parent_id == $pid) {
                $body .= <<<EOF
                <tr>
                    <td>{$item->id}</td>
                    <td style="padding-left: {$paddingLeft}px;">{$item->title}</td>
                    <td>{$item->created_at}</td>
                    <td>{$item->updated_at}</td>
                    <td>
                        <a target="_blank"
                           href="{$showUrl}"
                           class="btn btn-sm btn-default">查看</a>
                         <a href="{$addUrl}"
                           class="btn btn-sm btn-primary">新增</a>
                        <a href="{$editUrl}"
                           class="btn btn-sm btn-primary">编辑</a>
                         
                        <form action="{$deleteUrl}"
                              method="POST"
                              style="display: inline-block;">
                            {$csrf}
                            {$method}
                            <input type="submit"
                                   class="btn btn-sm btn-default"
                                   value="删除"
                                   onclick="return confirm(\'确定要删除吗？\');">
                        </form>
                    </td>
                </tr>
EOF;
                $body .= $this->displayData($data, $item->id, $level);
            }
        }
        return $body;

    }

    /**
     * @param $book_id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($book_id, Request $request)
    {
        if ($book_id) {
            $parent_id = $request->parent_id;
            return view('admin.book.article.create', compact('book_id', 'parent_id'));
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
        $body->parent_id = $request->parent_id;
        $body->sort = 0;
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
        $article->parent_id = $request->parent_id;
        $article->sort = 0;
        $article->content = $request->get('content');
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
