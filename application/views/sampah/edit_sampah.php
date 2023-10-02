  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Petugas</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
              <li class="breadcrumb-item active">Petugas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php if ($this->session->flashdata('sukses')): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('hapus')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('hapus'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('gagal')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('gagal'); ?></div>
            <?php endif; ?>
            <!-- ALERT -->                                                
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambahSampah">
                <i class="fa fa-plus"></i> Tambah
            </button>
            <br>
            <br>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <?php foreach ($jns_sampah as $sampah) : ?>
                    <form action="<?php echo base_url().'index.php/jenissampah/update';?>" method="post" class="col-sm-6">
                        <div class="form-group">
                            <label for="jenisSampah">Jenis Sampah</label>
                            <input type="hidden" name="id" value="<?= $sampah->id_sampah; ?>">
                            <input type="text" class="form-control" id="jenisSampah" name="nama_sampah" required placeholder="botol, kardus bekas" value="<?= $sampah->nama_sampah; ?>">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga / kg</label>
                            <input type="number" class="form-control" id="harga" name="harga" required placeholder="Rp." value="<?= $sampah->harga; ?>">
                        </div>
                        <div class="form-group">
                            <label for="kategoriSampah">Kategori Sampah</label>
                            <select class="form-control" id="kategoriSampah" name="kategori">
                                <option value="Plastik" <?= ($sampah->kategori == 'Plastik') ? 'selected' : ''; ?>>Plastik</option>
                                <option value="Kertas" <?= ($sampah->kategori == 'Kertas') ? 'selected' : ''; ?>>Kertas</option>
                                <option value="Logam" <?= ($sampah->kategori == 'Logam') ? 'selected' : ''; ?>>Logam</option>
                                <option value="Kaca" <?= ($sampah->kategori == 'Kaca') ? 'selected' : ''; ?>>Kaca</option>
                                <option value="Lain-lain" <?= ($sampah->kategori == 'Lain-lain') ? 'selected' : ''; ?>>Lain - Lain</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
                <?php endforeach ?>                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->            
    </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
