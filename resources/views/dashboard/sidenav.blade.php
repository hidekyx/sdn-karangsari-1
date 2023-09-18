<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
    @if($logged_user->role == "Admin")
    <li class="nav-item nav-category">Menu Admin</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/dashboard/siswa') }}">
        <i class="menu-icon mdi mdi-account-multiple"></i>
        <span class="menu-title">Data Siswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/dashboard/guru') }}">
        <i class="menu-icon mdi mdi-account-card-details"></i>
        <span class="menu-title">Data Guru</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/dashboard/kelas') }}">
        <i class="menu-icon mdi mdi-table"></i>
        <span class="menu-title">Data Kelas</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/dashboard/kegiatan') }}">
        <i class="menu-icon mdi mdi-calendar"></i>
        <span class="menu-title">Data Kegiatan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/dashboard/sarpras') }}">
        <i class="menu-icon mdi mdi-airballoon"></i>
        <span class="menu-title">Sarana dan Prasarana</span>
        </a>
    </li>
    @elseif($logged_user->role == "Guru")
    <li class="nav-item nav-category">Menu Guru</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/dashboard/') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/dashboard/absensi/list') }}">
        <i class="menu-icon mdi mdi-calendar"></i>
        <span class="menu-title">Laporan Absensi</span>
        </a>
    </li>
    @endif
    <li class="nav-item nav-category">Akun</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('/logout') }}">
        <i class="menu-icon mdi mdi-account-off"></i>
        <span class="menu-title">Log Out</span>
        </a>
    </li>
</ul>
    
</nav>