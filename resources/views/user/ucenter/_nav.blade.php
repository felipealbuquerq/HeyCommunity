<div class="d-none d-md-block">
    <div class="list-group">
        <a href="{{ route('user.ucenter.topic-published') }}" class="{{ setNavActive('*topic-published') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>我发起的话题</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('user.ucenter.topic-replies') }}" class="{{ setNavActive('*topic-replies') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>我参与的话题</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('user.ucenter.activity') }}" class="{{ setNavActive('*activity') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>我发起或参与的活动</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('columnist.show', $user->columnist->domain) }}" class="list-group-item list-group-item-action d-flex justify-content-between">
            <span>我的专栏</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
    </div>
</div>

<div class="d-block d-md-none mb-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*topic-published') }}" href="{{ route('user.ucenter.topic-published') }}">我发起的话题</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*topic-replies') }}" href="{{ route('user.ucenter.topic-replies') }}">我参与的话题</a>
        </li>
    </ul>
</div>
