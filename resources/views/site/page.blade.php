@extends('layouts.default')

@section('title')
    {{ $page->title }} - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-site" class="page-site-about">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np">
                    @include('site._sidebar')
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div id="sitepage-card" class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $page->title }}</h4>
                            <hr>

                            <div class="mt-3">
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-block d-md-none m-np mt-4">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop

