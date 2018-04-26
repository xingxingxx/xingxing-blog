<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="">
                <form method="POST" action="{{ route('update',['id'=>$article->id]) }}">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label text-md-right">标题</label>
                        <input type="hidden" name="type" value="1">

                        <input id="title" type="text"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               name="title" value="{{ $article->title }}" required autofocus>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content" class="form-label text-md-right">内容</label>
                        <div id="content">
                            <textarea name="content" style="display:none;">{{ $article->content }}</textarea>
                        </div>
                        @include('markdown::encode',['editors'=>['content']])
                    </div>
                    @if ($errors->has('content'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                            @endif
                            <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        保存
                                    </button>
                                </div>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>