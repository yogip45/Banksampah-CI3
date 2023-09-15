  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Sampah</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sampah</a></li>
              <li class="breadcrumb-item active">Data Sampah</li>
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
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jenis Sampah</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Tanggal Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($jns_sampah as $sampah) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>                                                    
                            <td><?php echo $sampah->nama_sampah ?></td>                                                   
                            <td><?php echo $sampah->kategori ?></td>                                                   
                            <td><?php echo $sampah->harga ?> /kg</td>                                                                                                        
                            <td><?php echo date('d M Y', strtotime($sampah->diubah)) ?></td>                                                    
                            <td class="text-center" >                                                        
                                <?php echo anchor('index.php/jenissampah/edit/'.$sampah->id, '<button type="button" class="btn btn-warning"><i class="fa text-white fa-edit fa-fw"></i></button>'); ?>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $sampah->id; ?>">
                                <i class="fa fa-trash fa-fw"></i>
                                </button>
                            </td>                                                                                                                                                                                                                   
                            <!-- Modal untuk konfirmasi hapus -->
                            <div class="modal fade" id="hapusModal<?php echo $sampah->id; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?php echo $sampah->id; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel<?php echo $sampah->id; ?>">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <?php echo anchor('index.php/jenissampah/hapus/'.$sampah->id, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal untuk edit -->                                                                                               
                        <?php endforeach; ?>
                        </div>
                    </tr>                                                                                           
                    </tbody>
                </table>
                <!-- MODAL INPUT -->
                <div class="modal fade" id="tambahSampah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Sampah</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan jenis sampah -->
                            <form action="<?php echo base_url().'index.php/jenissampah/tambah_aksi';?>" method="post">
                                <div class="form-group">
                                    <label for="jenisSampah">Jenis Sampah</label>
                                    <input type="text" class="form-control" id="jenisSampah" name="nama_sampah" required placeholder="botol, kardus bekas">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga / kg</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required placeholder="Rp.">
                                </div>
                                <div class="form-group">
                                    <label for="kategoriSampah">Kategori Sampah</label>
                                    <select class="form-control" id="kategoriSampah" name="kategori">
                                    <option value="Plastik">Plastik</option>
                                    <option value="Kertas">Kertas</option>
                                    <option value="Logam">Logam</option>
                                    <option value="Kaca">Kaca</option>
                                    <option value="Lain-lain">Lain - Lain</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL INPUT -->
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