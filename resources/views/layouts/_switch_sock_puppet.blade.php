@if (isset($_COOKIE['sockPuppetHash']) && $_COOKIE['sockPuppetHash'] == '$2y$10$.hAgAbqyo4m.KzJSr6uoluMgEVn/wH8NERzfGE28f9eLNKB67t00e')
    <!-- switch sock puppet -->
    <div class="btn-group" role="group" style="position:absolute; right:20px; top:70px; z-index:9998">
        <button id="btnGroup-switch-sock-puppet" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-secret"></i>&nbsp;
            Switch Sock Puppet
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroup-switch-sock-puppet">
            @foreach ([2, 3, 4, 5] as $userId)
                <a class="dropdown-item" href="{{ route('user.toggle-sock-puppet', ['id' => $userId]) }}">{{ \App\User::findOrFail($userId)->nickname }}</a>
            @endforeach
        </div>
    </div>
@endif