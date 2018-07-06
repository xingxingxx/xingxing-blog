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
                                <a class="btn btn-primary" href="{{ route('backend.news.category.create') }}">
                                    <i class="fa fa-plus"></i> 添加新闻分类
                                </a>
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
                                            <th>名称</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->id}}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('backend.news.category.edit', $category->id) }}"
                                                       class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 编辑</a>
                                                    <form action="{{ route('backend.news.category.destroy', $category->id) }}"
                                                          method="post" style="display: inline-block">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-xs btn-warning" onclick="return confirm('确定要删除吗?')">
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
                            {!! $categories->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection