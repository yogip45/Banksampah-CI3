        <div class="loader"></div>
                    
            <!-- /.sidebar -->

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Edit Data Petugas</h1>
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
                                <?php foreach ($petugas as $data) : ?>
                                    <form role="form" action="<?php echo base_url().'index.php/admin/update_petugas';?>" method="POST">                                                                                                                                                             
                                            <div class="form-group col-md-8">
                                                <label for="inputDesa">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama_petugas" value="<?= $data->nama_petugas?>">  
                                                <input type="hidden" class="form-control" id="inputNama" name="id_user" value="<?= $data->id_user?>">  
                                                <?= form_error('nama','<small class=" text-danger form-text text-muted">', '</small>') ?>                                          
                                            </div>                                                                                                                                                           
                                            <div class="form-group col-md-8">
                                                <label for="inputKecamatan">Username</label>
                                                <input type="text" class="form-control" id="inputDesa" name="username" value="<?= $data->username?>">
                                                <?= form_error('desa','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                    
                                            <div class="form-group col-md-8">
                                                <label for="inputKecamatan">Email</label>
                                                <input type="text" class="form-control" id="inputKecamatan" name="email" value="<?= $data->email?>">
                                                <?= form_error('kecamatan','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                          
                                            <div class="form-group col-md-8">
                                                <label for="inputRt">No Hp</label>
                                                <input type="number" class="form-control" id="inputRt" name="no_hp" value="<?= $data->no_hp?>">
                                                <?= form_error('rtt','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label>Level</label>
                                                <select class="form-control" name="role">
                                                    <option value="2" <?= $data->role == '2' ? 'selected' : '' ?>>Petugas</option>
                                                    <option value="3" <?= $data->role == '3' ? 'selected' : '' ?>>Super Admin</option>
                                                </select>                                                                                               
                                            </div>                                                                                                                                                                                                                                                                                                                                      
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning">Submit</button>
                                                <a href="/banksampah/index.php/petugas/index" type="button" class="btn btn-danger">Kembali</a>
                                            </div>
                                        </div>
                                    </form>
                                <?php endforeach ?>
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
        <script src="<?= base_url() ?>/assets/js/my-js.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>      
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>  
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
            
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>