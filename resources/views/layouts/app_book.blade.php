<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="博客,Sampson博客,肖兴平,Sampson,SampsonBlog,php,laravel,PhpStorm,php教程,laravel教程,PhpStorm教程">
    <meta name="description" content="Sampson的个人博客，一个提供优质原创内容的博客，定期分享php,laravel等新技术">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('vendor/markdown/css/editormd.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <style>
        body {
            background-color: #f2f5f9;
            color: rgba(0, 0, 0, .7) !important;
        }

        .card {
            border: none;
            box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .1);
        }

        .font-color {
            color: rgba(0, 0, 0, .7) !important
        }

        a {
            color: rgba(0, 0, 0, .7);
        }

        a:hover {
            color: rgba(0, 0, 0, .7);
        }

        .page-link {
            color: rgba(0, 0, 0, .7);
        }
    </style>
    {{--百度统计代码--}}
    @if(!app()->isLocal())
        <script>
            var _hmt = _hmt || [];
            (function () {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?4fc93c60dc8191750936d459d36ea7c2";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    @endif

</head>
<body style="min-height:100%;margin:0;padding:0;position:relative;">
<div id="app">
    @yield('content')
    @section('footer')
        <footer id="footer">
            <div class="card" style="margin-top:20px;text-align:center;">
                <div class="card-body" style="padding:15px;">
                    Copyright © 2018
                    <a target="_blank" href="https://xiaoxingping.top">Sampson的博客</a>&nbsp;|
                    <a target="_blank" href="http://www.miitbeian.gov.cn">粤ICP备17155556号</a>&nbsp;|
                    Powered by <a target="_blank" href="https://github.com/xingxingxx/my-blog-new">Sampson</a>
                </div>
            </div>
        </footer>
    @show
</div>
<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    if ($(window).height() - $('#app').height() > 30) {
        $('#footer').css('position', 'fixed');
        $('#footer').css('bottom', 0);
        $('#footer').css('width', '100%');
    }
    ;
</script>
@yield('script')
</body>
</html>
