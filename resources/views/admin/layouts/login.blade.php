<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{config('app.name')}}</title>
    {{--公共样式--}}
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/ionicons-2.0.1/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/iCheck/square/blue.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/adminLTE/css/AdminLTE.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/adminLTE/css/skins/skin-blue.min.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{ asset('vendor/adminLTE/js/Html5shiv.min.js') }}"></script>
    <script src="{{ asset('vendor/adminLTE/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('admin.index') }}"><b>{{config('app.name')}}</b></a>
    </div>
    <div class="login-box-body">
        @yield('content')
    </div>
</div>
{{--公共js--}}
<script src="{{ asset('vendor/jQuery/jQuery-2.2.0.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('vendor/adminLTE/js/app.min.js') }}"></script>
{{--自定义页面js--}}
@yield('script')
</body>
</html>