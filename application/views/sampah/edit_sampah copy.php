        <div class="loader"></div>                    
            <!-- /.sidebar -->

            <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Edit Data Sampah</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <button type="submit" class="btn btn-warning">Kembali</button>                                                 -->
                            <div class="panel panel-default">                                
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <?php foreach ($jns_sampah as $sampah) : ?>
                                            <form action="<?php echo base_url().'index.php/jenissampah/update';?>" method="POST">      
                                                <div class="form-group">
                                                    <input type="hidden" value="<?php echo $sampah->id ?>" name="id">
                                                </div>                                          
                                                <div class="form-group">
                                                    <label>Jenis Sampah</label>
                                                    <input type="text" class="form-control" name="nama_sampah" value="<?php echo $sampah->nama_sampah ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga</label>
                                                    <input type="number" class="form-control" value="<?php echo $sampah->harga ?>" name="harga">
                                                    <input type="hidden" class="form-control" value="Kg" name="satuan">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kategori</label>
                                                    <select class="form-control" name="kategori">
                                                        <option value="Plastik" <?php echo ($sampah->kategori == 'Plastik') ? 'selected' : ''; ?>>Plastik</option>
                                                        <option value="Kertas" <?php echo ($sampah->kategori == 'Kertas') ? 'selected' : ''; ?>>Kertas</option>
                                                        <option value="Logam" <?php echo ($sampah->kategori == 'Logam') ? 'selected' : ''; ?>>Logam</option>
                                                        <option value="Lain - Lain" <?php echo ($sampah->kategori == 'Lain - Lain') ? 'selected' : ''; ?>>Lain - Lain</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success">Simpan</button>                                                
                                                <!-- <button type="reset" class="btn btn-warning">Reset</button>                                                 -->
                                                <a href="/banksampah/index.php/jenissampah/index" class="btn btn-danger">Batal</a>                                                
                                            </form>
                                            <?php endforeach; ?>
                                        </div>                                                                  
                                <!-- /.panel-heading -->                                
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
    </body>

</html>