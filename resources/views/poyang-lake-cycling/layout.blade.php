<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="{{ trim($__env->yieldContent('description', $system->site_description)) }}">
    <meta name="keywords" content="{{ strToOneLine(trim($__env->yieldContent('keywords', $system->site_keywords))) }}">
    <meta name="author" content="HeyCommunity Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="apple-touch-icon" href="/images/icon.png">
    <link rel="apple-touch-startup-image" href="/images/splash.png">

    <title>@yield('title', $system->site_title . ' - ' . $system->site_subheading)</title>

    <link href='https://fonts.lug.ustc.edu.cn/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bower-assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-application-theme/css/toolkit.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-application-theme/css/application.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap-application-theme/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
        }
    </style>
</head>

<body class="with-top-navbar">

<!-- Nav -->
<nav id="section-mainNav" class="navbar navbar-expand-md fixed-top navbar-dark bg-primary app-navbar">
    <a class="navbar-brand" href="{{ route('poyang-lake-cycling.index') }}">
        阳明湖第四届业余自行车邀请赛
    </a>

    <button class="navbar-toggler navbar-toggler-right d-md-none"
            type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ setNavActive('*poyang-lake-cycling') }}">
                <a class="nav-link" href="{{ route('poyang-lake-cycling.index') }}">竞赛规程</a>
            </li>
            <li class="nav-item {{ setNavActive('*poyang-lake-cycling/apply') }}">
                <a class="nav-link" href="{{ route('poyang-lake-cycling.apply') }}">报名</a>
            </li>
        </ul>

        @if (Auth::check())
            <ul id="#js-popoverContent" class="nav navbar-nav float-right mr-0 d-none d-md-flex">
                <li class="nav-item ml-2">
                    <button class="btn btn-default navbar-btn navbar-btn-avatar" data-toggle="popover">
                        <img class="rounded-circle" src="{{ asset(Auth::user()->avatar) }}">
                    </button>
                </li>
            </ul>

            <ul class="nav navbar-nav d-none" id="js-popoverContent">
                <li class="nav-item">
                    <a class="nav-link">
                        已禁用
                    </a>
                </li>
            </ul>
        @endif
    </div>
</nav>


<!-- Flash Message -->
@include('flash::message')

<!-- Main Body -->
@yield('mainBody')

<div class="container" style="margin-top:30px; margin-bottom:20px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <span style="color:red">♥</span> <a href="https://www.hey-ganzhou.com" target="_blank">HEY赣州</a>
            &nbsp;&nbsp;
            power by <a href="https://www.protobia.net" target="_blank">ProtobiaTech</a>

            <div>
                联系 Email: rod@protobia.tech <br>
                联系电话: 17600719763 <br>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/bootstrap-application-theme/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/chart.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/toolkit.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/application.js') }}"></script>

<!-- iOS Web App -->
<script type="text/javascript" charset="utf-8">
    // Mobile Safari in standalone mode
    if(("standalone" in window.navigator) && window.navigator.standalone){
        // If you want to prevent remote links in standalone web apps opening Mobile Safari, change 'remotes' to true
        var noddy, remotes = true;

        document.addEventListener('click', function(event) {
            noddy = event.target;

            // Bubble up until we hit link or top HTML element. Warning: BODY element is not compulsory so better to stop on HTML
            while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
                noddy = noddy.parentNode;
            }

            if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes))
            {
                event.preventDefault();
                document.location.href = noddy.href;
            }
        }, false);
    }
</script>


<!-- wechat -->
@yield('_wechat')

<!-- script -->
@yield('script')

<!-- Analytic code -->
{!! $system->site_analytic_code !!}
</body>
</html>
