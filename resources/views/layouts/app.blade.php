<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('vendor/markdown/css/editormd.min.css')}}" rel="stylesheet">
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

                <form action="/" class="form-inline navbar-form" method="get" style="margin:0;padding:0;">
                    <input class="form-control" type="text" name="q" placeholder="Search" value="{{ $q ?? '' }}">
                    &nbsp;
                    <button class="btn btn-success-outline" type="submit">搜索</button>
                </form>

                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <footer id="footer" style="text-align: center;padding:20px;">
        <a target="_blank" href="http://www.miitbeian.gov.cn" style="color:#336699;">粤ICP备17155556号-2</a>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
