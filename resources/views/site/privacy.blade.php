@extends('layouts.default')

@section('title')
    隐私政策 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-site" class="page-site-about">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np">
                    @include('site._sidebar')
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div id="sitepage-card" class="card">
                        <div class="card-body">
                            <h4 class="card-title">隐私政策</h4>

                            <div class="mt-3">
                                <p>
                                    我的将秉持一个优秀互联网产品的本心，保护用户的隐私信息不被滥用、未经用户允许用于不合理的用途。 <br>
                                    对于用户隐私信息的使用和保存，遵守以下条款：<br>
                                </p>

                                <ol>
                                    <li>我们将严格保护您的隐私信息不被窃取或泄露。</li>
                                    <li>未经您的允许，我们不会向任何第三方公开或分享您的隐私信息。</li>
                                    <li>您可以要求注销帐户，我们将删除平台内与您有关的数据。</li>
                                </ol>

                                <p>其它：</p>
                                <ol>
                                    <li>我们保留更新或修改本政策的权利，隐私政策的修改将会及时公示在此页面中。</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-block d-md-none m-np mt-4">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop

