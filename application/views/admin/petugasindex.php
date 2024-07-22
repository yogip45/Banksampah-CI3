<div class="loader"></div>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Petugas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Pengguna</li>
                        <li class="breadcrumb-item active">Petugas</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php echo anchor('/index.php/admin/tambah_petugas/', '<button class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>'); ?>
                    <br><br>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataNasabah">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No.</th>
                                            <th style="width: 15%;">Username</th>
                                            <th style="width: 25%;">Nama</th>
                                            <th style="width: 25%;">Nomor HP</th>
                                            <th style="width: 12%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($petugas as $data) : ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $data->username ?></td>
                                                <td><?php echo $data->nama_petugas ?></td>
                                                <td><?php echo $data->no_hp ?></td>
                                                <td>
                                                    <?php if ($data->role != 3) : ?>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-warning" data-toggle="dropdown">Pilih Aksi</button>
                                                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailModal<?php echo $data->id_user; ?>">Detail
                                                                    Petugas</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="<?= site_url('index.php/admin/edit_petugas/' . $data->id_user) ?>">
                                                                    Edit Petugas</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#resetPassword<?php echo $data->id_user; ?>">
                                                                    Reset Password</a>
                                                                <?php if ($data->is_active == 1) : ?>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ubahStatus<?php echo $data->id_user; ?>">
                                                                        Nonaktifkan</a>
                                                                <?php endif; ?>
                                                                <?php if ($data->is_active == 0) : ?>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ubahStatus<?php echo $data->id_user; ?>">Aktifkan</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-warning" data-toggle="dropdown">Pilih Aksi</button>
                                                                <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailModal<?php echo $data->id_user; ?>">Detail
                                                                        Petugas</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="<?= site_url('index.php/admin/edit_petugas/' . $data->id_user) ?>">
                                                                        Edit Petugas</a>
                                                                </div>
                                                            <?php endif; ?>
                                                            </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL DETAIL DATA USER -->
                    <?php
                    $no = 1;
                    foreach ($petugas as $data) : ?>
                        <div class="modal fade" id="detailModal<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Petugas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>User Id</th>
                                                    <td><?php echo $data->id_user ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama</th>
                                                    <td><?php echo $data->nama_petugas ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Username</th>
                                                    <td><?php echo $data->username ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td><?php echo $data->email ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No HP</th>
                                                    <td><?php echo $data->no_hp ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Akun</th>
                                                    <td>
                                                        <?php
                                                        $roleText = '';
                                                        $roleClass = '';
                                                        if ($data->role == 1) {
                                                            $roleText = 'Nasabah';
                                                            $roleClass = 'text-primary';
                                                        } elseif ($data->role == 2) {
                                                            $roleText = 'Petugas';
                                                            $roleClass = 'text-success';
                                                        } elseif ($data->role == 3) {
                                                            $roleText = 'Super Admin';
                                                            $roleClass = 'text-danger';
                                                        }
                                                        ?>
                                                        <span class="<?php echo $roleClass; ?>"><?php echo $roleText; ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Status Akun</th>
                                                    <td>
                                                        <?php
                                                        $roleText = '';
                                                        $roleClass = '';
                                                        if ($data->is_active == 1) {
                                                            $is_activeText = 'Aktif';
                                                            $is_activeClass = 'text-primary';
                                                        } else {
                                                            $is_activeText = 'Tidak Aktif';
                                                            $is_activeClass = 'text-danger';
                                                        }
                                                        ?>
                                                        <span class="<?php echo $is_activeClass; ?>"><?php echo $is_activeText; ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Last Login</th>
                                                    <td><?= date('d M Y H:i', strtotime($data->last_login)) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- MODAL DETAIL NASABAH -->
                    <!-- UBAH STATUS -->
                    <?php
                    $no = 1;
                    foreach ($petugas as $data) : ?>
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
                                        <?php echo anchor('/index.php/admin/ubahstatus/' . $data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- UBAH STATUS -->

                        <!-- RESET PASSWD -->
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
                                        <?php echo anchor('/index.php/admin/resetpassword/' . $data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- RESET PASSWD -->

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
                                                            <i class="fas fa-clipboard fa-fw"></i> <span id="is_salin">
                                                                salin</span>
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
            </div>
        </div>
    </section>
</div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    <?php if ($this->session->flashdata('sukses')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo $this->session->flashdata("sukses"); ?>',
            showConfirmButton: false,
            timer: 3000 // Tampilkan pesan selama 3 detik
        });
    <?php endif; ?>
    <?php if ($this->session->flashdata('hapus')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo $this->session->flashdata("hapus"); ?>',
            showConfirmButton: false,
            timer: 3000 // Tampilkan pesan selama 3 detik
        });
    <?php endif; ?>
    <?php if ($this->session->flashdata('gagal')) : ?>
        Swal.fire({
            icon: "error",
            title: "Maaf...",
            text: "<?php echo $this->session->flashdata("gagal"); ?>",
            // footer: '<a href="#">Why do I have this issue?</a>'
        });
    <?php endif; ?>
</script>