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

                                <div class="col-md-8">
                                    @uploader(['name' => 'cover', 'max' => 1, 'accept' => 'jpg,png,gif','value'=>$book->cover])
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
    @uploader('assets')
@endsection
