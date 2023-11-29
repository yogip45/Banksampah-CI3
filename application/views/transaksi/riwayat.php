  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Histori Transaksi Nasabah</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item">Transaksi</li>
                          <li class="breadcrumb-item active">History Transaksi</li>
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
                                  </div>
                                  <div class="col-md-12">
                                      <h5><?= $nama; ?> / <?= $keyword; ?></h3>
                                          <br>
                                          <div class="table-responsive">
                                              <table class="table table-striped table-bordered" id="dataNasabah">
                                                  <thead>
                                                      <tr>
                                                          <th>No.</th>
                                                          <th>Id Setor / Penarikan</th>
                                                          <th>Tanggal Transaksi</th>
                                                          <th>Total</th>
                                                          <th>Status</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php if ($setoran != null || $riwayat_transaksi != null) : ?>
                                                      <?php
                                                            $no = 1;
                                                            foreach ($riwayat_transaksi['setoran'] as $data) : ?>
                                                      <tr class="odd gradeX">
                                                          <td><?php echo $no++ ?></td>
                                                          <td><?php echo $data->id_setor ?></td>
                                                          <td><?php echo date('d M Y', strtotime($data->tanggal_setor)) ?>
                                                          </td>
                                                          <td class="text-success">+ <?php echo $data->total ?></td>
                                                          <td
                                                              class="text-center <?php echo $data->status == 1 ? 'text-success' : 'text-warning'; ?>">
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
                                                          <?php
                                                                $no = 1;
                                                                foreach ($riwayat_transaksi['penarikan'] as $data) : ?>
                                                      <tr class="odd gradeX">
                                                          <td><?php echo $no++ ?></td>
                                                          <td><?php echo $data->id_penarikan ?></td>
                                                          <td><?php echo date('d M Y', strtotime($data->tgl_penarikan)); ?>
                                                          </td>
                                                          <?php if ($data->status == 3) : ?>
                                                          <td class="text-success">
                                                              + <?php echo $data->jumlah_penarikan; ?></td>
                                                          <?php else : ?>
                                                          <td class="text-red">- <?php echo $data->jumlah_penarikan; ?>
                                                          </td>
                                                          <?php endif; ?>

                                                          <td
                                                              class="text-center <?php echo $data->status == 1 ? 'text-success' : ($data->status == 3 ? 'text-danger' : 'text-warning'); ?>">
                                                              <?php
                                                                        if ($data->status == 1) {
                                                                            echo 'Selesai';
                                                                        } elseif ($data->status == 3) {
                                                                            echo 'Dibatalkan';
                                                                        } else {
                                                                            echo 'Belum Dikonfirmasi';
                                                                        }
                                                                        ?>
                                                          </td>
                                                          <td class="text-center">-</td>
                                                          <?php endforeach; ?>
                                                          <?php endif ?>
                                                  </tbody>
                                              </table>
                                              <table class="table table-striped table-bordered">
                                                  <?php
                                                    $totalSetoran = 0; // Variabel untuk mengakumulasi hasil setoran
                                                    $totalPenarikan = 0; // Variabel untuk mengakumulasi hasil penarikan

                                                    // Perhitungan total setoran
                                                    foreach ($riwayat_transaksi['setoran'] as $item) {
                                                        $totalSetoran += $item->total;
                                                    }

                                                    // Perhitungan total penarikan
                                                    $totalPenarikan = 0;
                                                    foreach ($riwayat_transaksi['penarikan'] as $item) {
                                                        if ($item->status == 1 || $item->status == 0) {
                                                            $totalPenarikan += $item->jumlah_penarikan;
                                                        }
                                                    }
                                                    ?>
                                                  <!-- <tr>
                                                      <td class="text-bold" style="width: 56%;">Saldo Nasabah</td>
                                                      <td class="text-success text-bold" style="width: 15%;">Rp.
                                                          <?php echo $nasabah[0]->saldo; ?>
                                                      </td>
                                                  </tr> -->
                                                  <tr>
                                                      <td class="text-bold" style="width: 56%;">Total Setoran</td>
                                                      <td class="text-success text-bold" style="width: 15%;">Rp.
                                                          <?= $totalSetoran; ?>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td class="text-bold" style="width: 56%;">Total Penarikan</td>
                                                      <td class="text-danger text-bold" style="width: 15%;">Rp.
                                                          <?= $totalPenarikan; ?>
                                                  </tr>
                                                  </td>
                                              </table>
                                          </div>

                                          <!-- MODAL PILIH NASABAH -->
                                          <div class="modal fade" id="tampilNasabah" tabindex="-1" role="dialog"
                                              aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Pilih Nasabah
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal"
                                                              aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body"
                                                          style="max-height: 70vh; overflow-y: auto;">
                                                          <div class="table-responsive">
                                                              <table
                                                                  class="table table-striped table-bordered table-hover"
                                                                  id="dataNasabah" style="width: 100%;">
                                                                  <thead>
                                                                      <tr>
                                                                          <th style="text-align: center;">No.</th>
                                                                          <th style="text-align: center;">NIN</th>
                                                                          <th style="text-align: center;">Nama Lengkap
                                                                          </th>
                                                                          <th style="text-align: center;">Aksi</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                      <?php
                                                                        $no = 1;
                                                                        foreach ($nasabah as $data) : ?>
                                                                      <tr class="odd gradeX">
                                                                          <td
                                                                              style="text-align: center; vertical-align: middle;">
                                                                              <?php echo $no++ ?></td>
                                                                          <td
                                                                              style="text-align: center; vertical-align: middle;">
                                                                              <?php echo $data->nin ?></td>
                                                                          <td
                                                                              style="text-align: center; vertical-align: middle;">
                                                                              <?php echo $data->nama ?></td>
                                                                          <td
                                                                              style="text-align: center; vertical-align: middle;">
                                                                              <button type="button"
                                                                                  class="btn btn-success"
                                                                                  data-dismiss="modal"
                                                                                  onclick="pilih_nasabah('<?php echo $data->nin ?>', '<?php echo $data->nama ?>')">Pilih</button>
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
                                                          <button type="button" class="btn btn-secondary"
                                                              data-dismiss="modal">Batal</button>
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