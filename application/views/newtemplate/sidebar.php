<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()?>adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $user['nama_petugas']  ?></a>
        </div>
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
          <li class="nav-item">
          <a href="/banksampah/index.php/admin/dashboard" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'petugasindex' || 'admin' && $this->uri->segment(2) == 'edit_petugas'
            || 'admin' && $this->uri->segment(2) == 'tambah_petugas' || $this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'nasabahindex'
            || $this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'tambah_nasabah' || $this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'edit_nasabah'
            ) ? 'active' : ''; ?>">

              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/banksampah/index.php/admin/petugasindex" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'petugasindex'
                || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'tambah_petugas' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'edit_petugas'
                ) ? 'active' : ''; ?>">
                  <i class="far fa-user nav-icon"></i>
                  <p>Petugas</p>
                </a>
              </li>                            
              <li class="nav-item">
                <a href="/banksampah/index.php/petugas/nasabahindex" class="nav-link <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex') ? 'active' : ''; ?>">
                  <i class="far fa-user nav-icon"></i>
                  <p>Nasabah</p>
                </a>
              </li>                            
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'tambah_setoran'
            )  ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/banksampah/index.php/setoran/setoranindex" class="nav-link <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'tambah_setoran'
                )  ? 'active' : ''; ?>"">
                  <p> Setor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <p> Penarikan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <p>Nasabah</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
