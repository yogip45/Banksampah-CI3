  <!-- Content Wrapper. Contains page content -->
  <div class="loader"></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Saya</h1>
          </div>
          <div class="col-sm-6">            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active">Profil Saya</li>
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
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <!-- ALERT -->                                                
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <!-- MYPROFILE -->
                <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?= base_url() ?>assets/foto/<?= $user['foto'] ?>"
                                    alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?= $user['nama_petugas'] ?></h3>

                                <p class="text-muted text-center"><?= $user['email'] ?></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Last Login</b> <a class="float-right"><?= date('d M H:i', strtotime($user['last_login'])) ?></a>
                                </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Data Diri</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <strong><i class="fas fa-book mr-1"></i> Nomor HP</strong>

                              <p class="text-muted">
                              <?= $user['no_hp'] ?>
                              </p>

                              <hr>

                              <strong><i class="fas fa-user mr-1"></i> Role</strong>

                              <p class="text-muted">
                                  <span style="<?= $user['role'] == 3 ? 'color: red;' : ($user['role'] == 2 ? 'color: green;' : '') ?>">
                                                                  <?= $user['role'] == 3 ? 'Super Admin' : ($user['role'] == 2 ? 'Petugas' : '') ?>
                                  </span>
                              </p>

                              <hr>

                              <strong><i class="fas fa-user mr-1"></i> Username</strong>

                              <p class="text-muted">
                              <?= $user['username'] ?>
                              </p>

                              <hr>

                          </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                      <div class="card">
                        <div class="card-header p-2">
                          <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#editProfile" data-toggle="tab">Edit Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#gantiFoto" data-toggle="tab">Foto Profile</a></li>
                          </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                          <div class="tab-content">
                            <div class="active tab-pane" id="editProfile">
                              <form class="form-horizontal" action="<?php echo base_url().'index.php/user/update_profile';?>" method="POST">
                                <div class="form-group row">
                                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputNama" placeholder="Nama Lengkap" name="nama" value="<?= $user['nama_petugas']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNo" class="col-sm-2 col-form-label">Nomor HP</label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputNo" placeholder="08xxx" name="no_hp" value="<?= $user['no_hp']?>">
                                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                              </form>
                            </div>
                            <div class="tab-pane" id="gantiFoto">
                              <!-- FORM EDIT PROFILE -->
                                  <div class="card-body">
                                      <div class="tab-content">
                                          <?= form_open_multipart('index.php/user/updatefoto');?>                                                                                                    
                                          <div class="form-group">
                                              <label for="inputFoto">Pilih File, Max (2Mb)</label>
                                              <div class="input-group">
                                                <div class="custom-file col-md-8">
                                                    <input type="file" class="custom-file-input" id="inputFoto" name="foto">
                                                    <label class="custom-file-label" for="inputFoto">Choose file</label>
                                                </div>
                                                <div class="form-group">
                                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                </div>                                        
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-sm-10">
                                              <button type="submit" class="btn btn-primary">Simpan</button>
                                              </div>
                                          </div>
                                          <?= form_close();?>
                                      </div>
                                  </div>
                              <!-- FORM EDIT PROFILE -->
                            </div>
                          </div>
                          <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                      </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                </section>
                <!-- MYPROFILE -->
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    // Saat input file berubah
    $('#inputFoto').change(function() {
        // Ambil nama file yang diunggah
        var fileName = $(this).val().split('\\').pop();
        // Tampilkan nama file di label
        $(this).next('.custom-file-label').html(fileName);
    });
});
</script>
<script src="<?php echo base_url()?>adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
<script src="<?php echo base_url()?>adminlte/plugins/toastr/toastr.min.js"></script>