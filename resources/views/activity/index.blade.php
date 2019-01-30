@extends('layouts.default')

@section('title')
活动首页 - {{ $system->site_title }}
@endsection

@section('description')
放下手中的电子设备，报名参加一个有趣的活动，和小伙伴们快乐地交流学习和娱乐玩耍
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-activity-index">
    <div class="container pt-4">
        @include('activity._carousel', ['elementId' => 'section-carousel'])

        <div class="row">
            <div class="col-12">
                <div style="z-index:99; position:absolute; right:15px;">
                    <a class="btn btn-secondary" href="{{ route('activity.index') }}">刷新</a>
                </div>

                <div class="input-group">
                    <a class="btn btn-primary " href="{{ route('activity.create') }}">发布新活动</a>
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;

                    <!-- 分类 -->
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                            @if (request('category_id'))
                                {{ $categories->where('id', request('category_id'))->pluck('name')->pop() }}
                            @else
                                所有分类
                            @endif
                        </button>
                        <div class="dropdown-menu">
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="{{ route('activity.index', [
                                    'category_id'   =>  $category->id,
                                    'area_id'       =>  request('area_id'),
                                ]) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    &nbsp;&nbsp;

                    <!-- 地区 -->
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                            @if (request('area_id'))
                                {{ $areas->where('id', request('area_id'))->pluck('name')->pop() }}
                            @else
                                所有地区
                            @endif
                        </button>
                        <div class="dropdown-menu">
                            @foreach ($areas as $area)
                                <a class="dropdown-item" href="{{ route('activity.index', [
                                    'area_id'       =>  $area->id,
                                    'category_id'   =>  request('category_id'),
                                ]) }}">{{ $area->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr class="mt-2 mb-4 m-hide">
                <div class="mb-3 m-block"></div>
            </div>
        </div>

        <!-- Activity List -->
        @include('activity._activity-list', ['activities' => $activities])

        <div class="row">
            <div class="col-md-12 m-np">
                @include('layouts._tail')
            </div>
        </div>
    </div>
</div>
@stop
