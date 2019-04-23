@extends('layouts.default')

@section('title')
我参与的话题 - {{ $system->site_title }}
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
                    @include('topic._topic-list-with-comment', ['topicComments' => $topicComments])
                </div>

                <div class="col-md-12 mt-3 d-block d-md-none m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
