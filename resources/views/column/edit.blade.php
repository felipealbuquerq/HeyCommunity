@extends('layouts.default')

@section('title')
    用户协议 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-site" class="page-site-about">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np d-none d-md-block">
                    @include('columnist._columnist_card', ['columnist' => $columnist])
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('columnist.show', $columnist->domain) }}">{{ $columnist->title }}</a> <span class="text-muted">专栏</span></li>
                            <li class="breadcrumb-item active" aria-current="page">更新专栏文章</li>
                        </ol>
                    </nav>

                    <div class="card m-nb-y m-nb-r">
                        <div class="card-body">
                            <h5 class="card-title">编辑专栏文章</h5>
                            <hr>

                            <form action="{{ route('column.update', $column->id) }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="input-title" class="col-sm-2 col-form-label">标题</label>
                                    <div class="col-sm-10">
                                        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title', $column->title) }}">

                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-content" class="col-sm-2 col-form-label">内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control simditor-editor" id="input-content" rows="8">{{ old('content', $column->content) }}</textarea>

                                        <div class="text-danger">{{ $errors->first('content') }}</div>

                                        @include('layouts._simditor')
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary btn-block" type="submit">更新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 m-np mt-4">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
