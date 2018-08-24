@extends('layouts.app_book')
@section('title', $book->title.' - '.$article->title)

@section('content')
  <div>
      <h5 style="position:fixed;top:0;height:55px;width:300px;background-color:#fff;padding:0 20px;z-index:99999;border-right:1px solid #ddd;line-height:55px;box-shadow: 4px 4px 4px rgba(0,0,0,.04);">
          <a  href="{{ route('index') }}">{{ config('app.name') }}</a>
      </h5>
      <nav style="margin-left:300px;z-index:9999999;" class="navbar fixed-top navbar-expand-md navbar-light navbar-laravel">
          <div class="container">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                      <li>
                          <a class="nav-link active" href="javascript:void(0);"><i class="fa fa-reorder "></i></a>
                      </li>
                      <li><a class="nav-link active" href="{{ route('book.index') }}">{{ $book->title }}</a></li>
                  </ul>
                  <ul class="navbar-nav ml-auto">
                      <!-- Authentication Links -->
                      @guest
                          <li><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                          <li><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <img style="height:25px;border-radius: 50%;" src="{{ Auth::user()->avatar?:Identicon::getImageDataUri(Auth::user()->name) }}">
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      退出登录
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

      <div style="width:300px;padding:10px 20px;position:fixed;bottom:0;top:55px;background-color: #fff;overflow:auto;z-index:999;border-right:1px solid #ddd;">
          {!! $menus !!}
          <br>
          <br>
      </div>

      <div style="margin-left:300px;margin-top:70px;">
          <div style="width:760px;background-color:#fff;margin:0 auto;padding:20px 50px;box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .1);">
              <p id="doc-content" style="padding:0;">
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
  <div style="position: fixed;top:50%;width:100%;margin-left:300px;z-index: 9999999;">
      <div style="float:left;margin-left:3%;">
          <a id="preArticle"
             style="text-decoration:none;color:#ccc;font-size:30px; display:none;" href="#">
              <i class="fa fa-chevron-left"></i></a>
      </div>
     <div style="float:right;margin-right:27%;">
         <a id="nextArticle"
            style="text-decoration:none;color:#ccc;font-size:30px; display:none;"
            href="#"><i class="fa fa-chevron-right"></i></a>
     </div>
  </div>
    <a href="javascript:void(0);" id="topMao" style="display: block;position: fixed;bottom:50px;right:30px;"><img
                src="{{ asset('img/top.png') }}"></a>
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
            $("html,body").animate({scrollTop: $("#app").offset().top-80}, 500);
        });
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