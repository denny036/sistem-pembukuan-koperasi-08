<nav class="navbar navbar-expand-lg main-navbar">
    <a href="/" class="navbar-brand sidebar-gone-hide">KOPERASI IT DEL</a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <ul class="navbar-nav">

        </ul>
    </div>
    <form class="form-inline ml-auto">
        <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/home') }}" class="nav-link nav-link-lg nav-link-user">
                        <div class="d-sm-none d-lg-inline-block">Back TO HOME</div>
                    </a>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="nav-link nav-link-lg nav-link-user">
                        <div class="d-sm-none d-lg-inline-block">Login</div>
                    </a>
                </li>
            @endif
            @endif
        </ul>
    </nav>


    <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link"><i class="fa-solid fa-house"></i><span>Home</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('informasi') }}" class="nav-link"><i class="fa-solid fa-newspaper"></i><span>Informasi</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengumumanIn') }}" class="nav-link"><i class="fa-solid fa-paper-plane"></i><span>Pengumuman</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link"><i class="fa-solid fa-circle-info"></i><span>About</span></a>
                </li>
            </ul>
        </div>
    </nav>
