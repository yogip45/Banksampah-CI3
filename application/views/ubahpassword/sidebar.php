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
                        <li <?php if (strpos(current_url(), '/auth/changepassword') !== false) echo 'class="active"'; ?>>
                            <a href="#"><i class="fa fa-lock fa-fw"></i> Ganti Password</a>
                        </li>                                                                        
                    </ul>
                </div>
            </aside>