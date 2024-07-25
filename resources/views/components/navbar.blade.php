<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <!-- <img src="{{ (is_null(auth()->user()->foto_profil)) ? ('/style/img/avatar.png') : (asset('storage/images/profile/' . auth()->user()->foto_profil)) }}" class="user-image img-circle" alt="User Image"> -->
            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href=""><i class="fas fa-user"></i>  Profile</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>  Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
        </div>
    </li>
</ul>
