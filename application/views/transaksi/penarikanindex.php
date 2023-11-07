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
                                      <!-- <div class="card card-primary card-outline">
                                          <div class="card-header">
                                              <h3 class="card-title">Proses Penarikan</h3>
                                          </div>
                                          <div class="card-body col-md-8">
                                              <form role="form" method="POST" action="<?php echo base_url() . 'index.php/penarikan/create_penarikan'; ?>">
                                                  <div class="form-row">
                                                      <div class="form-group col-md-4">
                                                          <label for="inputDesa">Nomor Induk Nasabah</label>
                                                          <div class="input-group">
                                                              <input value="<?= set_value('nin') ?>" type="text" class="form-control" id="inputNin" name="nin" readonly>
                                                              <div class="input-group-append">
                                                                  <button class="btn btn-primary" data-toggle="modal" data-target="#tampilNasabah" type="button">
                                                                      <i class="fas fa-list fa-fw"></i> Pilih
                                                                  </button>
                                                              </div>
                                                          </div>
                                                          <?= form_error('nin', '<small class="text-danger">', '</small>') ?>
                                                      </div>
                                                      <div class="form-group col-md-5">
                                                          <label for="inputDesa">Nama Nasabah</label>
                                                          <input value="<?= set_value('nama') ?>" type="text" class="form-control" id="inputNama" name="nama" readonly>
                                                          <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                                                      </div>
                                                      <div class="form-group col-md-3" id="tampilSaldo" hidden>
                                                          <label for="tampilSaldo">Saldo Nasabah</label>
                                                          <input value="<?= set_value('saldo') ?>" type="text" class="form-control" id="inputTampilSaldo" disabled>
                                                      </div>
                                                  </div>
                                                  <div class="form-row" id="divSaldo" hidden>
                                                      <div class="form-group col-md-4">
                                                          <input value="<?= set_value('saldo') ?>" type="number" class="form-control" id="inputSaldo" name="saldo" readonly hidden>
                                                          <?= form_error('saldo', '<small class="text-danger">', '</small>') ?>
                                                      </div>
                                                  </div>
                                                  <div class="form-row">
                                                      <div class="form-group col-md-4">
                                                          <label for="InputJumlah">Jumlah Penarikan</label>
                                                          <input placeholder="Masukkan jumlah penarikan" <?= set_value('jumlah_penarikan') ?> type="number" class="form-control" id="inputJumlah" name="jumlah_penarikan">
                                                          <?= form_error('jumlah_penarikan', '<small class="text-danger">', '</small>') ?>
                                                      </div>
                                                  </div>
                                                  <button id="btnSubmit" type="submit" class="btn btn-primary">Proses</button>
                                                  <button id="btnReset" type="reset" class="btn btn-warning">Reset</button>
                                              </form>
                                          </div>
                                      </div> -->
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="table-responsive">
                                      <table class="table table-striped table-bordered" id="dataNasabah">
                                          <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>Id</th>
                                                  <th>NIN</th>
                                                  <th>Tanggal Penarikan</th>
                                                  <th>Jumlah Penarikan</th>
                                                  <th>Status</th>
                                                  <th>Aksi</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                                $no = 1;
                                                foreach ($penarikan as $data) : ?>
                                                  <tr class="odd gradeX">
                                                      <td><?php echo $no++ ?></td>
                                                      <td><?php echo $data->id_penarikan ?></td>
                                                      <td><?php echo $data->nin ?></td>
                                                      <td><?php echo date('d M Y', strtotime($data->tgl_penarikan)) ?></td>
                                                      <td class="text-danger">Rp. <?php echo $data->jumlah_penarikan ?></td>
                                                      <td class="text-center <?php echo $data->status == 1 ? 'text-success' : 'text-warning'; ?>">
                                                          <?php echo $data->status == 1 ? 'Selesai' : 'Belum Dikonfirmasi'; ?>
                                                      </td>
                                                      <td class="text-center">
                                                          <?php if ($data->status == 0) : ?>
                                                              <div class="btn-group">
                                                                  <button type="button" class="btn btn-warning" data-toggle="dropdown">Pilih Aksi</button>
                                                                  <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                      <span class="sr-only"> Toggle Dropdown</span>
                                                                  </button>
                                                                  <div class="dropdown-menu" role="menu">
                                                                      <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#Selesai<?php echo $data->id_penarikan; ?>"><i class="far fa-check-circle"></i> Konfirmasi</a>
                                                                  <?php else : ?>
                                                                      -
                                                                  <?php endif; ?>
                                                                  </div>
                                                              </div>
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
                                                                          <button id="btnPilih" type="button" class="btn btn-success" data-dismiss="modal" onclick="pilih_nasabah('<?php echo $data->nin ?>', '<?php echo $data->nama ?>')">Pilih</button>
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
                                  <?php foreach ($penarikan as $data) : ?>
                                      <div class="modal fade" id="Selesai<?php echo $data->id_penarikan; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Penarikan</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      Pastikan nasabah sudah menerima uang penarikan
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                      <?php echo anchor('index.php/penarikan/konfirmasi/' . $data->id_penarikan, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  <?php endforeach; ?>
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
          getdata_nasabah(nin);
      }

      function getdata_nasabah(nin) {
          $.ajax({
              type: "POST",
              dataType: "JSON",
              url: "<?= base_url() . 'index.php/penarikan/getdata_nasabah' ?>",
              data: {
                  nin: nin
              },
              success: function(data) {
                  var saldo = data[0].saldo;
                  if (saldo != 0) {
                      $("#inputSaldo").val(saldo);
                      $("#inputTampilSaldo").val("Rp. " + saldo);
                      $("#saldoNasabah").text(saldo);
                      $("#inputJumlah").attr("disabled", false);
                      $("#btnSubmit").attr("disabled", false);
                  } else {
                      $("#inputSaldo").val(0);
                      $("#inputTampilSaldo").val(0);
                      $("#inputJumlah").attr("readonly", true);
                      $("#inputJumlah").attr("placeholder", "Saldo Tidak Mencukupi");
                      $("#btnSubmit").attr("disabled", true);
                  }
              },
          });
      }
  </script>