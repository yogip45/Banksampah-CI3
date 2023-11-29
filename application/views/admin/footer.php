<!-- jQuery -->
<script src="<?php echo base_url() ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>adminlte/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url() ?>adminlte/dist/js/pages/dashboard.js"></script> -->
<script>
    const loader = document.querySelector(".loader");
    window.addEventListener("load", () => {
        loader.classList.add("loader--hidden");
        loader.addEventListener("transitioned", () => {
            document.body.removeChild(document.querySelector(".loader"));
        });
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxBar = document.getElementById('myBar');
    <?php
    $bulan = array();
    $jumlah_setoran = array();
    $nama = [];
    $stok = [];

    foreach ($jns_sampah as $data_sampah) {
        $nama[] = $data_sampah->nama_sampah;
        $stok[] = $data_sampah->jumlah;
    }
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
            {
                label: 'Sampah Keluar',
                data: <?php echo json_encode($jumlah_barangkeluar); ?>,
                borderWidth: 1
            }
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

    // SAMPAH CHART
    const ctxLine = document.getElementById('myLine');
    const dataLine = {
        labels: <?php echo json_encode($nama); ?>, // Anda perlu menentukan label yang sesuai
        datasets: [{
            label: 'Jumlah (kg)',
            data: <?php echo json_encode($stok); ?>, // Gantilah dengan data yang sesuai
        }, ]
    };

    const configLine = {
        type: 'pie',
        data: dataLine,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Data Sampah'
                }
            }
        }
    };

    const chartLine = new Chart(ctxLine, configLine);
</script>
</body>

</html>