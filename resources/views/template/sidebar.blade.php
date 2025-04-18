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
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

        {{-- ====== Lainnya ====== --}}
        <li class="nav-header">DASHBOARD</li>
        <li class="nav-item">
          <a href="{{ route('admin.beranda') }}" class="nav-link {{ Request::is('admin/beranda') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Beranda</p>
          </a>
        </li>

        {{-- ====== Data Master ====== --}}
        <li class="nav-header">DATA MASTER</li>
        <li class="nav-item">
          <a href="{{ route('program.index') }}" class="nav-link {{ Request::is('admin/program*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Program Pesantren</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('sekolahformal.index') }}" class="nav-link {{ Request::is('admin/sekolahformal*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-school"></i>
            <p>Sekolah Formal</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('datasantri.index') }}" class="nav-link {{ Request::is('admin/datasantri*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Data Santri</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('angkatan.index') }}" class="nav-link {{ Request::is('admin/angkatan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>Data Angkatan</p>
          </a>
        </li>

        {{-- ====== Keuangan (opsional) ====== --}}
        <li class="nav-header">KEUANGAN</li>
        <li class="nav-item">
          <a href="{{ route('postagihan.index') }}" class="nav-link {{ Request::is('admin/postagihan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            <p>Pos Tagihan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('jenis-pembayaran.index') }}" class="nav-link {{ Request::is('admin/jenis-pembayaran*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            <p>Jenis Tagihan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('tarif-pembayaran.index') }}" class="nav-link {{ Request::is('admin/tarif-pembayaran*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            <p>Tarif Pembayaran</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('tagihan.index') }}" class="nav-link {{ Request::is('admin/tagihan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            <p>Tagihan Santri</p>
          </a>
        </li>

        {{-- ====== Logout ====== --}}
        <li class="nav-header">AKSES</li>
        <li class="nav-item">
          <a href="{{ route('logout') }}"
             class="nav-link"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
            <p>Logout</p>
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
