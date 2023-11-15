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
                <tr>
                    <th class="no">No</th>
                    <th>Tanggal</th>
                    <th>Id Setor</th>
                    <th>NIN</th>
                    <th>Nama Nasabah</th>
                    <th>Total Setoran</th>
                    <!-- Kolom-kolom detail setoran -->
                    <th>Jenis Sampah</th>
                    <th>Berat (Kg)</th>
                    <th>Harga (/Kg)</th>
                    <th>Total Harga Sampah</th>
                </tr>
                <?php
                $no = 1;
                foreach ($setoran as $data) : ?>
                <tr>
                    <td class="no" style="font-weight: bold;"><?= $no++ ?></td>
                    <td style="font-weight: bold;"><?= date('d F Y', strtotime($data->tanggal_setor)) ?></td>
                    <td style="font-weight: bold;"><?= $data->id_setor ?></td>
                    <td style="font-weight: bold;"><?= $data->nin ?></td>
                    <td style="font-weight: bold;"><?= $data->nama ?></td>
                    <td style="font-weight: bold;">Rp. <?= $data->total ?></td>
                    <td colspan="4" style="text-align: center; font-weight: bold;">Detail Sampah</td>
                    <?php
                        // Cek apakah ada detail untuk ID setoran ini
                        $detailForSetoran = array_filter($detail, function ($detailData) use ($data) {
                            return $detailData->id_setor == $data->id_setor;
                        });

                        if (!empty($detailForSetoran)) :
                            foreach ($detailForSetoran as $detailData) : ?>
                <tr>
                    <td colspan="6"></td> <!-- Kolom kosong untuk menyesuaikan kolom di atas -->
                    <td><?= $detailData->nama_sampah ?></td>
                    <td><?= $detailData->berat ?> Kg</td>
                    <td>Rp. <?= $detailData->harga ?></td>
                    <td>Rp. <?= $detailData->total ?></td>
                </tr>
                <?php endforeach;
                        endif;
            ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>