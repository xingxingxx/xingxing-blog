@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($articles as $key=>$article)
                    <div class="card" @if($key>0)style="margin-top:15px;"@endif>
                        <div class="card-body">
                            <h5>
                                <a style="color:@if($article->type==1)#336699 @else #ddd @endif;"
                                   href="{{ route('show',['id'=>$article->id]) }}">{{ $article->title }}</a>

                            </h5>
                            <p>
                                <a style="color:@if($article->type==1)#505050 @else #ddd @endif;"
                                   href="{{ route('show',['id'=>$article->id]) }}">
                                    {!! MarkdownEditor::parse($article->abstract) !!}
                                </a>
                            </p>
                            <p>{{ $article->created_at }}</p>
                            @if(\Auth::check())
                                <p>
                                <form action="{{ route('delete',['id'=>$article->id]) }}" method="POST"
                                      style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit"
                                           style="border:none;background-color: transparent;color:#0056b3;"
                                           value="删除文章"
                                           onclick="return confirm('确定要删除吗？');">
                                </form>
                                <a style="display: inline-block;" href="{{ route('edit',['id'=>$article->id]) }}">更新文章</a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
                <p style="margin-top:15px;"> {!! $articles->links() !!}</p>
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">关于我</div>

                    <div class="card-body">
                        个人简介：php工程师，热爱编程<br>
                        目前工作城市：深圳<br>
                        邮箱：<a style="color:#336699;" href="Mailto:xx9815@qq.com">xx915@qq.com</a><br>
                        github：<a style="color:#336699;" target="_blank" href="https://github.com/xingxingxx">https://github.com/xingxingxx</a><br>
                        微博：<a style="color:#336699;" target="_blank" href="http://weibo.com/u/3026783454">http://weibo.com/u/3026783454</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection