@extends('layouts.default')

@section('title')
{{ $user->nickname }} 的发布的话题 - {{ $system->site_title }}
@endsection

@section('description')
{{ $user->bio }}
@endsection

@section('avatar')
{{ $user->avatar }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-user-uhome">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-3 m-np">
                    @include('user.uhome._side-left')
                </div>

                <div class="col-md-9 m-np" id="section-body">
                    @include('user.uhome._nav')

                    <div class="tab-content" id="nav-mainTabContent">
                        <div class="tab-pane fade show active">
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

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3 d-block d-md-none m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
