<!-- Content Wrapper. Contains page content -->
<div class="loader"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Transaksi Nasabah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Nasabah</li>
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
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- CONTENT UTAMA -->
                            <?php echo form_open('index.php/setoran/search') ?>
                            <div class="form-group col-md-4">
                                <label for="inputDesa">Pilih Nasabah</label>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tampilNasabah"
                                    type="button"><i class="fa fa-folder-open fa-fw"></i> Pilih</button>
                                <br><br>
                                <input type="text" class="form-control" id="inputKeyword" name="keyword" readonly
                                    value="<?= $this->session->flashdata('keyword'); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputDesa">Nama Nasabah</label>
                                <input type="text" class="form-control" id="inputNama" name="nama" readonly
                                    value="<?= $this->session->flashdata('nama'); ?>">
                            </div>
                            <div class="form-row col-md-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Lihat Data</button>
                                    <a href="/banksampah/index.php/setoran/pernasabah" type="reset"
                                        class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                            </div>
                            <br>
                            <?php echo form_close() ?>
                            <!-- MODAL PILIH NASABAH -->
                            <div class="modal fade" id="tampilNasabah" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pilih Nasabah</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
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
                                                            <td
                                                                style="text-align: center; vertical-align: middle;"><?php echo $no++ ?></td>
                                                            <td
                                                                style="text-align: center; vertical-align: middle;"><?php echo $data->nin ?></td>
                                                            <td
                                                                style="text-align: center; vertical-align: middle;"><?php echo $data->nama ?></td>
                                                            <td
                                                                style="text-align: center; vertical-align: middle;">
                                                                <button type="button" class="btn btn-success"
                                                                    data-dismiss="modal"
                                                                    onclick="pilih_nasabah('<?php echo $data->nin ?>', '<?php echo $data->nama ?>')">Pilih</button>
                                                            </td>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-Primary"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TABEL -->
                            <table class="table table-striped table-bordered table-hover" id="dataTransaksi">
                                    <thead>
                                        <tr>
                                            <th>No.</th>                                                    
                                            <th>Tanggal Setor</th>                                                    
                                            <th>Jenis Sampah</th>
                                            <th>Berat</th>                                                    
                                            <th>Harga</th>                                                    
                                            <th>Total</th>                                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($transaksi as $data) : ?>
                                        <tr class="odd gradeX">
                                                <td><?php echo $no++?></td>
                                                <td><?php echo date('d M Y', strtotime($data->tanggal_setor)) ?></td>
                                                <td><?php echo $data->jenis_sampah ?></td>
                                                <td><?php echo $data->berat ?></td>                                                    
                                                <td><?php echo $data->harga ?></td>                                                    
                                                <td><?php echo $data->total ?></td>                                                    
                                                <?php endforeach; ?>
                                            </div>                                                                                                            
                                            <!-- <td>
                                            <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                                            </td> -->
                                        </tr>                                                                                                                                                                                                                  
                                    </tbody>                                          
                                    
                            </table>
                            <!-- TABEL -->
                            <!-- CONTENT UTAMA -->
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

<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
            function pilih_nasabah(nin,nama){
                inputKeyword.value = nin;
                inputNama.value = nama;
                
            }
</script>

<script>
    $(document).ready(function () {
  $("#dataTransaksi").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
      sEmptyTable: "Tidak ada data yang tersedia",
    },
    responsive: true,
  });
});
</script>