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
    $this->load->model('Admin_model');
  }

  public function index()
  {

    $this->data['page'] = 'mails';
    $this->data['rows'] = $this->Mail_model->getMails();
    $this->load->view('apanel/layout/default', $this->data);
  }

  function fetchMails($count = 1)
  {
    $max = 5;
    $srNo = 0;
    $fetch_data = $this->Mail_model->make_datatables();
    $data = array();
    $t_num = count($fetch_data);
    $p_num = $count + 1;
    $m_num = $count - 1;
    if ($t_num > ($max * $count)) {
      $a_num = $max * $count;
      $n_num = ($max * $count) - ($max - 1);
    } elseif ($t_num <= ($max * $count)) {
      $a_num = $t_num;
      $n_num = ($max * $count) - ($max - 1);
    } else {
      $a_num = $t_num;
      $n_num = 1;
    }
    foreach (array(array_chunk($fetch_data, $max)[$count - 1]) as $fetch_data) {

      foreach ($fetch_data as $row) {
        $sub_array = loadMAils($row->m_author, $row->m_subject, $row->m_date);
        $data[] = $sub_array;
      }
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
  function fetchSents($count = 1)
  {
    $max = 5;
    $srNo = 0;
    $fetch_data = $this->Mail_model->make_datatables();
    $data = array();
    $t_num = count($fetch_data);
    $p_num = $count + 1;
    $m_num = $count - 1;
    if ($t_num > ($max * $count)) {
      $a_num = $max * $count;
      $n_num = ($max * $count) - ($max - 1);
    } elseif ($t_num <= ($max * $count)) {
      $a_num = $t_num;
      $n_num = ($max * $count) - ($max - 1);
    } else {
      $a_num = $t_num;
      $n_num = 1;
    }
    foreach (array(array_chunk($fetch_data, $max)[$count - 1]) as $fetch_data) {

      foreach ($fetch_data as $row) {
        $sub_array = loadMAils($row->m_author, $row->m_subject, $row->m_date);
        $data[] = $sub_array;
      }
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


  public function compose()
  {
    $this->data['page'] = 'mails';
    $this->data['mode'] = 'compose';
    $this->load->view('apanel/layout/default', $this->data);
  }
  public function sendMail()
  {
    $vals['m_date'] = date(DATE_RFC2822, time());
    $vals['m_author'] = trim($this->session->userdata('site_id'));
    $vals['m_recipient'] = trim($this->input->post('rep_id'));
    $vals['m_subject'] = trim($this->input->post('m_sub'));
    $vals['m_content'] = trim($this->input->post('m_cont'));
    if (($vals['m_recipient'] != 0) && !empty($vals['m_subject']) && !empty($vals['m_content'])) {
      if ($row = $this->Mail_model->sendmail($vals)) {
        setMsg('success', 'Mail sent successfully');
      }
    } else {
      setMsg('error', 'Please fill in all the fields');
    }
    echo json_encode($vals);
  }

  function getAdmins()
  {
    $id = trim($this->session->userdata('site_id'));
    $name = trim($this->input->post('search'));
    if ($rows = $this->Admin_model->getSearchAdmins('site_login', $name, $id)) {

      $rslt[] .= '<div classs="list-group">';
      foreach ($rows as $row) {
        $adminData = unserialize(urldecode($row->site_admin_data));
        stripcslashes($adminData);
        $rslt[] .= '<a href="javascript:void(0);" role"button" class="selectAdmin list-group-item" data-name="' . $row->site_login . '" data-id="' . $row->site_id . '"><strong>' . $adminData['admin_name'] . '</strong> @' . $row->site_login . '</a>';
      }
      $rslt[] .= '</div>';
    } else {
      $rslt[] = '<div classs="list-group"><a class="list-group-item">No user found</a></div>';
    }
    echo json_encode($rslt);
    exit;
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
