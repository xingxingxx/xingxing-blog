@extends('layouts.app')
@section('title', $book->title.' - '.$article->title)

@section('content')
    <div class="container" style="margin-top: 10px;">
        <div class="justify-content-center row">
            <div class="col-md-3" style="padding:0;">
                <div id="menu" class="card"
                     style="position:fixed;bottom:0px;top:66px;width:287px;padding:15px;overflow: auto;z-index: 99999;">
                    <div class="card-boy">
                        <a style="color:#505050; display: block;" href="{{ route('book.index') }}">
                            <h4>{{ $book->title }}</h4>
                        </a>
                        <hr>
                        {!! $menus !!}
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-9" style="padding:0;">
                <div class="card">
                    <div class="body">
                        <div style="padding:10px 70px;">
                            <p id="doc-content">
                                <textarea style="display:none;"> {!! $article->content !!} </textarea>
                            </p>
                            <p class="text-center" style="margin-top:20px;">
                                如果这篇文章帮助到了您，可以赞助下主机费~~<br>
                            </p>
                            <p class="text-center">
                                <button class="btn btn-success" id="zanshang">赞赏</button>
                                <br>
                                <img id="zanshangImg" style="display: none;text-align: center;" width="300px;"
                                     src="{{ asset('img/wechat_zanshang.jpg') }}">
                            </p>
                            <a id="preArticle"
                               style="position:fixed;text-decoration:none;color:#ccc;font-size:30px;
            display:none;top:50%;margin-left:-50px;z-index: 9999999;"
                               href="#"><i class="fa fa-chevron-left"></i></a>

                            <div style="float:right;">
                                <a id="nextArticle"
                                   style="position:fixed;text-decoration:none;color:#ccc;
            font-size:30px;display: none;margin-left:20px;top:50%;z-index: 999999;"
                                   href="#"><i class="fa fa-chevron-right"></i></a>
                            </div>
                            <h3>评论</h3>
                            <hr>
                            <table id="commentList" style="margin:10px 0 20px 0;">
                                @foreach($article->comments as $comment)

                                    <tr>
                                        <td style="padding: 0 10px;">
                                            <a href="{{ $comment->website }}"
                                               target="_blank">
                                                <img style="height:35px;border-radius:50%;"
                                                     src="{{ ($comment->email=='xx9815@qq.com')? asset('img/my_avatar.png'):Identicon::getImageDataUri($comment->username) }}">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $comment->website }}"
                                               target="_blank">{{ $comment->username }}</a>
                                            <br>
                                            <span style="color:#ddd;">{{ $comment->created_at->format('Y-m-d H:i:s') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <p style="padding: 0 0 15px 0;" id="comment-content-{{ $comment->id }}">
                                                <textarea style="display:none;"> {!! $comment->content !!} </textarea>
                                            </p>
                                    </tr>
                                @endforeach
                            </table>
                            <form id="commentForm" onsubmit="return false;">
                                @csrf
                                <input type="hidden" name="aid" value="{{ $article->id }}">
                                <div class="form-group">
                                    <label for="username"
                                           class="form-label"><span
                                                class="text-danger">*</span>姓名</label>
                                    <input id="username" type="text" class="form-control" name="username"
                                           value="{{ $comment_cache->username??'' }}"
                                           required autofocus placeholder="您的名称"/>
                                </div>
                                <div class="form-group">
                                    <label for="email"
                                           class="form-label"><span
                                                class="text-danger">*</span>邮箱</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ $comment_cache->email??'' }}" placeholder="邮箱不会公开"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <label for="website"
                                           class="form-label">个人网站</label>
                                    <input id="website" type="text" class="form-control" name="website"
                                           value="{{ $comment_cache->website??'' }}" placeholder="可选，填写后点击头像可以直接进入"/>
                                </div>
                                <div class="form-group">
                                    <label for="content"
                                           class="form-label"><span
                                                class="text-danger" style="font-size:20px;">*</span>评论内容，支持<a
                                                href="https://daringfireball.net/projects/markdown/syntax">Markdown</a></label>
                                    <textarea id="content" rows="6" class="form-control"
                                              name="content" required>{{ old('content') }}</textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1 text-md-right">
                                        <a href="javascript:void(0)"><img id="captchaImg"
                                                                          src="{{ captcha_src('mini') }}"></a>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="captcha" type="text" class="form-control" name="captcha" value=""
                                               placeholder="验证码"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="commentSubmit" class="btn btn-primary">
                                        提交
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" id="topMao" style="display: block;position: fixed;bottom:50px;right:30px;"><img
                src="{{ asset('img/top.png') }}"></a>
@endsection
@section('footer')
    <footer id="footer">
        <div style="padding:25px;text-align:center;">
            Copyright © 2018
            <a target="_blank" href="https://xiaoxingping.top">Sampson的博客</a>&nbsp;|
            <a target="_blank" href="http://www.miitbeian.gov.cn">粤ICP备17155556号</a>&nbsp;|
            Powered by <a target="_blank" href="https://github.com/xingxingxx/my-blog-new">Sampson</a>
        </div>
    </footer>
@endsection
@section('script')
    <link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}"/>
    <script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>

    <script type="text/javascript">
        $('#zanshang').click(function () {
            $("#zanshangImg").toggle(500);
        });
        $('#topMao').click(function () {
            $("html,body").animate({scrollTop: $("#app").offset().top}, 500);
        });
        var tit = document.getElementById('menu');
        var titleTop = tit.offsetTop;
        //滚动事件
        document.onscroll = function () {
            //获取当前滚动的距离
            var btop = document.body.scrollTop || document.documentElement.scrollTop;
            //如果滚动距离大于导航条据顶部的距离
            if (btop >= titleTop) {
                tit.style.top = "0px";
            } else {
                tit.style.top = (titleTop - btop) + 'px';
            }
        }
        $(function () {
            $('#captchaImg').click(function () {
                $(this).attr('src', $(this).attr('src') + Math.random());
            });
            editormd.markdownToHTML("doc-content", {
                htmlDecode: "style,script,iframe",
                emoji: true,
                taskList: true,
                tex: true,
                flowChart: false,
                sequenceDiagram: false,
                codeFold: true,
            });
            @foreach($article->comments as $comment)
            editormd.markdownToHTML("comment-content-{{ $comment->id }}", {
                htmlDecode: "style,script,iframe",
                emoji: true,
                taskList: true,
                tex: true,
                flowChart: false,
                sequenceDiagram: false,
                codeFold: true,
            });
                    @endforeach

            var pre = $('#activeArticle').prev().attr('href');
            var next = $('#activeArticle').next().attr('href');
            if (pre) {
                $('#preArticle').show();
                $('#preArticle').attr('href', pre);
            }
            if (next) {
                $('#nextArticle').show();
                $('#nextArticle').attr('href', next);
            }


            $('#commentSubmit').click(function () {
                $('#username').removeClass('is-invalid');
                $('#username').next('.invalid-feedback').remove();
                $('#email').removeClass('is-invalid');
                $('#email').next('.invalid-feedback').remove();
                $('#website').removeClass('is-invalid');
                $('#website').next('.invalid-feedback').remove();
                $('#content').removeClass('is-invalid');
                $('#content').next('.invalid-feedback').remove();
                $('#captcha').removeClass('is-invalid');
                $('#captcha').next('.invalid-feedback').remove();

                $.ajax({
                    url: "{{ route('book.comment.store') }}",
                    type: 'post',
                    data: $('#commentForm').serializeArray(),
                    success: function (data) {
                        $('#captchaImg').attr('src', $('#captchaImg').attr('src') + Math.random());
                        $('#captcha').val('');
                        var myAvatar = "{{ asset('img/my_avatar.png') }}";
                        var defaultAvatar = "{{ asset('img/default_avatar.png') }}";
                        $('#commentList').append('<tr>' +
                            '                                    <td style="padding: 0 10px;">' +
                            '                                        <a  href="' + data.website + '"' +
                            '                                           target="_blank">' +
                            '                                            <img style="border-radius:50%;"' +
                            '                                                 src="' + (data.email == 'xx9815@qq.com' ? myAvatar : defaultAvatar) + '">' +
                            '                                        </a>' +
                            '                                    </td>' +
                            '                                    <td>' +
                            '                                        <a href="' + data.website + '"' +
                            '                                           target="_blank">' + data.username + '</a>' +
                            '                                        <br>' +
                            '                                        <span style="color:#ddd;">' + data.created_at + '</span>' +
                            '                                    </td>' +
                            '                                </tr>' +
                            '                                <tr>' +
                            '                                    <td></td>' +
                            '                                    <td>' +
                            '                                        <p style="padding: 0 0 15px 0;" id="comment-content-' + data.id + '">' +
                            '                                            <textarea style="display:none;"> ' + data.content + ' </textarea>' +
                            '                                        </p>' +
                            '                                </tr>');
                        editormd.markdownToHTML("comment-content-" + data.id, {
                            htmlDecode: "style,script,iframe",
                            emoji: true,
                            taskList: true,
                            tex: true,
                            flowChart: false,
                            sequenceDiagram: false,
                            codeFold: true,
                        });
                        alert('评论成功');
                        $("html,body").animate({scrollTop: $("#comment-content-" + data.id).offset().top - 80}, 300);

                    },
                    error: function (xhr, status, error) {
                        $('#captchaImg').attr('src', $('#captchaImg').attr('src') + Math.random());
                        var errors = xhr.responseJSON.errors;
                        for (var key in errors) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).after('<span class="invalid-feedback" style="display: block;">' +
                                ' <strong>' + errors[key][0] +
                                '</strong>' +
                                ' </span>');
                        }
                    }
                });

            });
        });

    </script>
@endsection