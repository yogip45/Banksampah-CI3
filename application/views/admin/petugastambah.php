        <div class="loader"></div>                    
            <!-- /.sidebar -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Tambah Data Petugas</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">
                                    DataTables Advanced Tables
                                </div> -->
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form role="form" action="<?php echo base_url().'index.php/admin/create_petugas';?>" method="POST">                                                                                                                                                             
                                            <div class="form-group col-md-8">
                                                <label for="inputNama">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama" value="<?= set_value('nama')?>">  
                                                <?= form_error('nama','<small class=" text-danger form-text text-muted">', '</small>') ?>                                          
                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                               
                                            <div class="form-group col-md-8">
                                                <label for="inputEmail">Email</label>
                                                <input type="text" class="form-control" id="inputEmail" name="email" value="<?= set_value('email')?>">
                                                <?= form_error('email','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                           
                                            <div class="form-group col-md-8">
                                                <label for="inputHp">No HP</label>
                                                <input type="number" class="form-control" id="inputHp" name="no_hp" value="<?= set_value('no_hp')?>">
                                                <?= form_error('no_hp','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                           
                                            <div class="form-group col-md-8">
                                                <label for="inputPassword1">Password</label>                                                                                                   
                                                <input type="password" class="form-control" id="inputPassword1" name="password1">
                                                <?= form_error('password1','<small class="text-danger form-text text-muted">', '</small>') ?>                                           
                                            </div>                                                                                                                           
                                            <div class="form-group col-md-8">
                                                <label for="inputPassword2">Konfirmasi Password</label>
                                                <input type="password" class="form-control" id="inputPassword2" name="password2">                                                
                                            </div>                                                                                                                                                                                                                                                                                                                                          
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                                <a href="/banksampah/index.php/admin/petugasindex"  type="reset" class="btn btn-danger">Batal</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.table-responsive -->                                    
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url()?>assets/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url()?>assets/js/startmin.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('inputPassword');
                const eyeIcon = document.getElementById('eyeIcon');

                togglePassword.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    }
                });
            });
        </script>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputRt = document.getElementById("inputRt");
            var inputRw = document.getElementById("inputRw");
            var inputRtrw = document.getElementById("rtrw");

            inputRw.addEventListener("input", function () {
                var rtValue = inputRt.value;
                var rwValue = inputRw.value;
                
                inputRtrw.value = rtValue + "/" + rwValue;
            });
        });
        </script>
        <script>
            const loader = document.querySelector(".loader");
            window.addEventListener("load",() => {
                loader.classList.add("loader--hidden");
                loader.addEventListener("transitioned", ()=>{
                    document.body.removeChild(document.querySelector(".loader"));
                });
            })
        </script>
        <script>
            window.setTimeout(function(){
                $(".alert").fadeTo(500,0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 3000);
        </script>
        <script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>      
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>  
        <script>
            $(document).ready(function () {
                $('#dataNasabah').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
                    "sEmptyTable": "Tidak ada data yang tersedia"
                },
                "responsive": true, // Aktifkan ekstensi Responsive                        
            });
        });
        </script>
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
            
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>