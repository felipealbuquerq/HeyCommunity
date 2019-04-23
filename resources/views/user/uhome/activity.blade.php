@extends('layouts.default')

@section('title')
{{ $user->nickname }} 的发起或参与的活动 - {{ $system->site_title }}
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
                            @include('activity._activity-list', ['activities' => $activities])
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
