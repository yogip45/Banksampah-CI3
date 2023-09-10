        <div class="loader"></div>        
            <!-- /.sidebar -->

            <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Data Sampah</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">                        
                        <div class="col-lg-12">                    
                            <!-- Notif Tambah data -->
                            <?php if ($this->session->flashdata('sukses')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                            <?php endif; ?>                            
                            <!-- Notif Hapus data -->
                            <?php if ($this->session->flashdata('hapus')): ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('hapus'); ?></div>
                            <?php endif; ?>                            
                            <div class="panel panel-default">                                
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <form role="form" action="<?php echo base_url().'jenissampah/tambah_aksi';?>" method="POST">                                                
                                                <div class="form-group">
                                                    <label>Jenis Sampah</label>
                                                    <input type="text" class="form-control" placeholder="Besi, Kardus" name="nama_sampah" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga</label>
                                                    <input type="number" class="form-control" placeholder="Rp." name="harga" required>
                                                    <input type="hidden" class="form-control" value="Kg" name="satuan">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Satuan</label>
                                                    <select class="form-control" name="" disabled>                                                        
                                                        <option value="Kg">Kg</option>
                                                        <option value="g">g</option>
                                                    </select>
                                                </div>                                                                                                 -->
                                                <button type="submit" class="btn btn-success">Tambah</button>                                                
                                                <button type="reset" class="btn btn-warning">Reset</button>                                                
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                        <div class="col-lg-8">
                                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    Data Sampah
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Jenis Sampah</th>
                                                    <th>Harga</th>
                                                    <!-- <th>Satuan</th> -->
                                                    <th>Tanggal Update</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($jns_sampah as $sampah) : ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>                                                    
                                                    <td><?php echo $sampah->nama_sampah ?></td>                                                    
                                                    <td><?php echo $sampah->harga ?> /kg</td>                                                                                                        
                                                    <td><?php echo date('d M Y', strtotime($sampah->diubah)) ?></td>                                                    
                                                    <td class="aksi-column" >                                                        
                                                        <?php echo anchor('index.php/jenissampah/edit/'.$sampah->id, '<button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>'); ?>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $sampah->id; ?>">
                                                        <i class="fa fa-trash fa-fw"></i>
                                                        </button>
                                                    </td>                                                                                                                                                                                                                   
                                                <!-- Modal untuk konfirmasi hapus -->
                                                <div class="modal fade" id="hapusModal<?php echo $sampah->id; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?php echo $sampah->id; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hapusModalLabel<?php echo $sampah->id; ?>">Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <?php echo anchor('jenissampah/hapus/'.$sampah->id, '<button type="button" class="btn btn-danger">OK</button>'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal untuk edit -->                                                                                               
                                                <?php endforeach; ?>
                                                </div>
                                            </tr>                                                                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
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
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
      
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>