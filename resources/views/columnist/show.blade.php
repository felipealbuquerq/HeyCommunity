@extends('layouts.default')

@section('title')
    {{ $columnist->title }} 专栏 - {{ $system->site_title }}
@endsection

@section('description')
    {{ strip_tags($columnist->description) }}
@endsection

@section('avatar')
    {{ $columnist->user->avatar }}
@endsection

@section('mainBody')
    <div id="section-site" class="page-site-about">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np d-none d-md-block">
                    @include('columnist._columnist_card')

                    @include('layouts._tail')
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div class="jumbotron pt-4 pb-2 mb-3">
                        <h1 class="display-4">
                            {{ $columnist->title }}
                            <small class="text-muted">专栏</small>
                        </h1>
                        <p class="lead">
                            {{ $columnist->description }}
                        </p>
                    </div>

                    <div class="mb-3 m-p15-x">
                        <a class="btn btn-secondary {{ setParamActive('filter', 'recent') }}" href="{{ route('columnist.show', ['domain' => $columnist->domain, 'filter' => 'recent']) }}">最近</a>
                        <a class="btn btn-secondary {{ setParamActive('filter', 'hot') }}" href="{{ route('columnist.show', ['domain' => $columnist->domain, 'filter' => 'hot']) }}">最热</a>

                        @if (Gate::allows('auth.ownOrAdmin', $columnist))
                            &nbsp;&nbsp;
                            <a href="{{ route('column.create', $columnist->domain) }}" class="btn btn-primary"><i class="fa fa-edit"></i> 新专栏文章</a>
                        @endif

                        <a class="btn btn-secondary pull-right" href="#" onclick="document.location.reload()">刷新</a>
                    </div>

                    @if ($columns->count() < 1)
                        <div class="card">
                            <div class="card-body">
                                暂无专栏文章
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="list-group list-group-flush">
                                @foreach ($columns as $column)
                                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <a class="h5 mb-1" href="{{ route('column.show', $column->id) }}">{{ $column->title }}</a>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-3">
                            <!-- Pagination -->
                            <nav id="section-pagination">
                                {{ $columns->links() }}
                            </nav>
                        </div>
                    @endif
                </div>

                <div class="col-12 m-np mt-4 d-block d-md-none">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
