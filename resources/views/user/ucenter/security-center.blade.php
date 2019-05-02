@extends('layouts.default')

@section('title')
安全中心 - {{ $system->site_title }}
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
                        <div class="card-header">安全中心</div>
                        <div class="card-body">
                            <div class="h5">密码安全</div>
                            <p>
                                如果你要修改密码，请<a todo-href="">点击这里修改</a> <br>
                                如果你忘记了密码，请<a todo-href="">点击这里找回密码</a>
                            </p>

                            <hr>

                            <div class="h5">手机和邮箱</div>
                            <p>绑定手机和邮箱有助于保障你的帐户安全，如果需要修改或绑定手机/邮箱，<a href="{{ route('user.ucenter.profile') }}">请点击这里</a></p>
                            <p>
                                你当前的手机是: {{ $user->phone }} <br>
                                你当前的邮箱是: {{ $user->email }} <br>
                            </p>
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
