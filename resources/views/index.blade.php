@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($articles as $key=>$article)
                    <div class="card" @if($key>0)style="margin-top:15px;"@endif>
                        <div class="card-body">
                            <h5>
                                <a style="color:#333;"
                                   href="{{ route('show',['id'=>$article->id]) }}">{{ $article->title }}</a>
                                @guest
                                @else
                                    <a style="float:right;" class="btn btn-md btn-default"
                                       href="{{ route('edit',['id'=>$article->id]) }}">更新文章</a>
                                @endguest
                            </h5>
                            <p>
                                <a style="color:#333;" href="{{ route('show',['id'=>$article->id]) }}">
                                    {!! MarkdownEditor::parse(str_limit($article->content,200))!!}
                                </a>
                            </p>
                        </div>
                    </div>
                @endforeach
                <p style="margin-top:15px;"> {!! $articles->links() !!}</p>
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">关于我</div>

                    <div class="card-body">
                        邮箱：<a href="Mailto:xx9815@qq.com">xx915@qq.com</a><br>
                        github：<a target="_blank" href="https://github.com/xingxingxx">https://github.com/xingxingxx</a><br>
                        微博：<a target="_blank" href="http://weibo.com/u/3026783454">http://weibo.com/u/3026783454</a><br>
                        自己写的玩的一个个人博客，基于laravel框架,前端在bootstrap的基础上做的定制<br>
                        很多地方还没有完成，后台系统，基本上现在只是做了下文章的增删改，所以后期还会进一步完善。<br>
                        我已经将博客的源码放到github上<a target="_blank" href="https://github.com/xingxingxx/myblog-laravel">https://github.com/xingxingxx/myblog-laravel</a>，随时可以获取。
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection