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
                <div class="col-lg-3 col-md-3 m-np">
                    @include('user.ucenter._nav')

                    <div class="d-none d-md-block">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div class="card">
                        <div class="card-header">安全中心</div>
                        <div class="card-body">
                            <div class="h5">密码安全</div>
                            <p>
                                如果你要修改密码，请<a todo-href="">点击这里修改</a> <br>
                                如果你忘记了密码，请<a todo-href="">点击这里找回密码</a>
                            </p>

                            <hr>

                            <div class="h5">验证邮箱和手机</div>
                            <p>验证邮箱和手机有助于保障你的帐户安全，如果需要修改邮箱或手机，请点击这里</p>
                            <p>
                                你的邮箱是: {{ $user->email }}，<a todo-href="">点击这里进行验证</a> <br>
                                你的手机是: {{ $user->phone }}，<a todo-href="">点击这里进行验证</a> <br>
                            </p>
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
