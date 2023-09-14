  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Setoran</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">                
                <!-- FORM -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" action="<?= base_url() ?>index.php/setoran/create_setoran" method="POST">
                                <div class="form-group">
                                    <label for="inputDesa">Nomor Induk Nasabah</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="inputNin" name="nin" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#tampilNasabah" type="button"><i class="fa fa-folder-open fa-fw"></i> Pilih</button>
                                        </div>
                                    </div>
                                    <?= form_error('nin', '<small class="text-danger form-text text-muted">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputDesa">Nama Nasabah</label>
                                    <input type="text" class="form-control" id="inputNama" name="nama" readonly>
                                    <?= form_error('nama', '<small class="text-danger form-text text-muted">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Sampah</label>
                                    <select class="form-control" id="jenisSampah" name="jenis_sampah">
                                        <option data-harga="0" value="">Pilih Sampah</option>
                                        <?php foreach ($jns_sampah as $sampah) : ?>
                                            <option data-harga="<?= $sampah->harga ?>"><?= $sampah->nama_sampah ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?= form_error('jns_sampah', '<small class="text-danger form-text text-muted">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputDesa">Harga /kg</label>
                                    <input type="number" class="form-control" id="inputHarga" name="harga" value="<?= set_value('harga') ?>" readonly>
                                    <?= form_error('harga', '<small class="text-danger form-text text-muted">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputKecamatan">Berat (kg)</label>
                                    <input type="number" class="form-control" id="inputBerat" name="berat" value="<?= set_value('berat') ?>">
                                    <?= form_error('berat', '<small class="text-danger form-text text-muted">', '</small>') ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <!-- Konten di sebelah kanan -->
                        </div>
                    </div>
                </div>
                <!-- FORM -->
                <!-- MODAL PILIH NASABAH -->
                <div class="modal fade" id="tampilNasabah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pilih Nasabah</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataNasabah" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
                                            <th style="text-align: center;">NIN</th>
                                            <th style="text-align: center;">Nama Lengkap</th>                                                                                                                   
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($nasabah as $data) : ?>
                                        <tr class="odd gradeX">
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $no++?></td>
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $data->nin ?></td>                                                                    
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $data->nama ?></td>                                                                    
                                                <td style="text-align: center; vertical-align: middle;">                                                    
                                                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="pilih_nasabah('<?php echo $data->nin ?>', '<?php echo $data->nama ?>')">Pilih</button>                                                                                                                                        
                                                </td>                                                    
                                                <?php endforeach; ?>                                                                                                                                                                        
                                                <!-- <td>
                                                <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                                                </td> -->
                                        </tr>                                                                                                                                                                                                                  
                                    </tbody>                                                                                      
                                </table>                                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-Primary" data-dismiss="modal">Batal</button>                                                
                        </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL PILIH NASABAH -->
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
<script src="<?= base_url() ?>/assets/js/trans-js.js"></script>
