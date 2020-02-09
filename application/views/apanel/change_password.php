<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Change Password</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <?php echo getBredcrum(array('#' => 'Change Password')); ?>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">

        <div class="panel">

            <div class="panel-body">
                <div class="col-md-12">
                    <?= showMsg(); ?>
                </div>

                <!-- Inline Form  -->
                <!--===================================================-->
                <form class="form-inline" method="POST" enctype="multipart/form-data">
                    <div class="col-md-8 mar-btm">
                        <?= formText('Old Password', 'site_opswd', '') ?>
                    </div>
                    <div class="col-md-8 mar-btm">
                        <?= formText('New Password', 'site_pswd', '') ?>
                    </div>
                    <div class="col-md-8 mar-btm">
                        <?= formText('Confirm Password', 'site_cpswd', '') ?>
                    </div>
                    <div class="col-md-8 mar-btm">
                        <button class="btn btn-primary" type="submit"><i class="ti-save"></i> Save</button>
                    </div>
                </form>
                <!--===================================================-->
                <!-- End Inline Form  -->

            </div>
        </div>








    </div>
    <!--===================================================-->
    <!--End page content-->

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->