@extends('admin.layouts.login')
@section('content')
    <p class="login-box-msg">登录账号</p>
    <form action="" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input name="email" value="{{ old('email') }}" type="text" class="form-control"
                   placeholder="登录账号">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input name="password" type="password" class="form-control" placeholder="登录密码">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input name="remember" type="checkbox"> 记住我
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
