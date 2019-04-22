@php
    if (isset($_COOKIE['sockPuppetUsers'])) {
        $sockPuppetUsers = explode(',', $_COOKIE['sockPuppetUsers']);
    }
@endphp


@if (
    env('SOCK_PUPPET_ENABLE') === true
    && isset($_COOKIE['sockPuppetEnable'])
    && $_COOKIE['sockPuppetEnable'] == 'true'

    && isset($_COOKIE['sockPuppetHash'])
    && $_COOKIE['sockPuppetHash'] == env('SOCK_PUPPET_HASH')

    && isset($_COOKIE['sockPuppetUsers'])
    && isset($sockPuppetUsers)
    && is_array($sockPuppetUsers)
    && count($sockPuppetUsers)
)
    <!-- switch sock puppet -->
    <div class="btn-group" role="group" style="position:fixed; right:20px; bottom:50px; z-index:9998">
        <button id="btnGroup-switch-sock-puppet" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-secret"></i>&nbsp;
            Switch Sock Puppet
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroup-switch-sock-puppet">
            @foreach ($sockPuppetUsers as $userId)
                <a class="dropdown-item" href="{{ route('user.toggle-sock-puppet', ['id' => $userId]) }}">{{ \App\User::findOrFail($userId)->nickname }}</a>
            @endforeach
        </div>
    </div>
@endif