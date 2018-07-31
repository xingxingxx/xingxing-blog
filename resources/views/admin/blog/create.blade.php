@extends('layouts.app_article')

@section('content')
    <div style="padding:20px;">
        <form id="blog-form" method="POST" action="{{ route('admin.blog.store') }}">
            @csrf
            <input id="blog-type" type="hidden" name="type" value="2">
            <div class="form-group">
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                       placeholder="标题"
                       required
                       autofocus>
            </div>
            <div class="form-group">
                <select class="form-control" id="special_id" name="special_id">
                    <option value="0">请选择专栏</option>
                    @foreach($specials as $special)
                        <option value="{{ $special->id }}">{{ $special->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div id="markdown-content">
                    <textarea name="content" style="display:none;">{{ old('content') }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <button id="save-draft" class="btn btn-warning">
                    保存为草稿
                </button>
                <button id="publish" class="btn btn-primary">
                    发布
                </button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#save-draft').click(function () {
                $('#blog-type').val(2);
                $('#blog-form').submit();
            });
            $('#publish').click(function () {
                $('#blog-type').val(1);
                $('#blog-form').submit();
            });
        });
    </script>
@endsection