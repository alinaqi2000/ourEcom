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
                    <h1 class="page-header text-overflow"><?= ($mode == 'edit') ? $row->page_title : 'Add New'; ?></h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <?php

                if ($mode == 'edit') {
                    echo getBredcrum(array(base_url(ADMIN) . '/pages' => 'Pages', '#' => $row->page_name));
                } else {
                    echo getBredcrum(array(base_url(ADMIN) . '/pages' => 'Pages', '#' => 'Add'));
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
                        <form class="form-inline" method="POST" enctype="multipart/form-data">
                            <div class="col-sm-8 float-left">
                                <?php if ($mode == 'edit') { ?>
                                    <?= formText('Name/Slug', 'page_name', $row->page_name) ?>
                                <?php } ?>
                                <?= formText('Title', 'page_title', $row->page_title, 'required') ?>
                                <?= formText('Meta Title', 'page_meta_title', $row->page_meta_title, 'required') ?>
                                <?= formText('Custom Link(optional)', 'page_link', $row->page_link) ?>
                                <?= formTextArea('Meta Description', 'page_meta_desc', $row->page_meta_desc, 5) ?>
                            </div>
                            <div class="col-sm-4 float-left">
                                <div class="form-group">
                                    <label for="field">Page Type</label>
                                    <select name="page_type" id="page_type" class="form-control">
                                        <option value="0" <?= ($row->page_type == '0' ? 'selected="selected"' : ''); ?>>Parent</option>
                                        <option value="1" <?= ($row->page_type == '1' ? 'selected="selected"' : ''); ?>>Sub</option>
                                    </select>
                                </div>
                                <div class="form-group" id="page_parent_input" style="<?= ($row->page_type == '1' ? '' : 'display:none'); ?>">
                                    <label for="field">Parent Page</label>
                                    <select name="page_parent" id="page_parent" class="form-control">
                                        <option value="0">No Parent</option>
                                        <?php
                                        if (count($res) > 0) {
                                            foreach ($res as $rs) {
                                                if ($rs->page_id != $this->uri->segment(4)) {
                                        ?><option value="<?= $rs->page_id; ?>" <?= ($row->page_parent == $rs->page_id ? 'selected="selected"' : ''); ?>><?= $rs->page_title; ?></option><?php
                                                                                                                                                                                    }
                                                                                                                                                                                }
                                                                                                                                                                            }
                                                                                                                                                                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field">Show in Menu</label>
                                    <select name="page_menu" id="page_menu" class="form-control">
                                        <option value="0" <?= ($row->page_menu == '0' ? 'selected="selected"' : ''); ?>>No</option>
                                        <option value="1" <?= ($row->page_menu == '1' ? 'selected="selected"' : ''); ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field">Featured</label>
                                    <select name="page_label" id="page_label" class="form-control">
                                        <option value="0" <?= ($row->page_label == '0' ? 'selected="selected"' : ''); ?>>Not Featured</option>
                                        <option value="1" <?= ($row->page_label == '1' ? 'selected="selected"' : ''); ?>>Featured</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field">Status</label>
                                    <select name="page_status" id="page_status" class="form-control">
                                        <option value="1" <?= ($row->page_status == '1' ? 'selected="selected"' : ''); ?>>Active</option>
                                        <option value="0" <?= ($row->page_status == '0' ? 'selected="selected"' : ''); ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center float-left">
                                <div class="form-group" style="margin-bottom:35px;">
                                    <label for="field">Page Detail</label>
                                    <textarea cols="80" id="ckeditors1" name="page_detail" value='<?= $row->page_detail ?>' rows="30"><?= $row->page_detail ?></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="pe-7s-diskette"></i> Save</button>
                                    &nbsp; <a href="<?= base_url(ADMIN) . '/pages' ?>" class=" btn btn-default"> <i class="pe-7s-left-arrow"></i> Cancel</a>
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


                    $(document).on('change', '#page_type', function() {
                        var $this = $(this).val();
                        if ($this == '1') {
                            $('#page_parent_input').show();
                        } else {
                            $('#page_parent_input').hide();
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
                    <h1 class="page-header text-overflow">Manage Pages</h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <?php echo getBredcrum(array('#' => 'Pages')); ?>
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
                                    <a href="<?= base_url('apanel/pages/add') ?>" id="demo-btn-addrow" class="btn btn-primary"><i class="demo-pli-add"></i> Add</a>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tablePages" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">ID#</th>
                                        <th>Title</th>
                                        <th>Parent Page</th>
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




            </div>
            <!--===================================================-->
            <!--End page content-->
            <script type="text/javascript" language="javascript">
                $(document).ready(function() {

                    var dataTable = $('#tablePages').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "<?= base_url(ADMIN . '/pages/fetchPages'); ?>",
                            type: "POST"
                        },
                        "columnDefs": [{
                            "targets": [3, 4],
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