@extends('layouts.app_article')

@section('content')
    <div style="padding:20px;">
        <form method="POST" action="{{ route('blog.store') }}">
            @csrf
            <div class="form-group">
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                       placeholder="标题"
                       required
                       autofocus>
            </div>
            <div class="form-group">
                <input id="type" type="radio" name="type" value="1"> 发布
                &emsp;
                <input id="type" type="radio" name="type" value="2" checked> 不发布
            </div>
            <div class="form-group">
                <div id="content">
                    <textarea name="content" style="display:none;">{{ old('content') }}</textarea>
                </div>
                @include('markdown::encode',['editors'=>['content']])
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    保存
                </button>
            </div>
        </form>
    </div>
@endsection