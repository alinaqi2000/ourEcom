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
    <link href="<?= base_url('assets/' . ADMIN) ?>/plugins/summernote/summernote.min.css" rel="stylesheet">



    <!--=================================================-->

    <script src="<?= base_url() ?>assets/apanel/js/jquery.min.js"></script>


    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?= base_url() ?>assets/apanel/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/apanel/plugins/pace/pace.min.js"></script>

    <link href="<?= base_url() ?>assets/apanel/plugins/ionicons/css/ionicons.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/apanel/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/apanel/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">


    <link href="<?= base_url() ?>assets/apanel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">
    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?= base_url() ?>assets/apanel/css/demo/nifty-demo.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

    <link id="dark_sheet" href="<?= $themeColor ?>" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>



    <style type="text/css">
        <?php
        if ($page != 'mails') {

        ?>.panel-body .form-group label,
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
            line-height: 1.47 !important;

        }

        .form-group label,
        .form-label {
            font-weight: 600 !important;
        }

        <?php
        }
        ?>.w-100 {
            width: 100%;
        }


        .alert {
            padding: 5px 3em 5px 5px;
        }

        <?php
        if ($this->session->userdata('themeMode') == 'light' || empty($this->session->userdata('themeMode'))) {
        ?>#moonImg {
            display: none;
        }

        <?php
        } else {
        ?>#moonIcon {
            display: none;
        }

        <?php
        }
        ?><?php
            if ($this->session->userdata('sideMode') == 'open' || empty($this->session->userdata('sideMode'))) {
            ?>#brandLogo {
            width: 200px;
            height: auto;
            margin: 10px;
        }

        #brandFav {
            display: none;
        }

        <?php
            } else {
        ?>#brandLogo {
            width: 200px;
            height: auto;
            margin: 10px;
            display: none;
        }

        #brandFav {
            display: initial;
        }

        <?php
            }
        ?>.ovr_lay {

            width: 178px;
            margin-top: -120px;
            height: 120px;
            text-align: center;
            opacity: 0;
            position: absolute;
            background: rgba(0, 0, 0, .5);
            transition: all .5s;
        }

        .ovr_lay i {
            font-size: 50px !important;
            color: #fff;
            transition: all .15s;
        }

        .ovr_lay i:hover {
            transform: scale(1.05);
            transition: all .15s;
        }

        .thumbnail:hover .ovr_lay {
            opacity: 1;
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
            <?= $this->load->view('apanel/' . $page); ?>
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

    <?= showMsg(); ?>
    <!--JAVASCRIPT-->
    <!--=================================================-->


    <!--jQuery [ REQUIRED ]-->


    <script src="<?= base_url() ?>assets/apanel/js/my_scripts.js"></script>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?= base_url() ?>assets/apanel/js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="<?= base_url() ?>assets/apanel/js/nifty.min.js"></script>


    <script src="<?= base_url() ?>assets/apanel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>


    <!--=================================================-->



    <!--Specify page [ SAMPLE ]-->
    <script src="<?= base_url() ?>assets/apanel/js/demo/dashboard.js"></script>
    <script src="<?= base_url() ?>assets/apanel/js/demo/mail.js"></script>

    <script src="<?= base_url() ?>assets/apanel/js/demo/nifty-demo.min.js"></script>







</body>


</html>