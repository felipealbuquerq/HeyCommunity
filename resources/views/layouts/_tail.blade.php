<div class="card card-link-list mt-3">
    <div class="card-body">
        <!-- Site Map -->
        <div class="">
            <a class="ml-0" href="{{ route('news.index') }}">新闻</a>
            <a href="{{ route('timeline.index') }}">动态</a>
            <a href="{{ route('columnist.index') }}">专栏</a>
            <a href="{{ route('topic.index') }}">话题</a>
            <a href="{{ route('activity.index') }}">活动</a>
        </div>

        <div class="mt-1">
            <a class="ml-0" href="{{ route('site.about') }}">关于</a>
            <a href="{{ route('site.help') }}">帮助</a>
            <a href="{{ route('site.terms') }}">用户协议</a>
            <a href="{{ route('site.privacy') }}">隐私政策</a>
        </div>

        <div class="text-nowrap text-overflow mt-2">
            <div class="">
                &copy; 2017-{{ date('Y') }} {{ $system->site_title }}
                <small>免费开源的社交软件</small>
            </div>
            <div>Powered By <a target="_blank" href="https://www.hey-community.com">HeyCommunityV4</a></div>
        </div>
    </div>
</div>
