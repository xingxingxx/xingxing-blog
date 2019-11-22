@extends('layouts.app')
@section('title', '博客首页')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding-right: 0;">
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        @forelse($articles as $key=>$article)
                            <h5 style="padding-top:{{ $key>0? '10px':'0'}};padding-bottom:5px;"><strong>
                                    <a href="{{ $article->info_url }}">{{ $article->title }}</a>
                                </strong>
                            </h5>
                            <div class="row">
                                <div class=" {{ $article->cover?'col-md-8' :'col-md-12'}}">
                                    <div style="margin-bottom: 5px;">
                                        <a href="{{ $article->info_url }}">{{ $article->abstract }}</a>
                                    </div>
                                    <div>
                                        <i class="fa fa-clock-o"></i>&nbsp;{{ $article->created_at->format('Y-m-d H:i:s') }}
                                        &nbsp;&nbsp;
                                        <i class="fa fa-eye"></i>&nbsp;{{ $article->view_count }}
                                        &nbsp;&nbsp;
                                        <i class="fa fa-comments-o"></i>&nbsp;{{ $article->comment_count }}
                                    </div>
                                </div>
                                @if($article->cover)
                                    <div class="col-md-4">
                                        <a href="{{ $article->info_url }}">
                                            <img style="width:100%;" src="{{ \Storage::url($article->cover) }}"></a>
                                    </div>
                                @endif
                            </div>
                            <hr>
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
                            <img style="width:35%;border-radius:50%;" src="{{ $admin->avatar }}">
                            <div style="margin-bottom:5px;"><strong>{{ $admin->name }}</strong></div>
                            {{ $admin->sign }}<br>
                            <a target="_blank" href="{{ $admin->github }}">Github</a>&nbsp;|&nbsp;
                            <a target="_blank" href="{{ $admin->weibo }}">微博</a>&nbsp;|&nbsp;
                            <a target="_blank" href="Mailto:{{ $admin->email }}">邮箱</a>
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
                        <h5>标签</h5>
                        <hr>
                        <a href="{{ route('index',['q'=>'php']) }}"><span class="badge badge-secondary">PHP</span></a>
                        <a href="{{ route('index',['q'=>'laravel']) }}"><span
                                    class="badge badge-secondary">Laravel</span></a>
                        <a href="{{ route('index',['q'=>'设计模式']) }}"><span class="badge badge-secondary">设计模式</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection