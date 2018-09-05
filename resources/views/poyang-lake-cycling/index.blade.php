@extends('poyang-lake-cycling.layout')

@section('title')
    2018第九届环鄱阳湖国际自行车赛（上犹站）
    暨阳明湖第四届业余自行车邀请赛
@endsection

@section('description')
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center">
                        2018第九届环鄱阳湖国际自行车赛（上犹站）<br>
                        暨阳明湖第四届业余自行车邀请赛竞赛规程
                    </h1>

                    <p>
                        报到时间：2018年9月22日15:00-20:00
                        报到地点：江西省上犹县文体中心（上犹县犹江大道，县行政中心旁）
                        联系人：黄慧  电话：15179078666，黄祥己 电话：13979783226，
                    </p>

                    <a class="btn btn-warning btn-block" href="{{ route('poyang-lake-cycling.apply') }}">立即报名</a>
                </div>
            </div>
        </div>
    </div>
@stop
