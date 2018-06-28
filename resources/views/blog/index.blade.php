@extends('layouts.app')
@section('title', '博客首页')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($articles as $key=>$article)
                    <div class="card" style="@if($key>0) margin-top:20px; @endif">
                        <div class="card-body">
                            <h5 style="padding-bottom:10px;color:#333;"><strong>
                                    <a href="{{ $article->info_url }}"
                                       style="@if($article->type==1)color:#333333; @else color:#dddddd; @endif">{{ $article->title }}</a>
                                </strong>
                            </h5>
                            <div class="row">
                                @if($article->cover)
                                    <div class="col-md-4">
                                        <a href="{{ $article->info_url }}"><img style="width:100%;"
                                                                                src="{{ $article->cover }}"></a>
                                    </div>
                                @endif
                                <div class="@if($article->cover) col-md-8 @else col-md-12 @endif">
                                    <p><a href="{{ $article->info_url }}"
                                          style="@if($article->type==1)color:#333333; @else color:#dddddd; @endif">{{ $article->abstract }}</a>
                                    </p>
                                    <div>

                                        发布时间：&nbsp;{{ $article->created_at }}
                                        &emsp;
                                        点击&nbsp;({{ $article->view_count }})
                                        &emsp;
                                        喜欢&nbsp;({{ $article->like_count }})
                                    </div>
                                    <div>
                                        {!! $article->opera_button !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <p><h4 class="text-center">抱歉！没有找到您需要的文章</h4></p>
                        </div>
                    </div>
                @endforelse
                <p style="margin-top:15px;"> {!! $articles->links() !!}</p>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">点击排行</div>

                    <div class="card-body">
                        @foreach($hots as $hot)
                            <div class="row">
                                <div class="col-sm-12" style="margin-bottom: 10px;">
                                    <a style="color:#505050;" href="{{ $hot->info_url }}">{{ $hot->title }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card" style="margin-top:20px;">
                    <div class="card-header">标签云</div>

                    <div class="card-body">
                        <a href="{{ route('index',['q'=>'php']) }}" style="color:#333;"
                           class="btn btn-sm btn-default"><span
                                    class="label label-default">PHP</span></a>
                        &nbsp;&nbsp;
                        <a href="{{ route('index',['q'=>'laravel']) }}" style="color:#333;"
                           class="btn btn-sm btn-default"><span
                                    class="label label-default">Laravel</span></a>
                        &nbsp;&nbsp;
                        <a href="{{ route('index',['q'=>'设计模式']) }}" style="color:#333;" class="btn btn-sm btn-default"><span
                                    class="label label-default">设计模式</span></a>
                    </div>
                </div>

                <div class="card" style="margin-top:20px;">
                    <div class="card-header">关注</div>

                    <div class="card-body">
                        邮箱：<a style="color:#336699;" href="Mailto:xx9815@qq.com">xx915@qq.com</a><br>
                        github：<a style="color:#336699;" target="_blank" href="https://github.com/xingxingxx">https://github.com/xingxingxx</a><br>
                        微博：<a style="color:#336699;" target="_blank" href="http://weibo.com/u/3026783454">http://weibo.com/u/3026783454</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection