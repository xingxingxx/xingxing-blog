<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Blog后台管理</title>
    {{--公共样式--}}
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/ionicons-2.0.1/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/iCheck/square/blue.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/adminLTE/css/AdminLTE.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/adminLTE/css/skins/skin-blue.min.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{ asset('vendor/adminLTE/js/Html5shiv.min.js') }}"></script>
    <script src="{{ asset('vendor/adminLTE/js/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body class="skin-blue sidebar-mini" id="pjax-container">
<div class="wrapper">
    {{--头部--}}
    @include('admin.components.header')
    {{--左侧菜单栏--}}
    @include('admin.components.menu')
    {{--主体内容区--}}
    <div class="content-wrapper" style="min-height:916px;">
        <section class="content-header">
            <h1>
                我的视图 <small>Dashboard</small>
            </h1>
{{--            {!! Breadcrumbs::renderIfExists() !!}--}}
        </section>
        @yield('content')
    </div>
    {{--底部--}}
    @include('admin.components.footer')
    {{--右侧面板--}}
    {{--    @include('backend.includes.control')--}}
</div>

{{--公共js--}}
<script src="{{ asset('vendor/jQuery/jQuery-2.2.0.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/adminLTE/js/app.min.js') }}"></script>
<script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('vendor/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
{{--自定义页面js--}}
@yield('script')
</body>
</html>