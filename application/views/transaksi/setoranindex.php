        <div class="loader"></div>        

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Data Transaksi Setor</h1>
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
                            <?php echo anchor('index.php/setoran/tambah_setoran/', '<button class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>'); ?>                                
                            </div>
                            <br>                            
                            <div class="panel panel-default">                               
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataNasabah">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Id Setor</th>
                                                    <th>Tanggal Setor</th>
                                                    <th>Jenis Sampah</th>
                                                    <th>Berat</th>                                                    
                                                    <th>Harga</th>                                                    
                                                    <th>Total</th>                                               
                                                    <th>Aksi</th>                                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 1;
                                                foreach ($nasabah as $data) : ?>
                                            <tr class="odd gradeX">
                                                    <td><?php echo $no++?></td>
                                                    <td><?php echo $data->id_setor ?></td>
                                                    <td><?php echo date('d M Y', strtotime($data->tanggal_setor)) ?></td>
                                                    <td><?php echo $data->jenis_sampah ?></td>
                                                    <td><?php echo $data->berat ?></td>                                                    
                                                    <td><?php echo $data->harga ?></td>                                                    
                                                    <td><?php echo $data->total ?></td>                                                    
                                                    <td>                                                    
                                                        <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#detailModal<?php echo $data->nin; ?>">
                                                        <i class="fa fa-bars fa-fw"></i>
                                                        </button>
                                                    </td>                                                    
                                                    <?php endforeach; ?>
                                                </div>                                                                                                            
                                                    <!-- <td>
                                                    <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                                                    </td> -->
                                            </tr>                                                                                                                                                                                                                  
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>                                                            
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Id Setor</th>
                                                                <td><?php echo $data->id_setor ?></td>                                                                
                                                            </tr>
                                                            <tr>
                                                                <th>NIN / Username</th>
                                                                <td><?php echo $data->nin ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tanggal Setor</th>
                                                                <td><?php echo date('d M Y H:i', strtotime($data->tanggal_setor)) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <td><?php echo $data->nama ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Harga</th>
                                                                <td><?php echo $data->harga ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Qty</th>
                                                                <td><?php echo $data->berat ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total</th>
                                                                <td><?php echo $data->total ?></td>
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
                                            <div class="modal fade" id="ubahStatus<?php echo $data->id_setor; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                                                <?php echo anchor('index.php/petugas/ubahstatus_nasabah/'.$data->id_setor, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <!-- RESET PASSWORD NASABAH -->
                                            <div class="modal fade" id="resetPassword<?php echo $data->id_setor; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                                                    <?php echo anchor('/index.php/petugas/resetpassword_nasabah/'.$data->id_setor, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <!-- NON AKTIFKAN AKUN -->
                                            <?php
                                                $no = 1;
                                                foreach ($nasabah as $data) : ?>
                                            <div class="modal fade" id="hapusModal<?php echo $data->id_setor; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                                                <?php echo anchor('index.php/petugas/hapus_nasabah/'.$data->id_setor, '<button type="button" class="btn btn-danger">OK</button>'); ?>
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
        <script>
            $(document).on('click', '.show-password-button', function() {
                const targetInputId = $(this).data('target');
                const input = $('#' + targetInputId);
                
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });
            </script>
        <!-- TOGGLE SHOW PASSWORD -->
        
        <!-- LOADING SCREEN -->
        <script>
            const loader = document.querySelector(".loader");
            window.addEventListener("load",() => {
                loader.classList.add("loader--hidden");
                loader.addEventListener("transitioned", ()=>{
                    document.body.removeChild(document.querySelector(".loader"));
                });
            })
        </script>
        <!-- LOADING SCREEN -->
        <!-- REMOVE ALERT OTOMATIS -->
        <script>
            window.setTimeout(function(){
                $(".alert").fadeTo(500,0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 3000);
        </script>
        <!-- REMOVE ALERT OTOMATIS -->
        <script src="<?php echo base_url()?>assets/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>      
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>  
        <!-- DATA TABLES -->
        <script>
            $(document).ready(function () {
                $('#dataNasabah').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
                        "sEmptyTable": "Tidak ada data yang tersedia"
                    },
                "responsive": true,
            });
        });
        </script>
        <!-- DATA TABLES -->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
            
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>