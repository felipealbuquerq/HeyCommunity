@extends('poyang-lake-cycling.layout')

@section('title')
    报名
@endsection

@section('description')
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h4 text-center">
                        报名成功
                    </h1>

                    <p class="mt-4 text-center">
                        恭喜<b>{{ $applyData->name }}</b>，您已成功报名 [<em>{{ \App\PoYangLakeCyclingApplyData::$groups[$applyData->group_id] }}</em>] 组
                        <br>
                        遵守赛事规则，祝您取得好成绩
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
