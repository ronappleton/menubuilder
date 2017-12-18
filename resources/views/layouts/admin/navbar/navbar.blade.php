@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="nav-link">
        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
            <span class="navbar-toggler-icon"></span>
        </button>
    </a>
    <a class="navbar-brand" href="#">RADMIN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @include('menu-builder::layouts.admin.navbar.menus.left')
        </ul>
        <ul class="navbar mx-auto">
            @include('menu-builder::layouts.admin.navbar.menus.middle')
        </ul>
        <ul class="navbar-nav ml-auto">
            @include('menu-builder::layouts.admin.navbar.menus.right')
            @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>

            @else
                @gravatar
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                         {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('account') }}"><i class="material-icons">account_balance</i> Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="material-icons">lock_outline</i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
@endsection