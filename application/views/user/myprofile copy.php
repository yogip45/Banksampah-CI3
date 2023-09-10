<div class="loader"></div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile Saya</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div class="panel panel-default">                                                                
                                <div class="panel-body">
                                <!-- BODY -->
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row no-gutters">
                                            <div class="image-crop col-md-4">
                                                <img src="<?= base_url() ?>assets/foto/<?= $user['foto'] ?>" alt="Foto Profile">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h3 class="card-title"><?= $user['nama'] ?></h3>
                                                    <h5 class="card-title"><?= $user['email'] ?> | <?= $user['username']?></h5>
                                                    <p class="card-text"><?= $user['alamat'] ?></p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            Bergabung <?= date('d M Y', strtotime($user['dibuat'])) ?>
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
                                    <h5 class="card-title">Ganti Foto Profil</h5>
                                </div>                                
                                <div class="panel-body">
                                <!-- BODY -->
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row no-gutters">                                            
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <?= form_open_multipart('petugas/updatefoto');?>                                                                                                    
                                                        <div class="form-group col-md-4">                                                            
                                                            <input type="file" name="foto" accept=".png, .jpg">
                                                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">Submit</button>                                                
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
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="card-title">Edit Profile</h5>
                                </div>
                                <div class="panel-body">
                                    <!-- BODY -->
                                    <form role="form" action="<?php echo base_url().'petugas/create_action';?>" method="POST">                                                                                                                                                             
                                            <div class="form-group col-md-6">
                                                <label for="inputDesa">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $user['nama']?>">  
                                                <?= form_error('nama','<small class=" text-danger form-text text-muted">', '</small>') ?>                                          
                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                               
                                            <div class="form-group col-md-6">
                                                <label for="inputAlamat">Email</label>
                                                <input type="text" class="form-control" id="inputAlamat" name="alamat" value="<?= $user['email']?>">
                                                <?= form_error('email','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail">Alamat</label>
                                                <input type="text" class="form-control" id="inputEmail" name="email" value="<?= $user['alamat']?>">
                                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                <?= form_error('email','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                        <div class="form-row">
                                            
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Edit</button>                                                
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
                                                    <form role="form" action="<?php echo base_url().'petugas/create_action';?>" method="POST">                                                                                                                                                             
                                                            <div class="form-group col-md-8">
                                                                <label for="inputDesa">Password Lama</label>
                                                                <input type="text" class="form-control" id="inputNama" name="passwordold">  
                                                                <?= form_error('nama','<small class=" text-danger form-text text-muted">', '</small>') ?>                                          
                                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                               
                                                            <div class="form-group col-md-8">
                                                                <label for="inputAlamat">Password Baru</label>
                                                                <input type="text" class="form-control" id="inputAlamat" name="passwordnew">
                                                                <?= form_error('email','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                            <div class="form-group col-md-8">
                                                                <label for="inputEmail">Konfirmasi Password Baru</label>
                                                                <input type="text" class="form-control" id="inputEmail" name="passwordnew1">
                                                                <?= form_error('email','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">Edit</button>                                                
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
    const toggleForm = document.getElementById('toggleForm');
    const editForm = document.getElementById('editForm');
    const formInputs = editForm.querySelectorAll('input, textarea');
    
    toggleForm.addEventListener('change', function () {
        formInputs.forEach(input => {
            input.disabled = !toggleForm.checked;
        });
    });
</script>

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
