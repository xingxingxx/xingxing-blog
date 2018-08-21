@extends('layouts.app')
@section('title', $special->title)
@section('content')
    <div class="jumbotron" style="background-color: #ffffff;margin-bottom: 0;">
        <div class="row justify-content-center">
            <div class="col-md-8 row">

                <div class="col-md-8">
                    <h3>{{ $special->title }}</h3>
                    <p>{{ $special->description }}</p>
                    <p>{{ $special->created_at }}</p>
                    <div>
                        <a href="#" class="btn btn-sm btn-primary">订阅专栏</a>
                        <button class="btn btn-sm btn-success" id="zanshang">赞赏</button>
                        <img id="zanshangImg" style="display: none;" width="300px;"
                             src="{{ asset('img/wechat_zanshang.jpg') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <img style="width:100%;" src="{{ asset('uploads/file/'.$special->cover) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-top:10px;">
                    <div class="card-body">
                        @forelse($articles as $key=>$article)

                            <h5 style="padding-bottom:10px;"><strong>
                                    <a href="{{ $article->info_url }}"
                                       >{{ $article->title }}</a>
                                </strong>
                            </h5>
                            <div class="row">
                                <div class=" {{ $article->cover?'col-md-8' :'col-md-12'}}">
                                    <div style="margin-bottom: 5px;">
                                        <a href="{{ $article->info_url }}"
                                           >{{ $article->abstract }}</a>
                                    </div>
                                    <div>
                                        发布于&nbsp;{{ $article->created_at->format('Y-m-d') }}
                                        &nbsp;&nbsp;
                                        阅读&nbsp;({{ $article->view_count }})
                                        &nbsp;&nbsp;
                                        评论&nbsp;({{ $article->comment_count }})
                                    </div>
                                </div>
                                @if($article->cover)
                                    <div class="col-md-4">
                                        <a href="{{ $article->info_url }}">
                                            <img style="width:100%;" src="{{ $article->cover }}"></a>
                                    </div>
                                @endif
                            </div>
                            <br>
                            <hr><br>
                        @empty
                            <div class="card">
                                <div class="card-body">
                                    <p><h4 class="text-center">抱歉！没有找到您需要的文章</h4></p>
                                </div>
                            </div>
                        @endforelse
                        <div> {!! $articles->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#zanshang').click(function () {
            $("#zanshangImg").toggle(500);
        });
    </script>
@endsection