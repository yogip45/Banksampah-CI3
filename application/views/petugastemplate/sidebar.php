<aside class="sidebar navbar-default" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li <?php if (strpos(current_url(), '/auth/dashboard') !== false) echo 'class="active"'; ?>>
                        <?php if ($this->session->userdata('role') != 3) : ?>
                            <a href="/banksampah/index.php/petugas/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        <?php else : ?>
                            <a href="/banksampah/index.php/admin/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        <?php endif; ?>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Pengguna<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">                            
                                <li <?php if (strpos(current_url(), '/nasabah/index') !== false) echo 'class="active"'; ?>>
                                    <a href="/banksampah/index.php/petugas/nasabahindex">Nasabah</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if (strpos(current_url(), '/jenissampah/index') !== false) echo 'class="active"'; ?>>
                            <a href="/banksampah/index.php/jenissampah/index"><i class="fa fa-trash fa-fw"></i> Data Sampah</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text-o fa-fw"></i> Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/banksampah/index.php/setoran/setoranindex">Setor</a>
                                </li>
                                <li>
                                    <a href="#">Pencairan</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if (strpos(current_url(), '/auth/dashboard') !== false) echo 'class="active"'; ?>>
                            <a href="/banksampah/index.php/user/myprofile"><i class="fa fa-user-circle-o fa-fw"></i> Profil Saya</a>
                        </li>
                    </ul>
                </div>
            </aside>