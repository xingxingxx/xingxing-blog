@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="container" style="margin-top:20px;">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">
                            {{ $article->title }}
                        </h5>
                        <p class="text-center">
                            发布于&nbsp;{{ $article->created_at->format('Y-m-d') }}
                            &nbsp;&nbsp;
                            阅读&nbsp;({{ $article->view_count }})
                            &nbsp;&nbsp;
                            评论&nbsp;({{ $article->comment_count }})
                        </p>
                        <p id="doc-content">
                            <textarea style="display:none;"> {!! $article->content !!} </textarea>
                        </p>
                        <p>
                            @if($preArticle)
                                上一篇：<a style="color:#336699;"
                                       href="{{ $preArticle->info_url }}">{{ $preArticle->title }}</a>
                                <br>
                            @endif
                            @if($nextArticle)
                                下一篇：<a style="color:#336699;"
                                       href="{{ $nextArticle->info_url }}">{{ $nextArticle->title }}</a>
                            @endif
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
                    </div>
                </div>
                <div class="card" style="margin-top:15px;">
                    <div class="card-body">
                        <table style="margin:10px 0 40px 0;">
                            @foreach($article->comments as $comment)

                                <tr>
                                    <td style="padding: 0 10px;">
                                        <a name="{{ $comment->username }}" href="{{ $comment->website }}" target="_blank">
                                            <img style="border-radius:50%;" src="{{ asset(($comment->email=='xx9815@qq.com')?'img/my_avatar.png':'img/default_avatar.png') }}">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $comment->website }}"
                                           target="_blank">{{ $comment->username }}</a>
                                        <br>
                                        <span style="color:#ddd;">{{ $comment->created_at->format('Y-m-d H:i') }}</span>
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
                        <form method="POST" action="{{ route('blog.comment.store') }}">
                            @csrf
                            <input type="hidden" name="aid" value="{{ $article->id }}">
                            <div class="form-group">
                                <label for="username"
                                       class="form-label {{ $errors->has('username') ? ' is-invalid' : '' }}"><span
                                            class="text-danger">*</span>姓名</label>
                                <input id="username" type="text" class="form-control" name="username"
                                       value="{{ old('username')?:$comment_cache->username??'' }}"
                                       required autofocus  placeholder="您的名称">
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback"  style="display:block;">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email"
                                       class="form-label {{ $errors->has('email') ? ' is-invalid' : '' }}"><span
                                            class="text-danger">*</span>邮箱</label>
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email')?:$comment_cache->email??'' }}"  placeholder="邮箱不会公开"
                                       required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback"  style="display:block;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="website"
                                       class="form-label {{ $errors->has('website') ? ' is-invalid' : '' }}">个人网站</label>
                                <input id="website" type="text" class="form-control" name="website"
                                       value="{{ old('website')?:$comment_cache->website??'' }}" placeholder="可选，填写后点击头像可以直接进入">
                                @if ($errors->has('website'))
                                    <span class="invalid-feedback"  style="display:block;">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="content"
                                       class="form-label  {{ $errors->has('content') ? ' is-invalid' : '' }}"><span
                                            class="text-danger" style="font-size:20px;">*</span>评论内容，支持<a
                                            href="https://daringfireball.net/projects/markdown/syntax">Markdown</a></label>
                                <textarea id="content" rows="6" class="form-control"
                                          name="content" required>{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback col-md-12" style="display:block;">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1 text-md-right">
                                    <a href="javascript:void(0)"><img  id="captchaImg" src="{{ captcha_src('mini') }}"></a>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="captcha" value=""  placeholder="验证码">
                                </div>
                                @if ($errors->has('captcha'))
                                    <span class="invalid-feedback col-md-12" style="display:block;">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    提交
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" id="topMao" style="display: block;position: fixed;bottom:50px;right:50px;"><img src="{{ asset('img/top.png') }}"></a>
@endsection
@section('script')
    <script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
    <script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>
    <script type="text/javascript">
      $(function () {
        $('#topMao').click(function () {
          $("html,body").animate({scrollTop: $("#app").offset().top}, 500);
        });

        $('#zanshang').click(function () {
          $("#zanshangImg").toggle(500);
        });
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
      });
    </script>
@endsection