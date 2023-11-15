  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="loader"></div> -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Silahkan Ubah Password Anda</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                          <li class="breadcrumb-item active">Ubah Password</li>
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
                      <!-- ALERT -->
                      <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body">
                              <form role="form" action="<?php echo base_url() . 'index.php/user/passwordreset'; ?>"
                                  method="POST">
                                  <div class="form-group col-md-4">
                                      <label for="inputRw">Password</label>
                                      <input type="password" class="form-control" id="inputPassword1" name="password1">
                                      <?= form_error('password1', '<small class="text-danger form-text text-muted">', '</small>') ?>
                                  </div>
                                  <div class="form-group col-md-4">
                                      <label for="inputRw">Konfirmasi Password</label>
                                      <input type="password" class="form-control" id="inputPassword2" name="password2">
                                      <?= form_error('password2', '<small class="text-danger form-text text-muted">', '</small>') ?>
                                  </div>
                                  <div class="form-row col-md-6">
                                      <div class="col-md-12">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                          <button type="reset" class="btn btn-warning">Reset</button>
                                      </div>
                                  </div>
                              </form>
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