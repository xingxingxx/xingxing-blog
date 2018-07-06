@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    @if($article)
                        <div class="card-body">
                            <h3 class="text-center">{{ $article->title }}</h3>
                            <p class="text-center">发布时间：{{ $article->created_at }}</p>
                            <p id="doc-content">
                                <textarea style="display:none;"> {!! $article->content !!} </textarea>
                            </p>
                            @if($preArticle)
                                <p>上一篇：<a style="color:#336699;"
                                          href="{{ route('book.show',['book_id'=>$preArticle->book_id,'id'=>$preArticle->id]) }}">{{ $preArticle->title }}</a>
                                </p>
                            @endif
                            @if($nextArticle)
                                <p>下一篇：<a style="color:#336699;"
                                          href="{{ route('book.show',['book_id'=>$nextArticle->book_id,'id'=>$nextArticle->id]) }}">{{ $nextArticle->title }}</a>
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
    <link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}"/>
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