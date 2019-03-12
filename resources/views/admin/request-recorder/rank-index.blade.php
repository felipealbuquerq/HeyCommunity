@extends('admin.layouts.default')

@section('mainBody')
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">访客排名</h4>
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
                                                    <th>用户</th>
                                                    <th>近7天访问数</th>
                                                    <th>近30天访问数</th>
                                                    <th>访问总数</th>
                                                    <th>最近访问时间</th>
                                                    <th>注册时间</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($recorders->isEmpty())
                                                    <tr>
                                                        <td colspan="5">无数据</td>
                                                    </tr>
                                                @else
                                                    @foreach ($recorders as $index => $recorder)
                                                        <tr>
                                                            <td>{{ ($index + 1) + ($recorders->currentPage() - 1) * $recorders->perPage() }}</td>
                                                            <td>
                                                                {{ $recorder->user ? $recorder->user->nickname : '-' }}
                                                                <small class="text-muted">/ {{ $recorder->user_id ?: '-' }}</small>
                                                            </td>
                                                            <td>{{ $recorder->getRecentTotal(7) }}</td>
                                                            <td>{{ $recorder->getRecentTotal(30) }}</td>
                                                            <td>{{ $recorder->total }}</td>
                                                            <td>
                                                                {{ $recorder->created_at }}
                                                                <small class="text-muted">({{ $recorder->created_at->diffForHumans() }})</small>
                                                            </td>
                                                            <td>
                                                                {{ $recorder->user->created_at }}
                                                                <small class="text-muted">({{ $recorder->user->created_at->diffForHumans() }})</small>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <nav id="section-pagination">
                                            {{ $recorders->links() }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
