@extends('admin.layouts.default')

@section('search')
    <form class="navbar-form pull-left" role="search" action="{{ route('admin.news.index') }}">
        <div class="form-group">
            <input type="hidden" name="type" value="news">
            <input type="text" name="q" class="form-control search-bar" placeholder="搜索" value="{{ Request::get('q') }}">
        </div>
        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
    </form>
@endsection

@section('mainBody')
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">页面列表</h4>
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
                                                <th>标题</th>
                                                <th>唯一标识</th>
                                                <th>发布时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if ($pages->isEmpty())
                                                <tr>
                                                    <td colspan="5">无数据</td>
                                                </tr>
                                            @else
                                                @foreach ($pages as $page)
                                                    <tr>
                                                        <td>{{ $page->id }}</td>
                                                        <td><a target="_blank" href="{{ route('site.page', $page->id) }}">{{ $page->title }}</a></td>
                                                        <td>{{ $page->unique_name }}</td>
                                                        <td>{{ $page->created_at }}</td>
                                                        <td>
                                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.site-page.edit', $page->id) }}" title="编辑"><i class="fa fa-edit"></i></a>
                                                            <a class="btn btn-xs btn-danger" onclick="destroy('{{ $page->title }}', {{ $page->id }})" title="删除"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <nav id="section-pagination">
                                            {{ $pages->links() }}
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
                var message = '是否要删除 "' + title + '" 这个页面';

                if (confirm(message)) {
                    var url = '{{ route('admin.site-page.destroy', null) }}' + '/' + id;
                    postSubmit(url, {_method: 'delete'});
                }
            }
        </script>
    </div>
@stop
