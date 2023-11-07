  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Konfirmasi Penarikan Saldo</h1>
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
                                      <div class="card-body col-md-8">
                                          <form role="form" method="POST"
                                              action="<?php echo base_url() . 'index.php/nasabah/create_penarikan'; ?>">
                                              <div class="form-row">
                                                  <div class="form-group col-md-4">
                                                      <div class="input-group">
                                                          <input value="<?= $this->input->get('nin'); ?>" name="nin"
                                                              type="text" class="form-control" id="tampilSaldo" readonly
                                                              hidden>
                                                          <div class="input-group-append">
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="form-group col-md-5">
                                                      <input value="<?= $this->input->get('jumlah_penarikan'); ?>"
                                                          type="text" class="form-control" id="inputJumlah"
                                                          name="jumlah_penarikan" readonly hidden>
                                                      <?= form_error('nin', '<small class="text-danger">', '</small>') ?>
                                                  </div>
                                              </div>
                                              <div class="form-row">
                                                  <div class="form-group col-md-4">
                                                      <label for="InputJumlah">Kode Verifikasi</label>
                                                      <input placeholder="Masukkan kode" type="number"
                                                          class="form-control" id="inputOtp" name="otp" required>
                                                      <small class="text-success">Silahkan cek email anda, dan
                                                          masukkan kode disini</small>
                                                  </div>
                                              </div>
                                              <button id="btnSubmit" type="submit"
                                                  class="btn btn-primary">Konfirmasi</button>
                                              <!-- <button id="btnReset" type="reset" class="btn btn-warning">Reset</button> -->
                                          </form>
                                      </div>
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