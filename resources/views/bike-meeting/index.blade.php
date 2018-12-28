@extends('bike-meeting.layout')

@section('title')
    上犹自行车运动协会年会
@endsection

@section('description')
@endsection

@section('mainBody')
    <style>
        .line {
            margin-bottom: 8px;
        }
    </style>
    <div id="section-mainbody" class="page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h4 text-center">
                        上犹自行车运动协会年会
                    </h1>

                    <br>

                    <p>
                        新年将至，在美利达到捷安特的5年时光里，俱乐部数百名骑友在一起爬过山岗越过小溪，风里雨里同行不弃。
                    </p>

                    <p>
                        在这5年时光里，征战过九龙江和阳岭，去到过龙勾采橙观莲，在七星草原篝火烧烤，同行登顶齐云山。
                    </p>

                    <p>
                        元月12日，我们再次欢聚一堂，联络情谊交流骑行，迎接新年新气象，携手开启新征程。
                    </p>

                    <p>
                        <b>活动时间</b>：2019年1月12日(星期六)，下午3点至晚上8点 <br>
                        <b>活动地点</b>：梅水观音坐莲农庄 （暂定） <br>
                        <b>活动流程</b>：3点至5点在农庄自由活动自由娱乐，5点半开始吃饭，席间席后才艺表演，抽奖活动。 <br>
                        <b>活动费用</b>：100RMB/人，报名问题和缴费请联系罗德 (电话和微信: 17600719763) <br>
                        <br>

                        活动接受现金和礼品赞助，才艺表演征集中，咨询，节目表演和赞助请联系 黄慧，罗德，海浪
                    </p>

                    <br>

                    @if ($applyData && $applyData->is_payment)
                        <a class="btn btn-warning btn-block" href="{{ route('bike-meeting.apply-successful') }}">您已成功报名并缴费</a>
                    @elseif ($applyData && !$applyData->is_payment)
                        <a class="btn btn-warning btn-block" href="{{ route('bike-meeting.payment') }}">立即缴费完成报名</a>
                    @else
                        <a class="btn btn-warning btn-block" href="{{ route('bike-meeting.apply') }}">立即报名</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
