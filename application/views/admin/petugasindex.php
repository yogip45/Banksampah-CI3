<div class="loader"></div>            
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Data Petugas dan Admin</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Action Button -->                        
                            <div class="mt-3">
                            <!-- ALERT -->                        
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
                            <?php echo anchor('/index.php/admin/tambah_petugas/', '<button class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>'); ?>
                                <!-- <button href="#" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                                <button href="#" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Pdf</button> -->
                            </div>
                            <br>                            
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">
                                    DataTables Advanced Tables
                                </div> -->
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataPetugas">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>                                                    
                                                    <th>Username</th>                                                    
                                                    <th>Nama</th>                                                    
                                                    <th>Aksi</th>                                                    
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
                                                    <td>                                                        
                                                        <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#detailModal<?php echo $data->id_user; ?>">
                                                        <i class="fa fa-bars fa-fw"></i>
                                                        </button>
                                                        <?php echo anchor('/index.php/admin/edit_petugas/'.$data->id_user, '<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit fa-fw"></i></button>'); ?>
                                                        <button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $data->id_user; ?>">
                                                        <i class="fa fa-trash fa-fw"></i></button>
                                                    </td>                                                    
                                                    <?php endforeach; ?>
                                                </div>                                                                                                            
                                                    <!-- <td>
                                                    <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                                                    </td> -->
                                            </tr>                                                                                                                                                                                                                  
                                            </tbody>
                                            <!-- Modal Detail Data -->
                                            
                                        </table>
                                            <!-- MODAL DETAIL DATA USER -->
                                                <?php
                                                $no = 1;
                                                foreach ($petugas as $data) : ?>
                                                <div class="modal fade" id="detailModal<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModal" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail User</h5>                                                            
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
                                                            <!-- Tambahkan baris ini sesuai dengan kolom yang lain -->
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
                                            <!-- MODAL KONFIRMASI HAPUS NASABAH -->
                                    </div>
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

        <!-- TOGGLE SHOW PASSWORD -->

        <script src = "<?= base_url() ?>assets/js/my-js.js"></script>
        
        <!-- REMOVE ALERT OTOMATIS -->
        <script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>      
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>  
        <!-- DATA TABLES -->        
        <!-- DATA TABLES -->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
            
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>