  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Edit Data Petugas</h1>
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
                      <!-- ALERT -->
                      <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body">
                              <?php foreach ($petugas as $data) : ?>
                              <form role="form" action="<?php echo base_url().'index.php/admin/update_petugas';?>"
                                  method="POST" class="col-8">
                                  <div class="form-group col-md-8">
                                      <label for="inputNama">Nama Lengkap</label>
                                      <input type="text" class="form-control" id="inputNama" name="nama_petugas"
                                          value="<?= $data->nama_petugas?>">
                                      <input type="hidden" class="form-control" id="inputNama" name="id_user"
                                          value="<?= $data->id_user?>">
                                      <?= form_error('nama','<small class="text-danger">', '</small>') ?>
                                  </div>
                                  <div class="form-group col-md-8">
                                      <label for="inputEmail">Email</label>
                                      <input type="text" class="form-control" id="inputEmail" name="email"
                                          value="<?= $data->email?>" readonly>
                                  </div>
                                  <div class="form-group col-md-8">
                                      <label for="inputHp">No HP</label>
                                      <input type="number" class="form-control" id="inputHp" name="no_hp"
                                          value="<?= $data->no_hp?>">
                                      <?= form_error('no_hp','<small class="text-danger">', '</small>') ?>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                          <button type="reset" class="btn btn-warning text-white">Reset</button>
                                          <a href="<?= base_url()?>index.php/admin/petugasindex" type="reset"
                                              class="btn btn-danger">Batal</a>
                                      </div>
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