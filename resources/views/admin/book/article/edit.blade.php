@extends('layouts.app_article')

@section('content')
    <div style="padding:20px;">

        <form method="POST" action="{{ route('admin.book.article.update',['id'=>$article->id]) }}">
            @csrf
            @method('PUT')
            <input type="hidden" id="parent_id" class="form-control" name="parent_id"
                   value="{{ $article->parent_id }}" >
            <div class="form-group">
                <input id="title" type="text" class="form-control" name="title"
                       value="{{ $article->title }}"
                       required autofocus>
            </div>
            <div class="form-group">
                <div id="markdown-content">
                    <textarea name="content">{{ $article->content }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    保存
                </button>
            </div>
        </form>
    </div>
@endsection
