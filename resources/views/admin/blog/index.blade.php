@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-2">
                                <a class="btn btn-primary" href="{{ route('admin.blog.create') }}">
                                    <i class="fa fa-plus"></i> 写博客
                                </a>
                            </div>
                            <div class="col-sm-10 text-right">
                                <form method="get" action="{{ route('admin.blog.index') }}" class="form-inline">
                                    <div class="form-group">
                                        <label>标题：</label>
                                        <input type="text" class="form-control" name="title"
                                               value="{{ old('title')?:$title??'' }}">
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
                                            <th>阅读数</th>
                                            <th>评论数</th>
                                            <th>创建时间</th>
                                            <th>更新时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($articles as $article)
                                            <tr>
                                                <td>{{ $article->id}}</td>
                                                <td>{{ $article->title }}</td>
                                                <td>{{ $article->view_count }}</td>
                                                <td>{{ $article->comment_count }}</td>
                                                <td>{{ $article->created_at }}</td>
                                                <td>{{ $article->updated_at }}</td>
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-default" href="{{ $article->info_url }}">查看</a>&emsp;
                                                    {!! $article->operaButton !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {!! $articles->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
