@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">{{ $article->title }}</h5>
                        <br>
                        <p>{!! MarkdownEditor::parse($article->content) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection