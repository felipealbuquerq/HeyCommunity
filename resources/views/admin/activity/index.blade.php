@extends('admin.layouts.default')

@section('search')
    <form class="navbar-form pull-left" role="search" action="{{ route('admin.activity.index') }}">
        <div class="form-group">
            <input type="hidden" name="type" value="activity">
            <input type="text" name="q" class="form-control search-bar" placeholder="搜索" value="{{ Request::get('q') }}">
        </div>
        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
    </form>
@endsection

@section('mainBody')
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">活动列表</h4>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table" id="section-datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>活动缩略图</th>
                                                    <th>标题</th>
                                                    <th>TU TB F C R</th>
                                                    <th>发布时间</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($activities->isEmpty())
                                                    <tr>
                                                        <td colspan="5">无数据</td>
                                                    </tr>
                                                @else
                                                @foreach ($activities as $activity)
                                                    <tr>
                                                        <td>{{ $activity->id }}</td>
                                                        <td><img src="{{ $activity->avatar }}" alt="活动缩略图" class="rounded" style="height:2.8em;"></td>
                                                        <td>
                                                            <a target="_blank" href="{{ route('activity.show', $activity->id) }}">{{ str_limit($activity->title, 40) }}</a>
                                                            <br>
                                                            {{ str_limit($activity->intro, 45) }}
                                                        </td>
                                                        <td>
                                                            {{ $activity->thumb_up_num }}
                                                            /
                                                            {{ $activity->thumb_down_num }}
                                                            /
                                                            {{ $activity->favorite_num }}
                                                            /
                                                            {{ $activity->comment_num }}
                                                            /
                                                            {{ $activity->read_num }}
                                                        </td>
                                                        <td>{{ $activity->created_at }}</td>
                                                        <td>
                                                            <a class="btn btn-xs btn-danger" onclick="destroy('{{ $activity->title }}', {{ $activity->id }})" title="删除"><i class="fa fa-trash-o"></i></a>
                                                            <button {{ $activity->inDailyPaper ? 'disabled' : '' }} class="btn btn-xs btn-primary" onclick="presentDailyPaper('{{ $activity->title }}', {{ $activity->id }})" title="转发到 Daily Paper"><i class="fa fa-send"></i></button>

                                                            @if ($activity->is_exhibited)
                                                                <button class="btn btn-xs btn-default" onclick="activitySetExhibited('{{ $activity->title }}', {{ $activity->id }}, 0)" title="取消展出"><i class="fa fa-star"></i></button>
                                                            @else
                                                                <button class="btn btn-xs btn-default" onclick="activitySetExhibited('{{ $activity->title }}', {{ $activity->id }}, 1)" title="设为展出"><i class="fa fa-star-o"></i></button>
                                                            @endif

                                                            @if ($activity->is_pinned)
                                                                <button class="btn btn-xs btn-default" onclick="activitySetPinned('{{ $activity->title }}', {{ $activity->id }}, 0)" title="取消置顶"><i class="fa fa-minus-square"></i></button>
                                                            @else
                                                                <button class="btn btn-xs btn-default" onclick="activitySetPinned('{{ $activity->title }}', {{ $activity->id }}, 1)" title="设为置顶"><i class="fa fa-thumb-tack"></i></button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                                </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <nav id="section-pagination">
                                            {{ $activities->links() }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function destroy(title,id) {
                var message = '是否要删除 "' + title + '"这个活动';

                if (confirm(message)) {
                    var url = '{{ route('admin.activity.destroy') }}';
                    postSubmit(url, {id: id});
                }
            }

            function presentDailyPaper(title, id) {
              var message = '是否要把 "' + title + '" 转发到 Daily Paper';

              if (confirm(message)) {
                var url = '{{ route('admin.daily-paper.store') }}';
                postSubmit(url, {
                  id: id,
                  type: '{{ addslashes(\App\Activity::class) }}'
                });
              }
            }

            function activitySetExhibited(title, id, isExhibit) {
              var message;
              if (isExhibit) {
                message = '是否要把 "' + title + '" 设为展出?';
              } else {
                message = '是否要把 "' + title + '" 取消展出?';
              }

              if (confirm(message)) {
                var url = '{{ route('admin.activity.set-exhibit-handler') }}';
                postSubmit(url, {
                  id: id,
                  is_exhibited: isExhibit
                });
              }
            }

            function activitySetPinned(title, id, isPinned) {
              var message;
              if (isPinned) {
                message = '是否要把 "' + title + '" 设为置顶?';
              } else {
                message = '是否要把 "' + title + '" 取消置顶?';
              }

              if (confirm(message)) {
                var url = '{{ route('admin.activity.set-pinned-handler') }}';
                postSubmit(url, {
                  id: id,
                  is_pinned: isPinned
                });
              }
            }
        </script>
    </div>
@stop
