@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-2">
                                <a class="btn btn-primary" href="{{ route('admin.special.create') }}">
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
                                        @foreach($specials as $special)
                                            <tr>
                                                <td>{{ $special->id}}</td>
                                                <td>
                                                    <img style="width:100px;" src="{{ \Storage::url($special->cover) }}">
                                                </td>
                                                <td>{{ $special->title }}</td>
                                                <td>{{ $special->description }}</td>
                                                <td>{{ $special->created_at }}</td>
                                                <td>{{ $special->updated_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.special.edit',['id'=>$special->id]) }}"
                                                       class="btn btn-sm btn-primary">编辑</a>
                                                    <form action="{{ route('admin.special.delete',['id'=>$special->id]) }}" method="POST"
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
                            {!! $specials->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
