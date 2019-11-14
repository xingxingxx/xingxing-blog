@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-2">
                                <a class="btn btn-primary" href="{{ route('admin.book.create') }}">
                                    <i class="fa fa-plus"></i> 新建专栏
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
                                            <th>封面</th>
                                            <th>标题</th>
                                            <th>介绍</th>
                                            <th>创建时间</th>
                                            <th>更新时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{ $book->id}}</td>
                                                <td>
                                                    <img style="width:100px;" src="{{ \Storage::url($book->cover) }}">
                                                </td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->description }}</td>
                                                <td>{{ $book->created_at }}</td>
                                                <td>{{ $book->updated_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.book.article.index',['book_id'=>$book->id]) }}" class="btn btn-sm btn-default">查看</a>
                                                    <a href="{{ route('admin.book.edit',['id'=>$book->id]) }}"
                                                       class="btn btn-sm btn-primary">编辑</a>
                                                    <form action="{{ route('admin.book.delete',['id'=>$book->id]) }}" method="POST"
                                                          style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit"
                                                               class="btn btn-sm btn-danger"
                                                               value="删除"
                                                               onclick="return confirm('确定要删除吗？');">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {!! $books->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
