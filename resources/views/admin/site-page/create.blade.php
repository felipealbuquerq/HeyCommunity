@extends('admin.layouts.default')

@section('mainBody')
<div class="">
    <div class="page-header-title">
        <h4 class="page-title">新增站点页面</h4>
    </div>
</div>

<div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-body p-t-10">
                        <h4 class="m-b-30 m-t-0"></h4>

                        <form class="form-horizontal" action="{{ route('admin.site-page.store') }}" method="post">
                            {{ csrf_field() }}

                            @include('admin.site-page._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
