<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="<?= base_url(ADMIN . '/home') ?>" class="navbar-brand">
                <img id="brandLogo" src="<?= base_url('uploads/logo/' . $site_info_data['site_logo']) ?>" alt="Nifty Logo" class="brand-icon">
                <img id="brandFav" src="<?= base_url('uploads/logo/' . $site_info_data['site_favicon']) ?>" alt="Nifty Logo" class="brand-icon">
                <!-- <div class="brand-title">
                    <span class="brand-text"><?= $site_info_data['site_name'] ?></span>
                </div> -->
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content">
            <ul class="nav navbar-top-links">

                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="navbar-toggle" id="sideButton" data-mode="<?= $this->session->userdata('sideMode') ?>" data-url="<?= base_url('apanel/index/side_mode') ?>" href="javascript:void(0);">
                        <i class="demo-pli-list-view"></i>
                    </a>
                </li>
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" id="sideButton2" href="#">
                        <i class="demo-pli-list-view"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->



                <!--Search-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- <li>
                    <div class="custom-search-form">
                        <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox">
                            <i class="demo-pli-magnifi-glass"></i>
                        </label>
                        <form>
                            <div class="search-container collapse" id="nav-searchbox">
                                <input id="search-input" type="text" class="form-control" placeholder="Type for search...">
                            </div>
                        </form>
                    </div>
                </li> -->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Search-->

            </ul>
            <ul class="nav navbar-top-links">
                <li>
                    <?php
                    if ($getUnread > 0) {
                    ?>
                        <a title="Manage Admins" href="<?= base_url(ADMIN . "/inbox") ?>">
                            <i class="ion-email-unread icon-lg icon-fw"></i>
                        </a>
                    <?php
                    } else {
                    ?>
                        <a title="Manage Admins" href="<?= base_url(ADMIN . "/inbox") ?>">
                            <i class="ion-email icon-lg icon-fw"></i>
                        </a>
                    <?php
                    }
                    ?>

                </li>
                <li>
                    <a title="Manage Admins" href="<?= base_url(ADMIN . "/manage_admins") ?>">
                        <i class="ion-person-stalker icon-lg icon-fw"></i>
                    </a>
                </li>
                <li>
                    <a title="Dark Mode" href="javascript:void(0);" id="darkColor" data-mode="<?= $this->session->userdata('themeMode') ?>" data-url="<?= base_url('apanel/index/dark_mode') ?>" data-dark="<?= base_url() ?>assets/apanel/css/dark-theme.min.css" data-light="<?= base_url() ?>assets/apanel/css/theme-mint.min.css">
                        <?php
                        // if ($this->session->userdata("themeMode") == "dark" || empty($this->session->userdata("themeMode"))) {
                        ?>
                        <img id="moonImg" style="width:15px;margin-top:4px;" src="<?= base_url("assets/" . ADMIN . "/moon-solid.png") ?>" alt="Dark Mode">
                        <?php
                        // } else {
                        ?>
                        <i id="moonIcon" class="fa fa-moon-o"></i>
                        <?php
                        // }
                        ?>


                    </a>
                </li>

                <li>
                    <a title="Visit Website" href="<?= base_url() ?>" target="_blank">
                        <i class="fa fa-globe"></i>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(ADMIN . '/logout') ?>" title="Logout">
                        <i class="ion-log-out icon-lg icon-fw"></i>
                    </a>
                </li>

                <!--User dropdown-->

                <!-- <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                        <span class="ic-user pull-right">
                         
                            <img class="img-circle img-user media-object" src="<?= !empty($site_admin_data['admin_image']) ? base_url('uploads/' . ADMIN . '/admin/' . $site_admin_data['admin_image']) : base_url('assets/' . ADMIN . '/img/user.png'); ?>" alt="Profile Picture">
                         
                            <span style="font-size: 14px;margin: 0px 8px;"><?= $site_admin_data['admin_name'] ?></span>
                           
                        </span>
                      
                    </a>


                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                        <ul class="head-list">
                            <li>
                                <a href="<?= base_url(ADMIN . '/admin_profile') ?>"><i class="demo-pli-male icon-lg icon-fw"></i> Profile</a>
                            </li>
                       
                            <li>
                                <a href="<?= base_url(ADMIN . '/change_pswd') ?>"><i class="ti-lock icon-lg icon-fw"></i> Change Password</a>
                            </li>

                            <li>
                                <a href="<?= base_url(ADMIN . '/logout') ?>"><i class="ion-log-out icon-lg icon-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->



            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>