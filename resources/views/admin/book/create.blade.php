@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        新建专栏
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.book.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title" class=form-label">标题</label>
                                <input id="title" type="text" class="form-control" name="title"
                                       value="{{ old('title') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="cover" class="form-label">封面</label>
                                <div id="uploader_1" class="uploader-list"
                                     data-url="{{route('upload.image')}}"
                                     data-name="cover" data-max="1" data-accept="png,jpg,jpeg,gif">
                                    <div class="img-item picker"></div>
                                    <div class="cf"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">描述</label>
                                <textarea id="description" rows="10" class="form-control"
                                          name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{asset('vendor/uploader/js/webuploader.html5only.min.js')}}"></script>
    <script src="{{asset('vendor/uploader/js/Uploader.js')}}"></script>
@endsection
