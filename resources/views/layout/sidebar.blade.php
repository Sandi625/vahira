  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
<img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">

          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
<img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          {{-- <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div> --}}



          <!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Brand Logo -->


          <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>

        <!-- Kelola Menu -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Kelola
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kelola Admin</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customer.index') }}" class="nav-link {{ request()->is('customer') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kelola Customer</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pembayaran.index') }}" class="nav-link {{ request()->is('pembayaran') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('penumpang.index') }}" class="nav-link {{ request()->is('penumpang') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Penumpang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('reservasi.index') }}" class="nav-link {{ request()->is('reservasi') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reservasi</p>
                    </a>
                </li>

                  <li class="nav-item">
                    <a href="{{ route('pakets.index') }}" class="nav-link {{ request()->is('pakets') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Paket Trip</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('pesanan.index') }}" class="nav-link {{ request()->is('pesanan') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pesanan</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Simple Link Menu -->


        <!-- Logout Menu -->
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>


          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
