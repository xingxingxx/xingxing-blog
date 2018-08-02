@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 10px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body" style="padding:0;">
                    <div id="menu" class="position-fixed"
                         style="padding:20px;background-color:#fff;bottom:0;top:66px;overflow: scroll; width:280px;">
                        <a style="color:#505050; display: block;"
                           href="{{ route('book.index') }}">
                            <h5>{{ $book->title }}</h5></a>
                        <hr>
                        {!! $menus !!}
                    </div>

                    @if($article)
                        <div style="margin-left:280px; padding:60px 60px; height:1000px;">
                            <p id="doc-content">
                                <textarea style="display:none;"> {!! $article->content !!} </textarea>
                            </p>
                            <a id="preArticle" class="position-fixed"
                               style="text-decoration:none;color:#dddddd;font-size:30px;display:none;margin-left:-50px;top:50%;z-index: 9999999;"
                               href="#">《</a>

                            <div style="float:right;">
                                <a id="nextArticle" class="position-fixed"
                                   style="text-decoration:none;color:#dddddd;font-size:30px;display: none;margin-left:10px;top:50%;z-index: 999999;"
                                   href="#">》</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" id="topMao" style="display: block;position: fixed;bottom:50px;right:30px;"><img
                src="{{ asset('img/top.png') }}"></a>
@endsection

@section('script')
    <link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}"/>
    <script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>

    <script type="text/javascript">
        $('#topMao').click(function () {
            $("html,body").animate({scrollTop: $("#app").offset().top}, 500);
        });

        $(function () {
            editormd.markdownToHTML("doc-content", {
                htmlDecode: "style,script,iframe",
                emoji: true,
                taskList: true,
                tex: true, // 默认不解析
                flowChart: false, // 默认不解析
                sequenceDiagram: false, // 默认不解析
                codeFold: true,
            });

            var pre = $('#activeArticle').prev().attr('href');
            var next = $('#activeArticle').next().attr('href');
            if (pre) {
                $('#preArticle').show();
                $('#preArticle').attr('href', pre);
            }
            if (next) {
                $('#nextArticle').show();
                $('#nextArticle').attr('href', next);
            }
        });
        var tit = document.getElementById('menu');
        var titleTop = tit.offsetTop;
        //滚动事件
        document.onscroll = function () {
            //获取当前滚动的距离
            var btop = document.body.scrollTop || document.documentElement.scrollTop;
            //如果滚动距离大于导航条据顶部的距离
            if (btop >= titleTop) {
                tit.style.top = "0px";
            } else {
                tit.style.top = (titleTop - btop) + 'px';
            }
        }
    </script>
@endsection