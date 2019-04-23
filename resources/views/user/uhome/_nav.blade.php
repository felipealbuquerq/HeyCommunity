<nav class="nav nav-pills justify-content-end" style="position:relative;" id="mainTab">
    <a class="nav-item nav-link {{ Request::is('*index') ? 'active' : '' }}" href="{{ route('user.uhome', $user->id) }}"
       style="position:absolute; left:0;"
    >社区轨迹</a>

    <a class="nav-item nav-link {{ Request::is('*topic-published') ? 'active' : '' }}" href="{{ route('user.uhome.topic-published', $user->id) }}">发起的话题</a>
    <a class="nav-item nav-link {{ Request::is('*topic-replies') ? 'active' : '' }}" href="{{ route('user.uhome.topic-replies', $user->id) }}">参与的话题</a>

    <a class="nav-item nav-link {{ Request::is('*activity') ? 'active' : '' }}" href="{{ route('user.uhome.activity', $user->id) }}">发起或参与的活动</a>

    @if ($user->columnist)
        <a class="nav-item nav-link" href="{{ route('columnist.show', $user->columnist->domain) }}">专栏</a>
    @endif
</nav>
