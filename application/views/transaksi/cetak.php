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
            </tbody>
        </table>
    </div>
</body>

</html>