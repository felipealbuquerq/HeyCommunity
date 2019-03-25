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
                                                <div style="display: inline-block; margin-bottom: 10px; margin-right: 10px; vertical-align: bottom;">
                                                    @foreach ($timeline->images as $image)
                                                        <img data-action="zoom" data-width="1050" data-height="700" src="{{ $image->file_path }}" style="width: 273px; height: 182px;">
                                                    @endforeach
                                                </div>
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
