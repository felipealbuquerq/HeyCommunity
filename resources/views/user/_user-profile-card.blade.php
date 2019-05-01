@if ($user)
    <div class="card card-profile mb-4">
        <div class="card-header" style="background-image: url('{{ asset($user->profile_bg_img) }}');"></div>
        <div class="card-body text-center">
            <a href="{{ route('user.uhome', $user->id)  }}">
                <img class="card-profile-img" src="{{ asset($user->avatar) }}">
            </a>

            <h6 class="card-title">
                <a class="text-inherit" href="{{ route('user.uhome', $user->id) }}">{{ $user->nickname }}</a>
            </h6>

            <p class="mb-4">{{ $user->bio ?: '暂无签名' }}</p>
        </div>
    </div>
@else
    <div class="card card-profile mb-4">
        <div class="card-header" style="background-image: url('{{ asset("/images/user/profile_bg_img.jpg") }}');"></div>
        <div class="card-body text-center">
            <a href="{{ route('user.login')  }}">
                <img class="card-profile-img" src="{{ asset('/images/user/avatars/default.png') }}">
            </a>

            <h6 class="card-title">
                <span class="text-inherit">游客
                    <small><a href="{{ route('user.login') }}">[登录]</a></small>
                </span>
            </h6>

            <p class="mb-4 text-muted">登录后才能与大家交流互动</p>
        </div>
    </div>
@endif
