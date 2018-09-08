@extends('poyang-lake-cycling.layout')

@section('title')
    报名
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
                            <th>姓名</th>
                            <th>性别</th>
                            <th>组别</th>
                            <th>俱乐部名称</th>
                            <th>身份证号码</th>
                            <th>手机号码</th>
                            <th>是否上犹籍选手</th>
                            <th>状态</th>
                        </tr>

                        @foreach ($applyData as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>{{ $item->name }}</th>
                                <th>{{ \App\PoYangLakeCyclingApplyData::$genders[$item->gender_id] }}</th>
                                <th>{{ \App\PoYangLakeCyclingApplyData::$groups[$item->group_id] }}</th>
                                <th>{{ $item->club_name }}</th>
                                <th>{{ $item->identity_card_number }}</th>
                                <th>{{ $item->phone }}</th>
                                <th>{{ $item->is_shangyou_people ? 'Y' : 'N' }}</th>
                                <th>{{ \App\PoYangLakeCyclingApplyData::$states[$item->state] }}</th>
                            </tr>
                        @endforeach
                    </table>

                    <div>
                        {{ $topics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
