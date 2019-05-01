@if ($topicComments->count())
    <div id="component-topic-list" class="list-group">
        @foreach ($topicComments as $comment)
            <div class="list-group-item m-nb-y m-nb-r">
                <a class="avatar" href="{{ route('user.uhome', $comment->author->id) }}"><img class="avatar" src="{{ asset($comment->author->avatar) }}"></a>
                <div class="pull-left body">
                    <div class="title">
                                                    <span class="info d-none d-sm-inline-block text-muted">
                                                        &nbsp;&nbsp;&nbsp; {{ $comment->created_at->diffForHumans() }}
                                                    </span>

                        <a href="{{ route('topic.show', $comment->topic->id) }}">
                            {{ $comment->topic->title }}
                            <sup class="text-muted">#{{ $comment->floor_number }}</sup>
                        </a>
                    </div>

                    <div class="content">
                        {!! str_limit(strip_tags($comment->content), 220) !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav id="section-pagination">
        {{ $topicComments->links() }}
    </nav>
@else
    <div class="card">
        <div class="card-body">
            暂无数据
        </div>
    </div>
@endif
