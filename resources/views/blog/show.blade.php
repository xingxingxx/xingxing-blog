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
                        <p>
                            @if($article->pre)
                                上一篇：<a style="color:#336699;" href="{{ $article->pre->info_url }}">{{ $article->pre->title }}</a>
                                <br>
                            @endif
                            @if($article->next)
                                下一篇：<a style="color:#336699;" href="{{ $article->next->info_url }}">{{ $article->next->title }}</a>
                            @endif
                        </p>
                        <p class="text-center" style="margin-top:20px;">
                            如果这篇文章帮助到了您，可以赞助下主机费~~<br>
                        </p>
                        <p class="text-center">
                            <button class="btn btn-success" id="zanshang">赞赏</button>
                            <br>
                            <img id="zanshangImg" style="display: none;text-align: center;" width="300px;"
                                 src="{{ asset('img/wechat_zanshang.jpg') }}">
                        </p>
                    </div>
                </div>
                <div class="card" style="margin-top:15px;">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>
    <script type="text/javascript">
      $(function () {
        $('#zanshang').click(function () {
          $("#zanshangImg").toggle(500);
        });
        editormd.markdownToHTML("doc-content", {
          htmlDecode: "style,script,iframe",
          emoji: true,
          taskList: true,
          tex: true,
          flowChart: false,
          sequenceDiagram: false,
          codeFold: true,
        });
      });
    </script>
@endsection