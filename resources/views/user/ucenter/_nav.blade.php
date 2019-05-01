<div class="d-none d-md-block">
    <div class="list-group">
        <a target="_blank" href="{{ route('user.uhome', $user->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between">
            <span>我的主页</span> <span class="icon icon-export"></span>
        </a>
        <a href="{{ route('user.ucenter') }}" class="{{ setNavActive('*index') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>社区生涯</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
    </div>

    <div class="list-group mt-3">
        <a href="{{ route('user.ucenter.profile') }}" class="{{ setNavActive('*profile*') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>我的资料</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('user.ucenter.setting-notice') }}" class="{{ setNavActive('*setting-notice') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>消息推送</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('user.ucenter.security-center') }}" class="{{ setNavActive('*security-center') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>安全中心</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
    </div>
</div>


<div class="mb-3 d-block d-md-none container text-right">
    <a href="{{ route('user.ucenter') }}" class="pull-left btn {{ Request::is('*index') ? 'btn-primary' : 'btn-secondary' }}">社区生涯</a>

    <a href="{{ route('user.ucenter.profile') }}" class="btn {{ Request::is('*profile*') ? 'btn-primary' : 'btn-secondary' }}">我的资料</a>
    <a href="{{ route('user.ucenter.setting-notice') }}" class="btn {{ Request::is('*setting-notice') ? 'btn-primary' : 'btn-secondary' }}">消息推送</a>
    <a href="{{ route('user.ucenter.security-center') }}" class="btn {{ Request::is('*security-center') ? 'btn-primary' : 'btn-secondary' }}">安全中心</a>
</div>
