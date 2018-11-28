@extends('layouts.default')

@section('title')
    {{ $columnist->title }} 专栏 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-site" class="page-site-about">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np">
                    @if (Auth::check() && Auth::id() == $columnist->user_id)
                        <a href="{{ route('column.create', $columnist->domain) }}" class="btn btn-block btn-primary mb-3"><i class="fa fa-edit"></i> 新专栏文章</a>
                    @endif

                    @include('columnist._columnist_card')
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div class="jumbotron pt-4 pb-2">
                        <h1 class="display-4">
                            {{ $columnist->title }}
                            <small class="text-muted">专栏</small>
                        </h1>
                        <p class="lead">
                            {{ $columnist->description }}
                        </p>
                    </div>

                    @if ($columnist->columns()->count() < 1)
                        <div class="card">
                            <div class="card-body">
                                暂无专栏文章
                            </div>
                        </div>
                    @endif
                    <div class="list-group list-group-flush">
                        @foreach ($columnist->columns()->paginate(6) as $column)
                            <a href="{{ route('column.show', $column->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $column->title }}</h5>
                                    <small class="text-muted">{{ $column->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">
                                    {{ mb_substr(strip_tags($column->content), 0, 120) }}
                                </p>
                                <small>
                                    {{ $column->read_num }} 阅读 /
                                    {{ $column->comment_num }} 评论 /
                                    {{ $column->thumb_up_num }} 点赞 /
                                    {{ $column->favorite_num }} 收藏

                                    &nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;
                                    {{ $column->created_at }}
                                </small>
                            </a>
                        @endforeach

                        <div class="mt-3">
                            {{ $columnist->columns()->paginate()->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-12 m-np mt-4">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
