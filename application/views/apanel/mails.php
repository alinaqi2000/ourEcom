<div id="content-container">
    <div id="page-head">
    </div>


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">

        <!-- MAIL INBOX -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-body">
                <div class="fixed-fluid">
                    <div class="fixed-sm-200 pull-sm-left fixed-right-border">

                        <div class="pad-btm bord-btm">
                            <a href="<?= base_url(ADMIN . '/compose') ?>" class="btn btn-block btn-success">Compose Mail</a>
                        </div>

                        <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Folders</p>
                        <div class="list-group bg-trans pad-btm bord-btm">
                            <a href="<?= base_url(ADMIN . '/inbox') ?>" class="list-group-item mail-nav-unread">
                                <i class="demo-pli-mail-unread icon-lg icon-fw"></i> <span id="tMails"></span>
                            </a>
                            <!-- <a href="#" class="list-group-item">
                                <i class="demo-pli-pen-5 icon-lg icon-fw"></i> Draft
                            </a> -->
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-mail-send icon-lg icon-fw"></i> Sent
                            </a>
                            <!-- <a href="#" class="list-group-item mail-nav-unread">
                                <i class="demo-pli-fire-flame-2 icon-lg icon-fw"></i> Spam (5)
                            </a> -->
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-trash icon-lg icon-fw"></i> Trash
                            </a>
                        </div>

                        <div class="list-group bg-trans">
                            <a href="#" class="list-group-item"><i class="demo-pli-male-female icon-lg icon-fw"></i> Address Book</a>
                            <a href="#" class="list-group-item"><i class="demo-pli-folder-with-document icon-lg icon-fw"></i> User Folders</a>
                        </div>

                        <!-- Friends -->
                        <div class="list-group bg-trans pad-ver bord-ver">
                            <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Friends</p>

                            <!-- Menu list item -->
                            <a href="#" class="list-group-item list-item-sm">
                                <span class="badge badge-purple badge-icon badge-fw pull-left"></span>
                                Joey K. Greyson
                            </a>
                            <a href="#" class="list-group-item list-item-sm">
                                <span class="badge badge-info badge-icon badge-fw pull-left"></span>
                                Andrea Branden
                            </a>
                            <a href="#" class="list-group-item list-item-sm">
                                <span class="badge badge-pink badge-icon badge-fw pull-left"></span>
                                Lucy Moon
                            </a>
                            <a href="#" class="list-group-item list-item-sm">
                                <span class="badge badge-success badge-icon badge-fw pull-left"></span>
                                Johny Juan
                            </a>
                            <a href="#" class="list-group-item list-item-sm">
                                <span class="badge badge-danger badge-icon badge-fw pull-left"></span>
                                Susan Sun
                            </a>
                        </div>



                    </div>
                    <?php
                    if ($mode == 'compose') {
                    ?>
                        <link href="<?= base_url('assets/' . ADMIN) ?>/plugins/summernote/summernote.min.css" rel="stylesheet">

                        <div class="fluid">
                            <!-- COMPOSE EMAIL -->
                            <!--===================================================-->

                            <!-- <div class="pad-btm clearfix">
                                <div class="pull-right pad-btm">
                                    <div class="btn-group">
                                        <button id="demo-toggle-cc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info">Cc</button>
                                        <button id="demo-toggle-bcc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info">Bcc</button>
                                    </div>
                                </div>
                            </div> -->



                            <!--Input form-->
                            <form method="post" id="mailForm" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-lg-1 control-label text-left" for="inputEmail">To</label>
                                    <div class="col-lg-11">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ion-at"></i></span>
                                            <input type="text" autocomplete="off" name="m_recipient" id="inputName" data-url="<?= base_url(ADMIN . '/mails/getAdmins') ?>" class="form-control">
                                        </div>
                                        <div id="loadAdmins"></div>

                                    </div>
                                </div>
                                <!-- <div id="demo-cc-input" class="hide form-group">
                                    <label class="col-lg-1 control-label text-left" for="inputCc">Cc</label>
                                    <div class="col-lg-11">
                                        <input type="text" id="inputCc" class="form-control">
                                    </div>
                                </div>
                                <div id="demo-bcc-input" class="hide form-group">
                                    <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
                                    <div class="col-lg-11">
                                        <input type="text" id="inputBcc" class="form-control">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
                                    <div class="col-lg-11">
                                        <input type="text" id="inputSubject" name="m_subject" class="form-control">
                                    </div>
                                </div>
                            </form>


                            <!--Attact file button-->
                            <!--                    <div class="media pad-btm">
					                        <div class="media-left">
					                            <span class="btn btn-default btn-file">
					                            Attachment <input type="file">
					                        </span>
					                        </div>
					                        <div id="demo-attach-file" class="media-body"></div>
					                    </div>-->


                            <!--Wysiwyg editor : Summernote placeholder-->
                            <textarea id="demo-mail-compose" name="inputContent" style="display: none;"></textarea>


                            <div class="pad-ver">

                                <!--Send button-->
                                <button id="mailSend" data-url="<?= base_url(ADMIN . '/mails/sendMail') ?>" type="submit" class="btn btn-primary">
                                    <i class="demo-psi-mail-send icon-lg icon-fw"></i> Send Mail
                                </button>

                                <!--Save draft button-->
                                <!-- <button id="mail-save-btn" type="button" class="btn btn-default">
                                    <i class="demo-pli-mail-unread icon-lg icon-fw"></i> Save Draft
                                </button> -->

                                <!--Discard button-->
                                <!-- <button id="mail-discard-btn" type="button" class="btn btn-default">
                                    <i class="demo-pli-mail-remove icon-lg icon-fw"></i> Discard
                                </button> -->
                            </div>


                            <!--===================================================-->
                            <!-- END COMPOSE EMAIL -->
                        </div>
                        <script>
                            $(document).on('nifty.ready', function() {




                                // MAILBOX-COMPOSE.HTML
                                // =================================================================

                                if ($('#demo-mail-compose').length) {


                                    // SUMMERNOTE
                                    // =================================================================
                                    // Require Summernote
                                    // http://hackerwins.github.io/summernote/
                                    // =================================================================
                                    $('#demo-mail-compose').summernote({
                                        height: 500
                                    });


                                    // Show The CC Input Field
                                    // =================================================================
                                    $('#demo-toggle-cc').on('click', function() {
                                        $('#demo-cc-input').toggleClass('hide');
                                    });



                                    // Show The BCC Input Field
                                    // =================================================================
                                    $('#demo-toggle-bcc').on('click', function() {
                                        $('#demo-bcc-input').toggleClass('hide');
                                    });



                                    // Attachment button.
                                    // =================================================================
                                    $('.btn-file :file').on('fileselect', function(event, numFiles, label, fileSize) {
                                        $('#demo-attach-file').html('<strong class="box-block text-capitalize"><i class="fa fa-paperclip fa-fw"></i> ' + label + '</strong><small class="text-muted">' + fileSize + '</small>');
                                    });


                                    return;
                                }





                                // MAILBOX-MESSAGE.HTML
                                // =================================================================

                                // SUMMERNOTE
                                // =================================================================
                                // Require Summernote
                                // http://hackerwins.github.io/summernote/
                                // =================================================================
                                if ($('#demo-mail-textarea').length) {
                                    $('#demo-mail-textarea').on('click', function() {
                                        $(this).empty().summernote({
                                            height: 300,
                                            focus: true
                                        });
                                        $('#demo-mail-send-btn').removeClass('hide');
                                    });
                                    return;
                                }





                            });
                        </script>
                        <script src="<?= base_url('assets/' . ADMIN) ?>/plugins/summernote/summernote.min.js"></script>
                    <?php
                    } else {
                    ?>
                        <div class="fluid">
                            <div id="demo-email-list">
                                <div class="row">
                                    <div class="col-sm-7 toolbar-left">

                                        <!-- Mail toolbar -->
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                        <!--Split button dropdowns-->
                                        <div class="btn-group">
                                            <label id="demo-checked-all-mail" for="select-all-mail" class="btn btn-default">
                                                <input id="select-all-mail" class="magic-checkbox" type="checkbox">
                                                <label for="select-all-mail"></label>
                                            </label>
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="dropdown-caret"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" id="demo-select-all-list">All</a></li>
                                                <li><a href="#" id="demo-select-none-list">None</a></li>
                                                <li><a href="#" id="demo-select-toggle-list">Toggle</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" id="demo-select-read-list">Read</a></li>
                                                <li><a href="#" id="demo-select-unread-list">Unread</a></li>
                                                <li><a href="#" id="demo-select-starred-list">Starred</a></li>
                                            </ul>
                                        </div>

                                        <!--Refresh button-->
                                        <button id="demo-mail-ref-btn" onclick="fetchMails()" data-toggle="panel-overlay" data-target="#demo-email-list" class="btn btn-default" type="button">
                                            <i class="demo-psi-repeat-2"></i>
                                        </button>

                                        <!--Dropdown button (More Action)-->
                                        <div class="btn-group dropdown">
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                                More <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Mark as read</a></li>
                                                <li><a href="#">Mark as unread</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Star</a></li>
                                                <li><a href="#">Clear Star</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 toolbar-right">
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

                                <!--Mail list group-->
                                <ul id="demo-mail-list" class="mail-list pad-top bord-top">





                                </ul>
                            </div>


                            <!--Mail footer-->
                            <div class="panel-footer clearfix">
                                <div class="pull-right">
                                    <span class="text-main mail_count"></span>
                                    <div class="btn-group btn-group">
                                        <button type="button" class="btn btn_prev pN btn-default">
                                            <i class="demo-psi-arrow-left"></i>
                                        </button>
                                        <button type="button" class="btn btn_next pB btn-default">
                                            <i class="demo-psi-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--===================================================-->
        <!-- END OF MAIL INBOX -->


    </div>
    <!--===================================================-->
    <!--End page content-->

</div>
<script type="text/javascript" language="javascript">
    $(document.body).ready(function() {
        var c_page = 0;
        var n_page = 2;
        // var d_class = 0;
        var d_class = "disabled";
        var n_class = "btn_next";
        var p_class = "btn_prev";

        function fetchMails(page) {


            $.ajax({
                method: "POST",
                url: "<?= base_url('apanel/mails/fetchMails/') ?>" + page,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    $("#demo-mail-list").html(response['data']);
                    $(".mail_count").html("<strong>" + response['n_count'] + "-" + response['a_count'] + "</strong> of <strong>" + response['t_count'] + "</strong>");
                    c_page = response['p_nxt'];
                    n_page = response['m_nxt'];
                    $("#tMails").html("Inbox (" + response['t_count'] + ")");

                    if (response['a_count'] >= response['t_count']) {
                        $(".pB").addClass(d_class).removeClass(n_class);
                    } else {
                        $(".pB").addClass(n_class).removeClass(d_class);
                    }
                    if (response['n_count'] == 1) {
                        $(".pN").addClass(d_class).removeClass(p_class);

                    } else {
                        $(".pN").removeClass(d_class).addClass(p_class);
                    }

                },
                error: function() {
                    $('#loadAdmins').fadeOut(250);
                }

            });
        }

        fetchMails(1);
        $(document.body).on("click", "#demo-mail-ref-btn", function() {
            fetchMails(1);
        });
        $(document.body).on("click", ".btn_next", function() {
            fetchMails(c_page);
        });
        $(document.body).on("click", ".btn_prev", function() {
            fetchMails(n_page);
        });
    });
</script>