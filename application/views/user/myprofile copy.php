<div class="loader"></div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile Saya</h1>
                <div class="row">
                    <div class="col-lg-12">
                            <!-- ALERT TINDAKAN -->
                            <div class="col-md-12">
                            <?php if ($this->session->flashdata('sukses')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>
                            </div>
                            <!-- ALERT TINDAKAN -->
                        <div class="col-md-12">
                            <div class="panel panel-default">                                                                
                                <div class="panel-body">
                                <!-- BODY -->
                                    <div class="card mb-3" style="max-width: 640px;">
                                        <div class="row no-gutters">
                                            <div class="image-crop col-md-4">
                                                <img src="<?= base_url() ?>assets/foto/<?= $user['foto'] ?>" alt="Foto Profile">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h3 class="card-title"><?= $user['nama_petugas'] ?></h3>
                                                    <h5 class="card-title">
                                                        <?= $user['email'] ?> |
                                                        <?= $user['username'] ?> | 
                                                        <span style="<?= $user['role'] == 3 ? 'color: red;' : ($user['role'] == 2 ? 'color: green;' : '') ?>">
                                                            <?= $user['role'] == 3 ? 'Admin' : ($user['role'] == 2 ? 'Petugas' : '') ?>
                                                        </span>
                                                    </h5>
                                                    <p class="card-text"><?= $user['no_hp'] ?></p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            Bergabung <?= date('d M Y', strtotime($user['dibuat'])) ?>                                                             
                                                        </small>
                                                    </p>                                                    
                                                    <p class="card-text">
                                                        <small class="text-muted">                                                            
                                                            Terakhir Login <?= date('d M Y H:i', strtotime($user['last_login'])) ?>
                                                        </small>
                                                    </p>                                                    
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="card-title">Edit Profile</h5>
                                </div>
                                <div class="panel-body">
                                    <!-- BODY -->
                                    <form role="form" action="<?php echo base_url().'index.php/user/update_profile';?>" method="POST">                                                                                                                                                             
                                            <div class="form-group col-md-6">
                                                <label for="inputDesa">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $user['nama_petugas']?>">  
                                                <?= form_error('nama','<small class=" text-danger form-text text-muted">', '</small>') ?>                                          
                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                               
                                            <div class="form-group col-md-6">
                                                <label for="inputAlamat">Email</label>
                                                <input type="text" class="form-control" id="inputAlamat" name="email" value="<?= $user['email']?>" disabled>
                                                <?= form_error('email','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                            <div class="form-group col-md-6">
                                                <label for="inputAlamat">No HP</label>
                                                <input type="text" class="form-control" id="inputEmail" name="no_hp" value="<?= $user['no_hp']?>">
                                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                <?= form_error('no_hp','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                        <div class="form-row">
                                            
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Simpan</button>                                                
                                            </div>
                                        </div>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="card-title">Ganti Foto Profil</h5>
                                </div>                                
                                <div class="panel-body">
                                <!-- BODY -->
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row no-gutters">                                  
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <?= form_open_multipart('index.php/user/updatefoto');?>                                                                                                    
                                                        <div class="form-group col-md-4">                                                            
                                                            <input type="file" name="foto" accept=".png, .jpg">
                                                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>                                                
                                                            </div>
                                                        </div>                                                    
                                                    <?= form_close();?>
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h5 class="card-title">Update Password</h5>
                                </div>                                
                                <div class="panel-body">
                                <!-- BODY -->
                                    <div class="card mb-3" style="max-width: 640px;">
                                        <div class="row no-gutters">                                            
                                            <div class="col-md-12">
                                                <div class="card-body">                                                    
                                                    <form role="form" action="<?php echo base_url().'index.php/user/update_password';?>" method="POST">                                                                                                                                                             
                                                            <div class="form-group col-md-8">
                                                                <label for="inputDesa">Password Lama</label>
                                                                <input type="password" class="form-control" id="inputPasswordOld" name="passwordold">  
                                                                <?= form_error('passwordold','<small class=" text-danger form-text text-muted">', '</small>') ?>                                          
                                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                               
                                                            <div class="form-group col-md-8">
                                                                <label for="inputAlamat">Password Baru</label>
                                                                <input type="password" class="form-control" id="inputPasswordNew" name="password1">
                                                                <?= form_error('password1','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                            <div class="form-group col-md-8">
                                                                <label for="inputEmail">Konfirmasi Password Baru</label>
                                                                <input type="password" class="form-control" id="inputPasswordNew1" name="password2">
                                                                <?= form_error('password2','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                <button type="submit" class="btn btn-danger">Simpan</button>                                                
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
</div>

<!-- Include JavaScript files -->
<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/metisMenu.min.js"></script>
<script src="<?php echo base_url()?>assets/js/startmin.js"></script>
<script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<script>
    const loader = document.querySelector(".loader");
    window.addEventListener("load", () => {
        loader.classList.add("loader--hidden");
        loader.addEventListener("transitioned", () => {
            document.body.removeChild(document.querySelector(".loader"));
        });
    });
</script>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<script>
    $(document).ready(function () {
        $('#dataNasabah').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
                "sEmptyTable": "Tidak ada data yang tersedia"
            },
            "responsive": true
        });
    });
</script>
</body>
</html>
