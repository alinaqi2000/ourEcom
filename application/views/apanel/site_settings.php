 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">
     <div id="page-head">

         <!--Page Title-->
         <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
         <div id="page-title">
             <h1 class="page-header text-overflow">Site Settings</h1>
         </div>
         <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
         <!--End page title-->


         <!--Breadcrumb-->
         <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
         <?php echo getBredcrum(array('#' => 'General Settings')); ?>
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
                         <?= formText('Site Name', 'site_name', $rows['site_name']) ?>
                     </div>
                     <div class="col-md-8 mar-btm">
                         <?= formTextArea('Site Description', 'site_desc',  $rows['site_desc']); ?>
                     </div>
                     <div class="col-md-8 mar-btm">
                         <?= formText('Footer Copyright Text', 'site_footer_text',  $rows['site_footer_text']); ?>
                     </div>

                     <div class="col-md-8 mar-btm">
                         <?= formImageFile('Site Primary Logo', 'site_logo', $rows['site_logo'], '80 x 40px', 'logo') ?>

                     </div>
                     <div class="col-md-8 mar-btm">
                         <?= formImageFile('Site Secondary Logo', 'sec_logo', $rows['sec_logo'], '80 x 40px', 'logo') ?>

                     </div>
                     <div class="col-md-8 mar-btm">
                         <?= formImageFile('Site Favicon', 'site_favicon', $rows['site_favicon'], '25 x 25px', 'logo') ?>

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