@extends('layouts.default')

@section('title')
    今日天气预报 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2">
                <h2 class="mt-5 mb-5 text-center">天气预报</h2>
                <iframe src="//www.seniverse.com/weather/weather.aspx?uid=UEA0895246&cid=CHJX060000&l=&p=SMART&a=1&u=C&s=3&m=0&x=1&d=3&fc=&bgc=&bc=&ti=0&in=0&li="
                        frameborder="0" scrolling="no" width="100%" height="110" allowTransparency="true"></iframe>

                <p class="text-muted text-center">
                    Time: {{ date('Y-m-d D') }} <br>
                    天气预报信息由心知天气提供
                </p>
            </div>
        </div>
    </div>
@stop

