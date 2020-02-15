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
                    <h1 class="page-header text-overflow"><?= ($mode == 'edit') ? $row->cat_title : 'Add New'; ?></h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <?php

                if ($mode == 'edit') {
                    echo getBredcrum(array(base_url(ADMIN) . '/categories' => 'Categories', '#' => $row->cat_slug));
                } else {
                    echo getBredcrum(array(base_url(ADMIN) . '/categories' => 'Categories', '#' => 'Add'));
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
                       
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form action="" id="form1" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="col-sm-8 col-sm-offset-1">
                                <?php if ($mode == 'edit') { ?>
                                    <?= formText('Name/Slug', 'cat_slug', $row->cat_slug) ?>
                                <?php } ?>
                                <?= formText('Title', 'cat_title', $row->cat_title, 'required') ?>
                                <?= formText('Custom Link (optional)', 'cat_link', $row->cat_link) ?>

                                <div class="form-group">
                                    <label for="field">Category Type</label>
                                    <select name="cat_type" id="cat_type" class="form-control">
                                        <option value="0" <?= ($row->cat_type == '0' ? 'selected="selected"' : ''); ?>>Level 1</option>
                                        <option value="1" <?= ($row->cat_type == '1' ? 'selected="selected"' : ''); ?>>Level 2</option>
                                        <option value="2" <?= ($row->cat_type == '2' ? 'selected="selected"' : ''); ?>>Level 3</option>
                                    </select>
                                </div>
                                <div class="form-group" id="cat_parent1_box" style="<?= ($row->cat_type == '1' || $row->cat_type == '2' ? '' : 'display:none'); ?>">
                                    <label for="field">Level 1 Categories</label>
                                    <select name="cat_parent1" id="cat_parent1" class="form-control">
                                        <option value="0">No Parent</option>
                                        <?php
                                        if (count($res1) > 0) {
                                            foreach ($res1 as $rs) {
                                                if ($rs->cat_id != $this->uri->segment(4)) {
                                        ?><option value="<?= $rs->cat_id; ?>" <?= ($row->cat_parent1 == $rs->cat_id ? 'selected="selected"' : ''); ?>><?= stripcslashes($rs->cat_title); ?></option>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="cat_parent2_box" style="<?= ($row->cat_type == '1' ? '' : 'display:none'); ?>">
                                    <label for="field">Level 2 Categories</label>
                                    <select name="cat_parent2" id="cat_parent2" class="form-control">
                                        <option value="0">No Parent</option>
                                        <?php
                                        if (count($res2) > 0) {
                                            foreach ($res2 as $rs) {
                                                if ($rs->cat_id != $this->uri->segment(4)) {
                                        ?><option value="<?= $rs->cat_id; ?>" <?= ($row->cat_parent2 == $rs->cat_id ? 'selected="selected"' : ''); ?>><?= stripcslashes($rs->cat_title); ?></option>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group" id="cat_icon" style="<?= ($row->cat_type == '0' || empty($row->cat_type) ? '' : 'display:none'); ?>">
                                    <label for="field">Category Icon (eg.icon-shirt)</label>
                                    <input type="text" name="cat_icon" value="<?= $row->cat_icon ?>" class="form-control" placeholder="Category Icon">
                                </div>
                                <div class="form-group">
                                    <label for="field">Show in menu</label>
                                    <select name="cat_menu" id="cat_menu" class="form-control">
                                        <option value="0" <?= ($row->cat_menu == '0' ? 'selected="selected"' : ''); ?>>No</option>
                                        <option value="1" <?= ($row->cat_menu == '1' ? 'selected="selected"' : ''); ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field">Feature</label>
                                    <select name="cat_label" id="cat_label" class="form-control">
                                        <option value="0" <?= ($row->cat_label == '0' ? 'selected="selected"' : ''); ?>>Not Featured</option>
                                        <option value="1" <?= ($row->cat_label == '1' ? 'selected="selected"' : ''); ?>>Featured</option>
                                        <option value="2" <?= ($row->cat_label == '2' ? 'selected="selected"' : ''); ?>>Rare</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field">Status</label>
                                    <select name="cat_status" id="cat_status" class="form-control">
                                        <option value="1" <?= ($row->cat_status == '1' ? 'selected="selected"' : ''); ?>>Active</option>
                                        <option value="0" <?= ($row->cat_status == '0' ? 'selected="selected"' : ''); ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="pe-7s-diskette"></i> Save</button>
                                    &nbsp; <a href="<?= base_url(ADMIN) . '/categories' ?>" class=" btn btn-default"> <i class="pe-7s-left-arrow"></i> Cancel</a>
                                </div>
                            </div>


                        </form>
                        <!--===================================================-->
                        <!-- End Inline Form  -->

                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!--End page content-->
            <script src="<?= base_url('assets/' . ADMIN . '/lib/') ?>ckeditor/ckeditor.js"></script>
            <script type="text/javascript" language="javascript">
                CKEDITOR.replace('ckeditors1');

                $(document).ready(function() {


                    $(document).on('change', '#cat_type', function() {
                        var $this = $(this).val();
                        if ($this == '1') {
                            $('#cat_parent_input').show();
                        } else {
                            $('#cat_parent_input').hide();
                        }
                    });
                    $('.orders').click(function() {


                        $('.txtedit').hide();


                        $(this).next('.txtedit').show().focus();


                        $(this).hide();
                    });


                    $('.txtedit').focusout(function() {

                        var edit_id = $(this).data('id');
                        var fieldname = $(this).data('order');
                        var value = $(this).val();


                        $(this).hide();

                        $(this).prev('.orders').show();
                        $(this).prev('.orders').text(value);


                        $.ajax({
                            url: '<?= base_url() ?>apanel/categories/updateOrder',
                            method: 'POST',
                            data: {
                                cat_order: fieldname,
                                value: value,
                                cat_id: edit_id
                            },
                            success: function(response) {
                                console.log(response);

                            }
                        });
                    });
                    $(document).on('change', '#cat_type', function() {
                        var $this = $(this).val();
                        if ($this == '1') {
                            $('#cat_parent1_box').show();
                            $('#cat_parent2_box').hide();
                            $('#cat_icon').hide();
                        } else if ($this == '2') {
                            $('#cat_parent1_box').show();
                            $('#cat_parent2_box').show();
                            $('#cat_icon').hide();
                        } else {
                            $('#cat_icon').show();
                            $('#cat_parent1_box').hide();
                            $('#cat_parent2_box').hide();

                        }
                    });



                });
            </script>

        <?php
        } else {
        ?>


            <div id="page-head">

                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Manage Categories</h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <?php echo getBredcrum(array('#' => 'Categories')); ?>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

            </div>


            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">




                <div class="panel">
                    <!--Data Table-->
                    <!--===================================================-->
                    <div class="panel-body">

                      

                        <div class="pad-btm form-inline">
                            <div class="row">
                                <div class="col-sm-6 table-toolbar-left">
                                    <a href="<?= base_url('apanel/categories/add') ?>" id="demo-btn-addrow" class="btn btn-primary"><i class="demo-pli-add"></i> Add</a>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tableCategories" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">ID#</th>
                                        <th>Title</th>
                                        <th>Level 1 Parent</th>
                                        <th>Level 2 Parent</th>
                                        <th width="5%">Orders</th>
                                        <th width="14%">Featured</th>
                                        <th width="8%">Status</th>
                                        <th width="15%">Action</th>

                                    </tr>
                                </thead>


                            </table>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End Data Table-->

                </div>
<h1 id="yes"></h1>



            </div>
            <!--===================================================-->
            <!--End page content-->
            <script type="text/javascript" language="javascript">
                $(document).ready(function() {

                    var dataTable = $('#tableCategories').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "<?= base_url(ADMIN . '/categories/fetchCategories'); ?>",
                            type: "POST"
                        },
                        "columnDefs": [{
                            "targets": [7],
                            "orderable": false,
                        }, ],
                    });



                });
            </script>
        <?php

        }
        ?>



    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->