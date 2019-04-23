<div class="d-none d-md-block">
    <div class="list-group">
        <a href="{{ route('user.ucenter') }}" class="{{ setNavActive('*index') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>社区轨迹</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
    </div>

    <div class="list-group mt-3">
        <a href="{{ route('user.ucenter.profile') }}" class="{{ setNavActive('*profile*') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>我的资料</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('user.ucenter.realname-verify') }}" class="{{ setNavActive('*realname-verify') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>实名认证</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('user.ucenter.setting-notice') }}" class="{{ setNavActive('*setting-notice') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>消息推送</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
        <a href="{{ route('user.ucenter.security-center') }}" class="{{ setNavActive('*security-center') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>安全中心</span> <span class="icon icon-chevron-thin-right"></span>
        </a>
    </div>
</div>
