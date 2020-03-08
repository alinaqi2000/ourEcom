<nav id="mainnav-container">
    <div id="mainnav">
        <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
        <!--It will only appear on small screen devices.-->
        <!--================================ -->
        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <?php
                                if (!empty($site_admin_data['admin_image'])) {
                                ?>
                                    <img class="img-circle img-md" src="<?= base_url("uploads/apanel/admin/") . $site_admin_data["admin_image"] ?>" alt="Profile Picture">
                                <?php
                                } else {
                                ?>
                                    <img class="img-circle img-md" src="<?= base_url("assets/".ADMIN."/user.png") ?>" alt="Profile Picture">
                                <?php
                                }
                                ?>
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name"><?= $site_admin_data["admin_name"] ?></p>
                                <span class="mnp-desc"><?= $site_admin_data['admin_portfolio'] ?></span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="<?= base_url(ADMIN . '/admin_profile') ?>" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> Profile
                            </a>
                            <a href="<?= base_url(ADMIN . '/change_pswd') ?>" class="list-group-item">
                                <i class="ti-lock icon-lg icon-fw"></i> Change Password
                            </a>
                            <a href="<?= base_url(ADMIN . '/logout') ?>" class="list-group-item">
                                <i class="ion-log-out icon-lg icon-fw"></i> logout
                            </a>
                        </div>
                    </div>


                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                        <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                        <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                        <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                        <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">

                        <!--Category name-->
                        <!-- <li class="list-header">Navigation</li> -->

                        <!--Menu list item-->
                        <li class="<?= $this->uri->segment(2) == 'home' ? 'active-sub' : ''; ?>">
                            <a href="<?= base_url(ADMIN . '/home') ?>">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'pages' ? 'active-sub' : ''; ?>">
                            <a href="<?= base_url(ADMIN . '/pages') ?>">
                                <i class="demo-pli-file-html"></i>
                                <span class="menu-title">Pages</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'categories' ? 'active-sub' : ''; ?>">
                            <a href="<?= base_url(ADMIN . '/categories') ?>">
                                <i class="ti-server"></i>
                                <span class="menu-title">Categories</span>
                            </a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'gallery' ? 'active-sub' : ''; ?>">
                            <a href="<?= base_url(ADMIN . '/gallery') ?>">
                                <i class="ti-gallery"></i>
                                <span class="menu-title">Gallery</span>
                            </a>
                        </li>
                        <li class="<?= ($this->uri->segment(2) == 'site_settings' || $this->uri->segment(2) == 'site_social' || $this->uri->segment(2) == 'site_contact') ? 'active-sub' : ''; ?>">
                            <a href="javascript:void(0);">
                                <i class="ion-settings"></i>
                                <span class="menu-title">Settings</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse <?= ($this->uri->segment(2) == 'site_settings' || $this->uri->segment(2) == 'site_social' || $this->uri->segment(2) == 'site_contact') ? 'in' : ''; ?>">
                                <li class="<?= $this->uri->segment(2) == 'site_settings' ? 'active-link' : ''; ?>"><a href="<?= base_url(ADMIN . '/site_settings') ?>">Site Settings</a></li>
                                <!-- <li class="<?= $this->uri->segment(2) == 'site_social' ? 'active-link' : ''; ?>"><a href="<?= base_url(ADMIN . '/site_social') ?>">Site Social</a></li>
                                <li class="<?= $this->uri->segment(2) == 'site_contact' ? 'active-link' : ''; ?>"><a href="<?= base_url(ADMIN . '/site_contact') ?>">Site Contact</a></li> -->


                            </ul>
                        </li>
                        <!--Menu list item-->

                    </ul>


                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>