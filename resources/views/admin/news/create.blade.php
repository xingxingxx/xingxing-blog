@extends('backend.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form action="{{ route('backend.news.store') }}" method="post">
                        <div class="box-header">
                            @include('backend.components.alert')
                        </div>
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <label for="category_id">分类</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if(old('category_id')==$category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                                <label for="cover">封面</label>
                                <input type="text" class="form-control" id="cover" name="cover"
                                       value="{{ old('cover') }}">
                                @if ($errors->has('cover'))
                                    <span class="help-block">{{ $errors->first('cover') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="keyword">关键词</label>
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                       value="{{ old('keyword') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">描述</label>
                                    <textarea class="form-control" id="description"
                                              name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">内容</label>
                                <textarea class="form-control" id="content"
                                          name="content">{{ old('content') }}</textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="reset" class="btn btn-default" value="重置">
                            <input type="submit" class="btn btn-primary pull-right" value="提交">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        CKEDITOR.replace('content', {height: '700px', width: '100%'});
    </script>
@endsection
