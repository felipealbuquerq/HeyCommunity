@extends('layouts.default')

@section('title')
    专栏首页 - {{ $system->site_title }}
@endsection

@section('description')
    知识分子和精英阶层的在这里分享精彩的观点和见解
@endsection

@section('mainBody')
    <div id="section-columnist" class="page-columnist-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-xl-3 col-md-4 m-np d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">推荐专栏</h6>
                            <div class="div">
                                <span>暂无推荐</span>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-title">最近更新的专栏</h6>
                            <div class="div">
                                @foreach ($recentColumnists as $columnist)
                                    <div class="mb-2">
                                        <strong><a href="{{ route('column.show', $columnist->domain) }}">{{ $columnist->title }}</a></strong>
                                        <small class="text-muted ml-1">{{ str_limit($columnist->description, 60) }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-xl-9 col-md-8 m-np">
                    <div class="right-tools mb-3 m-p15-x">
                        <a class="btn btn-secondary {{ setParamActive('filter', 'recent') }}" href="{{ route('columnist.index', ['filter' => 'recent']) }}">最近</a>
                        <a class="btn btn-secondary {{ setParamActive('filter', 'hot') }}" href="{{ route('columnist.index', ['filter' => 'hot']) }}">最热</a>
                        <a class="disabled btn btn-secondary {{ setParamActive('filter', 'recommend') }}" href="{{ route('columnist.index', ['filter' => 'recommend']) }}">推荐</a>

                        <!--
                        &nbsp;&nbsp;
                        <a class="btn btn-secondary {{ setParamActive('filter', 'subscription') }}" href="{{ route('columnist.index', ['filter' => 'subscription']) }}">订阅</a>
                        -->

                        <div class="pull-right d-none d-sm-block">
                            <a class="btn btn-secondary" href="#" onclick="document.location.reload()">刷新</a>
                        </div>
                    </div>

                    @if ($columns->count())
                        <div id="component-topic-list" class="list-group">
                            @foreach ($columns as $column)
                                <div class="list-group-item m-nb-y m-nb-r">
                                    <a class="avatar" href="{{ route('columnist.show', $column->author->domain) }}">
                                        <img class="avatar" src="{{ asset($column->user->avatar) }}">
                                    </a>
                                    <div class="pull-left body">
                                        <div class="title">
                                            <span class="info d-none d-sm-inline-block text-muted">
                                                {{ $column->thumb_up_num }} &nbsp; / &nbsp; {{ $column->comment_num }} &nbsp; / &nbsp; {{ $column->read_num }}
                                                &nbsp;&nbsp;&nbsp; {{ $column->created_at->format('m-d') }}
                                            </span>
                                            <a class="d-inline" href="{{ route('column.show', $column->id) }}">{{ $column->title }}</a>

                                            <small class="text-muted">
                                                &nbsp;/
                                                <a class="d-inline text-primary text-muted" href="{{ route('columnist.show', $column->author->domain) }}">
                                                    {{ $column->author->title }} 专栏
                                                </a>
                                            </small>
                                        </div>

                                        <div class="text">
                                            {{ mb_substr(strip_tags($column->content), 0, 110) }} ...
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <nav id="section-pagination">
                            {{ $columns->links() }}
                        </nav>
                    @else
                        <div class="card">
                            <div class="card-body">
                                暂无数据
                            </div>
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
