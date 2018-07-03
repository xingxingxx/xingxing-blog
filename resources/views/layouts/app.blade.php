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
    <link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}"/>
</head>
<body>
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
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li><a class="nav-link @if(url()->full()==route('index'))active @endif" href="{{ route('index') }}">首页</a></li>
                    <li><a class="nav-link @if(url()->full()==route('book.index'))active @endif" href="{{ route('book.index') }}">专栏</a></li>

                </ul>

                <form action="/" class="form-inline navbar-form pull-right" method="get" style="margin:0;padding:0;">
                    <input class="form-control" type="text" name="q" placeholder="Search" value="{{ $q ?? '' }}">
                    &nbsp;
                    <button class="btn btn-success-outline" type="submit">搜索</button>
                </form>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                        {{--<li><a class="nav-link" href="{{ route('register') }}">注册</a></li>--}}
                    @else
                        <li><a class="nav-link" href="{{ route('blog.create') }}">添加文章</a></li>
                        @if(empty($book))
                            <li><a class="nav-link" href="{{ route('book.create') }}">新增专栏</a></li>
                        @else
                            <li><a class="nav-link" href="{{ route('book.article.create',['book_id'=>$book->id]) }}">添加专栏文章</a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

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

    <main class="py-4">
        @yield('content')
    </main>
    <footer style="text-align: center">
        <a target="_blank" href="http://www.miitbeian.gov.cn" style="color:#336699;">粤ICP备17155556号-2</a>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
