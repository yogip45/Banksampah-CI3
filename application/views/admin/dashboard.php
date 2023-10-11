<!-- Content Wrapper. Contains page content -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script> 
<div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $jumlah['nasabah']; ?></h3>

                <p>Nasabah</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $jumlah['sampah']; ?><sub style="font-size: 20px"> Kg</sub></h3>

                <p>Sampah Terkumpul</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-trash"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="text-white"><?= $jumlah['petugas']; ?></h3>

                <p class="text-white">Petugas</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $jumlah['transaksi']; ?></h3>

                <p>Transaksi</p>
              </div>
              <div class="icon">
                <i class="ion ion-document-text"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Transaksi (Rp. )
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Bar</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                    <li class="nav-item">
                    <select class="form-control nav-link" id="tahunDropdown">
                          <?php foreach ($tahun as $tahun) { ?>
                              <option value="<?php echo $tahun->tahun; ?>"><?php echo $tahun->tahun; ?></option>
                          <?php } ?>
                    </select>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Area (tab pertama) -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 100%;">
                      <canvas id="myBar"></canvas>
                  </div>
                  <!-- Morris chart - Donut (tab kedua) -->
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <p>ini Donut</p>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url()?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>adminlte/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()?>adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url()?>adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url()?>adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url()?>adminlte/dist/js/pages/dashboard.js"></script> -->
<script>
  const loader = document.querySelector(".loader");
  window.addEventListener("load",() => {
      loader.classList.add("loader--hidden");
      loader.addEventListener("transitioned", ()=>{
          document.body.removeChild(document.querySelector(".loader"));
      });
  })
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myBar');
  <?php
  $bulan = array();
  $jumlah_setoran = array();
  foreach ($jml_setoran as $data) {
      $bulan[] = date("F", mktime(0, 0, 0, $data->bulan, 1));
      $jumlah_setoran[] = $data->jumlah_setoran;
  }
  foreach ($jml_penarikan as $data1) {
      $jumlah_penarikan[] = $data1->jumlah_penarikan;
  }
  foreach ($jml_barangkeluar as $data2) {
      $jumlah_barangkeluar[] = $data2->jumlah_barangkeluar;
  }
  ?>
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($bulan); ?>,
      datasets: [
        {
          label: 'Setoran Sampah',
          data: <?php echo json_encode($jumlah_setoran); ?>,
          borderWidth: 1
        },
        {
          label: 'Penarikan Saldo',
          data: <?php echo json_encode($jumlah_penarikan); ?>,
          borderWidth: 1
        },
        {
          label: 'Sampah Keluar',
          data: <?php echo json_encode($jumlah_barangkeluar); ?>,
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>
