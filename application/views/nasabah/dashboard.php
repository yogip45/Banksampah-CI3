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
                        <li class="breadcrumb-item active">Dashboard Admin</li>
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
                            <h3><sup style="font-size: 20px"> Rp.</sup> <?= $nasabah['saldo']; ?></h3>

                            <p>Saldo Saya</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">

                            <h3><?= $jumlah_setoran; ?><sub style="font-size: 20px"> Kg</sub></h3>

                            <p>Sampah Disetorkan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="text-white"><sup style="font-size: 20px">Rp. </sup><?= $total_setoran; ?></h3>

                            <p class="text-white">Riwayat Setoran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 class="text-white"><sup style="font-size: 20px">Rp. </sup><?= $total_penarikan; ?></h3>
                            <p>Riwayat Penarikan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-arrow-down"></i>
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
                                Transaksi Tahun <?= date('Y'); ?>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Area (tab pertama) -->
                                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 100%;">
                                    <canvas id="myBar"></canvas>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxBar = document.getElementById('myBar');
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
    ?>
    const dataBar = {
        labels: <?php echo json_encode($bulan); ?>,
        datasets: [{
                label: 'Setoran Sampah',
                data: <?php echo json_encode($jumlah_setoran); ?>,
                borderWidth: 1
            },
            {
                label: 'Penarikan Saldo',
                data: <?php echo json_encode($jumlah_penarikan); ?>,
                borderWidth: 1
            },
        ]
    };
    const optionsBar = {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value, index, values) {
                        return 'Rp.' + value;
                    }
                }
            }
        }
    };
    const chartBar = new Chart(ctxBar, {
        type: 'bar',
        data: dataBar,
        options: optionsBar
    });
</script>