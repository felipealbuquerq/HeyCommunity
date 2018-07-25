@extends('admin.layouts.default')

@section('search')
    <form class="navbar-form pull-left" role="search" action="{{ route('admin.user.index') }}">
        <div class="form-group">
            <input type="hidden" name="type" value="user">
            <input type="text" name="q" class="form-control search-bar" placeholder="搜索" value="{{ Request::get('q') }}">
        </div>
        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
    </form>
@endsection

@section('mainBody')
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">用户列表</h4>
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
                                                <td>头像</td>
                                                <th>昵称 / 签名</th>
                                                <th>性别</th>
                                                <th>注册时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if ($users->isEmpty())
                                                <tr>
                                                    <td colspan="5">无数据</td>
                                                </tr>
                                            @else
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td><img style="height:40px;" src="{{ $user->avatar }}"></td>
                                                        <td>
                                                            {{ $user->nickname }}
                                                            <br>
                                                            {{ $user->bio }}
                                                        </td>
                                                        <td>{{ $user->gender == 1 ? '男' : '女' }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>-</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <nav id="section-pagination">
                                            {{ $users->links() }}
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
