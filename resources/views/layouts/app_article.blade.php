<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}"/>
</head>
<body>
@yield('content')

<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        editormd("markdown-content", {
            width: "100%",
            height: 640,
            markdown: "",
            path: "{{asset('vendor/markdown/lib')}}/",
            toolbarIcons: function () {
                return ["undo", "redo", "|", "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|", "h1", "h2", "h3", "h4", "h5", "h6", "|", "list-ul", "list-ol", "hr", "|", "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "datetime", "emoji", "html-entities", "pagebreak", "||", "goto-line", "watch", "clear", "preview", "fullscreen"]
            },
            imageUpload: true,
            imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL: "{{route('markdown.upload')}}",
        });
    });

</script>
@yield('script')
</body>
</html>
