@extends('layouts.default')

@section('title')
    今日天气预报 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2">
                <h2 class="mt-5 mb-5 text-center">天气预报</h2>

                <iframe src="/weather-forecast-source"
                        frameborder="0" scrolling="no" width="100%" height="110" allowTransparency="true"></iframe>

                <p class="text-muted text-center">
                    Time: {{ date('Y-m-d D') }} <br>
                    天气预报信息由心知天气提供
                </p>
            </div>
        </div>
    </div>
@stop

