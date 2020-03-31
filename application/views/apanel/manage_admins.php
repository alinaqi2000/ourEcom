    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">



        <?php

        if ($mode == 'edit' || $mode == 'add') {

            if ($mode == 'edit') {
                $admin_data = unserialize(urldecode($row->site_admin_data));
                stripcslashes($admin_data);
            }
        ?>


            <div id="page-head">

                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><?= ($mode == 'edit') ? $row->admin_name : 'Add New'; ?></h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <?php

                if ($mode == 'edit') {
                    echo getBredcrum(array(base_url(ADMIN) . '/manage_admins' => 'Admins', '#' => $admin_data['admin_name']));
                } else {
                    echo getBredcrum(array(base_url(ADMIN) . '/manage_admins' => 'Admins', '#' => 'Add'));
                }
                ?>

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
                        <form action="" id="form1" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="col-sm-8">
                                <div class="col-sm-12">


                                    <div class="form-group">
                                        <?= formText('Admin Name', 'admin_name', $admin_data['admin_name']); ?>
                                        <?= formText('Admin Username', 'site_login', $row->site_login); ?>
                                        <label for="field">Admin Type</label>
                                        <select name="site_type" id="p_menu" class="form-control">
                                            <option value="super_admin" <?= ($row->site_type == 'super_admin' ? 'selected="selected"' : ''); ?>>Super</option>
                                            <option value="local_admin" <?= ($row->site_type == 'local_admin' ? 'selected="selected"' : ''); ?>>Local</option>
                                        </select>
                                    </div>
                                    <?= formText('Admin Portfolio', 'admin_portfolio', $admin_data['admin_portfolio']); ?>
                                    <?= formTextArea('Admin Description Text', 'admin_text', $admin_data['admin_text']); ?>
                                </div>
                                <?php
                                if ($mode == 'edit') {
                                ?>
                                    <div class="form-group">
                                        <label for="Change Password">Change Password</label>
                                        <input type="checkbox" id="cPass">
                                    </div>
                                    <div id="cPassDiv" style="display: none">
                                        <?php echo formText('Admin Password (displayed in md5())', 'site_pswd', $row->site_pswd); ?>

                                    </div>
                                <?php
                                } else {
                                    formText('Admin Password', 'site_pswd', $row->site_pswd);
                                }
                                ?>
                                <?= formImageFile('Admin Avatar', 'admin_image', $admin_data['admin_image'], '64 x 64px', 'apanel/admin', 'hasGallery', 'hasRemove') ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="ti-save"></i> Save</button>
                                    &nbsp; <a href="<?= base_url(ADMIN) . '/manage_admins' ?>" class="btn btn-default"> <i class="ti-left-arrow"></i> Cancel</a>
                                </div>
                            </div>

                            <input type="text" id="passY" name="passY" value="0" style="display: none">
                        </form>
                        <!--===================================================-->
                        <!-- End Inline Form  -->


                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!--End page content-->
            <script>
                $(document).ready(function() {
                    $(document.body).on("click", "#cPass", function() {
                        if ($(this).is(':checked')) {
                            $('#cPassDiv').show();
                            $('#passY').val('1');
                        } else {
                            $('#cPassDiv').hide();
                            $('#passY').val('0');
                        }
                    });
                });
            </script>
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
        <?php
        } else {
        ?>


            <div id="page-head">

                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Manage Admins</h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

            </div>


            <!--Page content-->
            <!--===================================================-->
            <!-- <div id="page-content">




                <div class="panel">
                   
                    <div class="panel-body">


                       

                        <div class="pad-btm form-inline">
                            <div class="row">
                                <div class="col-sm-6 table-toolbar-left">
                                    <a href="<?= base_url('apanel/manage_admins/add') ?>" id="demo-btn-addrow" class="btn btn-primary"><i class="demo-pli-add"></i> Add</a>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tableAdmins" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Portfolio</th>
                                        <th width="15%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $page_name = $this->uri->segment(2);
                                    $pager = $this->input->get('pager');
                                    $paging = getPagingSm("tbl_siteadmin", 'site_id <> 1', '', 1, $page_name, '?', 1, '', 'next', 'previous');

                                    if (count($paging[0]) > 0) {

                                        foreach ($paging[0] as $row) {
                                            $admin_id = $row->site_id;

                                            $site_admin_data = unserialize($row->site_admin_data);
                                            $admin_name = $site_admin_data['admin_name'];
                                    ?>
                                            <tr class="odd gradeX">
                                                <td><?= stripslashes($site_admin_data['admin_name']); ?></td>
                                                <td><strong><?= (stripslashes($row->site_type) == 'super_admin') ? 'Super Admin' : 'Local Admin'; ?></strong></td>
                                                <td><?= stripslashes($site_admin_data['admin_portfolio']); ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url(ADMIN) . '/manage_admins/edit/' . $admin_id ?>" class=" btn btn-sm btn-warning"> <i class="fa fa-edit"></i>Edit</a>
                                                    <a href="<?= base_url(ADMIN) . '/admin_delete/' . $admin_id ?>" class=" btn btn-sm btn-danger" onclick="return confirm('Are you sure, you want to delete <?= $admin_name ?> ?')"> <i class="ti-trash"></i>Delete</a>
                                                </td>
                                            </tr>
                                            <tr><?= $paging[1] ?></tr>
                                        <?
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7" align="center">No Record Found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                    

                </div>
                <h1 id="yes"></h1>



            </div> -->
            <!--===================================================-->
            <!--End page content-->

            <div id="page-content">

                <!-- Contact Toolbar -->
                <!---------------------------------->
                <div class="row pad-btm">
                    <div class="col-sm-6 toolbar-left">
                        <a href="<?= base_url('apanel/manage_admins/add') ?>" id="demo-btn-addrow" class="btn btn-primary"><i class="demo-pli-add"></i> Add</a>
                    </div>
                </div>
                <!---------------------------------->


                <div class="row">
                    <?php
                    $page_name = $this->uri->segment(2);
                    $pager = $this->input->get('pager');
                    $paging = getPagingSm("tbl_siteadmin", 'site_id <> 1', '', 8, $page_name, '?', $pager, '', 'next', 'previous');

                    if (count($paging[0]) > 0) {

                        foreach ($paging[0] as $row) {
                            $admin_id = $row->site_id;

                            $site_admin_data = unserialize($row->site_admin_data);
                            $admin_name = $site_admin_data['admin_name'];
                    ?>

                            <div class="col-sm-4 col-md-3">


                                <!-- Contact Widget -->
                                <!---------------------------------->
                                <div class="panel pos-rel">
                                    <div class="pad-all text-center">
                                        <div class="widget-control">
                                            <a role="button" class="add-tooltip btn btn-trans" data-original-title="<?= $row->site_type != 'super_admin' ? 'Local Admin' : 'Super Admin';  ?>"><span class="<?= $row->site_type != 'super_admin' ? 'unfavorite-color' : 'favorite-color';  ?>"><i class="demo-psi-star icon-lg"></i></span></a>
                                            <div class="btn-group dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="">
                                                    <li><a href="<?= base_url(ADMIN) . '/manage_admins/edit/' . $admin_id ?>"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>
                                                    <li><a type="button" onclick="bootbox.confirm('Are you sure, you want to delete <?= $admin_name ?> ?',function(result){ if(result){ return location.replace('<?= base_url(ADMIN) ?>/admin_delete/<?= $admin_id ?>'); } })"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
                                                    <!-- <li class="divider"></li>
                                                    <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i> Send a Message</a></li>
                                                    <li><a href="#"><i class="icon-lg icon-fw demo-pli-calendar-4"></i> View Details</a></li>
                                                    <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock</a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- <a href="#"> -->
                                        <?php
                                        if (!empty($site_admin_data['admin_image'])) {
                                        ?>
                                            <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?= base_url("uploads/apanel/admin/") . $site_admin_data["admin_image"] ?>">
                                        <?php
                                        } else {
                                        ?>
                                            <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?= base_url("assets/" . ADMIN . "/user.png") ?>">

                                        <?php
                                        }
                                        ?>

                                        <p class="text-lg text-semibold mar-no text-main"><?= $admin_name ?></p>
                                        <p class="text-sm"><?= $site_admin_data['admin_portfolio'] ?></p>
                                        <?php
                                        if (!empty($site_admin_data['admin_text'])) {
                                        ?>
                                            <p class="text-sm"><?= $site_admin_data['admin_text'] ?></p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="text-sm">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean massa.</p>
                                        <?php
                                        }
                                        ?>

                                        <!-- </a> -->
                                        <!-- <div class="pad-top btn-groups">
                                            <a href="#" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
                                            <a href="#" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
                                            <a href="#" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"></a>
                                            <a href="#" class="btn btn-icon demo-pli-instagram icon-lg add-tooltip" data-original-title="Instagram" data-container="body"></a>
                                        </div> -->
                                    </div>
                                </div>
                                <!---------------------------------->


                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="col-md-12"><?= $paging[1] ?></div>

                </div>


            </div>



        <?php

        }
        ?>



    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->