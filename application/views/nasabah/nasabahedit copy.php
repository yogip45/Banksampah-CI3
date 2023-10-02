  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Nasabah</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Nasabah</a></li>
              <li class="breadcrumb-item active">Form Nasabah</li>
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
              
              <?php foreach ($nasabah as $data) : ?>
                <form role="form" action="<?php echo base_url('index.php/petugas/update_nasabah'); ?>" method="POST">
                    <input type="hidden" value="<?= $data->id_user ?>" name="id_user">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $data->nama ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="text" class="form-control" id="inputEmail" name="email" value="<?= $data->email ?>" readonly>
                            <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group col-md-8">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="laki" name="jk" value="Laki-laki" <?= ($data->jk == 'Laki-laki') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="perempuan" name="jk" value="Perempuan" <?= ($data->jk == 'Perempuan') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputKecamatan">Kecamatan</label>
                            <select class="form-control" id="inputKecamatan" name="id_kecamatan">
                                <!-- Opsi kecamatan akan ditambahkan di sini -->
                                <option value="">Pilih Kecamatan</option>
                                <?php foreach ($kecamatan as $datakecamatan) : ?>
                                    <?php
                                    $selected = ($datakecamatan->id_kecamatan == $data->id_kecamatan) ? 'selected' : '';
                                    ?>
                                    <option value="<?= $datakecamatan->id_kecamatan; ?>" <?= $selected; ?>><?= $datakecamatan->nama_kecamatan; ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('id_kecamatan', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputDesa" id="labelDesa">Asal Desa</label>
                            <select class="form-control" id="inputDesa" name="id_desa">
                                <!-- Opsi desa akan ditambahkan di sini -->
                                <?php
                                $selectedDesa = ($data->id_desa == $nasabah->id_desa) ? 'selected' : '';
                                ?>
                                <option value="<?=$data->id_desa;?>" <?= $selectedDesa; ?>><?= $data->nama_desa; ?></option>
                            </select>
                            <?= form_error('id_desa', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputRt">Rt</label>
                            <input type="number" class="form-control" id="inputRt" name="rt" value="<?= $data->rt ?>">
                            <?= form_error('rt', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputRw">Rw</label>
                            <input type="number" class="form-control" id="inputRw" name="rw" value="<?= $data->rw ?>">
                            <?= form_error('rw', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAlamatLengkap">Alamat Lengkap</label>
                            <input type="text" class="form-control" id="inputAlamatLengkap" rows="3" name="alamat_lengkap"
                                value="<?= $data->alamat_lengkap ?>"></input>
                            <?= form_error('alamat_lengkap', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-warning text-white">Reset</button>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
      loaddesa();
    });
    function loaddesa(){
        var getkecamatan = $("#inputKecamatan").val();
        var id_desa = <?= $data->id_desa?>;
          $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "<?= base_url().'index.php/petugas/get_desa' ?>",
            data : {id_kecamatan : getkecamatan,
            id_desa: id_desa},
            success : function(data){
              console.log(data);

              var html = '';
              var i;
              for (i = 0; i < data.length; i ++ ){
                html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>'
              }
              $("#inputDesa").html(html);
            }
          });
    }
  </script>