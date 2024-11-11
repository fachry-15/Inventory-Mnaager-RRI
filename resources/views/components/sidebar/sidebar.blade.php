<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('dashboard') }}"> <img src="{{ asset('assets/images/logo/logoRRI.png') }}" alt="Logo" ></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('barang*') || request()->is('detail_barang/*') ? 'active' : '' }}">
                    <a href="{{ route('barang') }}" class='sidebar-link'>
                        <i class="fas fa-box"></i>
                        <span>Inventaris Barang</span>
                    </a>
                </li>
                
                <li class="sidebar-item  {{ request()->is('ruangan*') ? 'active' : '' }}">
                    <a href="{{ route('ruangan') }}" class='sidebar-link'>
                        <i class="fas fa-hospital"></i>
                        <span>Manajemen Ruangan</span>
                    </a>
                </li>

                    <li class="sidebar-item {{ request()->is('kategori*') || request()->is('daftarbaranag/*') ? 'active' : '' }}">
                        <a href="{{ route('kategori') }}" class='sidebar-link'>
                            <i class="fas fa-layer-group"></i>
                            <span>Kategori Barang</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('DaftarKantor') ? 'active' : '' }} ">
                        <a href="{{ route('daftarkantor') }}" class='sidebar-link'>
                            <i class="far fa-building"></i>
                            <span>Daftar Kantor</span>
                        </a>
                    </li>

                <li class="sidebar-item  {{ request()->is('pemindahan*') ? 'active' : '' }}">
                    <a href="{{ route('pemindahan') }}" class='sidebar-link'>
                        <i class="fas fa-briefcase"></i>
                        <span>Pengambilan Barang</span>
                    </a>
                </li>

                <li class="sidebar-item  {{ request()->is('pengembalian*') ? 'active' : '' }}">
                    <a href="{{ route('pengembalian') }}" class='sidebar-link'>
                        <i class="fas fa-archive"></i>
                        <span>Kembalikan Barang</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('PindahBarangMenu*') ? 'active' : '' }} ">
                    <a href="{{ route('pindahbarangmenu') }}" class='sidebar-link'>
                        <i class="fas fa-exchange-alt"></i>
                        <span>Pindah Barang</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('Maintenance') ? 'active' : '' }} ">
                    <a href="{{ route('maintenance') }}" class='sidebar-link'>
                        <i class="fas fa-wrench"></i>
                        <span>Perawatan Barang</span>
                    </a>
                </li>

                @if (auth()->user()->role == 'superadmin')
                <li class="sidebar-item {{ request()->is('karyawan*') ? 'active' : '' }}">
                    <a href="{{ route('karyawan') }}" class='sidebar-link'>
                        <i class="fas fa-user"></i>
                        <span>Akun Karyawan</span>
                    </a>
                </li>
            @endif

                <li class="sidebar-title">Akun</li>

                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class='sidebar-link' onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>