@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body" style="padding:0;">
                    <div id="menu" class="position-fixed" style="padding:20px;background-color:#fff;bottom:0;top:76px;overflow: scroll; width:280px;">
                        <a style="color:#505050; display: block;"
                           href="{{ route('book.index') }}">
                            <h5>{{ $book->title }}</h5></a>
                        <hr>
                        @foreach($menus as $menu)
                            <a href="{{ route('book.show',['book_id'=>$menu->book_id,'id'=>$menu->id]) }}"
                               style="color:#505050; display: block;padding:10px 0;
                               @if($menu->id==$article->id) font-weight:bold;  @endif">{{ $menu->title }}</a>
                        @endforeach
                    </div>

                    @if($article)
                        <div style="margin-left:280px; padding:60px 60px; height:100%;">
                            <h3 class="text-center">{{ $article->title }}</h3>
                            <p class="text-center">发布时间：{{ $article->created_at->format('Y-m-d') }}</p>
                            <p id="doc-content">
                                <textarea style="display:none;"> {!! $article->content !!} </textarea>
                            </p>
                            @if($preArticle)
                               <a class="position-fixed" style="text-decoration:none;color:#dddddd;font-size:30px;display:block;margin-left:-50px;top:50%;z-index: 9999999;"
                                  href="{{ route('book.show',['book_id'=>$preArticle->book_id,'id'=>$preArticle->id]) }}">《</a>
                            @endif
                            @if($nextArticle)
                               <div style="float:right;">
                                   <a class="position-fixed" style="text-decoration:none;color:#dddddd;font-size:30px;display: block;margin-left:10px;top:50%;z-index: 999999;" href="{{ route('book.show',['book_id'=>$nextArticle->book_id,'id'=>$nextArticle->id]) }}">》</a>
                               </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" id="topMao" style="display: block;position: fixed;bottom:50px;right:30px;"><img src="{{ asset('img/top.png') }}"></a>
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
                flowChart: true, // 默认不解析
                sequenceDiagram: true, // 默认不解析
                codeFold: true,
            });
        });
        var tit = document.getElementById('menu');
        var titleTop = tit.offsetTop;
        //滚动事件
        document.onscroll = function () {
            //获取当前滚动的距离
            var btop = document.body.scrollTop || document.documentElement.scrollTop;
            //如果滚动距离大于导航条据顶部的距离
            if (btop >= titleTop) {
                tit.style.top="0px";
            } else {
                tit.style.top=(titleTop-btop)+'px';
            }
        }
    </script>
@endsection