@extends('layouts.app')

@section('title', '专栏列表')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @foreach($specials as $key=>$vo)
                    <div class="card" style="margin-top:20px;">
                        <div class="card-body row">
                            <div class="col-md-4">
                                <img style="width:100%;" src="{{ \Storage::url($vo->cover) }}">
                            </div>
                            <div class="col-md-8">
                                <h3>{{ $vo->title }}</h3>
                                <p>{{ $vo->description }}</p>
                                <p>
                                    <i class="fa fa-clock-o"></i>&nbsp;{{ $vo->created_at->format('Y-m-d H:i:s') }}</p>
                                <div>
                                    <a href="{{ route('special.show',['id'=>$vo->id]) }}" class="btn btn-sm btn-primary">进入专栏</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {!! $specials->links() !!}
            </div>
        </div>
    </div>
@endsection