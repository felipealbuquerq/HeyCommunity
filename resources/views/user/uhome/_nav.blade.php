@section('_nav')
    <a class="nav-item nav-link {{ Request::is('*timeline') ? 'active' : '' }}" href="{{ route('user.uhome.timeline', $user->id) }}">动态</a>
    <a class="nav-item nav-link {{ Request::is('*topic-published') ? 'active' : '' }}" href="{{ route('user.uhome.topic-published', $user->id) }}">发起的话题</a>
    <a class="nav-item nav-link {{ Request::is('*topic-replies') ? 'active' : '' }}" href="{{ route('user.uhome.topic-replies', $user->id) }}">参与的话题</a>

    <a class="nav-item nav-link {{ Request::is('*activity') ? 'active' : '' }}" href="{{ route('user.uhome.activity', $user->id) }}">发起或参与的活动</a>

    @if ($user->columnist)
        <a target="_blank" class="nav-item nav-link" href="{{ route('columnist.show', $user->columnist->domain) }}">专栏 <sup><i class="fa fa-external-link"></i></sup></a>
    @endif
@endsection

<nav class="d-none d-md-flex nav nav-pills justify-content-end" style="position:relative;" id="mainTab">
    <a class="nav-item nav-link {{ Request::is('*index') ? 'active' : '' }}" href="{{ route('user.uhome', $user->id) }}"
       style="position:absolute; left:0;"
    >社区生涯</a>

    @yield('_nav')
</nav>

<div class="d-block d-md-none container mb-3">
    <a class="btn {{ Request::is('*index') ? 'btn-primary' : 'btn-secondary' }}" href="{{ route('user.uhome', $user->id) }}">社区生涯</a>

    <div class="btn-group pull-right">
        <button type="button" class="btn {{ Request::is(['*timeline*', '*topic*', '*activity*']) ? 'btn-primary' : 'btn-secondary' }} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (Request::routeIs('*timeline'))
                动态
            @elseif (Request::routeIs('*topic-published'))
                发起的话题
            @elseif (Request::routeIs('*topic-replies'))
                参与的话题
            @elseif (Request::routeIs('*activity'))
                发起或参与的活动
            @else
                请选择
            @endif
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('user.uhome.timeline', $user->id) }}">动态</a>
            <a class="dropdown-item" href="{{ route('user.uhome.topic-published', $user->id) }}">发起的话题</a>
            <a class="dropdown-item" href="{{ route('user.uhome.topic-replies', $user->id) }}">参与的话题</a>
            <a class="dropdown-item" href="{{ route('user.uhome.activity', $user->id) }}">发起或参与的活动</a>
            <a class="dropdown-item" href="{{ route('user.uhome.activity', $user->id) }}">发起或参与的活动</a>
            @if ($user->columnist)
                <a target="_blank" class="dropdown-item" href="{{ route('columnist.show', $user->columnist->domain) }}">专栏</a>
            @endif
        </div>
    </div>
</div>
