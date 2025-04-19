<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/') }}" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- User Panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name ?? 'User' }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

        <!-- DASHBOARD -->
        <li class="nav-header">DASHBOARD</li>
        <li class="nav-item">
          <a href="{{ route('admin.beranda') }}" class="nav-link {{ Request::is('admin/beranda') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>BERANDA</p>
          </a>
        </li>

        <!-- DATA MASTER DROPDOWN -->
        <li class="nav-item has-treeview {{ Request::is('admin/program*', 'admin/sekolahformal*', 'admin/datasantri*', 'admin/angkatan*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              DATA MASTER
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('program.index') }}" class="nav-link {{ Request::is('admin/program*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>PROGRAM PESANTREN</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('sekolahformal.index') }}" class="nav-link {{ Request::is('admin/sekolahformal*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>SEKOLAH FORMAL</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('datasantri.index') }}" class="nav-link {{ Request::is('admin/datasantri*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>DATA SANTRI</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('angkatan.index') }}" class="nav-link {{ Request::is('admin/angkatan*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>ANGKATAN</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- KEUANGAN DROPDOWN -->
        <li class="nav-item has-treeview {{ Request::is('admin/postagihan*', 'admin/jenis-pembayaran*', 'admin/tarif-pembayaran*', 'admin/tagihan*', 'admin/pembayaran*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>
              KEUANGAN
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('postagihan.index') }}" class="nav-link {{ Request::is('admin/postagihan*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>POS TAGIHAN</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('jenis-pembayaran.index') }}" class="nav-link {{ Request::is('admin/jenis-pembayaran*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>JENIS TAGIHAN</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tarif-pembayaran.index') }}" class="nav-link {{ Request::is('admin/tarif-pembayaran*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>TARIF PEMBAYARAN</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tagihan.index') }}" class="nav-link {{ Request::is('admin/tagihan*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>TAGIHAN SANTRI</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pembayaran.index') }}" class="nav-link {{ Request::is('admin/pembayaran*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>PEMBAYARAN</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- LOGOUT -->
        <li class="nav-header">AKSES</li>
        <li class="nav-item">
          <a href="{{ route('logout') }}"
             class="nav-link"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
            <p>LOGOUT</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
