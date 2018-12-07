@extends('layouts.default')

@section('title')
    新闻资讯 - {{ $system->site_title }}
@endsection

@section('description')
    实时的新闻与资讯
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-post-index">
    <div class="container pt-2">
        <div class="row">
            <div class="col-md-9 mt-4">
                <ul class="list-group">
                    @foreach($posts as $post)
                        <li class="list-group-item">
                            <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                            <small class="pull-right text-muted">{{ $post->created_at }}</small>
                        </li>
                    @endforeach
                </ul>

                @if ($posts->count() == 0)
                    <div class="card">
                        <div class="card-body">
                            暂无数据
                        </div>
                    </div>
                @endif

                <!-- Pagination -->
                <nav id="section-pagination">
                    {{ $posts->links() }}
                </nav>
            </div>

            <div class="col-md-3 mt-4 m-np">
                @include('layouts._tail')
            </div>
        </div>
    </div>
</div>
@endsection
