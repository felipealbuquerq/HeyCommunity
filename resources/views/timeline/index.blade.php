@extends('layouts.default')

@section('title')
    动态 - {{ $system->site_title }}
@endsection

@section('description')
    有什么新鲜事？与大家一起分享
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-topic-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-7 offset-lg-1">

                    <ul class="list-group media-list media-list-stream mb-4">
                        <form action="{{ route('timeline.store') }}" method="post">
                            {{ csrf_field() }}

                            <li class="media list-group-item p-4">
                                <div class="input-group">
                                    <input name="content" type="text" class="form-control" placeholder="说点什么 ...">
                                    <div class="btn-group input-group-append">
                                        <button type="button" class="btn btn-secondary">
                                            <span class="fa fa-image"></span>
                                        </button>
                                        <button type="button" class="btn btn-secondary">
                                            <span class="fa fa-video-camera"></span>
                                        </button>
                                        <button type="submit" class="btn btn-secondary">
                                            <span class="fa fa-send"></span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </form>

                        @foreach ($timelines as $timeline)
                            <li class="media list-group-item p-4">
                                <img class="media-object d-flex align-self-start mr-3" src="{{ $timeline->user->avatar }}">
                                <div class="media-body">
                                    <div class="media-body-text">
                                        <div class="media-heading">
                                            <small class="float-right text-muted">{{ $timeline->created_at->diffForHumans() }}</small>
                                            <h6>{{ $timeline->user->nickname }}</h6>
                                        </div>
                                        <p>{{ $timeline->content }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Pagination -->
                    <nav id="section-pagination">
                        {{ $timelines->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
