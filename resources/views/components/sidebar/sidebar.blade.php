<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('barang*') ? 'active' : '' }}">
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

                    <li class="sidebar-item {{ request()->is('kategori*') ? 'active' : '' }}">
                        <a href="{{ route('kategori') }}" class='sidebar-link'>
                            <i class="fas fa-layer-group"></i>
                            <span>Kategori Barang</span>
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

                <li class="sidebar-item {{ request()->is('pindahbarang*') ? 'active' : '' }} ">
                    <a href="{{ route('pindahbarang') }}" class='sidebar-link'>
                        <i class="fas fa-exchange-alt"></i>
                        <span>Pemindahan Barang</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('karyawan*') ? 'active' : '' }} ">
                    <a href="{{ route('karyawan') }}" class='sidebar-link'>
                        <i class="fas fa-user"></i>
                        <span>Akun Karyawan</span>
                    </a>
                </li>

                <li class="sidebar-title">Akun</li>

                <li class="sidebar-item  ">
                    <a href="table.html" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>