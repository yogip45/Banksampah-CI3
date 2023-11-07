  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Penarikan Saldo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Transaksi</li>
              <li class="breadcrumb-item active">Penarikan</li>
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
            <?php if ($this->session->flashdata('sukses')) : ?>
              <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('hapus')) : ?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('hapus'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('gagal')) : ?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('gagal'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('edit')) : ?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('edit'); ?></div>
            <?php endif; ?>
            <!-- ALERT -->
            <!-- TAMBAH -->
            <!-- TAMBAH -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">Proses Penarikan</h3>
                      </div>
                      <div class="card-body col-md-8">
                        <form role="form" method="POST" action="<?php echo base_url() . 'index.php/nasabah/verify_penarikan'; ?>">
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="inputDesa">Saldo Anda</label>
                              <div class="input-group">
                                <input value="Rp. <?= $nasabah['saldo']; ?>" type="text" class="form-control" id="tampilSaldo" readonly>
                                <div class="input-group-append">
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-5">
                              <label for="inputDesa">Nomor Nasabah Anda</label>
                              <input value="<?= $nasabah['nin']; ?>" type="text" class="form-control" id="inputNin" name="nin" readonly>
                              <?= form_error('nin', '<small class="text-danger">', '</small>') ?>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="InputJumlah">Jumlah Penarikan</label>
                              <input placeholder="Max <?= $nasabah['saldo']; ?>" <?= set_value('jumlah_penarikan') ?> type="number" class="form-control" id="inputJumlah" name="jumlah_penarikan">
                              <?= form_error('jumlah_penarikan', '<small class="text-danger">', '</small>') ?>
                            </div>
                          </div>
                          <button id="btnSubmit" type="submit" class="btn btn-primary">Proses</button>
                          <!-- <button id="btnReset" type="reset" class="btn btn-warning">Reset</button> -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataNasabah">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Id</th>
                          <th>Tanggal Penarikan</th>
                          <th>Jumlah Penarikan</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($penarikan as $data) : ?>
                          <tr class="odd gradeX">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data->id_penarikan ?></td>
                            <td><?php echo date('d M Y', strtotime($data->tgl_penarikan)) ?></td>
                            <td class="text-danger">Rp. <?php echo $data->jumlah_penarikan ?></td>
                            <td class="text-center <?php echo $data->status == 1 ? 'text-success' : 'text-warning'; ?>">
                              <?php echo $data->status == 1 ? 'Selesai' : 'Belum Dikonfirmasi'; ?>
                            </td>
                          <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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