@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        编辑专栏
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.book.update',['id'=>$book->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">标题</label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="{{ $book->title }}"
                                           required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cover" class="col-md-2 col-form-label text-md-right">封面</label>

                                <div id="uploader_1" class="uploader-list"
                                     data-url="{{route('upload.image')}}"
                                     data-name="cover" data-max="1" data-accept="png,jpg,jpeg,gif">
                                    <div id="WU_FILE_10" class="img-item">
                                        <div class="delete"></div>
                                        <img class="img" style="width:75px;height:75px;" src="{{ \Storage::url($book->cover) }}">
                                        <div class="wrapper" style="display: none;">100%</div>
                                        <input type="hidden" name="cover" value="{{ $book->cover }}">
                                    </div>
                                    <div class="img-item picker"></div>
                                    <div class="cf"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">描述</label>

                                <div class="col-md-8">
                                    <textarea id="description" rows="10" class="form-control" name="description">{{ $book->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        保存
                                    </button>
                                </div>
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
