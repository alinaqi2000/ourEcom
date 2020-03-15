    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">

            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Admin Profile</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <?php echo getBredcrum(array('#' => 'Admin Settings')); ?>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <div class="panel">

                <div class="panel-body">
                    <div class="col-md-12">

                    </div>
                    <!-- Inline Form  -->
                    <!--===================================================-->
                    <form class="form-inline" method="POST" enctype="multipart/form-data">
                        <div class="col-md-8 mar-btm">
                            <?= formText('Login Name', 'site_login', $site_login); ?>
                        </div>
                        <div class="col-md-8 mar-btm">
                            <?= formText('Admin Name', 'admin_name', $site_admin_data['admin_name']); ?>
                        </div>
                        <div class="col-md-8 mar-btm">
                            <?= formText('Admin Portfolio', 'admin_portfolio', $site_admin_data['admin_portfolio']); ?>
                        </div>
                        <div class="col-md-8 mar-btm">
                            <?= formTextArea('Admin Description Text', 'admin_text', $site_admin_data['admin_text']); ?>
                        </div>

                        <div class="col-md-8 mar-btm">
                            <?= formImageFile('Admin Avatar', 'admin_image', $site_admin_data['admin_image'], '64 x 64px', 'apanel/admin', 'hasGallery', 'hasRemove') ?>

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
    <script>
        jQuery(document).ready(function($) {
            c_mode = $("#demo-gallery").data('mode');

            var int = setInterval(check(), 100);

            function chkObject(elemId) {
                return $('elemId') ? true : false;
            }

            function check() {
                if (chkObject('#loadGals') == true) {
                    fetchGalls(1, c_mode);
                    int = window.clearInterval(int)
                }


            }
        });
    </script>