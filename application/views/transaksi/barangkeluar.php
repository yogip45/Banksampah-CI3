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
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
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
            <?php if ($this->session->flashdata('sukses')): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('hapus')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('hapus'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('edit')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('edit'); ?></div>
            <?php endif; ?>
            <!-- ALERT -->        
            <!-- TAMBAH -->
            <div class="col-md-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Pendapatan</h3>
                </div>
                  <div class="card-body">
                      <div class="tab-content">
                      <div class="active tab-pane" id="settings">
                      <div class="col-md-8">
                          <form role="form" action="<?= base_url() ?>index.php/stok/create_barangkeluar" method="POST">
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputTanggalKeluar">Tanggal Keluar</label>
                                <div class="input-group date" id="inputTanggalKeluar" data-target-input="nearest">
                                  <input placeholder="dd/mm/yyyy" name="tgl_keluar" type="text" class="form-control datetimepicker-input" data-target="#inputTanggalKeluar"/>
                                  <div class="input-group-append" data-target="#inputTanggalKeluar" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                                </div>
                                <?= form_error('tgl_keluar','<small class="text-danger">', '</small>') ?>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="inputSampah">Pilih Sampah</label>
                                <select class="form-control" id="inputSampah" name="id_sampah">
                                        <option data-harga="0" value="">Pilih Sampah</option>
                                        <?php foreach ($jns_sampah as $sampah) : ?>
                                          <option data-harga="<?= $sampah->harga ?>" value="<?= $sampah->id_sampah ?>"><?= $sampah->nama_sampah ?></option>
                                        <?php endforeach ?>
                                </select>
                                <?= form_error('id_sampah','<small class="text-danger">', '</small>') ?>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="berat">Jumlah (kg)</label>
                                <input type="number" class="form-control" id="inputJumlah" name="jumlah" step="0.01" min="0">
                                <?= form_error('jumlah','<small class="text-danger">', '</small>') ?>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="berat">Total Penjualan (Rp)</label>
                                <input type="number" class="form-control" id="inputJumlah" name="total" placeholder="" step="0.01" min="0">
                                <?= form_error('total','<small class="text-danger">', '</small>') ?>
                              </div>
                            </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="reset" class="btn btn-warning">Reset</button>
                          </form>
                      </div>
                      </div>
                      </div>
                  </div>
              </div>
              <!-- Konten di sebelah kanan -->
            </div>
            <!-- TAMBAH -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">                
                <table class="table table-striped table-bordered table-hover" id="dataNasabah">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id</th>
                            <th>Jenis Sampah</th>
                            <th>Tanggal Setor</th>
                            <th>Jumlah</th>
                            <th>Total</th>                                                    
                        </tr>
                    </thead>
                    <tbody>                                                
                    <?php
                        $no = 1;
                        foreach ($barangkeluar as $data) : ?>
                    <tr class="odd gradeX">
                            <td><?php echo $no++?></td>
                            <td><?php echo $data->id ?></td>
                            <td><?php echo $data->nama_sampah ?></td>
                            <td><?php echo date('d M Y', strtotime($data->tgl_keluar)) ?></td>
                            <td><?php echo $data->jumlah ?></td>
                            <td><?php echo $data->total ?></td>                                                    
                            <!-- <td>                                                    
                                <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#detailModal<?php echo $data->nin; ?>">
                                <i class="fa fa-bars fa-fw"></i>
                                </button>
                            </td>                                                     -->
                            <?php endforeach; ?>
                        </div>                                                                                                            
                            <!-- <td>
                            <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                            </td> -->
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
  $(function () {
      $('#inputTanggalKeluar').datetimepicker({
          locale: 'id',
          format: 'DD/MM/YYYY'
      });
  });
</script>

<script>
    $(document).ready(function(){
      loadmax();
    });

    function loadmax(){
      $("#inputSampah").change(function(){
        var getId = $("#inputSampah").val();
          $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "<?= base_url().'index.php/stok/max_barangkeluar' ?>",
            data : {id_sampah : getId},
            success : function(data){
              var placeholderText ="Maksimal " + data[0].jumlah + " Kg";
              $("#inputJumlah").attr("placeholder", placeholderText);
            }
          });
      });
    }
  </script>