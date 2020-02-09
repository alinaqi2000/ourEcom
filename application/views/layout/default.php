<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Martfury - Multi Vendor &amp; Marketplace</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/electronic.css">

    <script src="<?= base_url('assets/') ?>plugins/jquery-1.12.4.min.js"></script>

</head>

<body>



    <?php include_once("header.php"); ?>
    <?php include_once("mobile_menu.php"); ?>
    <?php echo $this->load->view($page); ?>
    <?php include_once("footer.php"); ?>
    <?php
    //include_once("popup.php"); 
    ?>





    <!-- <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> -->
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
        <div class="ps-search__content">
            <form class="ps-form--primary-search" action="http://nouthemes.net/html/martfury/do_action" method="post">
                <input class="form-control" type="text" placeholder="Search for...">
                <button><i class="aroma-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <script src="<?= base_url('assets/') ?>plugins/popper.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/bootstrap4/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/masonry.pkgd.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery.matchHeight-min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/slick/slick/slick.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/slick-animation.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/gmap3.min.js"></script>
    <!-- custom scripts-->
    <script src="<?= base_url('assets/') ?>js/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>
</body>


</html>