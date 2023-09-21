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
                                        <table class="table">
                                          <tr>
                                              <td style="width: 60%; vertical-align: top ">
                                                <p><?= $nasabah['nama']; ?></p>
                                                <p><?= $nasabah['nin']; ?></p>
                                                <p><?= $nasabah['id_admin']; ?></p>
                                              </td>
                                              <td style="width: 30%; vertical-align: top; text-align: right;" class="text-bold">
                                                <p>Saldo Awal:</p>
                                                <p>Saldo Baru:</p>
                                                <p>Total Pendapatan:</p>
                                              </td>
                                              <td style="width: 10%; vertical-align: top; text-align: left;">
                                                  <p>Rp. <span id="saldoLama"><?= $nasabah['saldo']; ?></span></p>
                                                  <p><span id="new_saldo"></span></p>
                                                  <p>Rp. <span id="total"></span></p>
                                              </td>
                                          </tr>
                                        </table>
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambahDetail">
                                    <i class="fa fa-plus"></i> Tambah
                                </button>
                                <br>
                                <br>
                                  <table class="table table-striped table-bordered" id="dataNasabah">
                                      <thead>
                                      <tr>
                                        <th>No.</th>
                                        <th>Jenis Sampah</th>
                                        <th>Berat (Kg)</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $no = 1;
                                      foreach ($detail as $data) : ?>
                                        <tr class="odd gradeX">
                                          <td><?php echo $no++ ?></td>
                                          <td><?php echo $data->jns_sampah ?></td>
                                          <td><?php echo $data->berat ?></td>
                                          <td><?php echo $data->harga ?></td>
                                          <td><?php echo $data->total ?></td>
                                          <td class="text-center">
                                            <?php echo anchor('/index.php/setoran/detail_setoran/'.$data->id_setor, '<button class="btn btn-info"><i class="fa fa-trash"></i> Hapus</button>'); ?>
                                          </td>
                                      <?php endforeach; ?>
                                    </tbody>
                                  </table>
                                  <button id="updateStatusButton" class="btn btn-info">Selesai Transaksi</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
                <!-- FORM -->
                <!-- MODAL INPUT -->
                <div class="modal fade" id="tambahDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Sampah</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan jenis sampah -->
                            <form action="<?php echo base_url().'index.php/setoran/create_detail';?>" method="post">
                                <div class="form-group">
                                  <select class="form-control" id="jenisSampah" name="jenis_sampah">
                                          <option data-harga="0" value="">Pilih Sampah</option>
                                          <?php foreach ($jns_sampah as $sampah) : ?>
                                              <option data-harga="<?= $sampah->harga ?>"><?= $sampah->nama_sampah ?></option>
                                          <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="berat">Berat</label>
                                    <input type="hidden" value="<?= $nasabah['id_setor']; ?>" name="id_setor">
                                    <input type="number" class="form-control" id="inputBerat" name="berat" required placeholder="Kg" step="0.01" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="inputHarga">Harga</label>
                                    <input type="number" class="form-control" id="inputHarga" name="harga" required placeholder="Rp." step="0.01" min="0" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputTotal">Total</label>
                                    <input type="number" class="form-control" id="inputTotal" name="total" required placeholder="Rp."readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL INPUT -->
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
  var jenisSampah = document.getElementById("jenisSampah");
// Mendapatkan elemen input harga
  var inputHarga = document.getElementById("inputHarga");
  // Menambahkan event listener ketika pilihan jenis sampah berubah
  jenisSampah.addEventListener("change", function () {
    // Mendapatkan harga dari atribut data-harga opsi yang dipilih
    var selectedOption = jenisSampah.options[jenisSampah.selectedIndex];
    var harga = selectedOption.getAttribute("data-harga");
    // Mengisi nilai input harga dengan harga yang ditemukan
    inputHarga.value = harga;
  });
  inputBerat.addEventListener("input", calculateTotal);

  // Fungsi untuk menghitung total
  function calculateTotal() {
    var harga = parseFloat(inputHarga.value) || 0; // Mengambil harga, mengkonversi ke float
    var berat = parseFloat(inputBerat.value) || 0; // Mengambil berat, mengkonversi ke float
    var total = harga * berat; // Menghitung total
    inputTotal.value = total.toFixed(0); // Menyimpan total dengan 2 desimal
  }
</script>

<script>
    // Ambil referensi ke elemen "total" dan tabel
    var totalElement = document.getElementById("total");
    var table = document.getElementById("dataNasabah");

    // Inisialisasi total
    var total = 0;

    // Loop melalui setiap baris (kecuali header) dalam tabel
    for (var i = 1; i < table.rows.length; i++) {
        // Ambil nilai dari kolom "Total" pada setiap baris
        var totalValue = parseFloat(table.rows[i].cells[4].textContent);
        
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
    $("#updateStatusButton").click(function() {
        $.ajax({
            url: "http://localhost/banksampah/index.php/setoran/donesetor",
            type: "POST",
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    alert(response.message);
                    // Refresh halaman atau lakukan tindakan lain yang diperlukan
                } else {
                    alert("Failed to update status.");
                }
            },
            error: function() {
                alert("An error occurred while updating status.");
            }
        });
    });
});
</script>
