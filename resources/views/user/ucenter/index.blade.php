@extends('layouts.default')

@section('title')
社区生涯 - {{ $system->site_title }}
@endsection

@php
$wxShareDisable = true;
@endphp

@section('mainBody')
    <div id="section-mainbody" class="page-user-ucenter">
        @include('user.ucenter._profile-header')

        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np">
                    @include('user.ucenter._nav')

                    <div class="d-none d-md-block">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div class="card">
                        <div class="card-header">社区生涯</div>
                        @if ($records->isEmpty())
                            <div class="card-body">暂无数据</div>
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
                </div>

                <div class="col-md-12 mt-3 d-block d-md-none m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
