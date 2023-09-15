<!-- Main Sidebar Container -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script> 

<?php $role = $this->session->userdata('role'); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/foto/<?= $user['foto'] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/banksampah/index.php/user/myprofile" class="d-block"><?= $user['nama_petugas']  ?></a>
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

              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($role==3) : ?>
                <li class="nav-item">
                  <a href="/banksampah/index.php/admin/petugasindex" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'petugasindex'
                || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'tambah_petugas' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'edit_petugas'
                ) ? 'active' : ''; ?>">
                  <p>Petugas</p>
                </a>
              </li>                            
              <?php endif ?>
              <?php if ($role!=1) : ?>
                <li class="nav-item">
                  <a href="/banksampah/index.php/petugas/nasabahindex" class="nav-link <?= ($this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'nasabahindex') ? 'active' : ''; ?>">
                    <p>Nasabah</p>
                  </a>
                </li>                            
                <?php endif ?>
            </ul>
          </li>
          <li class="nav-item">
          <a href="/banksampah/index.php/jenissampah" class="nav-link <?= ($this->uri->segment(1) == 'jenissampah') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-trash"></i>
            <p>
              Sampah
            </p>
          </a>
        </li>
          <li class="nav-item">
          <?php if ($role!=1) : ?>
            <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'tambah_setoran'
            )  ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/banksampah/index.php/setoran/setoranindex" class="nav-link <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'tambah_setoran'
                )  ? 'active' : ''; ?>">
                  <p> Setor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <p> Penarikan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/banksampah/index.php/setoran/pernasabah" class="nav-link">
                  <p>Nasabah</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif ?>
          <li class="nav-item">
            <a href="/banksampah/index.php/user/myprofile" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'myprofile') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Profile Saya
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
