<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends MY_Admin
{
  public function __construct()
  {
    parent::__construct();
    $this->isLoggedAdmin();
    $this->load->model('Master_model');
    $this->load->model('Page_model');
  }

  public function index()
  {

    $this->data['page'] = 'pages';
    $this->data['rows'] = $this->Page_model->getPages();
    $this->load->view('apanel/layout/default', $this->data);
  }

  function fetchPages()
  {
    $srNo = 0;
    $fetch_data = $this->Page_model->make_datatables();
    $data = array();
    foreach ($fetch_data as $row) {
      $srNo++;
      $sub_array = array();
      $sub_array[] = $row->page_id;
      $sub_array[] = $row->page_title;
      $sub_array[] = getParentPage($row->page_parent);
      $sub_array[] = getStatusButton($row->page_status, $row->page_id, 'page_status', base_url(ADMIN . '/pages/updateStatus'));

      $sub_array[] = '<a href="' . base_url('apanel/pages/edit/' . $row->page_id) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> &nbsp;
      <a class="btn btn-sm btn-danger" type="button" onclick="bootbox.confirm(\' Are you sure, you want to delete? \',function(result){ if(result){ return location.replace(\'' . base_url('apanel/pages/delete/' . $row->page_id) . '\'); } })"><i class="ti-trash"></i> Delete</a>';

      $data[] = $sub_array;
    }
    $output = array(
      "draw" => intval($_POST["draw"]),
      "recordsTotal" => $this->Page_model->get_all_data(),
      "recordsFiltered" => $this->Page_model->get_filtered_data(),
      "data" => $data
    );
    echo json_encode($output);
  }


  public function add()
  {
    $this->data['page'] = 'pages';
    $this->data['mode'] = 'add';
    $this->data['res'] = $this->Page_model->getParentPages();
    $this->load->view('apanel/layout/default', $this->data);
    if ($vals = $this->input->post()) {
      if (is_array($vals) && $vals['page_title'] != '') {
        $vals['page_name'] = toSlugUrl($vals['page_title']);
        if (empty($this->Page_model->isAlreadyExist($vals['page_title']))) {
          if ($this->Page_model->save($vals)) {
            setMsg('success', 'Page added successfully');
            redirect(base_url(ADMIN) .  '/pages', 'refresh');
          }
        } else {
          setMsg('error', 'A page already exists with this title');
          redirect(base_url(ADMIN) .  '/pages/add', 'refresh');
        }
      } else {
        $this->data['post'] = $vals;
        setMsg('error', 'Please enter all required fields');
        redirect(base_url(ADMIN) .  '/pages/add', 'refresh');
      }
    }
  }
  public function edit($edit_id)
  {
    $this->data['page'] = 'pages';
    $this->data['mode'] = 'edit';
    $this->data['res'] = $this->Page_model->getParentPages();
    $this->data['row'] = $this->Page_model->getPage($edit_id);

    $this->load->view('apanel/layout/default', $this->data);
    if ($vals = $this->input->post()) {
      if (is_array($vals) && $vals['page_title'] != '') {
        if (empty($this->Page_model->isAlreadyExistEdit($vals['page_title'], $edit_id))) {
          htmlentities($vals['page_detail']);
          if ($this->Page_model->save($vals, $edit_id)) {
            setMsg('success', 'Page updated successfully');
            redirect(base_url(ADMIN) .  '/pages/edit/' . $edit_id, 'refresh');
          }
        } else {
          setMsg('error', 'A page already exists with this title');
          redirect(base_url(ADMIN) .  '/pages/edit/' . $edit_id, 'refresh');
        }
      } else {
        $this->data['post'] = $vals;
        setMsg('error', 'Please enter all required fields');
        redirect(base_url(ADMIN) .  '/pages/edit/' . $edit_id, 'refresh');
      }
    }
  }
  public function updateOrder()
  {
    $page_id = $this->input->post('page_id');
    $page_order = $this->input->post('page_order');
    $value = $this->input->post('value');

    $this->Page_model->updateOrder($page_id, $page_order, $value);
    exit;
  }

  function updateStatus()
  {

    $page_id = $this->input->post('id');
    $page_status = $this->input->post('field');
    $getStatusValue = $this->Page_model->getStatusValue($page_id);

    if ($getStatusValue == 0) {
      $value = 1;
    } else {
      $value = 0;
    }
    $this->Page_model->updateOrder($page_id, $page_status, $value);
    echo json_encode($value);
    exit;
  }
  function delete($del_id)
  {
    if ($this->Page_model->delete($del_id)) {
      setMsg('success', 'Page deleted successfully');
      redirect(base_url(ADMIN) .  '/pages', 'refresh');
    } else {
      setMsg('error', 'Something went wrong, Please try later.');
      redirect(base_url(ADMIN) .  '/pages', 'refresh');
    }
  }

  function page_delete()
  {
    if ($this->input->post('checkbox_value')) {
      $id = $this->input->post('checkbox_value');
      for ($count = 0; $count < count($id); $count++) {
        $this->Page_model->delete($id[$count]);
      }
    }
  }
}
