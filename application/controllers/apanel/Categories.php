<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends MY_Admin
{
  public function __construct()
  {
    parent::__construct();
    $this->isLoggedAdmin();
    $this->load->model('Master_model');
    $this->load->model('Category_model');
  }

  public function index()
  {

    $this->data['page'] = 'categories';
    $this->data['rows'] = $this->Category_model->getCategories();
    $this->load->view('apanel/layout/default', $this->data);
  }

  function fetchCategories()
  {
    $srNo = 0;
    $fetch_data = $this->Category_model->make_datatables();
    $data = array();
    foreach ($fetch_data as $row) {
      $srNo++;
      $cat_lvl1 = "";
      $cat_lvl2 = "";
      if (!empty($row->cat_parent1)) {
        $cat_lvl1 = getParentCat($row->cat_parent1);
      }
      if (!empty($row->cat_parent2)) {
        $cat_lvl2 = getParentCat($row->cat_parent2);
      }

      $sub_array = array();
      $sub_array[] = $row->cat_id;
      $sub_array[] = $row->cat_title;
      $sub_array[] = $cat_lvl1;
      $sub_array[] = $cat_lvl2;
      $sub_array[] = getOrderButton($row->cat_order, $row->cat_id, 'cat_order', base_url("apanel/categories/updateOrder"));
      $sub_array[] = getFeaturedButton($row->cat_label,  $row->cat_id, 'cat_label',  base_url(ADMIN . '/categories/updateLabel'));
      $sub_array[] = getStatusButton($row->cat_status, $row->cat_id, 'cat_status', base_url(ADMIN . '/categories/updateStatus'));

      $sub_array[] = '<a href="' . base_url('apanel/categories/edit/' . $row->cat_id) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> &nbsp;
      <a onclick="return confirm(\' Are you sure, you want to delete? \')" href="' . base_url('apanel/categories/delete/' . $row->cat_id) . '" class="btn btn-sm btn-danger"><i class="ti-trash"></i> Delete</a>';

      $data[] = $sub_array;
    }
    $output = array(
      "draw" => intval($_POST["draw"]),
      "recordsTotal" => $this->Category_model->get_all_data(),
      "recordsFiltered" => $this->Category_model->get_filtered_data(),
      "data" => $data
    );
    echo json_encode($output);
  }


  public function add()
  {
    $this->data['page'] = 'categories';
    $this->data['mode'] = 'add';
    $this->data['res1'] = $this->Category_model->getParent1Categories();
    $this->data['res2'] = $this->Category_model->getParent2Categories();

    $this->load->view('apanel/layout/default', $this->data);
    if ($vals = $this->input->post()) {
      if (is_array($vals) && $vals['cat_title'] != '') {
        $vals['cat_slug'] = toSlugUrl($vals['cat_title']);
        if (empty($this->Category_model->isAlreadyExist($vals['cat_title']))) {
          if ($this->Category_model->save($vals)) {
            setMsg('success', 'Category added successfully');
            redirect(base_url(ADMIN) .  '/categories', 'refresh');
          }
        } else {
          setMsg('error', 'A category already exists with this title');
          redirect(base_url(ADMIN) .  '/categories/add', 'refresh');
        }
      } else {
        $this->data['post'] = $vals;
        setMsg('error', 'Please enter all required fields');
        redirect(base_url(ADMIN) .  '/categories/add', 'refresh');
      }
    }
  }
  public function edit($edit_id)
  {
    $this->data['page'] = 'categories';
    $this->data['mode'] = 'edit';
    $this->data['res1'] = $this->Category_model->getParent1Categories();
    $this->data['res2'] = $this->Category_model->getParent2Categories();
    $this->data['row'] = $this->Category_model->getCategory($edit_id);

    $this->load->view('apanel/layout/default', $this->data);
    if ($vals = $this->input->post()) {
      if (is_array($vals) && $vals['cat_title'] != '') {
        if (empty($this->Category_model->isAlreadyExistEdit($vals['cat_title'], $edit_id))) {
          htmlentities($vals['cat_detail']);
          if ($this->Category_model->save($vals, $edit_id)) {
            setMsg('success', 'Category updated successfully');
            redirect(base_url(ADMIN) .  '/categories/edit/' . $edit_id, 'refresh');
          }
        } else {
          setMsg('error', 'A category already exists with this title');
          redirect(base_url(ADMIN) .  '/categories/edit/' . $edit_id, 'refresh');
        }
      } else {
        $this->data['post'] = $vals;
        setMsg('error', 'Please enter all required fields');
        redirect(base_url(ADMIN) .  '/categories/edit/' . $edit_id, 'refresh');
      }
    }
  }
  public function updateOrder()
  {
    $cat_id = $this->input->post('id');
    $cat_order = $this->input->post('order');
    $value = $this->input->post('value');

    $this->Category_model->updateOrder($cat_id, $cat_order, $value);
    exit;
  }

  function updateStatus()
  {

    $cat_id = $this->input->post('id');
    $cat_status = $this->input->post('field');
    $getStatusValue = $this->Category_model->getStatusValue($cat_id);

    if ($getStatusValue == 0) {
      $value = 1;
    } else {
      $value = 0;
    }
    $this->Category_model->updateOrder($cat_id, $cat_status, $value);
    echo json_encode($value);
    exit;
  }
  function updateLabel()
  {

    $cat_id = $this->input->post('id');
    $cat_status = $this->input->post('field');
    $cat_label = $this->input->post('value');

    $this->Category_model->updateOrder($cat_id, $cat_status, $cat_label);
    echo json_encode($cat_label);
    exit;
  }
  function delete($del_id)
  {
    if ($this->Category_model->delete($del_id)) {
      setMsg('success', 'Category deleted successfully');
      redirect(base_url(ADMIN) .  '/categories', 'refresh');
    } else {
      setMsg('error', 'Something went wrong, Please try later.');
      redirect(base_url(ADMIN) .  '/categories', 'refresh');
    }
  }

  function cat_delete()
  {
    if ($this->input->post('checkbox_value')) {
      $id = $this->input->post('checkbox_value');
      for ($count = 0; $count < count($id); $count++) {
        $this->Category_model->delete($id[$count]);
      }
    }
  }
}
