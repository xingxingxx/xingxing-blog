@extends('layouts.app')

@section('title', '教程列表')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @foreach($books as $key=>$vo)
                    <div class="card"  style="margin-top:20px;">
                        <div class="card-body row">
                            <div class="col-md-3">
                                <img style="width:100%;box-shadow: #ccc 3px 3px 8px;" src="{{ asset('uploads/file/'.$vo->cover) }}">
                            </div>
                            <div class="col-md-9">
                                <h3>{{ $vo->title }}</h3>
                                <p>{{ $vo->description }}</p>
                                <p>{{ $vo->created_at }}</p>
                                <div>
                                    <a href="{{ route('book.show',['id'=>$vo->id]) }}" class="btn btn-sm btn-primary">阅读小书</a>
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