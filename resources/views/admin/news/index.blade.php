@extends('backend.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @include('backend.components.alert')
                        <div class="row">
                            <div class="col-sm-2">
                                <a class="btn btn-primary" href="{{ route('backend.news.create') }}">
                                    <i class="fa fa-plus"></i> 添加新闻
                                </a>
                            </div>
                            <div class="col-sm-10 text-right">
                                <form method="get" action="{{ route('backend.news.index') }}" class="form-inline">
                                    <div class="form-group">
                                        <label>标题：</label>
                                        <input type="text" class="form-control" name="title"
                                               value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>分类：</label>
                                        <select class="form-control" name="category_id">
                                            <option value="">全部</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if(old('category_id')==$category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">搜索</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th>标题</th>
                                            <th>分类</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($news as $new)
                                            <tr>
                                                <td>{{ $new->id}}</td>
                                                <td>{{ $new->title }}</td>
                                                <td>{{ $new->category->name }}</td>
                                                <td>{{ $new->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('backend.news.edit', $new->id) }}"
                                                       class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 编辑</a>
                                                    <form action="{{ route('backend.news.destroy', $new->id) }}"
                                                          method="post" style="display: inline-block">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-xs btn-warning"
                                                                onclick="return confirm('确定要删除吗?')">
                                                            <i class="fa fa-trash"></i> 删除
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {!! $news->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
