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
                        <li <?php if (strpos(current_url(), '/nasabah/dashboard') !== false) echo 'class="active"'; ?>>
                            <a href="/banksampah/index.php/nasabah/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>                                                
                        <li <?php if (strpos(current_url(), '/transaksi/index') !== false) echo 'class="active"'; ?>>
                            <a href="#"><i class="fa fa-file-text fa-fw"></i> Transaksi</a>
                        </li>                        
                        <li <?php if (strpos(current_url(), '/user/myprofile') !== false) echo 'class="active"'; ?>>
                            <a href="/banksampah/index.php/user/myprofile"><i class="fa fa-user-circle-o fa-fw"></i> Profil Saya</a>
                        </li>
                    </ul>
                </div>
            </aside>