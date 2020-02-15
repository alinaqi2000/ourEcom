<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mails extends MY_Admin
{
  public function __construct()
  {
    parent::__construct();
    $this->isLoggedAdmin();
    $this->load->model('Master_model');
    $this->load->model('Mail_model');
  }

  public function index()
  {

    $this->data['page'] = 'mails';
    $this->data['rows'] = $this->Mail_model->getMails();
    $this->load->view('apanel/layout/default', $this->data);
  }

  function fetchMails()
  {
    $srNo = 0;
    $fetch_data = $this->Mail_model->make_datatables();
    $data = array();
    foreach ($fetch_data as $row) {
      $srNo++;
      $m_lvl1 = "";
      $m_lvl2 = "";
      if (!empty($row->m_parent1)) {
        $m_lvl1 = getParentCat($row->m_parent1);
      }
      if (!empty($row->m_parent2)) {
        $m_lvl2 = getParentCat($row->m_parent2);
      }

      $sub_array = array();
      $sub_array[] = $row->m_id;
      $sub_array[] = $row->m_title;
      $sub_array[] = $m_lvl1;
      $sub_array[] = $m_lvl2;
      $sub_array[] = getOrderButton($row->m_order, $row->m_id, 'm_order',base_url("apanel/mails/updateOrder"));
      $sub_array[] = getFeaturedButton($row->m_label,  $row->m_id, 'm_label',  base_url(ADMIN . '/mails/updateLabel'));
      $sub_array[] = getStatusButton($row->m_status, $row->m_id, 'm_status', base_url(ADMIN . '/mails/updateStatus'));

      $sub_array[] = '<a href="' . base_url('apanel/mails/edit/' . $row->m_id) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> &nbsp;
      <a onclick="return confirm(\' Are you sure, you want to delete? \')" href="' . base_url('apanel/mails/delete/' . $row->m_id) . '" class="btn btn-sm btn-danger"><i class="ti-trash"></i> Delete</a>';

      $data[] = $sub_array;
    }
    $output = array(
      "draw" => intval($_POST["draw"]),
      "recordsTotal" => $this->Mail_model->get_all_data(),
      "recordsFiltered" => $this->Mail_model->get_filtered_data(),
      "data" => $data
    );
    echo json_encode($output);
  }


  public function add()
  {
    $this->data['page'] = 'mails';
    $this->data['mode'] = 'add';
    $this->data['res1'] = $this->Mail_model->getParent1Mails();
    $this->data['res2'] = $this->Mail_model->getParent2Mails();

    $this->load->view('apanel/layout/default', $this->data);
    if ($vals = $this->input->post()) {
      if (is_array($vals) && $vals['m_title'] != '') {
        $vals['m_slug'] = toSlugUrl($vals['m_title']);
        if (empty($this->Mail_model->isAlreadyExist($vals['m_title']))) {
          if ($this->Mail_model->save($vals)) {
            setMsg('success', 'Mail added successfully');
            redirect(base_url(ADMIN) .  '/mails', 'refresh');
          }
        } else {
          setMsg('error', 'A category already exists with this title');
          redirect(base_url(ADMIN) .  '/mails/add', 'refresh');
        }
      } else {
        $this->data['post'] = $vals;
        setMsg('error', 'Please enter all required fields');
        redirect(base_url(ADMIN) .  '/mails/add', 'refresh');
      }
    }
  }
  


 

  function delete($del_id)
  {
    if ($this->Mail_model->delete($del_id)) {
      setMsg('success', 'Mail deleted successfully');
      redirect(base_url(ADMIN) .  '/mails', 'refresh');
    } else {
      setMsg('error', 'Something went wrong, Please try later.');
      redirect(base_url(ADMIN) .  '/mails', 'refresh');
    }
  }

  function m_delete()
  {
    if ($this->input->post('checkbox_value')) {
      $id = $this->input->post('checkbox_value');
      for ($count = 0; $count < count($id); $count++) {
        $this->Mail_model->delete($id[$count]);
      }
    }
  }
}
