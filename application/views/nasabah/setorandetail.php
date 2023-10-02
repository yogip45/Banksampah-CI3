  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Setoran</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'index.php/setoran/setoranindex';?>">Setor</a></li>
              <li class="breadcrumb-item active">Detail Setoran</li>
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
                        <!-- <div class="col-md-2">
                        </div> -->
                        <!-- CARD KANAN -->
                        <div class="col-md-12">
                            <!-- Konten di sebelah kanan -->
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="text-left">
                                          <div class="table-responsive">
                                            <table class="table">
                                              <tr>
                                                  <td style="width: 60%; vertical-align: top ">
                                                    <h5><span id="id_setor"><?= $id_setor; ?></span>/<?= $setoran['nama']; ?>/<span id="nin"><?= $setoran['nin']; ?></span> </h5>
                                                  </td>
                                                </tr>
                                              </tr>
                                            </table>
                                            <table class="table">
                                              <tr>
                                                <td style="width: 60%; vertical-align: top ">
                                                  <p>Saldo Awal: <span class="text-bold">Rp. </span> <span id="saldoLama" class="text-bold"><?= $setoran['saldo_lama']; ?></span></p>
                                                  <p>Total Pendapatan: <span class="text-bold">Rp. </span> <span class="text-bold" id="total"></span></p>
                                                  <p>Saldo Baru: <span class="text-bold" id="new_saldo"></span></p>
                                                </td>
                                              </tr>
                                              </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Konten di sebelah kanan -->
                        </div>
                        <!-- CARD KANAN -->
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                    <br>
                    <br>
                        <div class="card card-outline">
                          <div class="card-body">
                              <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                <?php if ($setoran['status'] == 0) : ?>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDetail">
                                        <i class="fa fa-plus"></i> Tambah
                                    </button>
                                    <br>
                                <?php elseif ($setoran['status'] == 1) : ?>
                                    <h3 style="color: green;" class="text-bold">Transaksi Selesai</h3>
                                <?php endif; ?>
                                <br>
                                  <table class="table table-striped table-bordered" id="dataNasabah">
                                      <thead>
                                      <tr>
                                        <th>Jenis Sampah</th>
                                        <th>Berat (Kg)</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $no = 1;
                                      foreach ($detail as $data) : ?>
                                        <tr class="odd gradeX">
                                          <td><?php echo $data->nama_sampah ?></td>
                                          <td><?php echo $data->berat ?></td>
                                          <td><?php echo $data->harga ?></td>
                                          <td><?php echo $data->total ?></td>
                                      <?php endforeach; ?>
                                    </tbody>
                                  </table>              
                                  <?php if ($setoran['status'] == 0) : ?>
                                    <a data-target="#selesaiTransaksi<?= $setoran['nin']; ?>" href="#selesai" id="selesaiTransaksi" data-toggle="modal"  class="btn btn-info">Selesai Transaksi</a>
                                  <?php endif; ?>                    
                                </div>
                              </div>
                            </div>
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

<script>
    // Ambil referensi ke elemen "total" dan tabel
    var totalElement = document.getElementById("total");
    var table = document.getElementById("dataNasabah");

    // Inisialisasi total
    var total = 0;

    // Loop melalui setiap baris (kecuali header) dalam tabel
    for (var i = 1; i < table.rows.length; i++) {
        // Ambil nilai dari kolom "Total" pada setiap baris
        var totalValue = parseFloat(table.rows[i].cells[3].textContent);
        
        // Pastikan nilai yang diambil adalah angka
        if (!isNaN(totalValue)) {
            total += totalValue;
        }
    }

    // Tampilkan hasilnya di elemen "total"
    totalElement.innerText = total.toFixed(0); // Menampilkan dengan 2 desimal    
</script>
<script>
  var saldoLamaElement = document.getElementById("saldoLama");
  var saldoLama = parseFloat(saldoLamaElement.textContent.replace("Rp. ", "").replace(",", ""));

  // Mendapatkan nilai total
  var totalElement = document.getElementById("total");
  var total = parseFloat(totalElement.textContent.replace("Rp. ", "").replace(",", ""));

  // Menghitung saldo baru
  var saldoBaru = saldoLama + total;

  // Menampilkan saldo baru dalam elemen dengan ID "new_saldo"
  var newSaldoElement = document.getElementById("new_saldo");
  newSaldoElement.textContent = "Rp. " + saldoBaru.toFixed(0);

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $("#btn-selesai").click(function() {
        var id_setor = $("#id_setor").text();
        var totalStr = $("#total").text();
        var nin = $("#nin").text();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('index.php/setoran/selesaitransaksi'); ?>',
            data: {
              id_setor: id_setor,
              total: totalStr,
              nin: nin
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Jika ingin mengarahkan pengguna setelah menampilkan pesan
                    window.location.href = '<?php echo base_url('index.php/setoran/setoranindex'); ?>';
                } else {
                    alert('Transaksi Gagal');
                }
            },
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $(".hapus-detail").click(function() {
        var id_setor = $(this).data('id-setor');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('index.php/setoran/hapus_detail_setoran'); ?>',
            data: { id_setor: id_setor },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    alert('Hapus Gagal');
                }
            },
        });
    });
});
</script>




