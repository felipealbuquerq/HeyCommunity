@extends('layouts.default')

@section('title')
发布资讯 - {{ $system->site_title }}
@endsection

@section('description')
有什么新鲜事，与大家一起分享
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-topic-create">
        <div class="container pt-4">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('post') }}">资讯</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subNavName }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-4 d-block d-md-none m-np">
                    <div class="card m-nb-y m-nb-r mb-3">
                        <div class="card-body">
                            有什么新鲜事，与大家一起分享
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            有什么新鲜事，与大家一起分享
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 m-np">
                    <div class="card m-nb-y m-nb-r">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subNavName }}</h5>
                            <hr>

                            <form action="{{ $formActionUrl }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="input-title" class="col-sm-2 col-form-label">标题</label>
                                    <div class="col-sm-10">
                                        <input required name="title" type="text" class="form-control" id="input-title" value="{{ old('title', $post->title) }}">

                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-origin_url" class="col-sm-2 col-form-label">来源</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select name="type_id" class="custom-select">
                                                @foreach(\App\Post::$typeIds as $typeKey => $typeValue)
                                                    <option value="{{ $typeKey }}" {{ $typeKey == $post->type_id ? 'selected' : '' }}>{{ $typeValue }}</option>
                                                @endforeach
                                            </select>
                                            <input name="origin_url" type="text" class="form-control" id="input-origin_url"
                                                   placeholder="选填, 来源网址, 示例 https://www.hey-ganzhou.com/some-page"
                                                   style="flex-grow:3;"
                                                   value="{{ old('origin_url', $post->origin_url) }}">
                                        </div>

                                        <div class="text-danger">{{ $errors->first('origin_url') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-content" class="col-sm-2 col-form-label">内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control simditor-editor" id="input-content" rows="8">{{ old('content', $post->content) }}</textarea>

                                        <div class="text-danger">{{ $errors->first('content') }}</div>

                                        @include('layouts._simditor')
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary btn-block" type="submit">发布</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-block d-md-none m-np">
                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
