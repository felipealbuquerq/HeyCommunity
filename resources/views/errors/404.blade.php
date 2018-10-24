@extends('errors::layout')

@section('title', '404 页面不存在')

@section('message')
    对不起, 找不到您要访问的页面。
    <br>
    <small><a style="font-size:16px; color:#777;" href="{{ route('home') }}">返回首页</a></small>
@endsection
