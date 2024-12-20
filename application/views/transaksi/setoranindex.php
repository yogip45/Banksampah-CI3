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
                          <li class="breadcrumb-item">Transaksi</li>
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
                      <!-- TAMBAH -->
                      <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body col-md-12">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="card card-primary card-outline">
                                          <div class="card-header">
                                              <h3 class="card-title">Tambah Setoran</h3>
                                          </div>
                                          <div class="card-body col-md-4">
                                              <form role="form" action="<?= base_url() ?>index.php/setoran/create_setoran" method="POST">
                                                  <div class="form-group">
                                                      <label for="inputDesa">Nomor Induk Nasabah</label>
                                                      <div class="input-group">
                                                          <input type="text" class="form-control" id="inputNin" name="nin" readonly>
                                                          <div class="input-group-append">
                                                              <button class="btn btn-primary" data-toggle="modal" data-target="#tampilNasabah" type="button">
                                                                  <i class="fa fa-list fa-fw"></i> Pilih
                                                              </button>
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
                                                  <!-- <button type="reset" class="btn btn-warning">Reset</button> -->
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="table-responsive">
                                          <table class="table table-striped table-bordered" id="dataNasabah">
                                              <thead>
                                                  <tr>
                                                      <th>No.</th>
                                                      <th>Id Setor</th>
                                                      <th>NIN</th>
                                                      <th>Tanggal Setor</th>
                                                      <th>Total</th>
                                                      <th>Status</th>
                                                      <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                    $no = 1;
                                                    foreach ($setoran as $data) : ?>
                                                      <tr class="odd gradeX">
                                                          <td><?php echo $no++ ?></td>
                                                          <td><?php echo $data->id_setor ?></td>
                                                          <td><?php echo $data->nin ?></td>
                                                          <td><?php echo date('d M Y', strtotime($data->tanggal_setor)) ?>
                                                          </td>
                                                          <td>Rp. <?php echo $data->total ?></td>
                                                          <td class="text-center <?php echo $data->status == 1 ? 'text-success' : 'text-warning'; ?>">
                                                              <?php echo $data->status == 1 ? 'Selesai' : 'Belum Selesai'; ?>
                                                          </td>
                                                          <td class="text-center">
                                                              <?php if ($data->status == 1 || $data->status == 0) : ?>
                                                                  <?php
                                                                    $url = '/index.php/setoran/detail_setoran/' . $data->id_setor;
                                                                    $attributes = array('class' => 'btn btn-info');
                                                                    echo anchor($url, 'Detail', $attributes);
                                                                    ?>
                                                              <?php endif ?>
                                                              <?php if ($data->status == 0) : ?>
                                                                  <?php
                                                                    $url = '/index.php/setoran/hapus_setoran/' . $data->id_setor;
                                                                    $attributes = array('class' => 'btn btn-danger');
                                                                    echo anchor($url, 'Hapus', $attributes);
                                                                    ?>
                                                              <?php endif ?>
                                                          </td>
                                                      <?php endforeach; ?>
                                              </tbody>
                                          </table>
                                      </div>

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
                                                                          <td style="text-align: center; vertical-align: middle;">
                                                                              <?php echo $no++ ?></td>
                                                                          <td style="text-align: center; vertical-align: middle;">
                                                                              <?php echo $data->nin ?></td>
                                                                          <td style="text-align: center; vertical-align: middle;">
                                                                              <?php echo $data->nama ?></td>
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
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- MODAL PILIH NASABAH -->

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
  <script>
      function pilih_nasabah(nin, nama) {
          $("#tampilSaldo").attr("hidden", false);
          inputNin.value = nin;
          inputNama.value = nama;
      }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
      <?php if ($this->session->flashdata('sukses')) : ?>
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: '<?php echo $this->session->flashdata("sukses"); ?>',
              showConfirmButton: false,
              timer: 3000 // Tampilkan pesan selama 3 detik
          });
      <?php endif; ?>
      <?php if ($this->session->flashdata('hapus')) : ?>
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: '<?php echo $this->session->flashdata("hapus"); ?>',
              showConfirmButton: false,
              timer: 3000 // Tampilkan pesan selama 3 detik
          });
      <?php endif; ?>
      <?php if ($this->session->flashdata('gagal')) : ?>
          Swal.fire({
              icon: "error",
              title: "Maaf...",
              text: "<?php echo $this->session->flashdata("gagal"); ?>",
              // footer: '<a href="#">Why do I have this issue?</a>'
          });
      <?php endif; ?>
  </script>