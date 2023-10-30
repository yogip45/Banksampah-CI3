<!-- Content Wrapper. Contains page content -->
<div class="loader"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Nasabah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Pengguna</li>
                        <li class="breadcrumb-item active">Nasabah</li>
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
                    <?php if ($this->session->flashdata('sukses')) : ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('hapus')) : ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('hapus'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('edit')) : ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('edit'); ?></div>
                    <?php endif; ?>
                    <!-- ALERT -->
                    <?php echo anchor('/index.php/petugas/tambah_nasabah/', '<button class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>'); ?>
                    <br><br>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="dataNasabah">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIN</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($nasabah as $data) : ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data->nin ?></td>
                                            <td><?php echo $data->nama ?></td>
                                            <td class="address-cell"><?php echo $data->alamat_lengkap ?></td>
                                            <td><?php echo $data->email ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning" data-toggle="dropdown">Pilih Aksi</button>
                                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only"> Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailModal<?php echo $data->nin; ?>">
                                                            <i class="fas fa-info-circle"></i> Detail
                                                            Nasabah</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="<?= site_url('index.php/petugas/edit_nasabah/' . $data->id_user) ?>">
                                                            Edit Nasabah</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#resetPassword<?php echo $data->id_user; ?>">
                                                            Reset Password</a>
                                                        <?php if ($data->is_active == 1) : ?>
                                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#ubahStatus<?php echo $data->id_user; ?>">
                                                                Nonaktifkan</a>
                                                        <?php endif; ?>
                                                        <?php if ($data->is_active == 0) : ?>
                                                            <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#ubahStatus<?php echo $data->id_user; ?>">Aktifkan</a>
                                                        <?php endif; ?>
                                                        <?php if ($data->showHapusAkun == true && $this->session->userdata('role') == 3) : ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#hapusAkun<?php echo $data->id_user; ?>">
                                                                <i class="fas fa-exclamation-triangle"></i> Hapus Akun
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- MODAL DETAIL DATA NASABAH -->
                            <?php
                            $no = 1;
                            foreach ($nasabah as $data) : ?>
                                <div class="modal fade print-container" id="detailModal<?php echo $data->nin; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Nasabah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>User Id</th>
                                                        <td><?php echo $data->id_user ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NIN</th>
                                                        <td><?php echo $data->nin ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td><?php echo $data->nama ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <td><?php echo $data->alamat_lengkap ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td><?php echo $data->email ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Saldo</th>
                                                        <td>Rp. <?php echo $data->saldo ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Dibuat</th>
                                                        <td><?php echo date('d M Y H:i', strtotime($data->dibuat)) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Dibuat Oleh</th>
                                                        <td><?php echo $data->dibuat_oleh ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Akun</th>
                                                        <td>
                                                            <?php
                                                            $statusText = ($data->is_active == 1) ? 'Aktif' : 'Tidak Aktif';
                                                            $statusClass = ($data->is_active == 1) ? 'text-primary' : 'text-danger';
                                                            ?>
                                                            <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                                        </td>
                                                    </tr>
                                                    <!-- Tambahkan baris ini sesuai dengan kolom yang lain -->
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- MODAL DETAIL NASABAH -->
                            <!-- NON AKTIFKAN AKUN -->
                            <?php
                            $no = 1;
                            foreach ($nasabah as $data) : ?>
                                <div class="modal fade" id="ubahStatus<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Ubah Status Akun</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin mengubah status akun ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <?php echo anchor('index.php/petugas/ubahstatus_nasabah/' . $data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- NON AKTIFKAN AKUN -->
                                <?php if ($data->showHapusAkun == true && $this->session->userdata('role') == 3) : ?>
                                    <!-- HAPUS AKUN -->
                                    <div class="modal fade" id="hapusAkun<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel">Hapus Akun</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus akun ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <?php echo anchor('index.php/admin/hapus_nasabah/' . $data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- HAPUS AKUN -->
                                <?php endif ?>
                                <!-- RESET PASSWORD NASABAH -->
                                <div class="modal fade" id="resetPassword<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Reset Password Akun</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin mereset password akun ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <?php echo anchor('/index.php/petugas/resetpassword_nasabah/' . $data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- RESET PASSWORD NASABAH -->
                            <?php endforeach; ?>
                            <!-- TAMPIL PASSWORD BARU -->
                            <?php $reset_password = $this->session->flashdata('password'); ?>
                            <?php if ($reset_password != NULL) : ?>
                                <div class="modal fade" id="tampilPassword" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Password Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="copyText" readonly value="<?= $reset_password ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" type="button" id="copyBtn">
                                                                    <i class="fas fa-clipboard fa-fw"></i> <span id="is_salin"> salin</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <!-- TAMPIL PASSWORD BARU -->
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
<script>
    $(document).ready(function() {
        // Mengecek apakah ada nilai dalam session "reset_pass"
        var resetPassValue = "<?php echo $reset_password; ?>";
        if (resetPassValue != "") {
            // Cek apakah modal sudah pernah ditampilkan
            $("#tampilPassword").modal("show");
        }
    });
</script>
<script>
    const copyBtn = document.getElementById('copyBtn')
    const copyText = document.getElementById('copyText')
    const is_copy = document.getElementById('is_salin')

    if (copyBtn != null) {
        copyBtn.onclick = () => {
            copyText.select();
            document.execCommand('copy');
            is_copy.textContent = ' disalin';
            copyBtn.disabled = true;
        }
    }
</script>