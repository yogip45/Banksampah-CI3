  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Nasabah</h1>
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
                <form role="form" action="<?php echo base_url().'index.php/petugas/create_nasabah';?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputNama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="inputNama" name="nama" value="<?= set_value('nama')?>">  
                            <?= form_error('nama','<small class="text-danger">', '</small>') ?>                                          
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail">Email</label>
                            <input type="text" class="form-control" id="inputEmail" name="email" value="<?= set_value('email')?>">
                            <?= form_error('email','<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputPassword1">Password</label>                                                                                                   
                        <input type="password" class="form-control" id="inputPassword1" name="password1">
                        <?= form_error('password1','<small class="text-danger">', '</small>') ?>                                           
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputPassword2">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="inputPassword2" name="password2">                                                
                        <?= form_error('password2','<small class="text-danger">', '</small>') ?>                                           
                      </div>
                    </div>
                    <div class="form-group col-md-8">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="laki" name="jk" value="Laki-laki">
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="perempuan" name="jk" value="Perempuan">
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputKecamatan">Kecamatan</label>
                          <select class="form-control" id="inputKecamatan" name="id_kecamatan">
                              <!-- Opsi kecamatan akan ditambahkan di sini -->
                              <option value="">Pilih Kecamatan</option>
                              <?php foreach ($alamat as $data): ?>
                              <option value="<?=$data->id_kecamatan;?>"><?= $data->nama_kecamatan; ?></option>
                              <?php endforeach ?>
                          </select>
                          <?= form_error('id_kecamatan','<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputDesa" id="labelDesa">Asal Desa</label>
                          <select class="form-control" id="inputDesa" name="id_desa">
                              <!-- Opsi kecamatan akan ditambahkan di sini -->
                              <option value="">Pilih Desa</option>

                          </select>
                          <?= form_error('id_desa','<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAlamatLengkap">Alamat Lengkap</label>
                        <input type="text" class="form-control" id="inputAlamatLengkap" rows="3" name="alamat_lengkap" value="<?= set_value('alamat_lengkap')?>"></input>
                        <?= form_error('alamat_lengkap','<small class="text-danger">', '</small>') ?>
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
  <!-- GET DESA -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script>
    $(document).ready(function(){
      loaddesa();
    });

    function loaddesa(){
      $("#inputKecamatan").change(function(){
        var getkecamatan = $("#inputKecamatan").val();
          $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "<?= base_url().'index.php/petugas/get_desa' ?>",
            data : {id_kecamatan : getkecamatan},
            success : function(data){
              console.log(data);

              var html = '';
              var i;
              for (i = 0; i < data.length; i ++ ){
                html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>'
              }
              $("#inputDesa").html(html);
              $("#labelDesa").show();
              $("#inputDesa").show();
            }
          });
      });
    }
  </script>