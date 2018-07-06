@extends('backend.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form action="{{ route('backend.news.category.store') }}" method="post">
                        <div class="box-header">
                            @include('backend.components.alert')
                        </div>
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">名称</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
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