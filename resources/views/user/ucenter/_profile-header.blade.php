<div class="profile-header" style="background-image: url('{{ asset($user->profile_bg_img) }}');">
    <div class="container">
        <div class="container-inner">
            <img class="rounded-circle media-object" src="{{ asset($user->avatar) }}">
            <h3 class="profile-header-user">{{ $user->nickname }}</h3>
            <p class="profile-header-bio">
                {{ $user->bio ?: '暂无签名' }}
            </p>
        </div>

        <div class="row operations">
            <div class="col-sm-6 text-right d-none d-sm-block">
                <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-user-circle-o"></i> 更换头像</a>
                &nbsp;
                <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-picture-o"></i> 更换封面</a>
            </div>

            <div class="col-sm-6 text-left d-none d-sm-block">
                <a href="{{ route('user.uhome', $user->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-info-circle"></i> 我的主页</a>
                &nbsp;
                <a href="{{ route('user.profile') }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-id-card-o"></i> 更新资料</a>
            </div>

            <div class="col-12 d-block d-sm-none">
                <div class="btn-group btn-group-sm">
                    <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary">更换头像</a>
                    <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary">更换封面</a>
                    <a href="{{ route('user.uhome', $user->id) }}" class="btn btn-sm btn-secondary">我的主页</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-sm btn-secondary">更新资料</a>
                </div>
            </div>
        </div>
    </div>
</div>
