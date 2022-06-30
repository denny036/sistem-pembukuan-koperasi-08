<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">Koperasi IT DEL</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">KOP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
            <li><a class="nav-link" href="/home"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            </li>
            <li class="menu-header">Starter</li>
            @if (Auth::user()->role == 'admin')
                <li><a class="nav-link" href="{{ route('pengumuman') }}"><i class="fas fa-bullhorn"></i>
                        <span>Pengumuman</span></a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-newspaper"></i> <span>Berita</span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li><a class="nav-link" href="{{ route('kategori') }}">Kategori</a></li>
                        <li><a class="nav-link" href="{{ route('berita') }}">Berita</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-receipt"></i> <span>Bukti Pembayaran
                        </span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li><a class="nav-link" href="{{ route('simpanan_wajib') }}">Simpanan Wajip</a></li>
                        <li><a class="nav-link" href="{{ route('simpanan_pokok') }}">Simpanan Pokok</a></li>
                        <li><a class="nav-link" href="{{ route('simpanan_sukarela') }}">Simpanan Sukarela</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-money-bill"></i> <span>Pinjaman
                        </span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li><a class="nav-link" href="{{ route('pinjaman') }}">Daftar Pinjaman</a></li>
                        <li><a class="nav-link" href="{{ route('dfpeminjam') }}">Bukti Pembayaran</a></li>
                    </ul>
                </li>
                <li><a class="nav-link" href="{{ route('anggota') }}"><i class="fas fa-users"></i>
                        <span>Anggota</span></a></li>
            @elseif (Auth::user()->role == 'anggota')
                <li><a class="nav-link" href="{{ route('AgPinjam') }}"><i class="fa-solid fa-money-bill"></i>
                        <span>Pinjaman</span></a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-receipt"></i> <span>Daftar Pembayaran
                        </span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li><a class="nav-link" href="{{ route('simpanan_wajib') }}">Simpanan Wajip</a></li>
                        <li><a class="nav-link" href="{{ route('simpanan_pokok') }}">Simpanan Pokok</a></li>
                        <li><a class="nav-link" href="{{ route('simpanan_sukarela') }}">Simpanan Sukarela</a></li>
                    </ul>
                </li>
                <li><a class="nav-link" href="{{ route('dfpeminjam') }}"><i class="fa-solid fa-comment-dollar"></i>
                        <span>Pembayaran Pinjaman</span></a></li>
            @endif
            <li><a class="nav-link" href="{{ route('profil') }}"><i class="fas fa-user"></i> <span>Profil</span></a>
            </li>
    </aside>
</div>
