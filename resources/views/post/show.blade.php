@extends('layouts.default')

@section('title')
    {{ $post->title }} - {{ $system->site_title }}
@endsection

@section('description')
    {{ str_limit(strip_tags($post->content), 100) }}
@endsection

@section('avatar')
    {{ $post->avatar }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-post-show">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-9 m-np mb-3">
                    <div class="card card-post">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <span class="post-origin">
                                    {{ $post->user ? $post->user->nickname : '佚名' }}
                                </span>

                                <span class="pull-right post-date">
                                    {{ $post->created_at }}
                                </span>
                            </h6>

                            <div class="card-text">
                                {!! $post->content !!}
                            </div>

                            <br class="m-inline">
                            <br class="m-hide">
                            @if ($post->origin_url)
                                <a target="_blank" href="{{ $post->origin_url }}" class="card-link m-hide">阅读原文</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-3 m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
