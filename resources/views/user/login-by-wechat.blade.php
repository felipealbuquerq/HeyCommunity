@extends('layouts.default')

@section('title')
微信登录 - {{ $system->site_title }}
@endsection

@php
    $wxShareDisable = true;
@endphp

@section('mainBody')
<div id="section-mainbody" class="page-user-login-wechat-transfer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 m-np">
                <div class="card" style="margin-top:100px;">
                    <div class="card-body p-5">
                        <h2>欢迎登录到 {{ $system->site_title }}</h2>

                        <p class="mt-3">
                            正在为您跳转到首页 ...
                            <script>
                                setTimeout(function() {
                                  window.location.assign("{{ route('home') }}");
                                }, 3000)
                            </script>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
