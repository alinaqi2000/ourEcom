<div id="galPop" class="animated" style="display: none">
    <div id="content-container">

        <div id="page-content" style="   position: fixed;
    top: 0;
    right: 0;
      left: 0;
      bottom:0;
    background:rgba(0,0,0,.8);
    z-index: 999999;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    outline: 0;">
            <!--Data Table-->
            <!--===================================================-->

            <div class="panel ">
                <div class=" panel-body">


                    <div class="pad-all animated" style="width:100%;float:left">
                        <div class="col-md-12" style="padding: 12px 20px">
                            <div class="row">

                                <div class="col-md-6">
                                    <h2>Gallery</h2>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-sm btn-primary" type="button" name="saveGal" id="saveGal"><i class="fa fa-plus"></i> Add</button>
                                    <button class="btn btn-sm btn-danger" style="margin-left:6px" type="button" id="closeGal"><i class="fa fa-times"></i></button>

                                </div>
                            </div>
                        </div>
                        <div class="main-content" style="width:100%;float:left;">
                            <div class="col-md-12" style="">



                                <div class="col-md-12 mFilter toolbar-right">

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

                                <div class="photos" style="width: 100%;float:left;" data-mode="pop" id="demo-gallery" data-url="<?= base_url('apanel/gallery/fetchGall/') ?>">


                                </div>


                            </div>
                        </div>




                    </div>
                </div>

            </div>
        </div>
    </div>
</div>