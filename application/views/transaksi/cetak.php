<!DOCTYPE html>
<html>

<head>
    <title>Laporan Setoran Sampah</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
</head>
<style>
table,
th,
td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>

<body>
    <div style="text-align: center;">
        <?php if ($setoran != NULL): ?>
        <h1 style="text-align: center;">Laporan Setoran Sampah</h1>
        <?php endif ?>
        <?php if ($penarikan != NULL): ?>
        <h1 style="text-align: center;">Laporan Penarikan Saldo</h1>
        <?php endif ?>
        <?php if ($barangkeluar != NULL): ?>
        <h1 style="text-align: center;">Laporan Barang Keluar</h1>
        <?php endif ?>
        <p style="text-align: center;">Tanggal: <?= date('d F Y', strtotime($tglAwal)) ?> -
            <?= date('d F Y', strtotime($tglAkhir)) ?></p>

        <table style="margin: 0 auto; text-align: center; width: 80%;" class="table table-bordered">
            <tbody>
                <?php if ($setoran != NULL): ?>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Id Setor</th>
                    <th>NIN</th>
                    <th>Nama Nasabah</th>
                    <th>Total Setoran</th>
                </tr>
                <?php
                    $no = 1;
                    foreach ($setoran as $data) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d F Y', strtotime($data->tanggal_setor)) ?></td>
                    <td><?= $data->id_setor ?></td>
                    <td><?= $data->nin ?></td>
                    <td><?= $data->nama ?></td>
                    <td><?= $data->total ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif ?>
                <?php if ($penarikan != NULL): ?>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NIN</th>
                    <th>Nama Nasabah</th>
                    <th>Saldo</th>
                    <th>Total</th>
                </tr>
                <?php
                    $no = 1;
                    foreach ($penarikan as $data) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d F Y', strtotime($data->tgl_penarikan)) ?></td>
                    <td><?= $data->nin ?></td>
                    <td><?= $data->nama ?></td>
                    <td><?= $data->saldo ?></td>
                    <td><?= $data->jumlah_penarikan ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif ?>
                <?php if ($barangkeluar != NULL): ?>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Sampah</th>
                    <th>Jumlah (Kg)</th>
                    <th>Total Penjualan (Rp)</th>
                </tr>
                <?php
                    $no = 1;
                    foreach ($barangkeluar as $data) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d F Y', strtotime($data->tgl_keluar)) ?></td>
                    <td><?= $data->nama_sampah ?></td>
                    <td><?= $data->jumlah ?></td>
                    <td><?= $data->total ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif ?>
            </tbody>
        </table>
        <?php if ($detail != NULL): ?>
        <h1 style="text-align: center;">Detail Setoran Sampah</h1>
        <table style="margin: 0 auto; text-align: center; width: 80%;" class="table table-bordered">
            <tbody>
                <tr>
                    <th>No</th>
                    <th>Id Setor</th>
                    <th>Jenis Sampah</th>
                    <th>Berat (Kg)</th>
                    <th>Harga (/Kg)</th>
                    <th>Total Harga</th>
                </tr>
                <?php
                    $no = 1;
                    foreach ($detail as $data) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data->id_setor ?></td>
                    <td><?= $data->nama_sampah ?></td>
                    <td><?= $data->berat ?> Kg</td>
                    <td>Rp. <?= $data->harga ?></td>
                    <td><?= $data->total ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>

</html>