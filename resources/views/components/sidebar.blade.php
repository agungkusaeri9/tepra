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
            @if (auth()->user()->role === 'operator')
                <li>
                    <a class="nav-link" href="{{ route('jenis-barang-jasa.index') }}">
                        <i class="fas fa-database"></i>
                        <span>Jenis Barang Jasa</span>
                    </a>
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
            @elseif(auth()->user()->role === 'skpd')
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i>
                        <span>Realisasi Pendapatan</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('pendapatans.index') }}">Pendapatan</a></li>
                        <li><a href="{{ route('permasalahan-pendapatans.index') }}">Permasalahan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i>
                        <span>Anggaran</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('penyerapan-anggarans.index') }}">Penyerapan Anggaran</a></li>
                        <li><a href="{{ route('penarikan-dana-anggarans.index') }}">Penarikan Dana</a></li>
                        <li><a href="{{ route('permasalahan-anggarans.index') }}">Permasalahan</a></li>
                        <li><a href="{{ route('pendanaan-penanganan-covid19.index') }}">Penanganan Covid 19</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i>
                        <span>Pengadaan Barjas</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('target-pbjs.index') }}">Target PBJ</a></li>
                        <li><a href="{{ route('realisasi-pbjs.index') }}">Realisasi PBJ</a></li>
                        <li><a href="{{ route('permasalahan-pbjs.index') }}">Permasalahan PBJ</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permasalahan-pendapatans.index') }}">
                        <i class="fas fa-database"></i>
                        <span>Permasalahan Pendapatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permasalahan-anggarans.index') }}">
                        <i class="fas fa-database"></i>
                        <span>Permasalahan Anggaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permasalahan-pendapatans.index') }}">
                        <i class="fas fa-database"></i>
                        <span>Permasalahan Barang Jasa</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>
</div>
