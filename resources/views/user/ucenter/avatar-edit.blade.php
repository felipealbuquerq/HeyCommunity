@extends('layouts.default')

@section('title')
更新头像 - {{ $system->site_title }}
@endsection

@php
$wxShareDisable = true;
@endphp

@section('mainBody')
    <div id="section-mainbody" class="page-user-ucenter">
        @include('user.ucenter._profile-header')

        <div class="container pt-4">
            <div class="row">
                <div class="col-md-3 m-np">
                    @include('user.ucenter._nav')
                </div>

                <div class="col-md-9 m-np">
                    <div class="card">
                        <div class="card-header">
                            更新头像
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.ucenter.profile-update') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label class="offset-md-1 col-md-1 col-form-label">头像</label>
                                    <div class="col-md-6">
                                        <img class="rounded align-bottom" src="{{ asset($user->avatar) }}" style="width:80px;">
                                        <a href="{{ route('user.ucenter.avatar-edit') }}" class="btn btn-secondary btn-sm ml-3">更换头像</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
