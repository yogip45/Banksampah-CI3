  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Setoran Saya</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'index.php/setoran/setoranindex';?>">Setor</a></li>
              <li class="breadcrumb-item active">Data Setoran</li>
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
              <div class="card-body col-md-12">
                <div class="row">
                  </div>
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered" id="dataNasabah">
                        <thead>
                        <tr>
                          <th>Id Setor</th>
                          <th>Tanggal Setor</th>
                          <th>Total Rp.</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($setoran as $data) : ?>
                          <tr class="odd gradeX">
                            <td><?php echo $data->id_setor ?></td>
                            <td><?php echo date('d M Y', strtotime($data->tanggal_setor)) ?></td>
                            <td class="text-success"><?php echo $data->total ?></td>
                            <td class="text-center">
                                <?php
                                $url = '/index.php/nasabah/detail_setoran';
                                echo form_open($url);
                                echo form_hidden('id_setor', $data->id_setor);
                                echo '<button type="submit" class="btn btn-info"><i class="fas fa-bars"></i></button>';
                                echo form_close();
                                ?>
                            </td>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/trans-js.js"></script>
