@extends('layouts.app')
@section('title', '博客首页')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        @forelse($articles as $article)
                            <h5 style="padding-bottom:10px;color:#333;"><strong>
                                    <a href="{{ $article->info_url }}"
                                       style="color:#333;">{{ $article->title }}</a>
                                </strong>
                            </h5>
                            <div class="row">
                                <div class=" {{ $article->cover?'col-md-8' :'col-md-12'}}">
                                    <div style="margin-bottom: 5px;">
                                        <a href="{{ $article->info_url }}"
                                           style="color:#333;">{{ $article->abstract }}</a>
                                    </div>
                                    <div>
                                        发布于&nbsp;{{ $article->created_at->format('Y-m-d') }}
                                        &nbsp;&nbsp;
                                        阅读&nbsp;({{ $article->view_count }})
                                        &nbsp;&nbsp;
                                        评论&nbsp;({{ $article->comment_count }})
                                    </div>
                                </div>
                                @if($article->cover)
                                    <div class="col-md-4">
                                        <a href="{{ $article->info_url }}">
                                            <img style="width:100%;" src="{{ $article->cover }}"></a>
                                    </div>
                                @endif
                            </div>
                            <br>
                            <hr><br>
                        @empty
                            <p><h4 class="text-center">抱歉！没有找到您需要的文章</h4></p>
                        @endforelse
                        <div> {!! $articles->links() !!}</div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        <h5>关注</h5>
                        <hr>
                        <div style="text-align: center;">
                            <img  style="width:35%;border-radius:50%;"  src="{{ asset('img/my_avatar_big.jpg') }}">
                            <div style="margin-bottom:5px;"><strong>Sampson</strong></div>
                            不溺过去，不惧未来<br>
                            <a style="color:#505050;" target="_blank" href="https://github.com/xingxingxx">Github</a>&nbsp;|&nbsp;
                            <a style="color:#505050;" target="_blank" href="http://weibo.com/u/3026783454">微博</a>&nbsp;|&nbsp;
                            <a style="color:#505050;" target="_blank" href="Mailto:xx9815@qq.com">邮箱</a>

                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        <h5>点击排行</h5>
                        <hr>
                        @foreach($hots as $key=>$hot)
                            <div style="margin-bottom:5px;">
                                <a style="color:#505050;" href="{{ $hot->info_url }}">{{ $key+1 }}.&nbsp;&nbsp;{{ $hot->title }}</a>
                                    &nbsp;
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        <h5>标签云</h5>
                        <hr>
                        <a href="{{ route('index',['q'=>'php']) }}" style="color:#333;"
                           class="btn btn-sm btn-default"><span
                                    class="label label-default">PHP</span></a>
                        <a href="{{ route('index',['q'=>'laravel']) }}" style="color:#333;"
                           class="btn btn-sm btn-default"><span
                                    class="label label-default">Laravel</span></a>
                        <a href="{{ route('index',['q'=>'设计模式']) }}" style="color:#333;" class="btn btn-sm btn-default"><span
                                    class="label label-default">设计模式</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection