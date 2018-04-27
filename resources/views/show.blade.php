@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">{{ $article->title }}</h5>
                        <p class="text-center">发布时间：{{ $article->created_at }}</p>
                        <p>{!! MarkdownEditor::parse($article->content) !!}</p>
                        @if($article->pre)
                            <p>上一篇：<a style="color:#8888bb;" href="{{ route('show',['id'=>$article->pre->id]) }}">{{ $article->pre->title }}</a></p>
                        @endif
                        @if($article->next)
                            <p>下一篇：<a style="color:#8888bb;" href="{{ route('show',['id'=>$article->next->id]) }}">{{ $article->next->title }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection