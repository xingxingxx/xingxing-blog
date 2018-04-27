@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($articles as $key=>$article)
                    @if($article->type==1)
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
                                <p>{{ $article->created_at }}</p>
                            </div>
                        </div>
                    @else
                        @guest
                        @else
                            <div class="card" @if($key>0)style="margin-top:15px;"@endif>
                                <div class="card-body">
                                    <h5>
                                        <a style="color:#ddd;"
                                           href="{{ route('show',['id'=>$article->id]) }}">{{ $article->title }}</a>
                                        <a style="float:right;" class="btn btn-md btn-default"
                                           href="{{ route('edit',['id'=>$article->id]) }}">更新文章</a>
                                    </h5>
                                    <p>
                                        <a style="color:#ddd;" href="{{ route('show',['id'=>$article->id]) }}">
                                            {!! MarkdownEditor::parse(str_limit($article->content,200))!!}
                                        </a>
                                    </p>
                                    <p>{{ $article->created_at }}</p>
                                </div>
                            </div>
                        @endguest
                    @endif
                @endforeach
                <p style="margin-top:15px;"> {!! $articles->links() !!}</p>
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">关于我</div>

                    <div class="card-body">
                        个人简介：php工程师，热爱编程<br>
                        目前工作城市：深圳<br>
                        邮箱：<a href="Mailto:xx9815@qq.com">xx915@qq.com</a><br>
                        github：<a target="_blank" href="https://github.com/xingxingxx">https://github.com/xingxingxx</a><br>
                        微博：<a target="_blank" href="http://weibo.com/u/3026783454">http://weibo.com/u/3026783454</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection