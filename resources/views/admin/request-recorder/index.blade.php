@extends('admin.layouts.default')

@section('mainBody')
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">访客记录</h4>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <form method="get" class="form-inline m-b-30">
                                <div class="form-group">
                                    <label class="sr-only" for="input-keyword">访客昵称或ID</label>
                                    <input name="keyword" type="text" class="form-control" id="input-keyword" placeholder="访客昵称或ID" value="{{ Request::get('keyword') }}">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="input-ip">访客IP</label>
                                    <input name="ip" type="text" class="form-control" id="input-ip" placeholder="访客IP" value="{{ Request::get('ip') }}">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="input-name">请求</label>
                                    <select name="visitor_type" class="form-control">
                                        <option value="all">所有访客</option>
                                        <option value="user" {{ Request::get('visitor_type') == 'user' ? 'selected' : '' }}>已登录用户</option>
                                        <option value="guest" {{ Request::get('visitor_type') == 'guest' ? 'selected' : '' }}>未登录访客</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="input-name">请求</label>
                                    <select name="method" class="form-control">
                                        <option value="all">所有请求</option>
                                        <option value="GET" {{ Request::get('method') == 'GET' ? 'selected' : '' }}>GET</option>
                                        <option value="POST" {{ Request::get('method') == 'POST' ? 'selected' : '' }}>POST</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success waves-effect waves-light m-l-10">查询</button>
                            </form>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table" id="section-datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>时间</th>
                                                    <th>访客 <small class="text-muted">ID</small></th>
                                                    <th>IP</th>
                                                    <th>请求</th>
                                                    <th>路由</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($recorders->isEmpty())
                                                    <tr>
                                                        <td colspan="5">无数据</td>
                                                    </tr>
                                                @else
                                                    @foreach ($recorders as $recorder)
                                                        <tr>
                                                            <td>{{ $recorder->id }}</td>
                                                            <td>{{ $recorder->created_at }}</td>
                                                            <td>
                                                                {{ $recorder->user ? $recorder->user->nickname : '-' }}
                                                                <small class="text-muted">/ {{ $recorder->user_id ?: '-' }}</small>
                                                            </td>
                                                            <td>{{ $recorder->ip }}</td>
                                                            <td>{{ $recorder->method }}</td>
                                                            <td>{{ $recorder->route_name }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <nav id="section-pagination">
                                            {{ $recorders->appends([
                                                'keyword'   =>  Request::get('keyword'),
                                                'ip'        =>  Request::get('ip'),
                                                'visitor_type'  =>  Request::get('visitor_type'),
                                                'method'    =>  Request::get('method'),
                                            ])->links() }}
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
