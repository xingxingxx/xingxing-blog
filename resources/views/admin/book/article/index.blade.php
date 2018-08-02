@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-2">
                                <a class="btn btn-primary"
                                   href="{{ route('admin.book.article.create',['book_id'=>$book->id,'parent_id'=>0]) }}">
                                    <i class="fa fa-plus"></i> 新建专栏文章
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
                                            <th>标题</th>
                                            <th>创建时间</th>
                                            <th>更新时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {!! $displayData !!}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
