<div>
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Tepra</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">TP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('jenis-barang-jasa.index') }}">
                    <i class="fas fa-database"></i>
                    <span>Jenis Barang Jasa</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                    <span>Realisasi Pendapatan</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('pendapatans.index') }}">Pendapatan</a></li>
                    <li><a href="{{ route('permasalahan-pendapatans.index') }}">Permasalahan</a></li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="{{ route('triwulans.index') }}">
                    <i class="fas fa-database"></i>
                    <span>Triwulan</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
