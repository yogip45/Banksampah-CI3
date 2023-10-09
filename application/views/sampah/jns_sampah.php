<!-- Content Wrapper. Contains page content -->
<div class="loader"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Sampah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Sampah</li>
                        <li class="breadcrumb-item active">Master Sampah</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
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
                    <?php if ($this->session->flashdata('gagal')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('gagal'); ?></div>
                    <?php endif; ?>
                    <!-- ALERT -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambahSampah">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                    <br>
                    <br>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No.</th>
                                            <th style="width: 30%;">Jenis Sampah</th>
                                            <th style="width: 15%;">Kategori</th>
                                            <th style="width: 10%;">Harga</th>
                                            <th style="width: 10%;">Stok</th>
                                            <th style="width: 15%;">Tanggal Update</th>
                                            <th style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($jns_sampah as $sampah) : ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $sampah->nama_sampah ?></td>
                                                <td><?php echo $sampah->kategori ?></td>
                                                <td><?php echo $sampah->harga ?> /kg</td>
                                                <td><?php echo $sampah->jumlah ?> Kg</td>
                                                <td><?php echo date('d M Y', strtotime($sampah->diubah)) ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning" data-toggle="dropdown">Pilih Aksi</button>
                                                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal<?php echo $sampah->id_sampah; ?>">Edit</a>
                                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#hapusModal<?php echo $sampah->id_sampah; ?>">Hapus Data</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal untuk konfirmasi hapus -->
                                            <div class="modal fade" id_sampah="hapusModal<?php echo $sampah->id_sampah; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?php echo $sampah->id_sampah; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id_sampah="hapusModalLabel<?php echo $sampah->id_sampah; ?>">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <?php echo anchor('index.php/jenissampah/hapus/'.$sampah->id_sampah, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal untuk HAPUS -->
                                            <!-- Modal untuk EDIT SAMPAH -->
                                            <div class="modal fade" id="editModal<?php echo $sampah->id_sampah; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $sampah->id_sampah; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel<?php echo $sampah->id_sampah; ?>">Edit Data Sampah</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form untuk mengedit data sampah -->
                                                            <form action="<?php echo base_url().'index.php/jenissampah/update/'.$sampah->id_sampah;?>" method="post">
                                                                <div class="form-group">
                                                                    <label for="jenisSampahEdit">Jenis Sampah</label>
                                                                    <input type="text" class="form-control" id="jenisSampahEdit" name="nama_sampah" value="<?php echo $sampah->nama_sampah; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="hargaEdit">Harga / kg</label>
                                                                    <input type="number" class="form-control" id="hargaEdit" name="harga" value="<?php echo $sampah->harga; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kategoriSampahEdit">Kategori Sampah</label>
                                                                    <select class="form-control" id="kategoriSampahEdit" name="kategori">
                                                                        <option value="Plastik" <?php if ($sampah->kategori == 'Plastik') echo 'selected'; ?>>Plastik</option>
                                                                        <option value="Kertas" <?php if ($sampah->kategori == 'Kertas') echo 'selected'; ?>>Kertas</option>
                                                                        <option value="Logam" <?php if ($sampah->kategori == 'Logam') echo 'selected'; ?>>Logam</option>
                                                                        <option value="Kaca" <?php if ($sampah->kategori == 'Kaca') echo 'selected'; ?>>Kaca</option>
                                                                        <option value="Lain-lain" <?php if ($sampah->kategori == 'Lain-lain') echo 'selected'; ?>>Lain - Lain</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal untuk EDIT SAMPAH -->
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- KONFIRMASI HAPUS -->
                            <?php
                            $no = 1;
                            foreach ($jns_sampah as $data) : ?>
                                <div class="modal fade" id="hapusModal<?php echo $data->id_sampah; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <?php echo anchor('/index.php/jenissampah/hapus/'.$data->id_sampah, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- KONFIRMASI HAPUS -->

                            <!-- MODAL INPUT -->
                            <div class="modal fade" id="tambahSampah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Sampah</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form untuk menambahkan jenis sampah -->
                                            <form action="<?php echo base_url().'index.php/jenissampah/tambah_aksi';?>" method="post">
                                                <div class="form-group">
                                                    <label for="jenisSampah">Jenis Sampah</label>
                                                    <input type="text" class="form-control" id="jenisSampah" name="nama_sampah" required placeholder="botol, kardus bekas">
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga / kg</label>
                                                    <input type="number" class="form-control" id="harga" name="harga" required placeholder="Rp.">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategoriSampah">Kategori Sampah</label>
                                                    <select class="form-control" id="kategoriSampah" name="kategori">
                                                        <option value="Plastik">Plastik</option>
                                                        <option value="Kertas">Kertas</option>
                                                        <option value="Logam">Logam</option>
                                                        <option value="Kaca">Kaca</option>
                                                        <option value="Lain-lain">Lain - Lain</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL INPUT -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

