<div class="card card-profile mb-4">
    <div class="card-header" style="background-image: url('{{ asset($columnist->user->profile_bg_img) }}');"></div>
    <div class="card-body text-center">
        <img class="card-profile-img" src="{{ asset($columnist->user->avatar) }}">

        <h6 class="card-title">
            @if (Request::route()->getName() == 'columnist.show')
                <a class="text-inherit" href="{{ route('user.uhome', $columnist->user->id) }}">{{ $columnist->user->nickname }}</a>
            @else
                <a class="text-inherit" href="{{ route('columnist.show', $columnist->domain) }}">{{ $columnist->title }}</a> 专栏
            @endif
        </h6>

        @if (Request::route()->getName() == 'columnist.show')
            <p class="mb-4">{{ $columnist->introduction }}</p>
        @else
            <p class="mb-4">{{ $columnist->description }}</p>
        @endif

        <div class="row">
            <div class="col-4">
                <span>{{ $columnist->article_num }}</span>
                <div class="h5">
                    <span class="badge badge-primary">文章</span>
                </div>
            </div>
            <div class="col-4">
                <span>{{ $columnist->comment_num }}</span>
                <div class="h5">
                    <span class="badge badge-primary">评论</span>
                </div>
            </div>
            <div class="col-4">
                <span>{{ $columnist->read_num }}</span>
                <div class="h5">
                    <span class="badge badge-primary">阅读</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
    </div>
</div>
