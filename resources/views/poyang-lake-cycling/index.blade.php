@extends('poyang-lake-cycling.layout')

@section('title')
    2018第九届环鄱阳湖国际自行车赛（上犹站）
    暨阳明湖第四届业余自行车邀请赛
@endsection

@section('description')
@endsection

@section('mainBody')
    <style>
        .line {
            margin-bottom: 4px;
        }
    </style>
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h4 text-center">
                        2018第九届环鄱阳湖国际自行车赛（上犹站）暨阳明湖第四届业余自行车邀请赛竞赛规程
                    </h1>

                    <br>

                    <p class="line">
                        <b>一、主办单位：</b> <br>
                        上犹县人民政府
                    </p>

                    <p class="line">
                        <b>二、承办单位：</b> <br>
                        上犹县体育局
                    </p>

                    <p class="line">
                        <b>三、协办单位：</b><br>
                        阳明湖旅游开发有限公司 <br>
                        上犹县自行车运动协会 <br>
                        捷安特上犹车队骑行俱乐部
                    </p>

                    <p class="line">
                        <b>四、技术支持：</b> <br>
                        深圳市天珺体育咨询有限公司
                    </p>

                    <p class="line">
                        <b>五、活动开幕式：</b> <br>
                        时间：2018年9月23日07:30--8:30 <br>
                        地点：江西省赣州市上犹县文体中心
                    </p>

                    <p class="line">
                        <b>六、赛事活动：</b> <br>
                        时间：2018年9月23日 <br>
                        地址：江西省赣州市上犹县文体中心、阳明湖风景区 <br>
                        参赛人员：国内自行车协（联）会会员，业余自行车运动爱好者
                    </p>

                    <p class="line">
                        <b>七、赛事安排：</b><br>
                        时间：2018年9月23日07:30-12：00 <br>
                        起点：上犹县文体中心， <br>
                        终点：陡水镇陡水大桥（为不影响职业公路车比赛，业余参赛人员必须在终点等职业赛车队过完后才能原路返回文体中心，不便之处敬请谅解）
                    </p>

                    <br>
                    <a class="btn btn-warning btn-block" href="{{ route('poyang-lake-cycling.apply') }}">立即报名</a>
                </div>
            </div>
        </div>
    </div>
@stop
