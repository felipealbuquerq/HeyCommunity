@extends('admin.layouts.default')

@section('mainBody')
<div class="">
    <div class="page-header-title">
        <h4 class="page-title">站点页面更新</h4>
    </div>
</div>

<div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-body p-t-10">
                        <h4 class="m-b-30 m-t-0"></h4>

                        <form class="form-horizontal" action="{{ route('admin.site-page.update', $page->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label for="input-title" class="col-sm-2 control-label">页面标题</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title', $page->title) }}">
                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-content" class="col-sm-2 control-label">内容</label>
                                <div class="col-sm-10">
                                    <textarea name="content" class="form-control" id="ckeditor">{{ old('content', $page->content) }}</textarea>
                                    <div class="text-danger">{{ $errors->first('content') }}</div>

                                    @include('layouts.ckeditor5.ckeditor-classic')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default btn-block">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
