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
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icon.png') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('images/splash.png') }}">

    <title>{{ trim($__env->yieldContent('title', $system->site_title . ' - ' . $system->site_subheading)) }}</title>

    <link href='https://fonts.lug.ustc.edu.cn/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bower-assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-application-theme/css/toolkit.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-application-theme/css/application.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap-application-theme/js/jquery.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/entrycss/bin/entry.css') }}">

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
<div class="container">
    @if (Route::is(getBackToIndexRoute()))
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ $system->site_title }} <sup>&beta;</sup>
        </a>
    @else
        <a class="navbar-brand" href="{{ route(getBackToIndexRoute()) }}">
            {{ $system->site_title }}
            <sup class="icon-back-btn"><small class=""><i class="fa fa-reply"></i></small></sup>
        </a>
    @endif

    <div class="d-md-none" id="nav-btns">
        @php
            $noticeSum = \App\Notice::mine()->unread()->count();
        @endphp
        <a class="btn btn-default" href="{{ route('notice.index') }}">
            <i class="fa fa-bell {{ $noticeSum ? 'text-danger' : '' }}"></i>
        </a>
    </div>

    <button class="navbar-toggler navbar-toggler-right d-md-none"
            type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
            <!--
            <li class="nav-item">
                <a class="nav-link {{ setNavActive('/') }}" href="{{ url('/') }}">首页</a>
            </li>
            -->
            <li class="nav-item {{ setNavActive('news*') }}">
                <a class="nav-link" href="{{ route('news.index') }}"><i class="d-inine-block d-md-none fa fa-newspaper-o"></i> 新闻</a>
            </li>
            <li class="nav-item {{ setNavActive('timeline*') }}">
                <a class="nav-link" href="{{ route('timeline.index') }}"><i class="d-inline-block d-md-none fa fa-feed"></i> 动态</a>
            </li>
            <li class="nav-item {{ setNavActive('column*') }}">
                <a class="nav-link" href="{{ route('columnist.index') }}"><i class="d-inline-block d-md-none fa fa-file-text-o"></i> 专栏</a>
            </li>
            <li class="nav-item {{ setNavActive('topic*') }}">
                <a class="nav-link" href="{{ route('topic.index') }}"><i class="d-inline-block d-md-none fa fa-quote-left"></i> 话题</a>
            </li>
            <li class="nav-item {{ setNavActive('activity*') }}">
                <a class="nav-link" href="{{ url('activity') }}"><i class="d-inline-block d-md-none fa fa-calendar"></i> 活动</a>
            </li>
            <li class="nav-item {{ setNavActive(['about', 'help', 'terms', 'privacy']) }}">
                <a class="nav-link" href="{{ url('about') }}"><i class="d-inline-block d-md-none fa fa-info-circle"></i> 关于</a>
            </li>

            @if (Auth::check())
                <li class="nav-item d-block d-md-none {{ setNavActive('*ucenter*') }}">
                    <a class="nav-link" href="{{ route('user.ucenter') }}"><i class="d-inline-block d-md-none fa fa-newspaper-o"></i> 用户中心</a>
                </li>
                <li class="nav-item d-block d-md-none">
                    <a class="nav-link" href="{{ route('user.logout') }}"><i class="d-inline-block d-md-none fa fa-sign-out"></i> 登出</a>
                </li>
            @else
                <li class="nav-item d-block d-md-none {{ setNavActive('*signup*') }}">
                    <a class="nav-link" href="{{ route('user.signup') }}"><i class="d-inline-block d-md-none fa fa-user-plus"></i> 注册</a>
                </li>
                <li class="nav-item d-block d-md-none {{ setNavActive('*login*') }}">
                    <a class="nav-link" href="{{ route('user.login') }}"><i class="d-inline-block d-md-none fa fa-sign-in"></i> 登录</a>
                </li>
            @endif
        </ul>

        <form class="form-inline float-right d-none d-md-flex">
            <input class="form-control" type="text" data-action="grow" placeholder="搜索暂不可用" disabled>
        </form>

        <ul id="#js-popoverContent" class="nav navbar-nav float-right mr-0 d-none d-md-flex">
            <li class="nav-item">
                <a class="app-notifications nav-link" href="{{ route('notice.index') }}">
                    <span class="icon icon-bell {{ $noticeSum ? 'text-danger' : '' }}"></span>
                </a>
            </li>
            <li class="nav-item ml-2">
                <button class="btn btn-default navbar-btn navbar-btn-avatar" data-toggle="popover">
                    @if (Auth::check())
                        <img class="rounded-circle" src="{{ asset(Auth::user()->avatar) }}">
                    @else
                        <img class="rounded-circle" src="{{ asset(\App\User::guestAvatar()) }}">
                    @endif
                </button>
            </li>
        </ul>

        <ul class="nav navbar-nav d-none" id="js-popoverContent">
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.ucenter') }}">
                        <i class="fa fa-id-card-o"></i> &nbsp; 用户中心
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.logout') }}">
                        <i class="fa fa-sign-out"></i> &nbsp; 登出
                    </a>
                </li>
                @if (Auth::user()->is_super_admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.home') }}" target="_blank">
                            <i class="fa fa-cogs"></i> &nbsp; 管理后台
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.signup') }}">
                        <i class="fa fa-user-plus"></i> &nbsp; 注册
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.login') }}">
                        <i class="fa fa-sign-in"></i> &nbsp; 登录
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
</nav>


<!-- Flash Message -->
@include('flash::message')

<!-- Main Body -->
@yield('mainBody')

@include('layouts._switch_sock_puppet')
@include('layouts._global_fixed_buttons')



<script src="{{ asset('assets/bootstrap-application-theme/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/chart.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/toolkit.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/application.js') }}"></script>
<script>
    // execute/clear BS loaders for docs
    $(function () {
        while (window.BS && window.BS.loader && window.BS.loader.length) {
            (window.BS.loader.pop())()
        }
    })
</script>

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

<!-- Wechat -->
@include('layouts._wechat')

<!-- Script -->
@yield('script')

<!-- Analytic code -->
{!! $system->site_analytic_code !!}

<!-- CNZZ tongji -->
<div style="display:none">
<script src="https://s19.cnzz.com/z_stat.php?id=1273106497&web_id=1273106497" language="JavaScript"></script>
</div>
</body>
</html>
