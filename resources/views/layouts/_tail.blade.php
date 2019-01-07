<div class="card card-link-list">
    <div class="card-body">
        <!-- Site Map -->
        <div class="d-none">
            <a class="ml-0" href="{{ route('news.index') }}">新闻</a>
            <a href="{{ route('daily.index') }}">今日</a>
            <a href="{{ route('post.index') }}">资讯</a>
            <a href="{{ route('columnist.index') }}">专栏</a>
            <a href="{{ route('topic.index') }}">话题</a>
            <a href="{{ route('activity.index') }}">活动</a>
        </div>

        <div class="text-nowrap text-overflow">
            &copy; 2018 {{ $system->site_title }}
            <small>发现和创造美好</small>
        </div>

        <div>
            <a class="ml-0" href="{{ route('site.about') }}">关于</a>
            <a href="{{ route('site.help') }}">帮助</a>
            <a href="{{ route('site.terms') }}">用户协议</a>
            <a href="{{ route('site.privacy') }}">隐私政策</a>
        </div>
    </div>
</div>
