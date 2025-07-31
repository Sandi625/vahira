<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Bintoro Travel</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboardpelanggan') }}"
                        class="nav-link {{ request()->routeIs('dashboardpelanggan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('reservasi.pelanggan.create') }}"
                        class="nav-link {{ request()->routeIs('reservasi.pelanggan.create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Reservasi Online
                        </p>
                    </a>
                </li>


                {{-- <li class="nav-item">
                    <a href="{{ route('pelanggan.index') }}"
                        class="nav-link {{ request()->routeIs('pelanggan.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Pesan
                        </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('user.banks.index') }}"
                        class="nav-link {{ request()->is('banks') ? 'active' : '' }}">
                        <i class="fas fa-university nav-icon"></i>
                        <p>Info Bank</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
    <a href="{{ route('reservasi.pelanggan.sukses') }}"
       class="nav-link {{ request()->routeIs('reservasi.pelanggan.sukses') ? 'active' : '' }}">
        <i class="nav-icon fas fa-check-circle"></i>
        <p>Total Harga</p>
    </a>
</li> --}}


                <li class="nav-item">
                    <a href="{{ route('user.status.pembayaran') }}"
                        class="nav-link {{ request()->routeIs('user.status.pembayaran') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>Status Pembayaran</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ route('akun.profile') }}"
                        class="nav-link {{ request()->routeIs('akun.profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pengaturan Akun
                        </p>
                    </a>
                </li>



                <!-- Logout Link -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>

        </nav>
    </div>
</aside>
