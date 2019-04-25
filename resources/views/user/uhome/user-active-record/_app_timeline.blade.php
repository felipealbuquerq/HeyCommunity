<li class="list-group-item media p-4">
    <span class="fa fa-bullhorn text-muted mr-2" style="line-height:22px;"></span>

    <div class="media-body">
        <small class="text-muted float-right">{{ $record->created_at }}</small>
        <div class="media-heading">
            <a href="#"><strong>{{ $record->user->nickname }}</strong></a> 分享了动态
            <div>{{ $record->entity->content }}</div>
        </div>
    </div>
</li>
