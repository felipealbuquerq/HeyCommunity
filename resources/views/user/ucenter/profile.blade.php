@extends('layouts.default')

@section('title')
个人中心 - {{ $system->site_title }}
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
                            <span class="pull-right text-muted">
                                <a href="{{ route('user.ucenter.profile-edit') }}">
                                    <i class="fa fa-edit"></i>
                                    更新资料
                                </a>
                            </span>
                            我的资料
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.ucenter.profile-update') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="input-nickname" class="offset-md-1 col-md-1 col-form-label">昵称</label>
                                    <div class="col-md-6">
                                        <input disabled name="nickname" type="text" class="form-control" id="input-nickname" value="{{ old('nickname', $user->nickname) }}">

                                        <div class="text-danger">{{ $errors->first('nickname') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-bio" class="offset-md-1 col-md-1 col-form-label">签名</label>
                                    <div class="col-md-6">
                                        <textarea disabled name="bio" class="form-control" id="input-bio">{{ old('bio', $user->bio) }}</textarea>

                                        <div class="text-danger">{{ $errors->first('bio') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-gender" class="offset-md-1 col-md-1 col-form-label">性别</label>
                                    <div class="col-md-6">
                                        <select disabled name="gender" class="custom-select form-control">
                                            <option selected>请选择性别</option>
                                            @foreach (\App\User::$genders as $value => $name)
                                                <option value="{{ $value }}" {{ $value == old('gender', $user->gender) ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="text-danger">{{ $errors->first('gender') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-phone" class="offset-md-1 col-md-1 col-form-label">电话</label>
                                    <div class="col-md-6">
                                        <input disabled name="phone" type="text" class="form-control" id="input-phone" value="{{ old('phone', $user->phone) }}">

                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-email" class="offset-md-1 col-md-1">邮箱</label>
                                    <div class="col-md-6">
                                        <input disabled name="email" type="text" class="form-control" id="input-email" value="{{ old('email', $user->email) }}">

                                        <div class="text-danger">{{ $errors->first('email') }}</div>
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
