@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    @if($article)
                    <div class="card-body">
                        <h3 class="text-center">{{ $article->title }}</h3>
                        <div class="text-center">
                            <a href="{{ route('book.article.edit',['id'=>$article->id]) }}"
                               class="btn btn-sm btn-primary">编辑</a>
                            <form action="{{ route('book.article.delete',['id'=>$article->id]) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                       class="btn btn-sm btn-default"
                                       value="删除"
                                       onclick="return confirm('确定要删除吗？');">
                            </form>
                        </div>
                        <p class="text-center">发布时间：{{ $article->created_at }}</p>
                        <p id="doc-content">
                            <textarea style="display:none;"> {!! $article->content !!} </textarea>
                        </p>
                        @if($article->pre)
                            <p>上一篇：<a style="color:#336699;" href="{{ route('book.show',['book_id'=>$article->pre->book_id,'id'=>$article->pre->id]) }}">{{ $article->pre->title }}</a>
                            </p>
                        @endif
                        @if($article->next)
                            <p>下一篇：<a style="color:#336699;" href="{{ route('book.show',['book_id'=>$article->next->book_id,'id'=>$article->next->id]) }}">{{ $article->next->title }}</a>
                            </p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="list-group">
                    <a style="color:#505050;" href="{{ route('book.index') }}"
                       class="list-group-item"><h5>{{ $book->title }}</h5></a>

                    @foreach($menus as $menu)
                        <a href="{{ route('book.show',['book_id'=>$menu->book_id,'id'=>$menu->id]) }}"
                           style="color:#505050;"
                           class="list-group-item @if($menu->id==$article->id) active @endif">{{ $menu->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}" />
    <script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>

    <script type="text/javascript">
      $(function () {
        editormd.markdownToHTML("doc-content", {
          htmlDecode: "style,script,iframe",
          emoji: true,
          taskList: true,
          tex: true, // 默认不解析
          flowChart: true, // 默认不解析
          sequenceDiagram: true, // 默认不解析
          codeFold: true,
        });
      });
    </script>
@endsection