<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="">Geofilter Studio</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{route('account.index', ['home'])}}">My Profile</a></li>
                    <li><a href="{{route('logout.submit')}}">Logout</a></li>
                @else
                    <li><a href="{{route('login.index')}}">Sing In</a></li>
                    <li><a href="{{route('create-account.index')}}">Sign Up</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>