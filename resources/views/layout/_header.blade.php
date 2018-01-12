<nav class="navbar navbar-default navbar-static-top site-header">
    <div class="container">
        <div class="navbar-header">
            {{--  Branding Image  --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
        </div>

        {{--  Right Side Of Navbar  --}}
        <ul class="nav navbar-nav navbar-right">
            {{--  Authentication Links  --}}
            @guest
                <li><a href="{{ route('login') }}">登录</a></li>
                <li><a href="{{ route('register') }}">注册</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                            <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                        </span>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @can('manage_contents')
                            <li>
                                <a href="{{ url(config('administrator.uri')) }}">
                                    <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
                                    管理后台
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ route('user.show', Auth::id()) }}">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                个人资料
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.edit', Auth::id()) }}">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                设置
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                退出
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
</nav>
{{--  gotop  --}}
<a id="gotop" href="#top"></a>