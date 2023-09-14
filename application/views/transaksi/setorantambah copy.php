        <div class="loader"></div>                    
            <!-- /.sidebar -->

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Tambah Data Setoran</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-8">
                            <?php if ($this->session->flashdata('sukses')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">
                                    DataTables Advanced Tables
                                </div> -->
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form role="form" action="<?php echo base_url().'index.php/setoran/create_setoran';?>" method="POST">                                                                                                                                                             
                                            <div class="form-group col-md-8">
                                                <label for="inputDesa">Nomor Induk Nasabah       </label>                                                                                             
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#tampilNasabah" type="button"><i class="fa fa-folder-open fa-fw"></i> Pilih</button>
                                                    <br>
                                                    <br>
                                                    <input type="text" class="form-control" id="inputNin" name="nin" readonly>
                                                    <?= form_error('nin','<small class=" text-danger form-text text-muted">', '</small>') ?>                                                                                          
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="inputDesa">Nama Nasabah</label>
                                                    <input type="text" class="form-control" id="inputNama" name="nama" readonly>                                                                                       
                                                    <?= form_error('nama','<small class=" text-danger form-text text-muted">', '</small>') ?>                                                                                          
                                                </div>                                                                                                            
                                                <div class="form-group col-md-8">
                                                    <label>Jenis Sampah</label>
                                                    <select class="form-control" id="jenisSampah" name="jenis_sampah">
                                                        <option data-harga="0" value="">Pilih Sampah</option>
                                                        <?php foreach ($jns_sampah as $sampah) : ?>
                                                            <option data-harga="<?= $sampah->harga ?>"><?= $sampah->nama_sampah ?></option>
                                                            <?php endforeach ?>
                                                            <?= form_error('jns_sampah','<small class=" text-danger form-text text-muted">', '</small>') ?>                                                                                          
                                                </select>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="inputDesa">Harga /kg</label>                                                     
                                                    <input type="number" class="form-control" id="inputHarga" name="harga" value="<?= set_value('harga')?>" readonly>
                                                    <?= form_error('harga','<small class=" text-danger form-text text-muted">', '</small>') ?>                                                                                          
                                            </div>                                                                                                                    
                                            <div class="form-group col-md-8">
                                                <label for="inputKecamatan">Berat (kg)</label>
                                                <input type="number" class="form-control" id="inputBerat" name="berat" value="<?= set_value('berat')?>">
                                                <?= form_error('berat','<small class=" text-danger form-text text-muted">', '</small>') ?>
                                            </div>                                                                                                                                                                       
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                                <a href="/banksampah/index.php/setoran/setoranindex" class="btn btn-danger">Kembali</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- MODAL PILIH NASABAH -->
                                    <div class="modal fade" id="tampilNasabah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pilih Nasabah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" id="dataNasabah">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;">No.</th>
                                                                <th style="text-align: center;">NIN</th>
                                                                <th style="text-align: center;">Nama Lengkap</th>                                                                                                                   
                                                                <th style="text-align: center;">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $no = 1;
                                                            foreach ($nasabah as $data) : ?>
                                                            <tr class="odd gradeX">
                                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no++?></td>
                                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $data->nin ?></td>                                                                    
                                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $data->nama ?></td>                                                                    
                                                                    <td style="text-align: center; vertical-align: middle;">                                                    
                                                                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="pilih_nasabah('<?php echo $data->nin ?>', '<?php echo $data->nama ?>')">Pilih</button>                                                                                                                                        
                                                                    </td>                                                    
                                                                    <?php endforeach; ?>                                                                                                                                                                        
                                                                    <!-- <td>
                                                                    <button type="button" class="btn btn-warning"><i class="fa fa-edit fa-fw"></i></button>
                                                                    </td> -->
                                                            </tr>                                                                                                                                                                                                                  
                                                        </tbody>                                                                                      
                                                    </table>                                            
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-Primary" data-dismiss="modal">Batal</button>                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- MODAL PILIH NASABAH -->
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
        <script src="<?= base_url() ?>/assets/js/trans-js.js"></script>
        
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
                "responsive": false, // Aktifkan ekstensi Responsive                        
            });
        });
        </script>
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></s>
            
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    </body>

</html>