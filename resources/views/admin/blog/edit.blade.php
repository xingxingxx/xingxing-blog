@extends('layouts.app_article')

@section('content')
    <div style="padding:20px;">
        <form method="POST" action="{{ route('admin.blog.update',['id'=>$article->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input id="title" type="text" class="form-control" name="title" value="{{ $article->title }}"
                       placeholder="标题" required
                       autofocus>
            </div>
            <div class="form-group">
                <select class="form-control" id="special_id" name="special_id">
                    <option value="0">请选择专栏</option>
                    @foreach($specials as $special)
                        <option value="{{ $special->id }}" @if($article->special_id==$special->id) selected @endif>{{ $special->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div id="markdown-content">
                    <textarea name="content" style="display:none;">{{ $article->content }}</textarea>
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