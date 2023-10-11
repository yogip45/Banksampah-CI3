<!-- Main Sidebar Container -->
<?php $role = $this->session->userdata('role'); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/foto/<?= $nasabah['foto'] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/banksampah/index.php/user/myprofile" class="d-block"><?= $nasabah['nama']  ?></a>
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
          <a href="<?= base_url('index.php/nasabah/dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'nasabah' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('index.php/nasabah/setoran_saya') ?>" class="nav-link <?= ($this->uri->segment(1) == 'nasabah' && $this->uri->segment(2) == 'setoran_saya'
            || $this->uri->segment(1) == 'nasabah' && $this->uri->segment(2) == 'detail_setoran') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Riwayat Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="<?= base_url('index.php/user/myprofile') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'myprofile') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
