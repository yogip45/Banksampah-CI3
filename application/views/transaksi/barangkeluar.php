  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Barang Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Transaksi</li>
              <li class="breadcrumb-item active">Barang Keluar</li>
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
            <!-- TAMBAH -->
            <!-- TAMBAH -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">

                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">Tambah Data</h3>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                          <div class="col-md-8">
                            <form role="form" action="<?= base_url() ?>index.php/stok/create_barangkeluar" method="POST">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputTanggalKeluar">Tanggal Barang
                                    Keluar</label>
                                  <div class="input-group date" id="inputTanggalKeluar" data-target-input="nearest">
                                    <input placeholder="yyyy/mm/dd" value="<?= set_value('tgl_akhir') ?>" type="text" class="form-control datetimepicker-input" data-date-end-date="0d" data-target="#inputTanggalKeluar" name="tgl_keluar" />
                                    <div class="input-group-append" data-target="#inputTanggalKeluar" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                  <?= form_error('tgl_keluar', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="inputSampah">Pilih Sampah</label>
                                  <select class="form-control" id="inputSampah" name="id_sampah">
                                    <option value="">Pilih Sampah</option>
                                    <?php foreach ($jns_sampah as $sampah) : ?>
                                      <?php
                                      $selected = '';
                                      if (set_value('id_sampah') == $sampah->id_sampah) {
                                        $selected = 'selected';
                                      }
                                      ?>
                                      <option data-harga="<?= $sampah->harga ?>" value="<?= $sampah->id_sampah ?>" <?= $selected ?>>
                                        <?= $sampah->nama_sampah ?>
                                      </option>
                                    <?php endforeach ?>
                                  </select>
                                  <?= form_error('id_sampah', '<small class="text-danger">', '</small>') ?>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="berat">Jumlah (kg)</label>
                                  <input placeholder="Masukan total berat sampah" type="number" value="<?= set_value('jumlah') ?>" class="form-control" id="inputJumlah" name="jumlah" step="0.1" min="0">
                                  <?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="berat">Total Penjualan (Rp)</label>
                                  <input value="<?= set_value('total') ?>" type="number" class="form-control" id="inputJumlah" name="total" placeholder="Masukkan total penjualan sampah" step="0.01" min="0">
                                  <?= form_error('total', '<small class="text-danger">', '</small>') ?>
                                </div>
                              </div>
                              <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Konten di sebelah kanan -->
                </div>
                <table class="table table-striped table-bordered table-hover" id="dataNasabah">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Id</th>
                      <th>Jenis Sampah</th>
                      <th>Tanggal Keluar</th>
                      <th>Jumlah</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($barangkeluar as $data) : ?>
                      <?php
                      $timestamp = strtotime($data->tgl_keluar);
                      $bulanIndonesia = array(
                        'January' => 'Januari',
                        'February' => 'Februari',
                        'March' => 'Maret',
                        'April' => 'April',
                        'May' => 'Mei',
                        'June' => 'Juni',
                        'July' => 'Juli',
                        'August' => 'Agustus',
                        'September' => 'September',
                        'October' => 'Oktober',
                        'November' => 'November',
                        'December' => 'Desember'
                      );

                      $bulanTerjemahan = $bulanIndonesia[date('F', $timestamp)];
                      $tanggalTerjemahan = date('d', $timestamp) . ' ' . $bulanTerjemahan . ' ' . date('Y', $timestamp);
                      ?>
                      <tr class="odd gradeX">
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->id ?></td>
                        <td><?php echo $data->nama_sampah ?></td>
                        <td><?php echo $tanggalTerjemahan ?></td>
                        <td><?php echo $data->jumlah ?></td>
                        <td>Rp. <?php echo $data->total ?></td>
                      <?php endforeach; ?>
              </div>
              </tr>
              </tbody>

              </table>
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

  <script type="text/javascript">
    $(function() {
      // Mendapatkan tanggal hari ini
      var today = new Date();

      $('#inputTanggalKeluar').datetimepicker({
        locale: 'id',
        format: 'YYYY-MM-DD',
        // Menonaktifkan semua tanggal setelah hari ini
        maxDate: today
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      loadmax();
    });

    function loadmax() {
      $("#inputSampah").change(function() {
        var getId = $("#inputSampah").val();
        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: "<?= base_url() . 'index.php/stok/max_barangkeluar' ?>",
          data: {
            id_sampah: getId
          },
          success: function(data) {
            var placeholderText = "Maksimal " + data[0].jumlah + " Kg";
            jumlah = data[0].jumlah;
            if (jumlah == 0) {
              $("#inputJumlah").prop("disabled", true);
              $("#submitBtn").prop("disabled", true);
              $("#inputJumlah").attr("placeholder", "Stok Tidak Tersedia");
            } else {
              $("#inputJumlah").prop("disabled", false);
              $("#submitBtn").prop("disabled", false);
              $("#inputJumlah").attr("placeholder", placeholderText);
            }
          }
        });
      });
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
    <?php if ($this->session->flashdata('gagal')) : ?>
      Swal.fire({
        icon: "error",
        title: "Maaf...",
        text: "<?php echo $this->session->flashdata("sukses"); ?>",
        // footer: '<a href="#">Why do I have this issue?</a>'
      });
    <?php endif; ?>
  </script>