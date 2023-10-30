<div class="loader"></div>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Riwayat Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="<?= base_url() . 'index.php/setoran/setoranindex'; ?>">Setor</a></li>
                        <li class="breadcrumb-item active">Data Setoran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if ($this->session->flashdata('sukses')) : ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('hapus')) : ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('gagal'); ?></div>
                    <?php endif; ?>
                    <div class="card col-md-12">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">Riwayat Setor dan Penarikan Saldo</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1"
                                        data-toggle="tab">Setoran</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Penarikan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="dataSetoran">
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
                                                    <td><?php echo date('d M Y', strtotime($data->tanggal_setor)) ?>
                                                    </td>
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

                                <div class="tab-pane" id="tab_2">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered w-100" id="dataPenarikan">
                                            <thead>
                                                <tr>
                                                    <th>Id Penarikan</th>
                                                    <th>Tanggal Penarikan</th>
                                                    <th>Jumlah Penarikan</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($penarikan as $data) : ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $data->id_penarikan ?></td>
                                                    <td><?php echo date('d M Y', strtotime($data->tgl_penarikan)) ?>
                                                    </td>
                                                    <td class="text-success"><?php echo $data->jumlah_penarikan ?></td>
                                                    <td
                                                        class="text-center <?php echo $data->status == 1 ? 'text-success' : 'text-warning'; ?>">
                                                        <?php echo $data->status == 1 ? 'Selesai' : 'Belum Dikonfirmasi'; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($data->status == 0) : ?>
                                                        <button data-toggle="modal"
                                                            data-target="#konfirmasiModal<?php echo $data->id_penarikan; ?>"
                                                            type="submit" class="btn btn-success"><i
                                                                class="fas fa-check"></i></button>
                                                        <?php else : ?>
                                                        -
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- KONFIRMASI SELESAI -->
                                <?php
                                $no = 1;
                                foreach ($penarikan as $data) : ?>
                                <div class="modal fade" id="konfirmasiModal<?php echo $data->id_penarikan; ?>"
                                    tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Selesaikan Proses
                                                    Penarikan?</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Pastikan anda sudah menerima uang dari proses penarikan ini
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <?php echo anchor('/index.php/nasabah/konfirmasi/' . $data->id_penarikan, '<button type="button" class="btn btn-primary">OK</button>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <!-- KONFIRMASI SELESAI -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
// SETORAN
$(document).ready(function() {
    $("#dataSetoran").DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            sEmptyTable: "Tidak ada data yang tersedia",
        },
        responsive: true,
    });
    $("#dataPenarikan").DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            sEmptyTable: "Tidak ada data yang tersedia",
        },
        responsive: true,
    });
});
</script>