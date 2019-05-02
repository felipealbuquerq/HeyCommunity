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
                <div class="col-md-3 m-np">
                    @include('user.ucenter._nav')
                </div>

                <div class="col-md-9 m-np">
                    <div class="card">
                        <div class="card-header">消息推送</div>
                        <div class="card-body">
                            <p>
                                目前，我们仅通过微信公众号的消息推送功能把通知中心的消息推送给你 <br>
                                在将来，我们还会支持手机短信通知或邮件通知，并且支持消息推送的通道和消息类型的自定义开关，敬请期待
                            </p>

                            @if ($user->wx_open_id)
                                <p>
                                    <i class="fa fa-info-circle"></i>
                                    您已绑定微信，如果您关注了我们的公众号，我们将通过微信公众号实时推送社区消息给您 <br>
                                    扫描下方二维码，关注我们的公众号 <br>

                                    <img style="max-width:200px;" src="{{ asset('images/system/wechat/qrcode.jpg') }}">
                                </p>
                            @else
                                <p>
                                    <i class="fa fa-info-circle"></i>
                                    您未绑定微信，目前您将不能收到社区消息（但您可以登录网站收取社区消息）<br>
                                    敬请期待，不久的将来我们将完善相关功能
                                </p>
                            @endif
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
