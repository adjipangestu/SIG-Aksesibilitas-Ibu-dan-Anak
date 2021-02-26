        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-dark">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item {{ Request::segment(2) == 'home' ? 'active' : ''}}">
                            <a class="nav-link" href="/admin/home">
                                <span class="feather-icon"><i data-feather="activity"></i></span>
                                <span class="nav-link-text">Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::segment(2) == 'kelola-data' ? 'active' : ''}}">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
                                <span class="feather-icon"><i data-feather="package"></i></span>
                                <span class="nav-link-text">Kelola Data</span>
                            </a>
                            <ul id="dash_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item {{ Request::segment(3) == 'kabupaten' ? 'active' : ''}}">
                                            <a class="nav-link" href="{{ route('admin.kabupaten.index') }}">Kabupaten</a>
                                        </li>
                                        <li class="nav-item {{ Request::segment(3) == 'kelurahan' ? 'active' : ''}}">
                                            <a class="nav-link" href="{{ route('admin.kelurahan.index') }}">Kelurahan</a>
                                        </li>
                                        <li class="nav-item {{ Request::segment(3) == 'kecamatan' ? 'active' : ''}}">
                                            <a class="nav-link" href="{{ route('admin.kecamatan.index') }}">Kecamatan</a>
                                        </li>
                                        <li class="nav-item {{ Request::segment(3) == 'jenis-faskes' ? 'active' : ''}}">
                                            <a class="nav-link" href="{{ route('admin.jenis_faskes.index') }}">Jenis Fasilitas Kesehatan</a>
                                        </li>
                                        <li class="nav-item {{ Request::segment(3) == 'faskes' ? 'active' : ''}}">
                                            <a class="nav-link" href="{{ route('admin.faskes.index') }}">Fasilitas Kesehatan</a>
                                        </li>
                                        <li class="nav-item {{ Request::segment(3) == 'jarak' ? 'active' : ''}}">
                                            <a class="nav-link" href="{{ route('admin.jarak.index') }}">Input Jarak</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Request::segment(2) == 'user' ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('admin.user.index') }}">
                                <span class="feather-icon"><i data-feather="user"></i></span>
                                <span class="nav-link-text">Manajemen User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>