<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Keluar</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        /* Lebarkan tabel dan sel-selnya */
        table {
            width: 100%;
        }

        th,
        td {
            width: 20%;
            /* Sesuaikan lebar sel sesuai kebutuhan */
        }

        /* Sel No lebih kecil */
        th.no,
        td.no {
            width: 5%;
            /* Sesuaikan lebar sel No sesuai kebutuhan */
        }
    </style>

</head>

<body>
    <div style="text-align: center;">
        <?php if ($barangkeluar != NULL) : ?>
            <h1 style="text-align: center;">Laporan Barang Keluar</h1>
        <?php endif ?>
        <p style="text-align: center;">Tanggal: <?= date('d F Y', strtotime($tglAwal)) ?> -
            <?= date('d F Y', strtotime($tglAkhir)) ?></p>

        <table style="margin: 0 auto; text-align: center; width: 100%;">
            <tbody>
                <?php if ($barangkeluar != NULL) : ?>
                    <tr>
                        <th class="no">No</th>
                        <th>Tanggal</th>
                        <th>Jenis Sampah</th>
                        <th>Jumlah (Kg)</th>
                        <th>Total Penjualan (Rp)</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($barangkeluar as $data) : ?>
                        <tr>
                            <td class="no"><?= $no++ ?></td>
                            <td><?= date('d F Y', strtotime($data->tgl_keluar)) ?></td>
                            <td><?= $data->nama_sampah ?></td>
                            <td><?= $data->jumlah ?></td>
                            <td><?= $data->total ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>

</html>