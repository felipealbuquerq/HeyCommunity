@extends('layouts.default')

@section('title')
{{ $news->title }} - {{ $system->site_title }}
@endsection

@section('description')
{{ str_limit(strip_tags($news->content), 100) }}
@endsection

@section('avatar')
{{ $news->avatar }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-show">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-7 m-np mb-3">
                    <div class="card card-news">
                        <div class="card-header d-none d-md-block">新闻详情</div>
                        <div class="card-body">
                            <div class="entry">
                                <div class="mt-4 mb-2">
                                    <h2 class="text-left">{{ $news->title }}</h2>
                                    <small class="d-block mb-3 text-muted">
                                    <span class="">
                                        {{ $news->origin }}
                                    </span>

                                        <span class="pull-right news-date">
                                    {{ $news->time }}
                                </span>
                                    </small>
                                </div>

                                <div class="card-text">
                                    {!! $news->content !!}
                                </div>
                            </div>
                        </div>

                        <div class="card-footer small text-muted">
                            <span class="">发布于 {{ $news->time }}</span>
                            <span class="pull-right">
                                <a class="text-dark d-none d-md-inline" target="_blank" href="{{ $news->url ?: $news->weburl }}">{{ $news->origin }}</a>
                                <a class="text-dark d-inline-block d-md-none" target="_blank" href="{{ $news->weburl ?: $news->url }}">{{ $news->origin }}</a>
                            </span>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-md-5 m-np">
                    <div class="card">
                        <div class="card-header">评论</div>
                        <div class="card-body">
                            @include('layouts.comment.root-comment', ['entityType' => get_class($news), 'entityId' => $news->id])
                            @include('layouts.comment.comment-list', ['entity' => $news])
                        </div>
                    </div>

                    <div class="d-block d-md-none">
                        @include('layouts._tail')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
