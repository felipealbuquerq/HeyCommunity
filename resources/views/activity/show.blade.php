@extends('layouts.default')

@section('title')
    {{ $activity->title }} - {{ $system->site_title }}
@endsection

@section('description')
    {{ str_limit(strip_tags($activity->content), 100) }}
@endsection

@section('avatar')
    {{ $activity->avatar }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-activity-show">
        <div class="container pt-4">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('activity') }}">活动</a></li>
                    <li class="breadcrumb-item active" aria-current="page">活动详情</li>
                </ol>
            </nav>

            <div class="row" id="section-row-1">
                <div class="col-md-4 m-np m-nb-y">
                    <div class="card">
                        <img src="{{ asset($activity->avatar) }}" class="card-img-top" alt="{{ $activity->title }}">

                        <div class="card-body">
                            <h4 class="card-title">{{ $activity->title }}</h4>

                            <div class="card-subtitle text-muted">
                                <i class="fa fa-user"></i>&nbsp;
                                {{ $activity->author->nickname }}

                                <span class="pull-right">
                                    <small>发布于 {{ $activity->created_at }}</small>
                                </span>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fa fa-calendar"> 时间</i> &nbsp;
                                <span class="pull-right">
                                    <span>{{ \Carbon\Carbon::parse($activity->start_time)->format('Y/m/d') }}</span>
                                    至
                                    <span>{{ \Carbon\Carbon::parse($activity->start_time)->format('Y/m/d') }}</span>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-map-signs"> 地点</i> &nbsp;
                                <span class="pull-right">
                                    {{ $activity->local }}
                                </span>
                            </li>
                        </ul>

                        <div class="card-body">
                            <p class="card-text">{!! $activity->intro !!}</p>

                            <a class="btn btn-primary btn-block" href="{{ $activity->redirect_url }}" target="_blank">
                                <i class="fa fa-send"></i> &nbsp;
                                报名或了解活动详情
                            </a>
                        </div>

                    </div>

                    <div class="mt-3 d-none d-md-block">
                        @include('layouts._sns', ['class' => 'mb-3'])

                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-md-8 m-np" id="section-body">
                    <div class="card">
                        <div class="card-header">
                            <nav class="nav nav-tabs card-header-tabs">
                                <a class="text-dark nav-item nav-link active" id="nav-content-tab" data-toggle="tab" href="#nav-content">活动详情</a>
                                <a class="text-dark nav-item nav-link" id="nav-topic-tab" data-toggle="tab" href="#nav-topic">相关讨论</a>
                            </nav>
                        </div>
                        <div class="card-body">
                            <div class="tab-content pt-0">
                                <!-- Content -->
                                <div class="tab-pane fade show active" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
                                    {!! $activity->content !!}
                                </div>

                                <!-- Comments -->
                                <div class="tab-pane fade" id="nav-topic" role="tabpanel" aria-labelledby="nav-topic-tab">
                                    <form action="{{ route('activity-comment.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">

                                        <div class="input-group">
                                            <textarea name="content" class="form-control" placeholder="请输入评论内容" rows="3"></textarea>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-primary" type="submit" style="width:5em;">发布</button>
                                            </div>
                                        </div>
                                    </form>

                                    <hr>

                                    @if ($activity->comments->isEmpty())
                                        <p class="text-muted">暂无数据，你来发布第一条评论吧 ~</p>
                                    @endif

                                    <ul class="list-group media-list media-list-stream mb-4">
                                        @foreach ($activity->comments as $comment)
                                            <li class="media list-group-item p-4">
                                                <img class="media-object d-flex align-self-start mr-3" src="{{ asset($comment->user->avatar) }}">
                                                <div class="media-body">
                                                    <div class="media-body-text">
                                                        <div class="media-heading">
                                                            <small class="float-right text-muted">
                                                                #{{ $comment->floor_number }}
                                                                &nbsp;
                                                                {{ $comment->created_at->diffForHumans() }}
                                                            </small>
                                                            <h6><a href="{{ route('user.uhome', $comment->user_id) }}">{{ $comment->user->nickname }}</a></h6>
                                                        </div>
                                                        <p>{{ $comment->content }}</p>

                                                    </div>
                                                    <div class="text-muted" style="font-size:12px;">
                                                        {{ $comment->created_at }}
                                                        <div class="pull-right">
                                                            <a href="javascript:void" onclick="$('#activity-comment-{{ $comment->id }}-form').show()"><i class="fa fa-reply"></i> 评论</a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <form id="activity-comment-{{ $comment->id }}-form" method="post" action="{{ route('activity-comment.store') }}" class="mb-4" style="display:none;">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="评论一下 ~" name="content">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-secondary" type="submit">评论</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <ul class="media-list">
                                                        @foreach ($comment->comments as $subComment)
                                                        <li class="media">
                                                            <img class="media-object d-flex align-self-start mr-3" src="{{ $subComment->user->avatar }}">
                                                            <div class="media-body">
                                                                <div>
                                                                    <strong><a href="{{ route('user.uhome', $subComment->user_id) }}">{{ $subComment->user->nickname }}</a></strong>
                                                                    <div class="pull-right">
                                                                        <small class="text-muted">
                                                                            #{{ $subComment->floor_number }}
                                                                            &nbsp;
                                                                            {{ $subComment->created_at }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    {{ $subComment->content }}
                                                                </div>
                                                                <hr>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-block d-md-none m-np mt-3">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
