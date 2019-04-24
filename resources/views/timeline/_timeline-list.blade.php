@if ($timelines->count())
    <ul class="list-group media-list media-list-stream mb-4">
        @foreach ($timelines as $timeline)
            <li class="media list-group-item p-4">
                <img class="media-object d-flex align-self-start mr-3" src="{{ asset($timeline->user->avatar) }}">
                <div class="media-body col-md-7">
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
@else
    <div class="card">
        <div class="card-body">
            暂无数据
        </div>
    </div>
@endif

