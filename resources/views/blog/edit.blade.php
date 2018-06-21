<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

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
        <form method="POST" action="{{ route('blog.update',['id'=>$article->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group" style="width:95%;margin:0 auto;">
                <input id="title" type="text" class="form-control" name="title" value="{{ $article->title }}"
                       placeholder="标题" required
                       autofocus>
            </div>
            <br>
            <div class="form-group">
                <div id="content">
                    <textarea name="content" style="display:none;">{{ $article->content }}</textarea>
                </div>
                @include('markdown::encode',['editors'=>['content']])
            </div>

            <div class="form-group" style="width:95%;margin:0 auto;">
                <button type="submit" class="btn btn-primary">
                    保存
                </button>
            </div>
        </form>
    </main>
</div>
</body>
</html>