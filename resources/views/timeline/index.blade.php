@extends('layouts.default')

@section('title')
    动态 - {{ $system->site_title }}
@endsection

@section('description')
    有什么新鲜事？与大家一起分享
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-timeline-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    @include('user._user-profile-card', ['user' => Auth::user()])
                </div>

                <div class="col-md-6 m-np">
                    <ul class="list-group media-list media-list-stream mb-4">
                        @include('timeline._create')

                        @unless ($timelines->count())
                            <div class="card card-default">
                                <div class="card-body">
                                    暂无内容，你来发布第一个动态吧 ~
                                </div>
                            </div>
                        @endunless

                        @foreach ($timelines as $timeline)
                            <li class="media list-group-item p-4">
                                <img class="media-object d-flex align-self-start mr-3" src="{{ asset($timeline->user->avatar) }}">
                                <div class="media-body">
                                    <div class="media-body-text">
                                        <div class="media-heading">
                                            <small class="float-right text-muted">{{ $timeline->created_at->diffForHumans() }}</small>
                                            <h6><a href="{{ route('user.uhome', $timeline->user_id) }}">{{ $timeline->user->nickname }}</a></h6>
                                        </div>
                                        <p>{{ $timeline->content }}</p>

                                        @if ($timeline->images()->count())
                                            <div class="media-body-inline-grid" data-grid="images">
                                                @foreach ($timeline->images as $image)
                                                    <img data-action="zoom" data-width="{{ $image->image_width }}" data-height="{{ $image->image_height }}" src="{{ asset($image->file_path) }}">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-muted" style="font-size:12px;">
                                        {{ $timeline->created_at }}
                                        <div class="pull-right">
                                            <a href="javascript:void" onclick="$('#timeline-{{ $timeline->id }}-comment-form').show()"><i class="fa fa-reply"></i> 评论</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <form id="timeline-{{ $timeline->id }}-comment-form" method="post" action="{{ route('timeline-comment.store') }}" class="mb-4" style="display:none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="timeline_id" value="{{ $timeline->id }}">
                                        <div class="input-group mb-3">
                                            @if (Auth::guest())
                                                <input type="text" class="form-control" placeholder="登录后才能发表评论" name="content" disabled>
                                            @else
                                                <input type="text" class="form-control" placeholder="评论一下 ~" name="content">
                                            @endif
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="submit" {{ Auth::guest() ? 'disabled' : '' }}>评论</button>
                                            </div>
                                        </div>
                                    </form>

                                    <ul class="media-list">
                                        @foreach ($timeline->comments as $comment)
                                        <li class="media">
                                            <img class="media-object d-flex align-self-start mr-3" src="{{ asset($comment->user->avatar) }}">
                                            <div class="media-body">
                                                <div>
                                                    <strong><a href="{{ route('user.uhome', $comment->user_id) }}">{{ $comment->user->nickname }}</a></strong>
                                                    <div class="pull-right">
                                                        <small class="text-muted">{{ $comment->created_at }}</small>
                                                    </div>
                                                </div>
                                                <div>
                                                    {{ $comment->content }}
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

                    <!-- Pagination -->
                    <nav id="section-pagination">
                        {{ $timelines->links() }}
                    </nav>
                </div>

                <div class="col-md-3 m-np">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="mb-3">活跃的人</h6>
                            <ul class="media-list media-list-stream">
                                @foreach ($timelineUsers as $user)
                                    <li class="media mb-2">
                                        <img class="media-object d-flex align-self-start mr-3" src="{{ asset($user->avatar) }}">
                                        <div class="media-body">
                                            <strong><a href="{{ route('user.uhome', $user->id) }}">{{ $user->nickname }}</a></strong>
                                            <div class="media-body-actions">
                                                {{ $user->bio }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                @unless ($timelineUsers->count())
                                    <li><span class="text-muted">暂无内容</span></li>
                                @endunless
                            </ul>
                        </div>
                        <div class="card-footer">
                            在社区中活跃的用户，关注他们以订阅更多精彩动态
                        </div>
                    </div>

                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@endsection
