@extends('layouts.default')

@section('title')
    动态 - {{ $system->site_title }}
@endsection

@section('description')
    有什么新鲜事？与大家一起分享
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-timeline-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-7 offset-lg-1">

                    <ul class="list-group media-list media-list-stream mb-4">
                        @include('timeline._create')

                        @unless ($timelines->count())
                            <div class="card card-default">
                                <div class="card-body">
                                    暂无内容，你来发布第一个动态吧 ~
                                </div>
                            </div>
                        @endunless

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

                                        @if ($timeline->images()->count())
                                            <div class="media-body-inline-grid" data-grid="images">
                                                @foreach ($timeline->images as $image)
                                                    <img data-action="zoom" data-width="{{ $image->image_width }}" data-height="{{ $image->image_height }}" src="{{ asset($image->file_path) }}">
                                                @endforeach
                                            </div>
                                        @endif
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
