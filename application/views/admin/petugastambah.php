  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Petugas</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
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
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">                
                <form role="form" action="<?php echo base_url().'index.php/admin/create_petugas';?>" method="POST" class="col-8">                                                                                                                                                             
                  <div class="form-row">
                    <div class="form-group col-md-5">
                      <label for="inputNama">Nama Lengkap</label>
                      <input placeholder="Nama lengkap petugas" type="text" class="form-control" id="inputNama" name="nama" value="<?= set_value('nama')?>">  
                      <?= form_error('nama','<small class="text-danger">', '</small>') ?>                                          
                    </div>                                                                                                                                                                                                                                                                                                                                                                                                               
                    <div class="form-group col-md-4">
                      <label for="inputEmail">Email</label>
                      <input placeholder="Email untuk petugas" type="text" class="form-control" id="inputEmail" name="email" value="<?= set_value('email')?>">
                      <?= form_error('email','<small class="text-danger">', '</small>') ?>
                    </div>                                                                                                                           
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputHp">No HP</label>
                        <input placeholder="Nomor HP petugas" type="number" class="form-control" id="inputHp" name="no_hp" value="<?= set_value('no_hp')?>">
                        <?= form_error('no_hp','<small class="text-danger">', '</small>') ?>
                    </div>                                                                                                                           
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputPassword1">Password (auto generate)</label>                                                                                                   
                      <div class="input-group">
                        <input value="<?= generate_password(8); ?>" placeholder="Password untuk petugas" type="text" class="form-control" id="inputPassword1" name="password1" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="copyBtn">
                            <i class="fas fa-clipboard fa-fw"></i> <span id="is_salin"> salin</span>
                            </button>
                        </div>
                        <?= form_error('password1','<small class="text-danger">', '</small>') ?>                                           
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="<?= base_url()?>index.php/admin/petugasindex"  type="reset" class="btn btn-danger">Batal</a>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
    const copyBtn = document.getElementById('copyBtn')
    const copyText = document.getElementById('inputPassword1')
    const is_copy = document.getElementById('is_salin')
    
    if (copyBtn!=null) {
        copyBtn.onclick = () => {
            copyText.select();
            document.execCommand('copy');
            is_copy.textContent = ' disalin';
            copyBtn.disabled = true;
        }
    }
</script>