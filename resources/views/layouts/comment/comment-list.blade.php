<hr>

@if ($entity->comments->isEmpty())
    <p class="text-muted">暂无数据，你来发布第一条评论吧 ~</p>
@endif

<ul class="list-group media-list media-list-stream mb-4">
    @foreach ($entity->comments as $comment)
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
                    <input type="hidden" name="activity_id" value="{{ $entity->id }}">
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
