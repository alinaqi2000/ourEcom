<?php

function pr($array)
{
    if (is_array($array)) {
        echo "<pre style='position:absolute;z-index:99999;'>";
        print_r($array);
        echo "</pre>";
    } else {
        echo $array;
    }
}
function toSlugUrl($text)
{
    $text = trim($text);
    $text = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
    $text = str_replace("--", '-', $text);
    $text = str_replace("--", '-', $text);
    return strtolower($text);
}
function getBredcrum($ary)
{
    $bcrum .= '
    <ol class="breadcrumb">

    <li><a href="' . base_url(ADMIN . '/home') . '"><i class="demo-pli-home"></i></a></li>
    
    

    ';



    foreach ($ary as $key => $value) {

        if ($key == '#') {

            $bcrum .= '<li class="active">' . $value . '</li>';
        } else {

            $bcrum .= '<li><a href="' . '' . '' . $key . '">' . $value . '</a></li>';
        }
    }



    $bcrum .= '

    </ol>
    ';

    return $bcrum;
}

function getImageSrc($image)
{
    $img = '';

    if (!empty($image)) {
        $ary = explode("/", $image);

        if (file_exists($image) && !empty($ary[count($ary) - 1])) {
            $image = str_replace('../', '', $image);
            $image = str_replace('./', '', $image);
            $img = '' . base_url() . $image;
        } else {
            $img = '' . base_url() . 'assets/apanel/img/no_image.jpg';
        }
    } else {
        $img = '' . base_url() . 'assets/apanel/img/no_image.jpg';
    }

    return $img;
}


function getStatus($status)
{
    if ($status == '1') {
        return '<strong style="color:green;">Active</strong>';
    } else {
        return '<strong style="color:red;">Inactive</strong>';
    }
}

function getStatusButton($status, $id, $field, $url)
{
    if ($status == '1') {
        return '<button title="Click to Inactive" id="pageStatus' . $id . '" data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '" class="btn statusBtn btn-sm btn-success btn-rounded">Active</button>
        ';
    } else {
        return '<button title="Click to Active" id="pageStatus' . $id . '"  data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '" class="btn statusBtn  btn-sm btn-danger btn-rounded">InActive</button>
        ';
    }
}
function getOrderButton($status, $id, $field, $url)
{
    return '<span class="w-100 orders">' . $status . '</span><input data-id="' . $id . '" data-url="' . $url . '" data-order="' . $field . '" type="number" value="' . $status . '" class="form-control txtedit" style="width:55px;" />';
}
function getFeaturedButton($status, $id, $field, $url)
{
    if ($status == 0) {
        return '<div class="btn-group dropdown">
<button class="btn btn-sm btn-danger">Not Featured</button>
<button class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button" aria-expanded="false">
    <i class="dropdown-caret"></i>
</button>
<ul class="dropdown-menu" style="">
    <li><a class="labelBtn" role="button" id="pageLabel' . $id . '" data-label="1" data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '">Featured</a></li>
    <li><a class="labelBtn" role="button" id="pageLabel' . $id . '" data-label="2" data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '">Rare</a></li>
</ul>
</div>';
    } elseif ($status == 1) {
        return '<div class="btn-group dropdown">
        <button class="btn btn-sm btn-success">Featured</button>
        <button class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button" aria-expanded="false">
            <i class="dropdown-caret"></i>
        </button>
        <ul class="dropdown-menu" style="">
        <li><a class="labelBtn" role="button" id="pageLabel' . $id . '" data-label="0" data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '">Not Featured</a></li>
        <li><a class="labelBtn" role="button" id="pageLabel' . $id . '" data-label="2" data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '">Rare</a></li>
        </ul>
        </div>';
    } else {
        return '<div class="btn-group dropdown">
        <button class="btn btn-sm btn-labeled btn-purple"><i class="btn-label demo-psi-star"></i>Rare</button>
        <button class="btn btn-sm btn-purple dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button" aria-expanded="false">
            <i class="dropdown-caret"></i>
        </button>
        <ul class="dropdown-menu" style="">    
        <li><a class="labelBtn" role="button" id="pageLabel' . $id . '" data-label="1" data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '">Featured</a></li>
        <li><a class="labelBtn" role="button" id="pageLabel' . $id . '" data-label="0" data-url="' . $url . '" data-field="' . $field . '" data-value="' . $status . '" data-id="' . $id . '">Not Featured</a></li>
        </ul>
        </div>';
    }
}
function getOrderStatus($status)
{
    if ($status == '1') {
        return '<strong style="color:green;">Delivered</strong>';
    } elseif ($status == '2') {
        return '<strong style="color:red;">Cancelled</strong>';
    } else {
        return '<strong style="color:orange;">Pending</strong>';
    }
}

function showMsg($type = '', $msg = '')
{
    $CI = &get_instance();
    if (empty($type) && empty($msg)) {
        $type = $CI->session->userdata('f_type');
        $msg = $CI->session->userdata('f_msg');
        $CI->session->unset_userdata('f_type');
        $CI->session->unset_userdata('f_msg');
    }
    if ($type != '' && $msg != '') {
        switch ($type) {
            case 'success':
                return '<div id="floating-top-container" class="floating-container"><div id="floating-top-right"><div id="alrt" class="alert-wrap animated jellyIn in"><div class="alert alert-success" role="alert"><button class="close" type="button"><i class="pci-cross pci-circle"></i></button><div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="fa fa-check-circle fa-2x"></i></span></div><div class="media-body" style="line-height:2.5;font-size:medium;width:auto;">' . $msg . '</div></div></div> </div></div>';
                break;
            case 'error':
                return '<div id="floating-top-container" class="floating-container"><div id="floating-top-right"><div id="alrt" class="alert-wrap animated jellyIn in"><div class="alert alert-danger" role="alert"><button class="close" type="button"><i class="pci-cross pci-circle"></i></button><div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="fa fa-times-circle fa-2x"></i></span></div><div class="media-body" style="line-height:2.5;font-size:medium;width:auto;"> ' . $msg . '</div></div></div> </div></div>';
                break;
            case 'warning':
                return '<div id="floating-top-container" class="floating-container"><div id="floating-top-right"><div id="alrt" class="alert-wrap animated jellyIn in"><div class="alert alert-warning" role="alert"><button class="close" type="button"><i class="pci-cross pci-circle"></i></button><div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="fa fa-warning fa-2x"></i></span></div><div class="media-body" style="line-height:2.5;font-size:medium;width:auto;">' . $msg . '</div></div></div> </div></div>';
                break;
            default:
                return '<div id="floating-top-container" class="floating-container"><div id="floating-top-right"><div id="alrt" class="alert-wrap animated jellyIn in"><div class="alert alert-info" role="alert"><button class="close" type="button"><i class="pci-cross pci-circle"></i></button><div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="fa fa-info-circle fa-2x"></i></span></div><div class="media-body" style="line-height:2.5;font-size:medium;width:auto;">' . $msg . '</div></div></div> </div></div>';
                break;
        }
    }
}

function setMsg($type, $msg)
{
    $CI = &get_instance();
    $CI->session->set_userdata('f_type', $type);
    $CI->session->set_userdata('f_msg', $msg);
}

// Form
function formText($label, $name, $value, $required = '')
{
?>
    <div class="form-group w-100">
        <label for="demo-inline-inputmail"><?= $label; ?></label>
        <input type="text" name="<?= $name; ?>" value="<?= stripslashes($value); ?>" placeholder="Enter <?= $label; ?>" id="<?= $name; ?>" <?= $required == 'required' ? 'required="required"' : ''; ?> class="form-control w-100">
    </div>
<?php
}
function formNumber($label, $name, $value, $required = '')
{
?>
    <div class="form-group subitem text">
        <label for="field"><?= $label; ?></label>
        <input type="number" name="<?= $name; ?>" id="<?= $name; ?>" value="<?= stripslashes($value); ?>" <?= $required == 'required' ? 'required="required"' : ''; ?> class="form-control" />
    </div>
<?
}

function formTextIcon($label, $name, $value, $icon)
{
?>
    <div class="form-group">
        <label for="<?= $name; ?>"><?= $label; ?></label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-<?= $icon; ?>"></i></span>
            <input type="text" name="<?= $name; ?>" id="<?= $name; ?>" value="<?= stripslashes($value); ?>" class="form-control" />
        </div>
    </div>
<?
}

function formTextArea($label, $name, $value, $rows = 3, $limit = "")
{
    if (!empty($limit)) {
        $limit = " maxlength='$limit' ";
    }
?>
    <div class="form-group">
        <label class="col-md-12 form-label"><?= $label; ?></label>
        <textarea class="form-control w-100" minlength="0" <?= $limit; ?> rows="<?= $rows; ?>" name="<?= $name; ?>" id="<?= $name; ?>"><?= (stripslashes($value)); ?></textarea>

    </div>

<?
}

function getParentCat($cat_id)
{
    $CI = get_instance();
    if ($cat_id > 0) {
        $CI->db->where('cat_id', $cat_id);
        $query = $CI->db->get('tbl_categories');
        return $query->row()->cat_title;
    } else {
        return FALSE;
    }
}
function getParentPage($page_id)
{
    $CI = get_instance();
    if ($page_id > 0) {
        $CI->db->where('page_id', $page_id);
        $query = $CI->db->get('tbl_pages');
        return $query->row()->page_title;
    } else {
        return NULL;
    }
}


function getRecipientName($id)
{
    $CI = get_instance();

    $CI->db->where('site_id', $id);
    $query = $CI->db->get('tbl_siteadmin');
    $rslt = $query->row()->site_admin_data;
    $rslt = unserialize(urldecode($rslt));
    stripcslashes($rslt);
    return $rslt['admin_name'];
}
function getRecipientImage($id)
{
    $CI = get_instance();

    $CI->db->where('site_id', $id);
    $query = $CI->db->get('tbl_siteadmin');
    $rslt = $query->row()->site_admin_data;
    $rslt = unserialize(urldecode($rslt));
    stripcslashes($rslt);
    return $rslt['admin_image'];
}
function getRecipientUserName($id)
{
    $CI = get_instance();

    $CI->db->where('site_id', $id);
    $query = $CI->db->get('tbl_siteadmin');
    $rslt = $query->row()->site_login;
    return $rslt;
}

function getRecipientIdBySlug($slug)
{
    $CI = get_instance();

    $CI->db->where('site_login', $slug);
    $query = $CI->db->get('tbl_siteadmin');
    $rslt = $query->row()->site_id;
    return $rslt;
}
function getCatIdBySlug($cat_slug)
{
    $CI = get_instance();
    $CI->db->where('cat_slug', $cat_slug);
    $query = $CI->db->get('tbl_categories');
    return $query->row()->cat_id;
}
function getCatSlugById($cat_id)
{
    $CI = get_instance();
    $CI->db->where('cat_id', $cat_id);
    $query = $CI->db->get('tbl_categories');
    return $query->row()->cat_slug;
}
function countReviews($p_id)
{
    $CI = get_instance();
    $CI->db->where('r_product', $p_id);
    $queryr = $CI->db->get('tbl_reviews');
    $rsltr = $queryr->result();
    $r_count = count($rsltr);
    return $r_count;
}
function getProductIdBySlug($p_slug)
{
    $CI = get_instance();
    $CI->db->where('p_slug', $p_slug);
    $query = $CI->db->get('tbl_products');
    return $query->row()->p_id;
}
function getPageIdBySlug($p_slug)
{
    $CI = get_instance();
    $CI->db->where('page_name', $p_slug);
    $CI->db->or_where('page_link', $p_slug);
    $query = $CI->db->get('tbl_pages');
    return $query->row()->page_id;
}
function loadGall($id, $title, $image)
{
    return '<div class="col-4 col-sm-6 col-xs-6 col-md-4 col-lg-3" data-aos="fade-up" style="margin-bottom: 20px;"><a href="' . base_url() . 'uploads/gallery/' . $image . '" class="d-block photo-item" data-fancybox="gallery"><img src="' . base_url() . 'uploads/gallery/' . $image . '" alt="Image" class="img-fluid"><div class="photo-text-more"><span class="icon fa fa-search"></div></a><div class="w-100 gCheckbox" style="display:none;border-bottom:1px solid #ddd;padding:10px 0px;"><input id="m_check_' . $id . '" name="m_check" class="magic-checkbox" value="' . $id . '" type="checkbox"><label for="m_check_' . $id . '"></div></div>';
}
function loadGallPop($id, $title, $image)
{
    // return '<div class="col-3 col-sm-3 col-xs-6 col-md-3 col-lg-2"  style="margin-bottom: 10px;"><a href="' . base_url() . 'uploads/gallery/' . $image . '" class="d-block photo-item" data-fancybox="gallery"><img src="' . base_url() . 'uploads/gallery/' . $image . '" alt="Image" class="img-fluid"><div class="photo-text-more"><span class="icon fa fa-search"></div></a><div class="w-100 gCheckbox" style="border-bottom:1px solid #ddd;padding:10px 0px;"><input id="demo-radio-' . $id . '" class="magic-radio" type="radio" name="memberType" value="free" data-bv-field="memberType"><label for="demo-radio-' . $id . '">' . $title . '</label></div></div>';
    return '<div class="col-3 col-sm-3 col-xs-6 col-md-3 col-lg-2" style="margin-bottom: 10px;"><label for="demo-radio-' . $id . '"  class="d-block selectGal"><img src="' . base_url() . 'uploads/gallery/' . $image . '" alt="Image" class="img-fluid"><input id="demo-radio-' . $id . '" class="magic-radio" data-path="' . base_url() . 'uploads/gallery/" data-file="' . $image . '" type="radio" name="memberType" value="free" data-bv-field="memberType"><label>' . $title . '</label></label></div>';
}
function loadMAils($type, $id, $a_id, $rep_id, $sub, $date, $status, $label, $file, $tags, $fieldStar)
{
    if ($type == 'inbox') {
        $name = getRecipientName($a_id);
    } else {
        $name = getRecipientName($rep_id);
    }
    $n_date = explode(' ', $date);
    $read = "";
    $attach = "";
    $star = "";
    $atc_icon = "";
    $tgs = "";
    $tgsClass = "";
    if (!empty($tags)) {
        $tgs = explode(',', $tags);
    }
    if ($tgs != "") {
        $tgsClass = '<span class="label label-primary">' . $tgs[0] . '</span>';
    }
    if ($status == 0) {
        $read = 'mail-list-unread';
    }
    if ($label == 1) {
        $star = 'mail-starred';
    }
    if ($label == 1 || $label == 0) {
        $isStar = '<div class="mail-star"><a type="button" class="starredBtn" id="stars' . $id . '" data-value="' . $label . '" data-field="' . $fieldStar . '" data-id="' . $id . '" data-url="' . base_url(ADMIN . '/mails/updateLabel') . '"><i class="demo-psi-star"></i></a></div>';
    }
    if (!empty($file)) {
        $attach = 'mail-attach';
        $atc_icon = '<div class="mail-attach-icon"><i class="demo-psi-paperclip"></i></div>';
    }


    $rslt = '<li id="listItem' . $id . '" class="' . $read . ' ' . $star . ' ' . $attach . '"><div class="mail-control"><input id="m_check_' . $id . '" name="m_check" class="magic-checkbox" value="' . $id . '" type="checkbox"><label for="m_check_' . $id . '"></label></div>' . $isStar . '<div class="mail-from"><a href="' . base_url(ADMIN) . "/inbox/" . $a_id . '/' . $id . '">' . $name . '</a></div><div class="mail-time">' . $n_date[1] . ' ' . $n_date[2] . ', ' . $n_date[3] . '</div>' . $atc_icon . '<div class="mail-subject"><a href="' . base_url(ADMIN) . "/inbox/" . $a_id . '/' . $id . '">' . $tgsClass . $sub . '</a></div></li>';
    return $rslt;
}
function getPageTitleBySlug($p_slug)
{
    $CI = get_instance();
    $CI->db->where('page_name', $p_slug);
    $CI->db->or_where('page_link', $p_slug);
    $query = $CI->db->get('tbl_pages');
    return $query->row()->page_title;
}
function getPageTitleById($p_id)
{
    $CI = get_instance();
    $CI->db->where('page_id', $p_id);
    $query = $CI->db->get('tbl_pages');
    return $query->row()->page_title;
}

function getProductSlugById($p_id)
{
    $CI = get_instance();
    $CI->db->where('p_id', $p_id);
    $query = $CI->db->get('tbl_products');
    return $query->row()->p_slug;
}
function getLocation($cus_id)
{
    $CI = get_instance();
    $CI->db->where('cus_id', $cus_id);
    $query = $CI->db->get('tbl_customers');
    $row = $query->row();
    $location = $row->cus_street . ', ' . $row->cus_city . ', ' . $row->cus_state . ', ' . $row->cus_country;
    return $location;
}
function getProductTitleById($p_id)
{
    $CI = get_instance();
    $CI->db->where('p_id', $p_id);
    $query = $CI->db->get('tbl_products');
    return $query->row()->p_title;
}
function getProductTitleBySlug($p_slug)
{
    $CI = get_instance();
    $CI->db->where('p_slug', $p_slug);
    $query = $CI->db->get('tbl_products');
    return $query->row()->p_title;
}
function getCatTitleBySlug($cat_slug)
{

    $CI = get_instance();
    $CI->db->where('cat_slug', $cat_slug);
    $query = $CI->db->get('tbl_categories');
    if ($query->row()->cat_title) {
        return $query->row()->cat_title;
    } else {
        return 'Categories';
    }
}


function getDateByDb($date)
{

    $recieved = explode(' ', $date);
    return $recieved[0];
}

function upload_file($path, $field_name)
{
    $CI = &get_instance();
    $stamp = time();
    // $ray = preg_split('/(,|;|-|_|&|#|:)/', $tmp);
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|txt|mp4|x-ms-wma|mp3|jpg|png|gif|jpeg|zip|rar|html|php|htm|css|js|sql';
    $config['max_size'] = 2100;
    $config['file_name'] = 'file_' . $stamp;

    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($field_name)) {
        $image['error'] = $CI->upload->display_errors();
        return $image;
    } else {
        $image = $CI->upload->data();
        return $image;
    }
}

function upload_image($path, $field_name, $image_width = '', $image_height = '')
{
    $CI = &get_instance();

    $stamp = time() . '_' . rand(1111, 9999);
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = 2100;
    $config['file_name'] = "image_" . $stamp;

    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($field_name)) {
        $image['error'] = $CI->upload->display_errors();
        return $image;
    } else {
        $image = $CI->upload->data();

        if (!empty($image_width)) {
            if (!empty($image['file_name'])) {
                $config['source_image'] = $path . $image['file_name'];
                $config['width'] = $image_width;
                $config['height'] = $image_height ? $image_height : $image_width;
                $config['maintain_ratio'] = TRUE;
                $CI->load->library('image_lib', $config);
                $CI->image_lib->resize();
            } else {
                $image['error'] = $CI->upload->display_errors();
                return $image;
            }
        }
        return $image;
    }
}

function formImageFile($label, $name, $value, $resolution = '1024px x 728px', $directory = 'media', $gallery='', $remove = "")
{
?> <label class="col-md-12 mar-btm form-label"><?= $label; ?></label>
    <input type="hidden" id="typeImg" name="imgType" value="browse">
    <input type="hidden" id="newImg" name="<?= $name; ?>" value="<?= $value; ?>">
    <div class="form-group">

        <div class="" style="border: 1px solid #e7e7e7;border-radius:3px;padding:12px;">
            <div class="col-md-6  float-left">
                <img id="recImg" src="<?= getImageSrc("./uploads/" . $directory . "/" . $value); ?>" style="max-height: 175px;max-width: 190px;" />
            </div>
            <div class="col-md-6 float-left">
                <div class="col-md-12 float-left">
                    <span class="pull-left btn btn-primary btn-file" style="margin:4px;">
                        Browse <i class="fa fa-desktop"></i>
                        <input type="file" name="<?= $name; ?>" id="browseType">
                    </span>
                    <?php
                    if ($gallery == 'hasGallery') {
                    ?>
                        <button title="Choose from site gallery" class="btn galShow btn-primary" style="margin: 4px;" type="button">Gallery <i class="ti-gallery"></i></button>
                    <?php
                    }
                    if (!empty($value) && $remove == 'hasRemove') {
                    ?>
                        <button class="btn btn-danger" style="margin: 4px;" name="delImage">Remove <i class="fa fa-times"></i></button>

                    <?php
                    }
                    ?>
                </div>
                <p style="padding:10px;" class="float-left">
                    <em>Best Resolution:</em> <strong><?= $resolution; ?></strong><br>
                    <em>Allowed Formats:</em> <strong>JPG, JPEG, PNG, GIF</strong>
                </p>
            </div>
            <div class="clearfix"></div>

        </div>

    </div>

<?php
}

function getMenuSubCats($cat_parent)
{
    $CI = get_instance();
    $CI->db->where('cat_parent', $cat_parent);
    $CI->db->where('cat_type', '1');
    $CI->db->where('cat_menu', '1');
    $CI->db->where('cat_status', '1');
    $CI->db->order_by('cat_order', 'ASC');
    $query = $CI->db->get('tbl_categories');
    $gots = $query->result();

?><ul>
        <?php
        foreach ($gots as $got) {

        ?>
            <li><a href="<?= base_url('categories/') . $got->cat_slug ?>"><?= $got->cat_title ?><?= $got->cat_label == '1' ? '<span class="tip tip-new">New!</span>' : ''; ?></a></li>
        <?php
        }
        ?>
    </ul><?php

        }
        function getSubCats($cat_parent)
        {
            $CI = get_instance();
            $CI->db->where('cat_parent', $cat_parent);
            $CI->db->where('cat_type', '1');
            $CI->db->where('cat_status', '1');
            $CI->db->order_by('cat_order', 'ASC');
            $query = $CI->db->get('tbl_categories');
            $gots = $query->result();

            foreach ($gots as $got) {

            ?><li><a class="<?= $CI->uri->segment(2) == $got->cat_slug ? 'cat-active' : '';  ?>" href="<?= base_url('categories/') . $got->cat_slug ?>"><?= $got->cat_title ?></a></li><?php
                                                                                                                                                                                    }
                                                                                                                                                                                }
                                                                                                                                                                                function activeSubCat($url, $parent)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('cat_slug', $url);
                                                                                                                                                                                    $CI->db->where('cat_parent', $parent);
                                                                                                                                                                                    $CI->db->where('cat_type', '1');
                                                                                                                                                                                    $CI->db->where('cat_status', '1');
                                                                                                                                                                                    $CI->db->order_by('cat_order', 'ASC');
                                                                                                                                                                                    $query = $CI->db->get('tbl_categories');
                                                                                                                                                                                    $gots = $query->row()->cat_id;
                                                                                                                                                                                    if (!empty($gots)) {
                                                                                                                                                                                        return TRUE;
                                                                                                                                                                                    } else {
                                                                                                                                                                                        return FALSE;
                                                                                                                                                                                    }
                                                                                                                                                                                }
                                                                                                                                                                                function getMenuProducts($p_cat)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('p_cat', $p_cat);
                                                                                                                                                                                    $CI->db->where('p_menu', '1');
                                                                                                                                                                                    $CI->db->where('p_status', '1');
                                                                                                                                                                                    $CI->db->order_by('p_order', 'ASC');
                                                                                                                                                                                    $query = $CI->db->get('tbl_products');
                                                                                                                                                                                    $gots = $query->result();

                                                                                                                                                                                        ?>
    <ul>
        <?php
                                                                                                                                                                                    foreach ($gots as $got) {

        ?>
            <li><a href="<?= base_url('product/') . $got->p_slug ?>"><?= $got->p_title ?></a></li>
        <?php
                                                                                                                                                                                    }
        ?>
    </ul>
    <?php

                                                                                                                                                                                }
                                                                                                                                                                                function getMenuSubPages($page_parent)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('page_parent', $page_parent);
                                                                                                                                                                                    $CI->db->where('page_menu', '1');
                                                                                                                                                                                    $CI->db->where('page_status', '1');
                                                                                                                                                                                    $CI->db->order_by('page_order', 'ASC');
                                                                                                                                                                                    $query = $CI->db->get('tbl_pages');
                                                                                                                                                                                    $gots = $query->result();
                                                                                                                                                                                    if (count($gots) > 0) {
    ?>
        <ul>
            <?php
                                                                                                                                                                                        foreach ($gots as $got) {

            ?>
                <li><a href="<?= $got->page_link ? base_url() . $got->page_name : 'javascript:void(0);';  ?>"><?= $got->page_title ?></a></li>
            <?php
                                                                                                                                                                                        }
            ?>
        </ul>

        <?php
                                                                                                                                                                                    }
                                                                                                                                                                                }

                                                                                                                                                                                function countMenuSubPages($page_parent)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('page_parent', $page_parent);
                                                                                                                                                                                    $CI->db->where('page_menu', '1');
                                                                                                                                                                                    $CI->db->where('page_status', '1');
                                                                                                                                                                                    $CI->db->order_by('page_order', 'ASC');
                                                                                                                                                                                    $query = $CI->db->get('tbl_pages');
                                                                                                                                                                                    $gots = $query->result();
                                                                                                                                                                                    if (count($gots) > 0) {
                                                                                                                                                                                        return TRUE;
                                                                                                                                                                                    } else {
                                                                                                                                                                                        return FALSE;
                                                                                                                                                                                    }
                                                                                                                                                                                }

                                                                                                                                                                                function getSubPCategories($cat_parent, $sub_cat = '')
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('cat_parent', $cat_parent);
                                                                                                                                                                                    $CI->db->where('cat_type', '1');
                                                                                                                                                                                    $CI->db->where('cat_status', '1');
                                                                                                                                                                                    $CI->db->order_by('cat_order', 'ASC');
                                                                                                                                                                                    $query = $CI->db->get('tbl_categories');
                                                                                                                                                                                    $array = $query->result();
                                                                                                                                                                                    if (count($array) > 0) {
                                                                                                                                                                                        foreach ($array as $rs) {
        ?><option value="<?= $rs->cat_id; ?>" <?= ($rs->cat_id == $sub_cat ? 'selected="selected"' : ''); ?>><?= stripcslashes($rs->cat_title); ?>

            </option><?php
                                                                                                                                                                                        }
                                                                                                                                                                                    } else {
                        ?>
        <option value="0">No Category</option>
        <?php
                                                                                                                                                                                    }
                                                                                                                                                                                }

                                                                                                                                                                                function add_to_cart_url($pro_id)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    if (!($CI->session->userdata('cus_id') > 0)) {
                                                                                                                                                                                        echo base_url('add_to_cart_login/') . $pro_id;
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo 'javascript:void(0);';
                                                                                                                                                                                    }
                                                                                                                                                                                }

                                                                                                                                                                                function getStCarts($customer_id)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('customer_id', $customer_id);
                                                                                                                                                                                    $query = $CI->db->get('tbl_carts');
                                                                                                                                                                                    $array = $query->result();

                                                                                                                                                                                    return  $array;
                                                                                                                                                                                }
                                                                                                                                                                                function getCart($customer_id)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('customer_id', $customer_id);
                                                                                                                                                                                    $query = $CI->db->get('tbl_carts');
                                                                                                                                                                                    $array = $query->result();
                                                                                                                                                                                    if (count($array) > 0) {

                                                                                                                                                                                        foreach ($array as $rs) {
                                                                                                                                                                                            $rslt[] = '<div class="product">
        <div class="product-details">
        <h4 class="product-title">
        <a href="' . base_url("product/") . getProductSlugById($rs->product_id) . '">' . $rs->cart_title . '</a>
        </h4>
        <span class="cart-product-info">
        <span class="cart-product-qty">1</span>
        x ' . $rs->cart_price . '
        </span>
        </div>
        <figure class="product-image-container">
        <a href="' . base_url("product/") . getProductSlugById($rs->product_id) . '" class="product-image">
        <img src="' . base_url("uploads/products/") . $rs->cart_image . '" alt="product">
        </a>
        <a href="' . base_url('cart/cart_del/') . $rs->cart_id . '" class="btn-remove cart_delete" data-id="' . $rs->cart_id . '" title="Remove Product"><i class="icon-cancel"></i></a>
        </figure>
        </div>';
                                                                                                                                                                                        }
                                                                                                                                                                                        return $rslt;
                                                                                                                                                                                    }
                                                                                                                                                                                }
                                                                                                                                                                                function getCartCount($customer_id)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('customer_id', $customer_id);
                                                                                                                                                                                    $query = $CI->db->get('tbl_carts');
                                                                                                                                                                                    $array = $query->result();
                                                                                                                                                                                    return count($array);
                                                                                                                                                                                }


                                                                                                                                                                                function getCartPrice($customer_id)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('customer_id', $customer_id);
                                                                                                                                                                                    $query = $CI->db->get('tbl_carts');
                                                                                                                                                                                    $arrays = $query->result();
                                                                                                                                                                                    foreach ($arrays as $array) {
                                                                                                                                                                                        $total += $array->cart_price;
                                                                                                                                                                                    }


                                                                                                                                                                                    return $total;
                                                                                                                                                                                }
                                                                                                                                                                                function getSearchSCats($parent_cat)
                                                                                                                                                                                {

                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('cat_parent', $parent_cat);
                                                                                                                                                                                    $CI->db->where('cat_status', '1');
                                                                                                                                                                                    $CI->db->where('cat_type', '1');
                                                                                                                                                                                    $querys = $CI->db->get('tbl_categories');
                                                                                                                                                                                    $s_cats = $querys->result();

                                                                                                                                                                                    if (count($s_cats) > 0) {
                                                                                                                                                                                        foreach ($s_cats as $p_cat) {
        ?>
            <option value="<?= $p_cat->cat_id ?>">- <?= $p_cat->cat_title ?></option>
        <?php
                                                                                                                                                                                        }
                                                                                                                                                                                    }
                                                                                                                                                                                }
                                                                                                                                                                                function getSearchCats()
                                                                                                                                                                                {

                                                                                                                                                                                    $CI = get_instance();
                                                                                                                                                                                    $CI->db->where('cat_status', '1');
                                                                                                                                                                                    $CI->db->where('cat_type', '0');
                                                                                                                                                                                    $query = $CI->db->get('tbl_categories');
                                                                                                                                                                                    $p_cats = $query->result();

                                                                                                                                                                                    if (count($p_cats) > 0) {
                                                                                                                                                                                        foreach ($p_cats as $p_cat) {
        ?><option value="<?= $p_cat->cat_id ?>"><?= $p_cat->cat_title ?></option>
            <?= getSearchSCats($p_cat->cat_id) ?>
<?php

                                                                                                                                                                                        }
                                                                                                                                                                                    }
                                                                                                                                                                                }

                                                                                                                                                                                function fetch($ex)
                                                                                                                                                                                {
                                                                                                                                                                                    return $ex->result();
                                                                                                                                                                                }

                                                                                                                                                                                function getList($tbl_name, $where, $start, $limit)
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();

                                                                                                                                                                                    $CI->db->where($where);
                                                                                                                                                                                    $CI->db->limit($start, $limit);
                                                                                                                                                                                    $query = $CI->db->get($tbl_name);
                                                                                                                                                                                    // $total_pages_rs = $query->result();
                                                                                                                                                                                    $ex = $query->result();

                                                                                                                                                                                    return $ex;
                                                                                                                                                                                }


                                                                                                                                                                                function getPaging($table, $where, $order, $limit, $tpage, $seprater, $pager, $spcl_cond = '', $nxt = '', $prv = '')
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();

                                                                                                                                                                                    $tbl_name = $table;  //your table name
                                                                                                                                                                                    $adjacents = 3;
                                                                                                                                                                                    //  echo $_REQUEST['page']; 

                                                                                                                                                                                    // $CI->db->where($where);
                                                                                                                                                                                    // $query = $CI->db->get($tbl_name);
                                                                                                                                                                                    // $total_pages_rs = $query->result_array();

                                                                                                                                                                                    // $query = "SELECT COUNT(*) as num FROM $tbl_name $where";
                                                                                                                                                                                    // $total_pages_ex = $conn->query($query);
                                                                                                                                                                                    // $total_pages_rs = $total_pages_ex->fetch_array();
                                                                                                                                                                                    $total_pages = count($total_pages_rs);

                                                                                                                                                                                    $targetpage = $tpage; //your file name  (the name of this file)
                                                                                                                                                                                    //  $limit = 12;    
                                                                                                                                                                                    //  $_GET['pager']          //how many items to show per page
                                                                                                                                                                                    $page = $pager;
                                                                                                                                                                                    if ($page) {
                                                                                                                                                                                        $start = ($page - 1) * $limit;    //first item to display on this page
                                                                                                                                                                                    } else {
                                                                                                                                                                                        $start = 0;        //if no page var is given, set start to 0
                                                                                                                                                                                    }

                                                                                                                                                                                    $seprator = $seprater;
                                                                                                                                                                                    if ($spcl_cond != '') {
                                                                                                                                                                                        $CI->db->where('cat_id', $spcl_cond);
                                                                                                                                                                                        $query = $CI->db->get('tbl_categories');
                                                                                                                                                                                        $rsltp = $query->row();
                                                                                                                                                                                        if ($rsltp->cat_type == '0') {
                                                                                                                                                                                            $CI->db->where('p_pcat', $rsltp->cat_id);
                                                                                                                                                                                            $CI->db->where('p_status', '1');
                                                                                                                                                                                            $CI->db->order_by('p_order');
                                                                                                                                                                                            $CI->db->limit($limit, $start);
                                                                                                                                                                                            $querys = $CI->db->get($tbl_name);
                                                                                                                                                                                        } else {
                                                                                                                                                                                            $CI->db->where('p_cat', $rsltp->cat_id);
                                                                                                                                                                                            $CI->db->where('p_status', '1');
                                                                                                                                                                                            $CI->db->order_by('p_order');
                                                                                                                                                                                            $CI->db->limit($limit, $start);
                                                                                                                                                                                            $querys = $CI->db->get($tbl_name);
                                                                                                                                                                                        }
                                                                                                                                                                                    } else {
                                                                                                                                                                                        $CI->db->where($where);
                                                                                                                                                                                        $CI->db->order_by($order);
                                                                                                                                                                                        $CI->db->limit($limit, $start);
                                                                                                                                                                                        $querys = $CI->db->get($tbl_name);
                                                                                                                                                                                    }
                                                                                                                                                                                    if ($spcl_cond != '') {
                                                                                                                                                                                        $CI->db->where('cat_id', $spcl_cond);
                                                                                                                                                                                        $query = $CI->db->get('tbl_categories');
                                                                                                                                                                                        $rsltp = $query->row();
                                                                                                                                                                                        if ($rsltp->cat_type == '0') {
                                                                                                                                                                                            $CI->db->where('p_pcat', $rsltp->cat_id);
                                                                                                                                                                                            $CI->db->where('p_status', '1');
                                                                                                                                                                                            $CI->db->order_by('p_order');
                                                                                                                                                                                            $queryc = $CI->db->get($tbl_name);
                                                                                                                                                                                        } else {
                                                                                                                                                                                            $CI->db->where('p_cat', $rsltp->cat_id);
                                                                                                                                                                                            $CI->db->where('p_status', '1');
                                                                                                                                                                                            $CI->db->order_by('p_order');
                                                                                                                                                                                            $queryc = $CI->db->get($tbl_name);
                                                                                                                                                                                        }
                                                                                                                                                                                    } else {
                                                                                                                                                                                        $CI->db->where($where);
                                                                                                                                                                                        $CI->db->order_by($order);
                                                                                                                                                                                        $queryc = $CI->db->get($tbl_name);
                                                                                                                                                                                    }
                                                                                                                                                                                    // $sql=$CI->db->last_query();
                                                                                                                                                                                    $sql = $querys->result();
                                                                                                                                                                                    $sqlc = $queryc->result();
                                                                                                                                                                                    $total_pages = count($sqlc);
                                                                                                                                                                                    // $sql = "SELECT * from $tbl_name $where  LIMIT $start, $limit";

                                                                                                                                                                                    if ($page == 0)
                                                                                                                                                                                        $page = 1;     //if no page var is given, default to 1.
                                                                                                                                                                                    $prev = $page - 1;       //previous page is page - 1
                                                                                                                                                                                    $next = $page + 1;       //next page is page + 1
                                                                                                                                                                                    $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.
                                                                                                                                                                                    $lpm1 = $lastpage - 1;      //last page minus 1
                                                                                                                                                                                    $pagination = "";
                                                                                                                                                                                    if ($lastpage > 1) {
                                                                                                                                                                                        $pagination .= "<nav aria-label='...'>";
                                                                                                                                                                                        $pagination .= "<ul class=\"pagination\">";
                                                                                                                                                                                        //previous button
                                                                                                                                                                                        if ($page > 1)
                                                                                                                                                                                            $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$prev\">&laquo; " . $prv . "</a></li>";
                                                                                                                                                                                        else
                                                                                                                                                                                            $pagination .= " <li class=\"page-item disabled\"><a class=\" page-link \" href=\"\">&laquo; " . $prv . "</a></li>";

                                                                                                                                                                                        //pages 
                                                                                                                                                                                        if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                                                                                                                                                                                            for ($counter = 1; $counter <= $lastpage; $counter++) {
                                                                                                                                                                                                if ($counter == $page)
                                                                                                                                                                                                    $pagination .= "<li class=\"page-item active\"><a class=\" page-link \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                else
                                                                                                                                                                                                    $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                            }
                                                                                                                                                                                        } elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                                                                                                                                                                                            //close to beginning; only hide later pages
                                                                                                                                                                                            if ($page < 1 + ($adjacents * 2)) {
                                                                                                                                                                                                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                                                                                                                                                                                    if ($counter == $page)
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item active\"><a class=\" page-link \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                    else
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                                }
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$lpm1\">$lpm1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$lastpage\">$lastpage</a></li>";
                                                                                                                                                                                            }
                                                                                                                                                                                            //in middle; hide some front and some back
                                                                                                                                                                                            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=1\">1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=2\">2</a></li>";
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                                                                                                                                                                                    if ($counter == $page)
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item active\"><a class=\" page-link \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                    else
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                                }
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$lpm1\">$lpm1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$lastpage\">$lastpage</a></li>";
                                                                                                                                                                                            }
                                                                                                                                                                                            //close to end; only hide early pages
                                                                                                                                                                                            else {
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=1\">1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=2\">2</a></li>";
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                                                                                                                                                                                    if ($counter == $page)
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item active\"><a class=\" page-link \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                    else
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                                }
                                                                                                                                                                                            }
                                                                                                                                                                                        }
                                                                                                                                                                                        //next button
                                                                                                                                                                                        if ($page < $counter - 1)
                                                                                                                                                                                            $pagination .= "<li class=\"page-item\"><a class=\" page-link \" href=\"$targetpage" . $seprator . "pager=$next\">" . $nxt . " &raquo;</a></li>";
                                                                                                                                                                                        else
                                                                                                                                                                                            $pagination .= "<li class=\"page-item disabled\"><a class=\" page-link \" href=\"\">" . $nxt . " &raquo;</a></li>";
                                                                                                                                                                                        $pagination .= "</ul>\n";
                                                                                                                                                                                        $pagination .= "</nav>\n";
                                                                                                                                                                                    }

                                                                                                                                                                                    return array($sql, $pagination);
                                                                                                                                                                                }
                                                                                                                                                                                function getPagingSm($table, $where, $order, $limit, $tpage, $seprater, $pager, $spcl_cond = '', $nxt = '', $prv = '')
                                                                                                                                                                                {
                                                                                                                                                                                    $CI = get_instance();

                                                                                                                                                                                    $tbl_name = $table;  //your table name
                                                                                                                                                                                    $adjacents = 3;
                                                                                                                                                                                    //  echo $_REQUEST['page']; 

                                                                                                                                                                                    // $CI->db->where($where);
                                                                                                                                                                                    // $query = $CI->db->get($tbl_name);
                                                                                                                                                                                    // $total_pages_rs = $query->result_array();

                                                                                                                                                                                    // $query = "SELECT COUNT(*) as num FROM $tbl_name $where";
                                                                                                                                                                                    // $total_pages_ex = $conn->query($query);
                                                                                                                                                                                    // $total_pages_rs = $total_pages_ex->fetch_array();
                                                                                                                                                                                    // $total_pages = count($total_pages_rs);

                                                                                                                                                                                    $targetpage = $tpage; //your file name  (the name of this file)
                                                                                                                                                                                    //  $limit = 12;    
                                                                                                                                                                                    //  $_GET['pager']          //how many items to show per page
                                                                                                                                                                                    $page = $pager;
                                                                                                                                                                                    if ($page) {
                                                                                                                                                                                        $start = ($page - 1) * $limit;    //first item to display on this page
                                                                                                                                                                                    } else {
                                                                                                                                                                                        $start = 0;        //if no page var is given, set start to 0
                                                                                                                                                                                    }

                                                                                                                                                                                    $seprator = $seprater;

                                                                                                                                                                                    $CI->db->where($where);
                                                                                                                                                                                    $CI->db->order_by($order);
                                                                                                                                                                                    $CI->db->limit($limit, $start);
                                                                                                                                                                                    $querys = $CI->db->get($tbl_name);

                                                                                                                                                                                    $CI->db->where($where);
                                                                                                                                                                                    $CI->db->order_by($order);
                                                                                                                                                                                    $queryc = $CI->db->get($tbl_name);

                                                                                                                                                                                    // $sql=$CI->db->last_query();
                                                                                                                                                                                    $sql = $querys->result();
                                                                                                                                                                                    $sqlc = $queryc->result();
                                                                                                                                                                                    $total_pages = count($sqlc);
                                                                                                                                                                                    // $sql = "SELECT * from $tbl_name $where  LIMIT $start, $limit";

                                                                                                                                                                                    if ($page == 0)
                                                                                                                                                                                        $page = 1;     //if no page var is given, default to 1.
                                                                                                                                                                                    $prev = $page - 1;       //previous page is page - 1
                                                                                                                                                                                    $next = $page + 1;       //next page is page + 1
                                                                                                                                                                                    $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.
                                                                                                                                                                                    $lpm1 = $lastpage - 1;      //last page minus 1
                                                                                                                                                                                    $pagination = "";
                                                                                                                                                                                    if ($lastpage > 1) {
                                                                                                                                                                                        $pagination .= "<nav aria-label='...'>";
                                                                                                                                                                                        $pagination .= "<ul class=\"pagination pagination-sm\">";
                                                                                                                                                                                        //previous button
                                                                                                                                                                                        if ($page > 1)
                                                                                                                                                                                            $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$prev\">&laquo; " . $prv . "</a></li>";
                                                                                                                                                                                        else
                                                                                                                                                                                            $pagination .= " <li class=\"page-item disabled\"><a class=\" page-link   \" href=\"\">&laquo; " . $prv . "</a></li>";

                                                                                                                                                                                        //pages 
                                                                                                                                                                                        if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                                                                                                                                                                                            for ($counter = 1; $counter <= $lastpage; $counter++) {
                                                                                                                                                                                                if ($counter == $page)
                                                                                                                                                                                                    $pagination .= "<li class=\"page-item active\"><a class=\" page-link   \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                else
                                                                                                                                                                                                    $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                            }
                                                                                                                                                                                        } elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                                                                                                                                                                                            //close to beginning; only hide later pages
                                                                                                                                                                                            if ($page < 1 + ($adjacents * 2)) {
                                                                                                                                                                                                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                                                                                                                                                                                    if ($counter == $page)
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item active\"><a class=\" page-link   \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                    else
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                                }
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$lpm1\">$lpm1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$lastpage\">$lastpage</a></li>";
                                                                                                                                                                                            }
                                                                                                                                                                                            //in middle; hide some front and some back
                                                                                                                                                                                            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=1\">1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=2\">2</a></li>";
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                                                                                                                                                                                    if ($counter == $page)
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item active\"><a class=\" page-link   \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                    else
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                                }
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$lpm1\">$lpm1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$lastpage\">$lastpage</a></li>";
                                                                                                                                                                                            }
                                                                                                                                                                                            //close to end; only hide early pages
                                                                                                                                                                                            else {
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=1\">1</a></li>";
                                                                                                                                                                                                $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=2\">2</a></li>";
                                                                                                                                                                                                $pagination .= "...";
                                                                                                                                                                                                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                                                                                                                                                                                    if ($counter == $page)
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item active\"><a class=\" page-link   \" href=\"\">$counter</a></li>";
                                                                                                                                                                                                    else
                                                                                                                                                                                                        $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$counter\">$counter</a></li>";
                                                                                                                                                                                                }
                                                                                                                                                                                            }
                                                                                                                                                                                        }
                                                                                                                                                                                        //next button
                                                                                                                                                                                        if ($page < $counter - 1)
                                                                                                                                                                                            $pagination .= "<li class=\"page-item\"><a class=\" page-link   \" href=\"$targetpage" . $seprator . "pager=$next\">" . $nxt . " &raquo;</a></li>";
                                                                                                                                                                                        else
                                                                                                                                                                                            $pagination .= "<li class=\"page-item disabled\"><a class=\" page-link   \" href=\"\">" . $nxt . " &raquo;</a></li>";
                                                                                                                                                                                        $pagination .= "</ul>\n";
                                                                                                                                                                                        $pagination .= "</nav>\n";
                                                                                                                                                                                    }

                                                                                                                                                                                    return array($sql, $pagination);
                                                                                                                                                                                }
