<li class="media list-group-item p-4">
    <span class="fa fa-bullhorn text-muted mr-2" style="line-height:22px;"></span>
    <div class="media-body col-md-8 pl-0">
        <div class="media-body-text">
            <small class="text-muted float-right">{{ $record->entity->timeline->created_at->diffForHumans() }}</small>
            <div class="media-heading">
                评论了
                <a href="#"><strong>{{ $record->entity->timeline->user->nickname }}</strong></a>
                的动态
            </div>
            <div>{{ $record->entity->timeline->content }}</div>

            @if ($record->entity->timeline->images()->count())
                <div class="media-body-inline-grid" data-grid="images">
                    @foreach ($record->entity->timeline->images as $image)
                        <img data-action="zoom" data-width="{{ $image->image_width }}" data-height="{{ $image->image_height }}" src="{{ asset($image->file_path) }}">
                    @endforeach
                </div>
            @endif
        </div>
        <div class="text-muted" style="font-size:12px;">
            {{ $record->entity->timeline->created_at }}
            <div class="pull-right">
                <a href="javascript:void" onclick="$('#timeline-{{ $record->entity->timeline->id }}-comment-form').show()"><i class="fa fa-reply"></i> 评论</a>
            </div>
        </div>
        <hr>
        <form id="timeline-{{ $record->entity->timeline->id }}-comment-form" method="post" action="{{ route('timeline-comment.store') }}" class="mb-4" style="display:none;">
            {{ csrf_field() }}
            <input type="hidden" name="timeline_id" value="{{ $record->entity->timeline->id }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="评论一下 ~" name="content">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">评论</button>
                </div>
            </div>
        </form>

        <ul class="media-list">
            <li class="media">
                <img class="media-object d-flex align-self-start mr-3" src="{{ asset($record->entity->user->avatar) }}">
                <div class="media-body">
                    <div>
                        <strong><a href="{{ route('user.uhome', $record->user_id) }}">{{ $record->entity->user->nickname }}</a></strong>
                        <div class="pull-right">
                            <small class="text-muted">{{ $record->entity->created_at }}</small>
                        </div>
                    </div>
                    <div>
                        {{ $record->entity->content }}
                    </div>
                    <hr>
                </div>
            </li>
        </ul>
    </div>
</li>