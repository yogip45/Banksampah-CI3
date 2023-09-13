        <div class="loader"></div>                    
            <!-- /.sidebar -->

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Data Nasabah</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form role="form" action="<?php echo base_url().'index.php/petugas/create_nasabah';?>" method="POST">  
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputNama">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama" value="<?= set_value('nama')?>">  
                                                <?= form_error('nama','<small class=" text-danger form-text text-muted">', '</small>') ?>                                          
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail">Email</label>
                                                <input type="text" class="form-control" id="inputEmail" name="email" value="<?= set_value('email')?>">
                                                <?= form_error('email','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword1">Password</label>                                                                                                   
                                                <input type="password" class="form-control" id="inputPassword1" name="password1">
                                                <?= form_error('password1','<small class="text-danger form-text text-muted">', '</small>') ?>                                           
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword2">Konfirmasi Password</label>
                                                <input type="password" class="form-control" id="inputPassword2" name="password2">                                                
                                                <?= form_error('password2','<small class="text-danger form-text text-muted">', '</small>') ?>                                           
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label>Jenis Kelamin</label>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="laki" name="jk" value="Laki-laki">
                                                <label class="form-check-label" for="laki">Laki-laki</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="perempuan" name="jk" value="Perempuan">
                                                <label class="form-check-label" for="perempuan">Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputDesa">Asal Desa</label>
                                                <input type="text" class="form-control" id="inputDesa" name="desa" value="<?= set_value('desa')?>">
                                                <?= form_error('desa','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputRt">Rt</label>
                                                <input type="number" class="form-control" id="inputRt" name="rt" value="<?= set_value('rt')?>">
                                                <?= form_error('rt','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputRw">Rw</label>
                                                <input type="number" class="form-control" id="inputRw" name="rw" value="<?= set_value('rw')?>">
                                                <?= form_error('rw','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="inputKecamatan">Kecamatan</label>
                                            <input type="text" class="form-control" id="inputKecamatan" name="kecamatan" value="<?= set_value('kecamatan')?>">
                                            <?= form_error('kecamatan','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="inputAlamatLengkap">Alamat Lengkap</label>
                                            <input type="text" class="form-control" id="inputAlamatLengkap" rows="3" name="alamat_lengkap" value="<?= set_value('alamat_lengkap')?>"></input>
                                            <?= form_error('alamat_lengkap','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        <script src="<?= base_url() ?>/assets/js/my-js.js"></script>

        <script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>      
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>  
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
            
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>