@extends('layouts.default')

@section('title')
{{ $user->nickname }} 的主页 - {{ $system->site_title }}
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

                    @if ($records->isEmpty())
                        <div class="card">
                            <div class="card-body">
                                暂无数据
                            </div>
                        </div>
                    @else
                        <ul class="list-group media-list media-list-stream mb-2">
                            @foreach ($records as $record)
                                @include('user.uhome.user-active-record.' . $record->entity_blade_tpl)
                            @endforeach
                        </ul>

                        <!-- Pagination -->
                        <nav id="section-pagination">
                            {{ $records->links() }}
                        </nav>
                    @endif
                </div>

                <div class="col-md-12 mt-3 d-block d-md-none m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
