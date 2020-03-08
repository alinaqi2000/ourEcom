<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends MY_Admin
{
  public function __construct()
  {
    parent::__construct();
    $this->isLoggedAdmin();
    $this->load->model('Master_model');
    $this->load->model('Gallery_model');
  }

  public function index()
  {

    $this->data['page'] = 'gallery';
    $this->data['rows'] = $this->Gallery_model->getGallery();
    $this->load->view('apanel/layout/default', $this->data);
  }
  function fetchGall($count = 1)
  {
    $max = 8;
    $fetch_data = $this->Gallery_model->make_datatables();
    $data = array();
    $t_num = count($fetch_data);
    $p_num = $count + 1;
    $m_num = $count - 1;
    if ($t_num > ($max * $count)) {
      $a_num = $max * $count;
      $n_num = ($max * $count) - ($max - 1);
    } else {
      $a_num = $t_num;
      if ($a_num == 0) {
        $n_num = 0;
      } else {
        $n_num = ($max * $count) - ($max - 1);
      }
    }
    if ($t_num > 0 && !empty($fetch_data)) {
      $data = array();
      foreach (array(array_chunk($fetch_data, $max)[$count - 1]) as $fetch_data) {

        foreach ($fetch_data as $row) {
          $sub_array = loadGall($row->g_id, $row->g_title, $row->g_image);
          $data[] = $sub_array;
        }
      }
    } else {
      $data = '<h5>No image(s) to show.</h5>';
    }
    $output = array(
      'data' => $data,
      't_count' => $t_num,
      'a_count' => $a_num,
      'n_count' => $n_num,
      'p_nxt' => $p_num,
      'm_nxt' => $m_num,
    );


    echo json_encode($output);
    exit;
  }
  // function fetchGall()
  // {
  //   $srNo = 0;
  //   $fetch_data = $this->Gallery_model->make_datatables();
  //   $data = array();
  //   foreach ($fetch_data as $row) {
  //     $srNo++;

  //     $sub_array = array();
  //     $sub_array[] = $row->g_id;
  //     $sub_array[] = $row->g_title;
  //     $sub_array[] = '<img style="width:100px;" src="' . base_url() . 'uploads/gallery/' . $row->g_image . '">';
  //     $sub_array[] = '<a href="' . base_url('apanel/gallery/edit/' . $row->g_id) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> &nbsp;
  //     <a class="btn btn-sm btn-danger" type="button" onclick="bootbox.confirm(\' Are you sure, you want to delete? \',function(result){ if(result){ return location.replace(\'' . base_url('apanel/gallery/delete/' . $row->g_id) . '\'); } })"><i class="ti-trash"></i> Delete</a>';

  //     $data[] = $sub_array;
  //   }
  //   $output = array(
  //     "draw" => intval($_POST["draw"]),
  //     "recordsTotal" => $this->Gallery_model->get_all_data(),
  //     "recordsFiltered" => $this->Gallery_model->get_filtered_data(),
  //     "data" => $data
  //   );
  //   echo json_encode($output);
  // }

  function add_image()
  {
    if (!empty($_FILES['file']['name'])) {

      if ($image = upload_image('./uploads/gallery/', 'file')) {
        $vals['g_image'] = $image['file_name'];
      }
    }
    $this->Gallery_model->save($vals);

    exit;
  }
  public function add()
  {
    $this->data['page'] = 'gallery';
    $this->data['mode'] = 'add';
    $this->load->view('apanel/layout/default', $this->data);

    if ($vals = $this->input->post()) {
      pr($vals);
      exit;
      if (is_array($vals)) {

        if (isset($_FILES["g_image"]["name"]) && $_FILES["g_image"]["name"] != "") {
          $image = upload_image('./uploads/gallery/', 'g_image');
          if (!empty($image['file_name'])) {
            $vals['g_image'] = $image['file_name'];
          } else {
            setMsg('error', 'Please upload a valid document file >> ' . strip_tags($image['error']));
            redirect(base_url(ADMIN) .  '/gallery/add', 'refresh');
          }
        }
        if ($this->Gallery_model->save($vals)) {
          setMsg('success', 'Category added successfully');
          redirect(base_url(ADMIN) .  '/gallery', 'refresh');
        }
      } else {
        $this->data['post'] = $vals;
        setMsg('error', 'Please enter all required fields');
        redirect(base_url(ADMIN) .  '/gallery/add', 'refresh');
      }
    }
  }
  public function edit($edit_id)
  {
    $this->data['page'] = 'gallery';
    $this->data['mode'] = 'edit';
    $this->data['res1'] = $this->Gallery_model->getParent1Gall();
    $this->data['res2'] = $this->Gallery_model->getParent2Gall();
    $this->data['row'] = $this->Gallery_model->getGall($edit_id);

    $this->load->view('apanel/layout/default', $this->data);
    if ($vals = $this->input->post()) {
      if (is_array($vals) && $vals['g_title'] != '') {
        if (empty($this->Gallery_model->isAlreadyExistEdit($vals['g_title'], $edit_id))) {
          htmlentities($vals['g_detail']);
          if ($this->Gallery_model->save($vals, $edit_id)) {
            setMsg('success', 'Category updated successfully');
            redirect(base_url(ADMIN) .  '/gallery/edit/' . $edit_id, 'refresh');
          }
        } else {
          setMsg('error', 'A category already exists with this title');
          redirect(base_url(ADMIN) .  '/gallery/edit/' . $edit_id, 'refresh');
        }
      } else {
        $this->data['post'] = $vals;
        setMsg('error', 'Please enter all required fields');
        redirect(base_url(ADMIN) .  '/gallery/edit/' . $edit_id, 'refresh');
      }
    }
  }
  public function updateOrder()
  {
    $g_id = $this->input->post('id');
    $g_order = $this->input->post('order');
    $value = $this->input->post('value');

    $this->Gallery_model->updateOrder($g_id, $g_order, $value);
    exit;
  }

  function updateStatus()
  {

    $g_id = $this->input->post('id');
    $g_status = $this->input->post('field');
    $getStatusValue = $this->Gallery_model->getStatusValue($g_id);

    if ($getStatusValue == 0) {
      $value = 1;
    } else {
      $value = 0;
    }
    $this->Gallery_model->updateOrder($g_id, $g_status, $value);
    echo json_encode($value);
    exit;
  }
  function updateLabel()
  {

    $g_id = $this->input->post('id');
    $g_status = $this->input->post('field');
    $g_label = $this->input->post('value');

    $this->Gallery_model->updateOrder($g_id, $g_status, $g_label);
    echo json_encode($g_label);
    exit;
  }
  function delete($del_id)
  {
    if ($this->Gallery_model->delete($del_id)) {
      setMsg('success', 'Category deleted successfully');
      redirect(base_url(ADMIN) .  '/gallery', 'refresh');
    } else {
      setMsg('error', 'Something went wrong, Please try later.');
      redirect(base_url(ADMIN) .  '/gallery', 'refresh');
    }
  }

  function g_delete()
  {
    if ($this->input->post('c_box')) {
      $id = $this->input->post('c_box');
      // pr($id);
      // exit;

      for ($count = 0; $count < count($id); $count++) {
        $gotAttach = $this->Gallery_model->getAttach($id[$count]);
        // echo $files['file'];
        // exit;
        $got = "./uploads/gallery/" . $gotAttach;
        if (unlink($got)) {
          $this->Gallery_model->delete($id[$count]);
        }
      }
    }
  }
}
