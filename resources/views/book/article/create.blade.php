@extends('layouts.app_article')

@section('content')
    <div style="padding:20px;">

        <form method="POST" action="{{ route('book.article.store') }}">
            @csrf
            <div class="form-group">
                <input type="hidden" id="book_id" type="text" class="form-control" name="book_id"
                       value="{{ $book_id }}" >
            </div>
            <div class="form-group">
                <input id="title" type="text" class="form-control" name="title"
                       value="{{ old('title') }}"
                       required autofocus>
            </div>
            <div class="form-group">
                <div id="markdown-content">
                    <textarea name="content">{{ old('content') }}</textarea>
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
