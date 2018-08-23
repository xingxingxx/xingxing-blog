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
            color: rgba(0,0,0,.7) !important;
        }
        .card {
            border: none;
            box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .1);
        }
        .font-color {
            color: rgba(0,0,0,.7) !important
        }
        a {
            color: rgba(0,0,0,.7);
        }
        a:hover{color:rgba(0,0,0,.7);}
        .page-link{color: rgba(0,0,0,.7);}
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
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li><a class="nav-link {{ url()->full()==route('index')?'active':'' }}" href="{{ route('index') }}">首页</a>
                    </li>
                    <li><a class="nav-link {{ url()->full()==route('special.index')?'active':'' }}"
                           href="{{ route('special.index') }}">专栏</a></li>
                    <li><a class="nav-link {{ url()->full()==route('book.index')?'active':'' }}"
                           href="{{ route('book.index') }}">教程</a></li>
                </ul>

                <form action="/" class="form-inline my-2 my-lg-0" method="get">
                    <input class="form-control mr-sm-2" type="text" name="q" placeholder="搜索" value="{{ $q ?? '' }}">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">搜索</button>
                </form>

                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    登出
                                </a>
                                @if(Auth::user()->is_admin)
                                    <a class="dropdown-item" href="{{ route('admin.index') }}" target="_blank">
                                        管理后台
                                    </a>
                                @endif
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
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
</div>
<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    if($(window).height()-$('#app').height()>30){
        $('#footer').css('position','fixed');
        $('#footer').css('bottom',0);
        $('#footer').css('width','100%');
    };
</script>
@yield('script')
</body>
</html>
