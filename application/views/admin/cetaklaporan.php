<div class="loader"></div>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Transaksi</li>
                        <li class="breadcrumb-item active">Barang Keluar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

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
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="settings">
                                        <div class="col-md-8">
                                            <form role="form"
                                                action="<?= base_url() ?>index.php/cetaklaporan/create_laporan"
                                                method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputJenisTransaksi">Pilih Transaksi</label>
                                                        <select class="form-control" id="inputJenisTransaksi"
                                                            name="jns_transaksi">
                                                            <option value="">Pilih Jenis Transaksi</option>
                                                            <option value="1">Setoran</option>
                                                            <option value="2">Penarikan Saldo</option>
                                                            <option value="3">Barang Keluar</option>
                                                        </select>
                                                        <?= form_error('jns_transaksi','<small class="text-danger">', '</small>') ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputTanggalAwal">Tanggal Awal</label>
                                                        <div class="input-group date" id="inputTanggalAwal"
                                                            data-target-input="nearest">
                                                            <input placeholder="yyyy/mm/dd"
                                                                value="<?=set_value('tgl_awal')?>" type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#inputTanggalAwal" name="tgl_awal" />
                                                            <div class="input-group-append"
                                                                data-target="#inputTanggalAwal"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                        <?= form_error('tgl_awal','<small class="text-danger">', '</small>') ?>
                                                    </div>
                                                    <div style="display: flex; align-items: center;">
                                                        <i class="fas fa-minus"></i>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputTanggalAkhir">Tanggal Akhir</label>
                                                        <div class="input-group date" id="inputTanggalAkhir"
                                                            data-target-input="nearest">
                                                            <input placeholder="yyyy/mm/dd"
                                                                value="<?=set_value('tgl_akhir')?>" type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#inputTanggalAkhir" name="tgl_akhir" />
                                                            <div class="input-group-append"
                                                                data-target="#inputTanggalAkhir"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                        <?= form_error('tgl_akhir','<small class="text-danger">', '</small>') ?>
                                                    </div>
                                                </div>
                                                <button type="submit" id="submitBtn"
                                                    class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(function() {
    $('#inputTanggalAwal').datetimepicker({
        locale: 'id',
        format: 'YYYY-MM-DD'
    });
    $('#inputTanggalAkhir').datetimepicker({
        locale: 'id',
        format: 'YYYY-MM-DD'
    });
});
</script>