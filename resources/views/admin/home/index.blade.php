@extends('admin.layouts.default')

@section('mainBody')
<div class="">
<div class="page-header-title">
    <h4 class="page-title">仪表盘</h4>
</div>
</div>

<div class="page-content-wrapper ">

<div class="container">

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                    <h4 class="panel-title text-muted font-light">用户总数</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15"><b>{{ $userTotal }}</b></h2>
                    <p class="text-muted m-b-0 m-t-20">最近 7 天增长 <b>{{ $userTotalOfRecent7Day }} <small>/ {{ $userGrowthOfRecent7DayPercent }}%</small></b></p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                    <h4 class="panel-title text-muted font-light">新闻总数</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15"><b>{{ $newsTotal }}</b></h2>
                    <p class="text-muted m-b-0 m-t-20">最近 7 天增长 <b>{{ $newsTotalOfRecent7Day }} <small>/ {{ $newsGrowthOfRecent7DayPercent }}%</small></b></p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                    <h4 class="panel-title text-muted font-light">话题总数</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15"><b>{{ $topicTotal }}</b></h2>
                    <p class="text-muted m-b-0 m-t-20">最近 7 天增长 <b>{{ $topicTotalOfRecent7Day }} <small>/ {{ $topicGrowthOfRecent7DayPercent }}%</small></b></p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                    <h4 class="panel-title text-muted font-light">活动总数</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15"><b>{{ $activityTotal }}</b></h2>
                    <p class="text-muted m-b-0 m-t-20">最近 7 天增长 <b>{{ $activityTotalOfRecent7Day }} <small>/ {{ $activityGrowthOfRecent7DayPercent }}%</small></b></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-t-0">用户趋势</h4>

                    <ul class="list-inline widget-chart m-t-20 text-center">
                        <li>
                            <h4 class=""><b>{{ $userTotal }}</b></h4>
                            <p class="text-muted m-b-0">总数</p>
                        </li>
                        <li>
                            <h4 class=""><b>{{ $userTotalOfRecent7Day }}</b></h4>
                            <p class="text-muted m-b-0">最近 7 天</p>
                        </li>
                        <li>
                            <h4 class=""><b>{{ $userTotalOfRecent30Day }}</b></h4>
                            <p class="text-muted m-b-0">最近 30 天</p>
                        </li>
                    </ul>

                    <script>
                      $(document).ready(function() {
                        window.userTrendData = JSON.parse('{!! $userTrendData !!}');
                        $.Dashboard.createAreaChart('morris-area-user-trend', 0, 0, window.userTrendData, 'y', ['a', 'b'], ['当前', '7天前'], ['#3292e0', '#bdbdbd']);
                      });
                    </script>
                    <div id="morris-area-user-trend" style="height: 300px"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-t-0">访客趋势</h4>

                    <ul class="list-inline widget-chart m-t-20 text-center">
                        <li>
                            <h4 class=""><b>{{ $visitorTotal }}</b></h4>
                            <p class="text-muted m-b-0">总数</p>
                        </li>
                        <li>
                            <h4 class=""><b>{{ $visitorTotalOfRecent7Day }}</b></h4>
                            <p class="text-muted m-b-0">最近 7 天</p>
                        </li>
                        <li>
                            <h4 class=""><b>{{ $visitorTotalOfRecent30Day }}</b></h4>
                            <p class="text-muted m-b-0">最近 30 天</p>
                        </li>
                    </ul>

                    <script>
                        $(document).ready(function() {
                          window.visitorTrendData = JSON.parse('{!! $visitorTrendData !!}');
                          $.Dashboard.createAreaChart('morris-area-visitor-trend', 0, 0, window.visitorTrendData, 'y', ['a', 'b'], ['当前', '7天前'], ['#3292e0', '#bdbdbd']);
                        });
                    </script>
                    <div id="morris-area-visitor-trend" style="height: 300px"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div><!-- container -->


</div> <!-- Page content Wrapper -->
@stop
