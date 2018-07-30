@extends('layouts.default')

@section('title')
    用户协议 - {{ $system->site_title }}
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
                            <h4 class="card-title">用户协议</h4>

                            <div class="mt-3">
                                <p>
                                    欢迎您来到<em>HEY赣州</em>。 <br>
                                    我们致力于打造一个有价值、优质的赣州线上社区，请您理解或遵守以下条款：
                                </p>

                                <div class="h5"></div>
                                <ol>
                                    <li>遵守法律法规和社会公德，在平台内发布有价值的内容。</li>
                                    <li>您在平台内发布的内容知识产权归您所有。</li>
                                    <li>您可以要求注销帐户，我们将删除平台内与您有关的数据。</li>
                                    <li>我们将严格保护您的隐私信息不被泄露或被滥用。</li>
                                </ol>

                                <p>
                                    我们保留更新或修改本协议的权利，本协议的修改将会及时公示在此页面中。
                                </p>
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

