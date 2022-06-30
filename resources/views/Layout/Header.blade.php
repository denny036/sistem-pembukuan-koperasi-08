<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep" aria-expanded="false"><i
                    class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#"></a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons" tabindex="2"
                    style="overflow: hidden; outline: none;">
                    @foreach ($utang as $u)
                        @if (Auth::user()->role == 'admin')
                            @if ($u->tgl_pelunasan < $date && $u->status != 'Lunas')
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Pinjaman {{ $u->name }} pada {{ date('d F Y', strtotime($u->tgl_pinjaman)) }} dan
                                        berahir pada {{ date('d F Y', strtotime($u->tgl_pelunasan)) }} sudah jatuh
                                        tempo
                                        <div class="time"></div>
                                    </div>
                                </a>
                            @endif
                        @else
                            @if ($u->tgl_pelunasan < $date && $u->status != 'Lunas')
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Pinjaman anda pada {{ date('d F Y', strtotime($u->tgl_pinjaman)) }} sudah
                                        jatuh
                                        tempo
                                        <div class="time"></div>
                                    </div>
                                </a>
                            @elseif ($u->tgl_pelunasan > $date && $u->status != 'Lunas')
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Anda memiliki pinjaman pada {{ date('d F Y', strtotime($u->tgl_pinjaman)) }}
                                        dan jatuh
                                        tempo pada {{ date('d F Y', strtotime($u->tgl_pelunasan)) }}
                                        <div class="time"></div>
                                    </div>
                                </a>
                            @else
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Pinjaman anda pada {{ date('d F Y', strtotime($u->tgl_pinjaman)) }} sudah
                                            Lunas</b>
                                        <div class="time"></div>
                                    </div>
                                </a>
                            @endif
                        @endif
                    @endforeach

                </div>
                <div class="dropdown-footer text-center">
                    <a href="#"></a>
                </div>
                <div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr"
                    style="width: 9px; z-index: 1000; cursor: default; position: absolute; top: 58px; left: 341px; height: 350px; opacity: 0.3; display: block;">
                    <div class="nicescroll-cursors"
                        style="position: relative; top: 0px; float: right; width: 7px; height: 306px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
                    </div>
                </div>
                <div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr"
                    style="height: 9px; z-index: 1000; top: 399px; left: 0px; position: absolute; cursor: default; display: none; width: 341px; opacity: 0.3;">
                    <div class="nicescroll-cursors"
                        style="position: absolute; top: 0px; height: 7px; width: 350px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;">
                    </div>
                </div>
            </div>
        </li>

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('Gambar/New Akun/' . Auth::user()->foto_profil) }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block"></div>{{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Menu</div>
                <a href="{{ route('profil') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
