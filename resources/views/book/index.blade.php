@extends('layouts.app')

@section('title', '教程首页')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @foreach($books as $key=>$vo)
                    <div class="card" @if($key>0) style="margin-top:20px;" @endif>
                        <div class="card-body">
                            <div style="float:left;width:200px;"><img style="width:100%;"
                                                                      src="{{ asset('uploads/file/'.$vo->cover) }}">
                            </div>
                            <div style="float:left;margin-left:20px;width:600px;">
                                <h3>{{ $vo->title }}</h3>
                                <p>{{ $vo->description }}</p>
                                <p>{{ $vo->created_at }}</p>
                                <div>
                                    <a href="{{ route('book.show',['id'=>$vo->id]) }}" class="btn btn-sm btn-primary">进入专栏</a>
                                    {{--<a href="#" class="btn btn-sm btn-warning">订阅</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {!! $books->links() !!}
            </div>
        </div>
    </div>
@endsection