<li class="list-group-item media p-4">
    <span class="fa fa-comments text-muted mr-2" style="line-height:22px"></span>

    <div class="media-body">
        <small class="text-muted float-right">{{ $record->created_at }}</small>
        <div class="media-heading">
            评论了
            <a href="#"><strong>{{ $record->entity->timeline->user->nickname }}</strong></a>
            的动态
            <div>{{ $record->entity->content }}</div>
        </div>
    </div>
</li>
