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
  const data = {
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
  };
  const options = {
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
  const chart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
  });
</script>

</body>
</html>