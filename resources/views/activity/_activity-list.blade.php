@if ($activities->count())
    <div class="row">
        @foreach ($activities as $item)
            <div class="col-md-4 m-np">
                <div id="component-activity-card" class="card card-activity">
                    <a class="box-pic" href="{{ route('activity.show', $item->id) }}">
                        <div class="start-time">
                            <i class="fa fa-clock-o"></i>&nbsp; {{ \Carbon\Carbon::parse($item->start_time)->diffForHumans() }}
                            @if ($item->is_exhibited)
                                &nbsp;&nbsp;<i class="fa fa-star text-danger"></i>
                            @endif
                            @if ($item->is_pinned)
                                &nbsp;&nbsp;<i class="fa fa-thumb-tack text-danger"></i>
                            @endif
                        </div>
                        <img class="card-img-top m-nb-r" src="{{ asset($item->avatar) }}" alt="{{ $item->title }}">

                        <div class="info text-right">
                            <div class="local">
                                <i class="fa fa-map"></i> &nbsp;
                                {{ $item->area ? $item->area->name : '' }}
                                {{ $item->local }}
                            </div>
                            <div class="date">
                                <i class="fa fa-calendar"></i> &nbsp;
                                {{ \Carbon\Carbon::parse($item->start_time)->format('m-d H:i') }}
                                至
                                {{ \Carbon\Carbon::parse($item->end_time)->format('m-d H:i') }}
                            </div>
                        </div>
                    </a>
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('activity.show', $item->id) }}">{{ $item->title }}</a></h4>
                        <p class="card-text">{{ $item->intro }}</p>
                        <!--
                        <a href="{{ route('activity.show', $item->id) }}" class="btn btn-primary">立即报名</a>
                        -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav id="section-pagination">
        {{ $activities->appends([
            'category_id'   =>  request('category_id'),
            'area_id'       =>  request('area_id'),
        ])->links() }}
    </nav>
@else
    <div class="card">
        <div class="card-body">
            暂无数据
        </div>
    </div>
@endif
