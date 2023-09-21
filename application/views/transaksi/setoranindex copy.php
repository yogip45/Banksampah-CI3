  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Setoran</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
              <li class="breadcrumb-item active">Setoran</li>
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
            <?php if ($this->session->flashdata('edit')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('edit'); ?></div>
            <?php endif; ?>
            <!-- ALERT -->        
            <!-- TAMBAH -->
            <div class="col-md-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Pendapatan</h3>
                </div>
                  <div class="card-body">
                      <div class="tab-content">
                      <div class="active tab-pane" id="settings">
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
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="reset" class="btn btn-warning">Reset</button>
                          </form>
                      </div>
                      </div>
                      </div>
                  </div>
              </div>
              <!-- Konten di sebelah kanan -->
            </div>
            <!-- TAMBAH -->
            <?php echo anchor('/index.php/setoran/tambah_setoran/', '<button class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>'); ?>
            <br>
            <br>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">                
                <table class="table table-striped table-bordered table-hover" id="dataNasabah">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id Setor</th>
                            <th>NIN</th>
                            <th>Tanggal Setor</th>
                            <th>Jenis Sampah</th>
                            <th>Berat</th>                                                    
                            <th>Harga</th>                                                    
                            <th>Total</th>                                               
                        </tr>
                    </thead>
                    <tbody>                                                
                    <?php
                        $no = 1;
                        foreach ($nasabah as $data) : ?>
                    <tr class="odd gradeX">
                            <td><?php echo $no++?></td>
                            <td><?php echo $data->id_setor ?></td>
                            <td><?php echo $data->nin ?></td>
                            <td><?php echo date('d M Y', strtotime($data->tanggal_setor)) ?></td>
                            <td><?php echo $data->jenis_sampah ?></td>
                            <td><?php echo $data->berat ?></td>                                                    
                            <td><?php echo $data->harga ?></td>                                                    
                            <td><?php echo $data->total ?></td>                                                    
                            <!-- <td>                                                    
                                <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#detailModal<?php echo $data->nin; ?>">
                                <i class="fa fa-bars fa-fw"></i>
                                </button>
                            </td>                                                     -->
                            <?php endforeach; ?>
                        </div>                                                                                                            
                            <!-- <td>
                            <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                            </td> -->
                    </tr>                                                                                                                                                                                                                  
                    </tbody>                                          
                    
                </table>
                    <!-- MODAL DETAIL DATA NASABAH -->
                    <?php
                    $no = 1;
                    foreach ($nasabah as $data) : ?>
                    <div class="modal fade print-container" id="detailModal<?php echo $data->nin; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>                                                            
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <table class="table">
                                <tr>
                                    <th>Id Setor</th>
                                    <td><?php echo $data->id_setor ?></td>                                                                
                                </tr>
                                <tr>
                                    <th>NIN / Username</th>
                                    <td><?php echo $data->nin ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Setor</th>
                                    <td><?php echo date('d M Y H:i', strtotime($data->tanggal_setor)) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Nasabah</th>
                                    <td><?php echo $data->nama ?></td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td><?php echo $data->harga ?></td>
                                </tr>
                                <tr>
                                    <th>Qty</th>
                                    <td><?php echo $data->berat ?></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><?php echo $data->total ?></td>
                                </tr>
                                <!-- Tambahkan baris ini sesuai dengan kolom yang lain -->
                            </table>
                            </div>
                            <div class="modal-footer">                                                                                                                  
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <!-- MODAL DETAIL NASABAH -->
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