    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">



        <?php

        if ($mode == 'edit' || $mode == 'add') {

        ?>


            <div id="page-head">

                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><?= ($mode == 'edit') ? $row->g_title : 'Add New'; ?></h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <?php

                if ($mode == 'edit') {
                    echo getBredcrum(array(base_url(ADMIN) . '/gallery' => 'Gallery', '#' => $row->g_slug));
                } else {
                    echo getBredcrum(array(base_url(ADMIN) . '/gallery' => 'Gallery', '#' => 'Add'));
                }
                ?>

                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

            </div>


            <!--Page content-->
            <!--===================================================-->
            <div id="page-content" style="width:100%;float:left;">

                <div class="panel">

                    <div class="panel-body">

                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form action="<?= base_url() ?>apanel/gallery/add_image" id="" method="post" class="dropzone dz-clickable" enctype="multipart/form-data">
                            <!-- <input type="text" name="tiit" value="100" hidden> -->

                            <div class="dz-default dz-message">
                                <div class="dz-icon">
                                    <i class="demo-pli-upload-to-cloud icon-5x"></i>
                                </div>
                                <div>
                                    <span class="dz-text">Drop files to upload</span>
                                    <p class="text-sm text-muted">or click to pick manually</p>
                                </div>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" multiple>
                            </div>


                            <!-- <button type="submit" data-url="<?= base_url() ?>apanel/gallery/addd" id="bbttnn" class="btn btn-primary">Submit</button> -->


                        </form>
                        <!--===================================================-->
                        <!-- End Inline Form  -->
                        <div id="repp">

                        </div>
                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!--End page content-->

        <?php
        } else {
        ?>

            <link href="<?= base_url() ?>assets/apanel/plugins/unitegallery/css/unitegallery.min.css" rel="stylesheet">

            <div id="page-head">

                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Manage Gallery</h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <?php echo getBredcrum(array('#' => 'Gallery')); ?>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

            </div>


            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">





                <!--Data Table-->
                <!--===================================================-->

                <div class="panel">
                    <div class="panel-body">



                        <div class="pad-btm form-inline">
                            <div class="row">
                                <div class="col-sm-6 table-toolbar-left">
                                    <a href="<?= base_url('apanel/gallery/add') ?>" id="demo-btn-addrow" class="btn btn-primary"><i class="demo-pli-add"></i> Add</a>
                                    <a role="button" id="editGall" class="btn btn-warning" style="display:none;margin-left: 10px;"><i class="demo-pli-pencil"></i> Edit</a>

                                </div>
                            </div>
                        </div>


                        <!--===================================================-->
                        <!--End Data Table-->


                        <div class="pad-all" style="width:100%;float:left;">

                            <div class="main-content">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="row">


                                            <div class="col-md-6">
                                                <div style="display: none;margin:10px 0px;" id="dGall">
                                                    <div class="btn-group mFilter">
                                                        <label id="demo-checked-all-mail" for="select-all-mail" class="btn btn-default">
                                                            <input id="select-all-mail" onclick="$('input[name*=\'m_check\']').attr('checked', this.checked);" class="magic-checkbox" type="checkbox">
                                                            <label for="select-all-mail">Select All</label>
                                                        </label>

                                                    </div>
                                                    <a role="button" data-url="<?= base_url('apanel/gallery/g_delete') ?>" id="galleryTrash" class="btn btn-danger"><i class="demo-pli-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mFilter toolbar-right">
                                                <!--Pager buttons-->
                                                <span class="text-main mail_count"></span>
                                                <div class="btn-group btn-group">
                                                    <button class="btn btn-default pN btn_prev" type="button">
                                                        <i class="demo-psi-arrow-left"></i>
                                                    </button>
                                                    <button class="btn btn-default pB btn_next" type="button">
                                                        <i class="demo-psi-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="photos" id="demo-gallery" data-url="<?= base_url('apanel/gallery/fetchGall/') ?>">


                                    </div>


                                </div>
                            </div>
                            <!-- <a href="#">
                                <img alt="The winding road" src="<?= base_url() ?>assets/apanel/img/gallery/thumbs/tile1.jpg" data-image="<?= base_url() ?>assets/apanel/img/gallery/big/tile1.jpg" data-description="The winding road description" style="display:none">
                            </a> -->


                            <div class="col-sm-12 mFilter toolbar-right">
                                <!--Pager buttons-->
                                <span class="text-main mail_count"></span>
                                <div class="btn-group btn-group">
                                    <button class="btn btn-default pN btn_prev" type="button">
                                        <i class="demo-psi-arrow-left"></i>
                                    </button>
                                    <button class="btn btn-default pB btn_next" type="button">
                                        <i class="demo-psi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--===================================================-->
            <!--End page content-->



        <?php

        }
        ?>



    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->