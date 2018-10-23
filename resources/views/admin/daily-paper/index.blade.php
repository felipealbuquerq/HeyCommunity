@extends('admin.layouts.default')

@section('search')
@endsection

@section('mainBody')
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">今日列表</h4>
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
                                                <th>日期</th>
                                                <th>类型</th>
                                                <th>标题</th>
                                                <th>发布时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if ($dailyPapers->isEmpty())
                                                <tr>
                                                    <td colspan="5">无数据</td>
                                                </tr>
                                            @else
                                                @foreach ($dailyPapers as $dailyPaper)
                                                    <tr>
                                                        <td>{{ $dailyPaper->id }}</td>
                                                        <td>{{ $dailyPaper->date->format('Y/m/d') }}</td>
                                                        <td>{{ $dailyPaper->type_name }}</td>
                                                        @if ($dailyPaper->entity_type == \App\News::class)
                                                            <td><a target="_blank" href="{{ route('news.show', $dailyPaper->id) }}">{{ $dailyPaper->entity->title }}</a></td>
                                                        @elseif ($dailyPaper->entity_type == \App\Topic::class)
                                                            <td><a target="_blank" href="{{ route('topic.show', $dailyPaper->id) }}">{{ $dailyPaper->entity->title }}</a></td>
                                                        @elseif ($dailyPaper->entity_type == \App\Activity::class)
                                                            <td><a target="_blank" href="{{ route('activity.show', $dailyPaper->id) }}">{{ $dailyPaper->entity->title }}</a></td>
                                                        @endif
                                                        <td>{{ $dailyPaper->created_at }}</td>
                                                        <td>
                                                            <a class="btn btn-xs btn-danger" onclick="destroy('{{ $dailyPaper->title }}', {{ $dailyPaper->id }})" title="删除"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <nav id="section-pagination">
                                            {{ $dailyPapers->links() }}
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
            function destroy(title, id) {
                var message = '是否要删除 "' + title + '" 这条数据';

                if (confirm(message)) {
                    var url = '{{ route('admin.daily-paper.destroy', ['id' => null]) }}/' + id;
                    postSubmit(url, {
                      _method: 'DELETE',
                    });
                }
            }
        </script>
    </div>
@stop
