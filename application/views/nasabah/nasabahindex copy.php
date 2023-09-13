        <div class="loader"></div>        

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Data Nasabah</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Action Button -->                        
                            <div class="mt-3">
                            <!-- ALERT -->                        
                            <?php if ($this->session->flashdata('sukses')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('hapus')): ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('hapus'); ?></div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('edit')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('edit'); ?></div>
                            <?php endif; ?>
                            <!-- ALERT -->                                                
                            <?php echo anchor('index.php/petugas/tambah_nasabah/', '<button class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>'); ?>
                                <!-- <button href="#" class="btn btn-success"><i class="fa fa-file--o"></i> Excel</button>
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
                                        <table class="table table-striped table-bordered table-hover" id="dataNasabah">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>NIN</th>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>Email</th>
                                                    <th>Action</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 1;
                                                foreach ($nasabah as $data) : ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $no++?></td>
                                                    <td><?php echo $data->nin ?></td>
                                                    <td><?php echo $data->nama ?></td>
                                                    <td><?php echo $data->alamat_lengkap ?></td>
                                                    <td><?php echo $data->email ?></td>                                                    
                                                    <td>                                                    
                                                        <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#detailModal<?php echo $data->nin; ?>">
                                                        <i class="fa fa-bars fa-fw"></i>
                                                        </button>
                                                        <?php echo anchor('index.php/petugas/edit_nasabah/'.$data->id_user, '<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit fa-fw"></i></button>'); ?>
                                                        <button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $data->id_user; ?>">
                                                        <i class="fa fa-trash fa-fw"></i></button>
                                                    </td>                                                    
                                                </div>                                                                                                            
                                                <!-- <td>
                                                    <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                                                </td> -->
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
                                                                <th>NIN / Username</th>
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
                                                                <?php echo anchor('index.php/petugas/ubahstatus_nasabah/'.$data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
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
                                                                <?php echo anchor('/index.php/petugas/resetpassword_nasabah/'.$data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <!-- NON AKTIFKAN AKUN -->
                                            <?php
                                                $no = 1;
                                                foreach ($nasabah as $data) : ?>
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
                                                                <?php echo anchor('index.php/petugas/hapus_nasabah/'.$data->id_user, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            <!-- MODAL KONFIRMASI HAPUS NASABAH -->
                                            <!-- MODAL PASSWORD RESET BARU -->
                                                    <div class="modal fade" id="tampilPassword" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="hapusModalLabel">Password Baru Anda</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <?php $reset_password = $this->session->flashdata('password');  ?>
                                                                        <h5 class="text-center" id="isi_password"><?= $reset_password; ?></h5>
                                                                    </div>
                                                                    <div class="col-lg-6 text-center">
                                                                        <button class="btn btn-outline-light text-dark" id="copyButton" onclick="copyToClipboard('isi_password')">Copy</button>
                                                                    </div>
                                                                </div>                                                                    
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <!-- MODAL PASSWORD RESET BARU -->
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script>
            $(document).ready(function() {
                // Mengecek apakah ada nilai dalam session "reset_pass"
                var resetPassValue = "<?= $reset_password; ?>";
                if (resetPassValue != "") {
                    // Cek apakah modal sudah pernah ditampilkan
                    $("#tampilPassword").modal("show");
                }
        });        
        </script>
        <script>
            function copyToClipboard(elementId) {
            var copyText = document.getElementById(elementId);
            var textArea = document.createElement("textarea");

            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);

            textArea.select();
            document.execCommand("copy");

            document.body.removeChild(textArea);

            // Menonaktifkan tombol setelah berhasil disalin
            var copyButton = document.getElementById("copyButton");
            copyButton.textContent = "copied";
            copyButton.disabled = true;
            }
        </script>

        <!-- jQuery -->
        <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url()?>assets/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url()?>assets/js/startmin.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>      
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <!-- DATA TABLES -->
        <!-- MY JS -->
        <script src="<?= base_url() ?>/assets/js/my-js.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
            
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>