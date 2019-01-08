@extends('layouts.default')

@section('title')
    {{ $post->title }} - {{ $system->site_title }}
@endsection

@section('description')
    {{ str_limit(strip_tags($post->content), 100) }}
@endsection

@section('avatar')
    {{ $post->avatar }}
@endsection

@section('mainBody')
    <iframe src="{{ $post->origin_url }}"
        @if($post->origin_data)
            srcdoc="{{ $post->origin_data }}"
        @endif
        height="600" frameborder="2" scrolling="auto" style="width:96%; margin:20px 2% 0;">
    </iframe>
@endsection