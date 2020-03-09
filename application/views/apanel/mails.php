<div id="content-container">
    <div id="page-head">
    </div>


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">

        <!-- MAIL INBOX -->
        <!--===================================================-->
        <?php
        if ($mode == 'sent') {
        ?>
            <!--Mail list group-->
            <div class="panel" id="typeMails" data-url="<?= base_url('apanel/mails/fetchSents/') ?>">
            <?php
        } else {
            ?>
                <div class="panel" id="typeMails" data-url="<?= base_url('apanel/mails/fetchMails/') ?>">
                <?php
            }
                ?>
                <div class="panel-body">
                    <div class="fixed-fluid">
                        <div class="fixed-sm-200 pull-sm-left fixed-right-border">

                            <div class="pad-btm bord-btm">
                                <a href="<?= base_url(ADMIN . '/compose') ?>" class="btn btn-block btn-primary"><i class="fa fa-paper-plane"></i> Compose Mail</a>
                            </div>

                            <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Folders</p>
                            <div class="list-group bg-trans pad-btm bord-btm">
                                <a href="<?= base_url(ADMIN . '/inbox') ?>" id="t_MAislUnRead" class="list-group-item">
                                    <i class="demo-pli-mail-unread icon-lg icon-fw"></i> <span id="tMails"></span>
                                </a>
                                <!-- <a href="#" class="list-group-item">
                                <i class="demo-pli-pen-5 icon-lg icon-fw"></i> Draft
                            </a> -->
                                <a href="<?= base_url(ADMIN . '/sent') ?>" class="list-group-item">
                                    <i class="demo-pli-mail-send icon-lg icon-fw"></i> <span id="tSents">Sent</span>
                                </a>
                                <!-- <a href="#" class="list-group-item mail-nav-unread">
                                <i class="demo-pli-fire-flame-2 icon-lg icon-fw"></i> Spam (5)
                            </a> -->
                                <?php
                                if ($mode != 'read' && $mode != 'compose') {
                                ?>
                                    <a type="button" id="mailTrash" data-url="<?php echo base_url(); ?>apanel/mails/m_delete" class="list-group-item">
                                        <i class="demo-pli-trash icon-lg icon-fw"></i> Delete
                                    </a>
                                <?php
                                }
                                ?>
                            </div>

                            <!-- <div class="list-group bg-trans">
                            <a href="#" class="list-group-item"><i class="demo-pli-male-female icon-lg icon-fw"></i> Address Book</a>
                            <a href="#" class="list-group-item"><i class="demo-pli-folder-with-document icon-lg icon-fw"></i> User Folders</a>
                        </div> -->

                            <!-- Friends -->
                            <!-- <div class="list-group bg-trans pad-ver bord-ver">
                            <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Friends</p>

                            
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
                        </div> -->



                        </div>
                        <?php
                        if ($mode == 'compose') {
                        ?>
                            <link href="<?= base_url('assets/' . ADMIN) ?>/plugins/summernote/summernote.min.css" rel="stylesheet">

                            <div class="fluid">
                                <!-- COMPOSE EMAIL -->
                                <!--===================================================-->

                                <div class="pad-btm clearfix">
                                    <div class="pull-right pad-btm">
                                        <div class="btn-group">
                                            <button id="demo-toggle-cc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info">#Tags</button>
                                            <button id="demo-toggle-bcc" data-toggle="button" type="button" class="btn btn-sm btn-default btn-active-info"><i class="demo-psi-paperclip icon-lg icon-fw"></i></button>
                                        </div>
                                    </div>
                                </div>



                                <!--Input form-->
                                <form method="post" id="mailForm" enctype="multipart/form-data" class="form-horizontal">
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
                                    <div class="form-group">
                                        <label class="col-lg-1 control-label text-left" for="inputSubject">Subject</label>
                                        <div class="col-lg-11">
                                            <input type="text" id="inputSubject" name="m_subject" class="form-control">
                                        </div>
                                    </div>
                                    <div id="demo-cc-input" class="hide form-group">
                                        <label class="col-lg-1 control-label text-left" for="tagsinput">#Tags</label>
                                        <div class="col-lg-11">
                                            <input type="text" class="form-control" id="tagsinput" name="m_tags" placeholder="Type to add a tag" value="" id="tagsinput" data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div id="demo-bcc-input" class="hide form-group">
                                        <div class="col-lg-2">
                                            <span class="btn btn-primary btn-file"><i class="demo-psi-paperclip"></i> Attachment(s)
                                                <input type="file" id="inputAttach" size="50" name="m_attachs[]" multiple="multiple">
                                            </span>
                                        </div>
                                        <div class="col-lg-10 col-xs-12">
                                            <strong>Supported Formats : </strong> pdf|doc|docx|ppt|pptx|txt|mp4|jpg|png|gif |jpeg|zip|rar|html|php|htm|css|js<br>
                                            <strong>Max size per file: </strong> 2mb
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="fList"></div>
                                        </div>
                                    </div>
                                    <!-- <div id="demo-bcc-input" class="hide form-group">
                                    <label class="col-lg-1 control-label text-left" for="inputBcc">Bcc</label>
                                    <div class="col-lg-11">
                                        <input type="text" id="inputBcc" class="form-control">
                                    </div>
                                </div> -->

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
                                    <span style="margin: 12px;display:none;" id="cond"></span>

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
                                $(document).on('ready', function() {
                                    if ($('#demo-mail-compose').length) {
                                        $('#demo-mail-compose').summernote({
                                            height: 500
                                        });
                                        $('#demo-toggle-cc').on('click', function() {
                                            $('#demo-cc-input').toggleClass('hide');
                                        });
                                        $('#demo-toggle-bcc').on('click', function() {
                                            $('#demo-bcc-input').toggleClass('hide');
                                        });
                                        $('.btn-file :file').on('fileselect', function(event, numFiles, label, fileSize) {
                                            $('#demo-attach-file').html('<strong class="box-block text-capitalize"><i class="fa fa-paperclip fa-fw"></i> ' + label + '</strong><small class="text-muted">' + fileSize + '</small>');
                                        });
                                    }
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
                        } elseif ($mode == 'read') {
                        ?>
                            <div class="fluid">

                                <!-- VIEW MESSAGE -->
                                <!--===================================================-->

                                <div class="mar-btm pad-btm bord-btm">
                                    <h1 class="page-header">
                                        <?php
                                        if (!empty($row->m_tags)) {
                                        ?>

                                            <?php
                                            $m_tags = explode(',', $row->m_tags);
                                            foreach ($m_tags as $tag) {
                                            ?>

                                                <span class="label label-normal label-primary"><?= $tag ?></span>

                                            <?php
                                            }
                                            ?>

                                        <?php
                                        }
                                        ?>



                                        <?php
                                        if (!empty($row->m_subject)) {
                                        ?>
                                            <?= $row->m_subject ?>

                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($readType == 'sent') {
                                        ?>
                                            <a class="btn pull-right btn-default" href="<?= base_url(ADMIN . '/sent') ?>">
                                                <i class="demo-psi-left-4"></i>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="btn pull-right btn-default" href="<?= base_url(ADMIN . '/inbox') ?>">
                                                <i class="demo-psi-left-4"></i>
                                            </a>
                                        <?php
                                        }
                                        ?>

                                    </h1>

                                </div>

                                <div class="row">
                                    <div class="col-sm-7 toolbar-left">

                                        <!--Sender Information-->
                                        <div class="media">
                                            <span class="media-left">
                                                <?php
                                                $to = "";
                                                if ($readType == 'inbox') {
                                                    $got_author = $row->m_author;
                                                } else {
                                                    $to = "<span>To : </span>";
                                                    $got_author = $row->m_recipient;
                                                }
                                                ?>

                                                <?php
                                                if (!empty(getRecipientImage($got_author))) {
                                                ?>
                                                    <img src="<?= base_url('uploads/' . ADMIN . '/admin/') . getRecipientImage($got_author) ?>" class="img-circle img-sm" alt="Profile Picture">

                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?= base_url('assets/' . ADMIN . '/user.png') ?>" class="img-circle img-sm" alt="Profile Picture">

                                                <?php
                                                }
                                                ?>
                                            </span>
                                            <div class="media-body text-left">
                                                <div class="text-bold"><?= $to ?><?= getRecipientName($got_author) ?></div>
                                                <small class="text-muted">@<?= getRecipientUserName($got_author) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 toolbar-right">

                                        <!--Details Information-->
                                        <?php
                                        $m_date = explode(' ', $row->m_date);
                                        ?>
                                        <p class="mar-no"><small class="text-muted"><?= $m_date[0] . ' ' . $m_date[1] . ' ' . $m_date[2] . ' ' . $m_date[3] ?></small></p>
                                        <?php
                                        if (count($attachs) > 0 && $attachs != '') {
                                        ?>
                                            <a href="#attaches">
                                                <i class="demo-psi-paperclip icon-lg icon-fw"></i>
                                                <strong>Attachments (<?= count($attachs) ?>)</strong>
                                            </a>


                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row pad-top">
                                    <div class="col-sm-7 toolbar-left">


                                        <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                        <div class="btn-group btn-group">
                                            <!-- <button class="btn btn-default"><i class="demo-pli-information icon-lg"></i></button> -->
                                            <?php
                                            $infTitle = "Mail Info";
                                            $info = "This mail was sent on " . $row->m_date . ". If you want to delete all it's content then click on remove button.";
                                            ?>
                                            <button class="btn btn-default btn-active-success add-popover" data-toggle="popover" data-container="body" data-placement="bottom" data-original-title="<?= $infTitle ?>" data-content="<?= $info ?>"><i class="demo-pli-information icon-lg"></i></button>
                                            <a type="button" onclick="bootbox.confirm('Are you sure, you want to delete this mail permanently for you?',function(result){ if(result){ return location.replace('<?= base_url(ADMIN) ?>/mails/delete/<?= $row->m_id ?>'); } })" class="btn btn-default"><i class="demo-pli-trash icon-lg"></i> Remove</a>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-5 toolbar-right">
                                   
                                    <div class="btn-group btn-group">
                                        <a class="btn btn-default" href="#">
                                            <i class="demo-psi-left-4"></i>
                                        </a>
                                        <a class="btn btn-default" href="#">
                                            <i class="demo-psi-right-4"></i>
                                        </a>
                                    </div>
                                </div> -->
                                </div>

                                <!--Message-->
                                <!--===================================================-->
                                <div style="background-color: transparent !important;" class="mail-message">
                                    <?php
                                    if (!empty($row->m_content)) {
                                    ?>
                                        <?= $row->m_content  ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <!--===================================================-->
                                <!--End Message-->

                                <!-- Attach Files-->
                                <!--===================================================-->
                                <?php
                                if (count($attachs) > 0 && !empty($attachs)) {
                                ?>
                                    <div id="attaches" class="pad-ver">
                                        <p class="text-main text-bold box-inline"><i class="demo-psi-paperclip icon-fw"></i> Attachments <span>(<?= count($attachs) ?>) - </span></p>
                                        <a href="<?= base_url(ADMIN . '/mails/downloadAll/' . $row->m_author . '/' . $row->m_id) ?>" class="btn-link">Download all in a Zip file</a>

                                        <ul class="mail-attach-list list-ov">
                                            <?php
                                            foreach ($attachs as $attach) {
                                                $attach_type = explode('/', $attach['type']);
                                                $size = '';
                                                $icon = '';
                                                if ($attach['size'] > 1000000) {
                                                    $size =  round($attach['size'] / 1000000, 2) . ' mb(s)';
                                                } elseif ($attach['size'] > 1000 && $attach['size'] < 1000000) {
                                                    $size = round($attach['size'] / 1000, 2) . ' kb(s)';
                                                } else {
                                                    $size = $attach['size']  . ' byte(s)';
                                                }
                                            ?>
                                                <!-- <li>
                                                <a href="#" class="thumbnail">
                                                    <div class="mail-file-img">
                                                        <img class="image-responsive" src="img/bg-img/bg-img-4.jpg" alt="image">
                                                    </div>
                                                    <div class="caption">
                                                        <p class="text-main mar-no">Nature.jpg</p>
                                                        <small class="text-muted">Added: May 01, 2016</small>
                                                    </div>
                                                </a>
                                            </li> -->
                                                <li>
                                                    <div class="thumbnail">
                                                        <?php
                                                        if ($attach_type[1] == 'jpg' || $attach_type[1] == 'jpeg' || $attach_type[1] == 'png' || $attach_type[1] == 'gif') {
                                                        ?>
                                                            <div class="mail-file-img">
                                                                <div style="height: 120px;">
                                                                    <img class="image-responsive" src="<?= base_url('uploads/' . ADMIN . '/mailAttachments/' . $attach['file']) ?>" alt="image">
                                                                </div>
                                                                <div class="ovr_lay"><a href="<?= base_url(ADMIN . '/mails/download/' . $attach['file']) ?>"><i class="demo-pli-download-from-cloud"></i></a></div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                            if ($attach_type[1] == 'html' || $attach_type[1] == 'css'  || $attach_type[1] == 'js') {
                                                                $icon = 'demo-pli-file-html';
                                                            } elseif ($attach_type[1] == 'zip' || $attach_type[1] == 'octet-stream') {
                                                                $icon = 'demo-pli-file-zip';
                                                            } elseif ($attach_type[1] == 'mp3' || $attach_type[1] == 'x-ms-wma') {
                                                                $icon = 'demo-pli-file-music';
                                                            } elseif ($attach_type[1] == 'mp4') {
                                                                $icon = 'demo-pli-video';
                                                            } elseif ($attach_type[1] == 'docx' || $attach_type[1] == 'doc' || $attach_type[1] == 'ppt' || $attach_type[1] == 'pptx') {
                                                                $icon = 'demo-pli-file-word';
                                                            } elseif ($attach_type[1] == 'pdf') {
                                                                $icon = 'demo-pli-file-text-image';
                                                            } elseif ($attach_type[1] == 'txt') {
                                                                $icon = 'demo-pli-file-text';
                                                            } elseif ($attach_type[1] == 'pdf') {
                                                                $icon = 'demo-pli-file-text-image';
                                                            } else {
                                                                $icon = 'demo-pli-file';
                                                            }
                                                        ?>
                                                            <div class="mail-file-icon">
                                                                <i class="fle-icon <?= $icon ?>"></i>
                                                                <div class="ovr_lay"><a href="<?= base_url(ADMIN . '/mails/download/' . $attach['file']) ?>"><i class="demo-pli-download-from-cloud"></i></a></div>

                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="caption">
                                                            <p class="text-main mar-no"><?= $attach['file'] ?></p>
                                                            <small class="text-muted">Size : <?= $size ?></small>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>

                                        </ul>
                                    </div>
                                <?php
                                }
                                ?>
                                <!--===================================================-->
                                <!-- End Attach Files-->


                                <!--Quick reply : Summernote Placeholder -->
                                <!-- <div id="demo-mail-textarea" class="mail-message-reply bg-trans-dark">
                                <strong>Reply</strong> or <strong>Forward</strong> this message...
                            </div> -->

                                <!--Send button-->
                                <!-- <div class="pad-btm">
                                <button id="demo-mail-send-btn" type="button" class="btn btn-primary btn-lg btn-block hide">
                                    <span class="demo-psi-mail-send icon-lg icon-fw"></span>
                                    Send Message
                                </button>
                            </div> -->
                                <!--===================================================-->
                                <!-- END VIEW MESSAGE -->

                            </div>
                        <?php
                        } elseif ($mode == 'inbox' || $mode == 'sent') {
                        ?>
                            <div class="fluid min-400">
                                <div id="demo-email-list">
                                    <div class="row">
                                        <div class="col-sm-7 toolbar-left">

                                            <!-- Mail toolbar -->
                                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                            <!--Split button dropdowns-->
                                            <div class="btn-group mFilter">
                                                <label id="demo-checked-all-mail" for="select-all-mail" class="btn btn-default">
                                                    <input id="select-all-mail" onclick="$('input[name*=\'m_check\']').attr('checked', this.checked);" class="magic-checkbox" type="checkbox">
                                                    <label for="select-all-mail"></label>
                                                </label>

                                            </div>

                                            <!--Refresh button-->
                                            <button id="demo-mail-ref-btn" title="Refresh" data-toggle="panel-overlay" data-target="#demo-email-list" class="btn btn-default" type="button">
                                                <i class="demo-psi-repeat-2"></i>
                                            </button>
                                            <?php
                                            if ($mode == 'inbox') {
                                            ?>
                                                <!--Dropdown button (More Action)-->
                                                <div class="btn-group mFilter dropdown">
                                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                                        More <i class="dropdown-caret"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a data-url="<?= base_url(ADMIN . '/mails/m_read') ?>" id="mailRead" type="button">Mark as read</a></li>
                                                        <li><a data-url="<?= base_url(ADMIN . '/mails/m_starred') ?>" id="mailStarred" type="button">Mark as Starred</a></li>
                                                        <li><a data-url="<?= base_url(ADMIN . '/mails/m_un_starred') ?>" id="mailUnStarred" type="button">Clear Starred</a></li>

                                                        <!-- <li><a data-url="<?= base_url(ADMIN . '/mails/m_un_read') ?>" id="mailUnRead" type="button">Mark as unread</a></li> -->
                                                        <li class="divider"></li>
                                                        <li><a id="showAllMails" type="button">Load All</a></li>
                                                        <li><a id="showRead" type="button">Only Read</a></li>
                                                        <li><a id="showUnRead" type="button">Only UnRead</a></li>
                                                        <li><a id="showStarred" type="button">Only Starred</a></li>
                                                        <li><a id="showUnStarred" type="button">Only UnStarred</a></li>
                                                    </ul>
                                                </div>
                                        </div>
                                        <div class="col-sm-5 mFilter toolbar-right">
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
                                    <?php
                                            } else {
                                    ?>
                                    </div>
                                    <div class="col-sm-5 mFilter toolbar-right">
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
                                <?php
                                            }
                                ?>
                                </div>

                                <!--Mail list group-->
                                <ul id="demo-mail-list" class="mail-list pad-top bord-top">
                                </ul>



                            </div>


                            <!--Mail footer-->
                            <div class="panel-footer mFilter clearfix">
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