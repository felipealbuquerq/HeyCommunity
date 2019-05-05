@if ($entity->comments->isEmpty())
    <hr>
    <div class="text-muted">暂无数据，你来发布第一条评论吧 ~</div>
@else
    @php
        $comments = $entity->comments()->paginate(5);
    @endphp
    <div id="section-comment-list" class="mt-4">
        <ul class="list-group media-list media-list-stream">
            @foreach ($comments as $comment)
                <li class="media list-group-item pt-4 pb-4 pl-0 pr-0">
                    <img class="media-object d-flex align-self-start mr-3" src="{{ asset($comment->user->avatar) }}">
                    <div class="media-body">
                        <div class="media-body-text">
                            <div class="media-heading">
                                <small class="float-right text-muted">
                                    <span>#{{ $comment->floor_number }}</span>
                                    &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="disable"><i class="fa fa-thumbs-o-up"></i> 点赞 <sup>{{ $comment->thumb_up_num ?: '' }}</sup></a>
                                    &nbsp;<small>|</small>&nbsp;
                                    <a class="disable"><i class="fa fa-thumbs-o-down"></i> 反对 <sup>{{ $comment->thumb_down_num ?: '' }}</sup></a>
                                </small>
                                <h6><a href="{{ route('user.uhome', $comment->user_id) }}">{{ $comment->user->nickname }}</a></h6>
                            </div>
                            <p class="content">{!!  nl2br($comment->content) !!}</p>

                        </div>
                        <div class="text-muted" style="font-size:12px;">
                            {{ $comment->created_at->diffForHumans() }}

                            <div class="pull-right">
                                <a href="javascript:void" onclick="$('#comment-{{ $comment->id }}-form').show()">
                                    <i class="fa fa-reply"></i> 评论
                                    <sup>{{ $comment->comment_num ?: '' }}</sup>
                                </a>
                            </div>
                        </div>

                        @if ($comment->comments()->count())
                        <hr>
                        @endif

                        <form id="comment-{{ $comment->id }}-form" method="post" action="{{ route('comment.store') }}" class="mb-4" style="display:none;">
                            @unless ($comment->comments()->count())
                                <hr>
                            @endunless

                            {{ csrf_field() }}
                            <input type="hidden" name="entity_type" value="{{ get_class($comment->belongEntity) }}">
                            <input type="hidden" name="entity_id" value="{{ $comment->belongEntity->id }}">
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
                                            {{ ($subComment->content) }}
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


    <nav id="section-pagination">
        {{ $comments->links() }}
    </nav>
@endif
