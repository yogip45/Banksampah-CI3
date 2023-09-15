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
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
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
                    <?php if ($this->session->flashdata('sukses')): ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('hapus')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('hapus'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('gagal')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('gagal'); ?></div>
                    <?php endif; ?>

                    <?php echo anchor('/index.php/admin/tambah_petugas/', '<button class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>'); ?>
                    <br><br>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="dataNasabah">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>                                                    
                                        <th class="text-center">Username</th>                                                    
                                        <th class="text-center">Nama</th>                                          
                                        <th class="text-center">Aksi</th>                                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($petugas as $data) : ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++?></td>                                                    
                                            <td><?php echo $data->username ?></td>                                                                                                        
                                            <td><?php echo $data->nama_petugas ?></td>                                                                                                        
                                            <td class="text-center">                                                        
                                                <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#detailModal<?php echo $data->id_user; ?>">
                                                    <i class="fa fa-bars fa-fw"></i>
                                                </a>
                                                <a href="<?php echo base_url('index.php/admin/edit_petugas/'.$data->id_user); ?>" class="btn btn-outline-warning">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#hapusModal<?php echo $data->id_user; ?>">
                                                    <i class="fa fa-trash fa-fw"></i>
                                                </a>
                                            </td>                                                    
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
                                    <div class="modal-footer"> 
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#resetPassword<?php echo $data->id_user; ?>">Reset Password</button>
                                        <?php if ($data->is_active == 1): ?>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#ubahStatus<?php echo $data->id_user; ?>">Non Aktifkan Akun</button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#ubahStatus<?php echo $data->id_user; ?>">Aktifkan Akun</button>
                                        <?php endif; ?>                                                           
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- MODAL DETAIL NASABAH -->

                    <!-- KONFIRMASI HAPUS -->
                    <?php
                    $no = 1;
                    foreach ($petugas as $data) : ?>
                        <div class="modal fade" id="hapusModal<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                        <?php echo anchor('/index.php/admin/hapus_petugas/'.$data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                                                
                    <?php endforeach; ?>
                    <!-- KONFIRMASI HAPUS -->

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
                                        <?php echo anchor('/index.php/admin/ubahstatus/'.$data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
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
                                    Apakah Anda yakin ingin mereset password user ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <?php echo anchor('/index.php/admin/resetpassword/'.$data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
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
                                            <div class="col-lg-6">
                                                <h5 class="text-bold" id="isi_password"><?= $reset_password; ?></h5>
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
$(document).ready(function () {
    // Mengecek apakah ada nilai dalam session "reset_pass"
    var resetPassValue = "<?php echo $reset_password; ?>";
    if (resetPassValue != "") {
        // Cek apakah modal sudah pernah ditampilkan
        $("#tampilPassword").modal("show");
    }
});
</script>
