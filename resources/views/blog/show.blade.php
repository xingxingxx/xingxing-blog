@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        {!! $article->update_button !!}
                        <h5 class="text-center">
                            {{ $article->title }}
                        </h5>
                        <p class="text-center">发布时间：{{ $article->created_at }}</p>
                        <p id="doc-content">
                            <textarea style="display:none;"> {!! $article->content !!} </textarea>
                        </p>
                        @if($article->pre)
                            <p>上一篇：<a style="color:#336699;"
                                      href="{{ $article->pre->info_url }}">{{ $article->pre->title }}</a>
                            </p>
                        @endif
                        @if($article->next)
                            <p>下一篇：<a style="color:#336699;"
                                      href="{{ $article->next->info_url }}">{{ $article->next->title }}</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('vendor/markdown/js/jquery.min.js')}}"></script>
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