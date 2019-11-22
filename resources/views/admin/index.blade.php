@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box"><span class="info-box-icon bg-aqua"><i
                                class="fa fa-file-text-o"></i></span>
                    <div class="info-box-content"><span class="info-box-text">博客</span> <span
                                class="info-box-number">{{ $blog_count }}
                            <small>篇</small></span></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box"><span class="info-box-icon bg-red"><i class="fa fa-newspaper-o"></i></span>
                    <div class="info-box-content"><span class="info-box-text">专栏</span> <span
                                class="info-box-number">{{ $special_count }}</span></div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box"><span class="info-box-icon bg-green"><i
                                class="fa fa-book"></i></span>
                    <div class="info-box-content"><span class="info-box-text">教程</span> <span
                                class="info-box-number">{{ $book_count }}</span></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box"><span class="info-box-icon bg-yellow"><i
                                class="fa fa-users"></i></span>
                    <div class="info-box-content"><span class="info-box-text">用户</span> <span
                                class="info-box-number">{{ $user_count }}</span></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="avatar" class="col-md-2 col-form-label text-md-right">头像</label>
                                <div id="uploader_1" class="uploader-list"
                                     data-url="{{route('upload.image')}}"
                                     data-name="avatar" data-max="1" data-accept="png,jpg,jpeg,gif">
                                    <div id="WU_FILE_10" class="img-item">
                                        <div class="delete"></div>
                                        <img class="img" style="width:75px;height:75px;" src="{{ $user->avatar }}">
                                        <div class="wrapper" style="display: none;">100%</div>
                                        <input type="hidden" name="avatar" value="{{ $user->avatar }}">
                                    </div>
                                    <div class="img-item picker"></div>
                                    <div class="cf"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">昵称</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">邮箱</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">签名</label>
                                <div class="col-md-8">
                                    <input id="sign" type="text" class="form-control" name="sign"
                                           value="{{ $user->sign }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="github" class="col-md-2 col-form-label text-md-right">Github主页</label>
                                <div class="col-md-8">
                                    <input id="github" type="text" class="form-control" name="github"
                                           value="{{ $user->github }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="weibo" class="col-md-2 col-form-label text-md-right">微博</label>
                                <div class="col-md-8">
                                    <input id="weibo" type="text" class="form-control" name="weibo"
                                           value="{{ $user->weibo }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="wechat" class="col-md-2 col-form-label text-md-right">微信</label>
                                <div class="col-md-8">
                                    <input id="wechat" type="text" class="form-control" name="wechat"
                                           value="{{ $user->wechat }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="qq" class="col-md-2 col-form-label text-md-right">QQ</label>
                                <div class="col-md-8">
                                    <input id="qq" type="text" class="form-control" name="qq"
                                           value="{{ $user->qq }}">
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
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-xs-6">

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{asset('vendor/uploader/js/webuploader.html5only.min.js')}}"></script>
    <script src="{{asset('vendor/uploader/js/Uploader.js')}}"></script>
@endsection