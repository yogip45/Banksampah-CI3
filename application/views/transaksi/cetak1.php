<!DOCTYPE html>
<html>

<head>
    <title>Laporan Setoran</title>
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
        <?php if ($setoran != NULL) : ?>
            <h1 style="text-align: center;">Laporan Setoran Sampah</h1>
        <?php endif ?>
        <p style="text-align: center;">Tanggal: <?= date('d F Y', strtotime($tglAwal)) ?> -
            <?= date('d F Y', strtotime($tglAkhir)) ?></p>

        <table style="margin: 0 auto; text-align: center; width: 100%;">
            <tbody>
                <?php if ($setoran != NULL) : ?>
                    <tr>
                        <th class="no">No</th>
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
                            <td class="no"><?= $no++ ?></td>
                            <td><?= date('d F Y', strtotime($data->tanggal_setor)) ?></td>
                            <td><?= $data->id_setor ?></td>
                            <td><?= $data->nin ?></td>
                            <td><?= $data->nama ?></td>
                            <td><?= $data->total ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif ?>

            </tbody>
        </table>
        <?php if ($detail != NULL) : ?>
            <h1 style="text-align: center;">Detail Setoran Sampah</h1>
            <table style="margin: 0 auto; text-align: center; width: 80%;">
                <tbody>
                    <tr>
                        <th style="width: 12%;">No</th>
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
                            <td style="width: 12%;"><?= $no++ ?></td>
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