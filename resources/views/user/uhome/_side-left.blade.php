@include('user._user-profile-card', ['user' => $user])

<div class="card d-md-block d-lg-block mb-4 m-nb-r m-nb-y">
    <div class="card-body">
        <h6 class="mb-3">
            用户资料
            <!--
            <small> · <a href="#">编辑</a></small>
            -->
        </h6>
        <ul class="list-unstyled list-spaced">
            <li><span class="text-muted icon icon-user mr-3"></span>U{{ $user->id }}</li>
            <li><span class="text-muted icon icon-location-pin mr-3"></span>中国大陆</li>
            <li><span class="text-muted icon icon-calendar mr-3"></span>注册于 {{ $user->created_at->format('Y年m月d日') }}, 第 {{ $user->id }} 名会员 </li>
        </ul>
    </div>
</div>

<div class="mt-3 d-none d-md-block">
    @include('layouts._tail')
</div>
