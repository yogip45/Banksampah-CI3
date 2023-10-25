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
        <?php if ($role == 3) : ?>
          <li class="nav-item">
            <a href="<?= base_url('index.php/admin/dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              Dashboard
              </p>
            </a>
          </li>
        <?php endif ?>
        <?php if ($role == 2) : ?>
          <li class="nav-item">
            <a href="<?= base_url('index.php/petugas/dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <?php endif ?>
        <li class="nav-item <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'petugasindex' || 'admin' && $this->uri->segment(2) == 'edit_petugas'
                              || 'admin' && $this->uri->segment(2) == 'tambah_petugas' || $this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'nasabahindex'
                              || $this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'tambah_nasabah' || $this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'edit_nasabah'
                            ) ? 'menu-open' : ''; ?>">
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
            <?php if ($role == 3) : ?>
              <li class="nav-item">
                <a href="<?= base_url('index.php/admin/petugasindex') ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'petugasindex'
                                                                                            || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'tambah_petugas' || $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'edit_petugas'
                                                                                          ) ? 'active' : ''; ?>">
                  <p class="nav-link">Petugas</p>
                </a>
              </li>
            <?php endif ?>
            <?php if ($role != 1) : ?>
              <li class="nav-item">
                <a href="<?= base_url('index.php/petugas/nasabahindex') ?>" class="nav-link <?= ($this->uri->segment(1) == 'petugas' && $this->uri->segment(2) == 'nasabahindex') ? 'active' : ''; ?>">
                  <p class="nav-link">Nasabah</p>
                </a>
              </li>
            <?php endif ?>
          </ul>
        </li>
        <li class="nav-item <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'tambah_setoran' ||
                              $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'pernasabah' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'detail_setoran'
                              || $this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'barangkeluar' || $this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'create_barangkeluar'
                              || $this->uri->segment(1) == 'penarikan' && $this->uri->segment(2) == 'penarikanindex')  ? 'menu-open' : ''; ?>">
          <?php if ($role != 1) : ?>
            <a href="#" class="nav-link <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'tambah_setoran' ||
                                          $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'pernasabah' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'detail_setoran'
                                          || $this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'barangkeluar' || $this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'create_barangkeluar'
                                          || $this->uri->segment(1) == 'penarikan' && $this->uri->segment(2) == 'penarikanindex')  ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('index.php/setoran/setoranindex') ?>" class="nav-link <?= ($this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'setoranindex' || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'tambah_setoran'
                                                                                              || $this->uri->segment(1) == 'setoran' && $this->uri->segment(2) == 'detail_setoran')  ? 'active' : ''; ?>">
                  <p class="nav-link"> Setor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('index.php/penarikan/penarikanindex'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'penarikan' && $this->uri->segment(2) == 'penarikanindex')  ? 'active' : ''; ?>">
                  <p class="nav-link"> Penarikan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('index.php/stok/barangkeluar') ?>" class="nav-link <?= ($this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'barangkeluar'
                                                                                            || $this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'create_barangkeluar')  ? 'active' : ''; ?>">
                  <p class="nav-link">Barang Keluar</p>
                </a>
              </li>
            </ul>
        </li>
      <?php endif ?>
      <li class="nav-item">
        <a href="<?= base_url('index.php/jenissampah') ?>" class="nav-link <?= ($this->uri->segment(1) == 'jenissampah') ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-trash"></i>
          <p>
            Sampah
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('index.php/cetaklaporan') ?>" class="nav-link <?= ($this->uri->segment(1) == 'cetaklaporan') ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-print"></i>
          <p>
            Laporan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('index.php/user/myprofile') ?>" class="nav-link <?= ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'myprofile') ? 'active' : ''; ?>">
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