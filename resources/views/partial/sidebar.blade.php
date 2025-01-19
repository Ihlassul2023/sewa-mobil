<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      @auth  
      <div class="image">
        <img src="{{asset('template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->nama}}</a>
      </div>
      @endauth
      @guest
      <div class="info">
        <a href="#" class="d-block">Silahkan Login</a>
      </div>
      @endguest
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
               
            @auth
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Manajemen Mobil
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/mobil/create" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Mobil</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/mobil" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Mobil</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Penyewaan Mobil
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/listMobil" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mobil Tersedia</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/daftarSewa" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mobil Disewa</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item bg-danger" >
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                   Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @endauth
            @guest
            <li class="nav-item bg-primary">
                <a href="/login" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Login
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              </li>
            @endguest
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>