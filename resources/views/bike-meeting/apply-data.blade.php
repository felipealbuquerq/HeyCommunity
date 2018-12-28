@extends('bike-meeting.layout')

@section('title')
    报名列表
@endsection

@section('description')
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container" style="margin-top:40px;">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h4 text-center">
                        报名数据
                    </h1>

                    <br>
                    <br>
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>姓名或昵称</th>
                            <th>手机号码</th>
                            <th>是否缴费</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                        </tr>

                        @foreach ($applyData as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>{{ $item->nickname }}</th>
                                <th>{{ $item->phone }}</th>
                                <th>{{ $item->created_at }}</th>
                                <th>{{ $item->updated_at }}</th>
                            </tr>
                        @endforeach
                    </table>

                    <div>
                        {{ $applyData->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
