@extends('bike-meeting.layout')

@section('title')
    报名
@endsection

@section('description')
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="h4 mt-4">
                        请使用微信打开该页面
                    </h1>
                    <p class="text-muted mt-2">
                        请使用微信扫描下方二维码进行报名或查询报名状态
                    </p>

                    <br>
                    <img class="rounded img-fluid" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(route('bike-meeting.index'))) !!} ">
                </div>
            </div>
        </div>
    </div>
@stop
