<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Apanel - <?= $site_info_data['site_name'] ?></title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>uploads/logo/<?= $site_info_data['site_favicon'] ?>">

    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="<?= base_url() ?>assets/apanel/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="<?= base_url() ?>assets/apanel/css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="<?= base_url() ?>assets/apanel/css/demo/nifty-demo-icons.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/apanel/plugins/animate-css/animate.min.css" rel="stylesheet">
    <?php
    if ($page == 'mails') {
    ?>
        <link href="<?= base_url('assets/' . ADMIN) ?>/plugins/summernote/summernote.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/apanel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">

    <?php
    }
    ?>
    <script src="<?= base_url() ?>assets/apanel/js/jquery.min.js"></script>



    <!--=================================================-->




    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?= base_url() ?>assets/apanel/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/apanel/plugins/pace/pace.min.js"></script>

    <link href="<?= base_url() ?>assets/apanel/plugins/ionicons/css/ionicons.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/apanel/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/apanel/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?= base_url() ?>assets/apanel/css/demo/nifty-demo.min.css" rel="stylesheet">

    <?php
    if ($page == 'categories' || $page == 'pages') {
    ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/apanel/css/dataTable.min.css" />
        <script type="text/javascript" src="<?= base_url() ?>assets/apanel/js/dataTable.min.js"></script>

    <?php
    }
    if ($page == 'gallery' || $page ==  'admin_profile' || $page ==  'manage_admins') {
    ?>
        <link rel="stylesheet" href="<?= base_url() ?>assets/apanel/css/new/aos.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/apanel/css/new/fancybox.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/apanel/css/new/magnific-popup.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/apanel/css/new/style.css">
        <link href="<?= base_url() ?>assets/apanel/plugins/dropzone/dropzone.min.css" rel="stylesheet">

    <?php
    }
    ?>
    <link id="dark_sheet" href="<?= $themeColor ?>" rel="stylesheet">


    <style type="text/css">
        .min-400 {
            min-height: 400px;
        }

        a[type="button"]:hover {
            cursor: pointer;
        }

        .mail-message i,
        .mail-message p,
        .mail-message span,
        .mail-message h1,
        .mail-message h2,
        .mail-message h4,
        .mail-message h5,
        .mail-message h6,
        .mail-message table,
        .mail-message tr,
        .mail-message td,
        .mail-message div {
            background-color: transparent !important;
        }
    </style>
    <?php
    if ($page == 'mails' && $mode == 'read') {
        if ($this->session->userdata('themeMode') == 'light') {
    ?>
            <style type="text/css">
                .page-header {

                    color: #4d627b;
                }
            </style>
        <?php
        } else {
        ?>
            <style type="text/css">
                .page-header {

                    color: #d4d4d4;
                }
            </style>
        <?php
        }
    }
    if ($page != 'mails') {

        ?>
        <style type="text/css">
            .panel-body .form-group label,
            .panel-body .form-group select,
            .panel-body .form-group {
                width: 100%;
            }

            .panel-body .form-group label {
                margin-bottom: 1rem;
            }

            .panel-body .form-group {
                margin-bottom: 2rem;
            }

            table thead th,
            table tbody td {
                text-align: center;
            }

            .float-left {
                float: left !important;
            }

            .media-body {
                line-height: 1.47;

            }

            .form-group label,
            .form-label {
                font-weight: 600 !important;
            }
        </style>
    <?php
    }
    ?>
    <style type="text/css">
        .w-100 {
            width: 100%;
        }


        .alert {
            padding: 5px 3em 5px 5px;
        }
    </style>
    <?php
    if ($this->session->userdata('themeMode') == 'light' || empty($this->session->userdata('themeMode'))) {
    ?>
        <style type="text/css">
            #moonImg {
                display: none;
            }
        </style>
    <?php
    } else {
    ?>
        <style type="text/css">
            #moonIcon {
                display: none;
            }
        </style>
        <?php
    }
        ?><?php
            if ($this->session->userdata('sideMode') == 'open' || empty($this->session->userdata('sideMode'))) {
            ?>
        <style type="text/css">
            #brandLogo {
                width: 200px;
                height: auto;
                margin: 10px;
            }

            #brandFav {
                display: none;
            }
        </style>
    <?php
            } else {
    ?>
        <style type="text/css">
            #brandLogo {
                width: 200px;
                height: auto;
                margin: 10px;
                display: none;
            }

            #brandFav {
                display: initial;
            }
        </style>
    <?php
            }
    ?>
    <style type="text/css">
        .ovr_lay {

            width: 178px;
            margin-top: -120px;
            height: 120px;
            text-align: center;
            opacity: 0;
            position: absolute;
            background: rgba(52, 59, 71, .8);
            transition: all .5s;
        }

        .ovr_lay i {
            font-size: 50px !important;
            color: #fff;
            transition: all .15s;
        }

        .thumbnail:hover .ovr_lay {
            opacity: 1;
            transition: all .5s;
        }

        .thumbnail img {
            transition: all .5s;
        }

        .thumbnail i {
            transition: all .5s;
        }

        .thumbnail img {
            height: inherit !important;
        }

        .thumbnail:hover img {
            transform: scale(1.1);
            filter: blur(1px);
            transition: all .5s;
        }

        .thumbnail:hover .fle-icon {
            transform: scale(1.1);
            filter: blur(1px);
            transition: all .5s;
        }
    </style>
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="container" class="layOut effect aside-float aside-bright <?= $sideMode ?>" <?php
                                                                                        if ($this->uri->segment(2) == 'login') {
                                                                                        ?> style="background: url(<?= base_url("assets/" . ADMIN . "/img/bg-img/bg-img-3.jpg") ?>) no-repeat;background-size:cover;" <?php
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                        ?>>

        <!--NAVBAR-->
        <!--===================================================-->
        <?php
        if ($this->uri->segment(2) != 'login') {
            include_once('header.php');
        }
        ?>
        <!--===================================================-->
        <!--END NAVBAR-->


        <div class="boxed">
            <?php $this->load->view('apanel/' . $page); ?>
            <?php
            if ($this->uri->segment(2) != 'login') {
                include_once("sidebar.php");
            }
            ?>

        </div>
        <!-- FOOTER -->
        <!--===================================================-->

        <?php
        if ($this->uri->segment(2) != 'login') {
            include_once("footer.php");
        }
        ?>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <?php
    if ($page == 'admin_profile' || 'manage_admins') {
        include_once('pop_ups/galleryPopUp.php');
    }
    ?>
    <?= showMsg(); ?>
    <!--JAVASCRIPT-->
    <!--=================================================-->


    <!--jQuery [ REQUIRED ]-->



    <script src="<?= base_url('assets/' . ADMIN) ?>/plugins/bootbox/bootbox.min.js"></script>
    <?php
    if ($page == 'mails') {
    ?>
        <script src="<?= base_url() ?>assets/apanel/js/mail_scripts.js"></script>
        <script src="<?= base_url() ?>assets/apanel/js/demo/mail.js"></script>
        <script src="<?= base_url() ?>assets/apanel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <?php
    }
    ?>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?= base_url() ?>assets/apanel/js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="<?= base_url() ?>assets/apanel/js/nifty.min.js"></script>




    <!--=================================================-->



    <!--Specify page [ SAMPLE ]-->
    <!-- <script src="<?= base_url() ?>assets/apanel/js/demo/dashboard.js"></script> -->

    <script src="<?= base_url() ?>assets/apanel/js/demo/nifty-demo.min.js"></script>

    <?php
    if ($page == 'gallery' || $page ==  'admin_profile' || $page ==  'manage_admins') {
    ?>
        <script src="<?= base_url() ?>assets/apanel/js/new/jquery.magnific-popup.min.js"></script>
        <script src="<?= base_url() ?>assets/apanel/js/new/aos.js"></script>

        <script src="<?= base_url() ?>assets/apanel/js/new/jquery.fancybox.min.js"></script>

        <script src="<?= base_url() ?>assets/apanel/js/new/main.js"></script>

        <script src="<?= base_url() ?>assets/apanel/plugins/dropzone/dropzone.min.js"></script>

        <script src="<?= base_url() ?>assets/apanel/js/gallery_scripts.js"></script>
        <?php
        if ($page == 'gallery') {
        ?>

            <!-- <script>
                jQuery(document).ready(function($) {
                    fetchGalls(1);
                });
            </script> -->
        <?php
        }
        ?>
        <!-- <script src="<?= base_url() ?>assets/apanel/js/demo/form-file-upload.js"></script> -->
    <?php
    }
    ?>
    <script src="<?= base_url() ?>assets/apanel/js/my_scripts.js"></script>

    <?php
    if ($page != 'mails') {
    ?>
        <script>
            $(document.body).ready(function() {
                // Prevents form submittion on enter
                $(window).keydown(function(event) {
                    if (event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });
            });
        </script>
    <?php
    }
    ?>



</body>


</html>