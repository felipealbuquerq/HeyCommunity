@extends('layouts.default')

@section('title')
    更新文章 - {{ $column->title }}
@endsection

@section('description')
    专栏文章，分享你的观点和见解
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
                        <div class="card-header">
                            更新专栏文章
                        </div>
                        <div class="card-body">
                            <form action="{{ route('column.update', $column->id) }}" method="post" onsubmit="formSubmit(event)">
                                {{ csrf_field() }}

                                @include('column._form')

                                <div class="form-group row">
                                    <div class="col-md-10 offset-md-1">
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
