@extends('layouts.app')
@section('title', '博客首页')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding-right: 0;">
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        @forelse($articles as $article)
                            <h5 style="padding-bottom:10px;"><strong>
                                    <a href="{{ $article->info_url }}">{{ $article->title }}</a>
                                </strong>
                            </h5>
                            <div class="row" style="padding-bottom:10px;">
                                <div class=" {{ $article->cover?'col-md-8' :'col-md-12'}}">
                                    <div style="margin-bottom: 5px;">
                                        <a href="{{ $article->info_url }}">{{ $article->abstract }}</a>
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
                            <hr><br>
                        @empty
                            <p><h4 class="text-center">抱歉！没有找到您需要的文章</h4></p>
                        @endforelse
                        <div> {!! $articles->links() !!}</div>
                    </div>
                </div>

            </div>
            <div class="col-md-4" style="padding-left:20px;">
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        <h5>关注</h5>
                        <hr>
                        <div style="text-align: center;">
                            <img  style="width:35%;border-radius:50%;"  src="{{ asset('img/my_avatar_big.jpg') }}">
                            <div style="margin-bottom:5px;"><strong>Sampson</strong></div>
                            不溺过去，不惧未来<br>
                            <a target="_blank" href="https://github.com/xingxingxx">Github</a>&nbsp;|&nbsp;
                            <a target="_blank" href="http://weibo.com/u/3026783454">微博</a>&nbsp;|&nbsp;
                            <a target="_blank" href="Mailto:xx9815@qq.com">邮箱</a> |
                            <a target="_blank" href="{{ asset('img/wechat_contact.jpeg') }}">微信</a> |
                            <a target="_blank" href="{{ asset('img/qq_contact.jpeg') }}">QQ</a>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        <h5>点击排行</h5>
                        <hr>
                        @foreach($hots as $key=>$hot)
                            <div style="margin-bottom:5px;">
                                <a href="{{ $hot->info_url }}">{{ $key+1 }}.&nbsp;&nbsp;{{ $hot->title }}</a>
                                    &nbsp;
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        <h5>标签云</h5>
                        <hr>
                        <a href="{{ route('index',['q'=>'php']) }}"
                           class="btn btn-sm btn-default"><span
                                    class="label label-default">PHP</span></a>
                        <a href="{{ route('index',['q'=>'laravel']) }}"
                           class="btn btn-sm btn-default"><span
                                    class="label label-default">Laravel</span></a>
                        <a href="{{ route('index',['q'=>'设计模式']) }}" class="btn btn-sm btn-default"><span
                                    class="label label-default">设计模式</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection