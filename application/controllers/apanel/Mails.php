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
    $fetch_data = $this->Mail_model->make_datatables();
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
          $sub_array = loadMAils($row->m_id, $row->m_author, $row->m_subject, $row->m_date, $row->m_status, $row->m_slabel, $row->m_attach, $row->m_tags);
          $data[] = $sub_array;
        }
      }
    } else {
      $data = '<li><h5>No mail(s) to show.</h5></li>';
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
    $fetch_data = $this->Mail_model->make_datatables();

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
    if ($t_num > 0 && !empty($fetch_data)) {
      $data = array();
      foreach (array(array_chunk($fetch_data, $max)[$count - 1]) as $fetch_data) {

        foreach ($fetch_data as $row) {
          $sub_array = loadMAils($row->m_id, $row->m_author, $row->m_subject, $row->m_date, $row->m_status, $row->m_slabel, $row->m_attach, $row->m_tags);
          $data[] = $sub_array;
        }
      }
    } else {
      $data = '<li><h3>No mails yet.</h3></li>';
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
  public function read($m_id)
  {
    $mail_id = explode('_', $m_id);
    $this->Mail_model->setAsRead($mail_id[0]);
    $this->data['attachs'] = unserialize(urldecode($this->Mail_model->getAttach($mail_id[0])));
    // pr(unserialize(urldecode($this->Mail_model->getAttach($mail_id[0]))));
    // exit;
    $this->data['row'] = $this->Mail_model->getMail($mail_id[0]);
    $this->data['page'] = 'mails';
    $this->data['mode'] = 'read';
    $this->load->view('apanel/layout/default', $this->data);
  }
  public function sendMail()
  {
    $vals['m_date'] = date(DATE_RFC2822, time());
    $vals['m_author'] = trim($this->session->userdata('site_id'));
    $vals['m_recipient'] = trim($this->input->post('rep_id'));
    $vals['m_subject'] = trim($this->input->post('m_sub'));
    $vals['m_content'] = trim($this->input->post('m_cont'));
    $vals['m_tags'] = trim($this->input->post('m_tgs'));
    // echo $vals['m_tags'];
    // exit;
    // $vals['m_attach'] = trim($this->input->post('m_attach'));
    if (($vals['m_recipient'] != 0) && !empty($vals['m_subject'])) {

      if (isset($_FILES["m_attachs"]["name"]) && $_FILES["m_attachs"]["name"] != "") {
        $filesCount = count($_FILES['m_attachs']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
          // $name =  $_FILES["m_attach"]["name"][$i];
          $_FILES['m_attach']['name'] = $_FILES['m_attachs']['name'][$i];
          $_FILES['m_attach']['tmp_name'] = $_FILES['m_attachs']['tmp_name'][$i];
          $_FILES['m_attach']['type']     = $_FILES['m_attachs']['type'][$i];
          $_FILES['m_attach']['error']     = $_FILES['m_attachs']['error'][$i];
          $_FILES['m_attach']['size']     = $_FILES['m_attachs']['size'][$i];
          $image = upload_file('./uploads/apanel/mailAttachments/', 'm_attach');
          if (!empty($image['file_name']) && empty($image['error'])) {
            $gotFiles[$i]['file'] = $image['file_name'];
            $gotFiles[$i]['size'] = $_FILES['m_attach']['size'];
            $gotFiles[$i]['type'] = $_FILES['m_attach']['type'];
          } else {
            setMsg('error', strip_tags($image['error']));
            redirect(base_url(ADMIN) .  '/compose', 'refresh');
          }
        }
        $vals['m_attach'] = serialize($gotFiles);
      }
      if ($row = $this->Mail_model->sendmail($vals)) {
        setMsg('success', 'Mail sent successfully');
      }
    } else {
      setMsg('error', 'Please fill in all the fields');
    }
    echo json_encode($_FILES["m_attach"]["name"]);
    exit;
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


    // pr($id);exit;


    $gotAttach = unserialize(urldecode($this->Mail_model->getAttach($del_id)));
    $gotCount = count($gotAttach);
    if ($gotCount > 0 && !empty($gotAttach)) {
      foreach ($gotAttach as $files) {
        // echo $files['file'];
        // exit;
        $got = "./uploads/apanel/mailAttachments/" . $files['file'];
        if (unlink($got)) {
          if ($this->Mail_model->delete($del_id)) {
            setMsg('success', 'Mail deleted successfully');
            redirect(base_url(ADMIN) .  '/inbox', 'refresh');
          } else {
            setMsg('error', 'Something went wrong, Please try later.');
            redirect(base_url(ADMIN) .  '/inbox', 'refresh');
          }
        }
      }
    } else {
      if ($this->Mail_model->delete($del_id)) {
        setMsg('success', 'Mail deleted successfully');
        redirect(base_url(ADMIN) .  '/inbox', 'refresh');
      } else {
        setMsg('error', 'Something went wrong, Please try later.');
        redirect(base_url(ADMIN) .  '/inbox', 'refresh');
      }
    }
  }

  function m_delete()
  {
    if ($this->input->post('c_box')) {
      $id = $this->input->post('c_box');
      // pr($id);exit;

      for ($count = 0; $count < count($id); $count++) {
        $gotAttach = unserialize(urldecode($this->Mail_model->getAttach($id[$count])));
        $gotCount = count($gotAttach);
        if ($gotCount > 0  && !empty($gotAttach)) {
          foreach ($gotAttach as $files) {
            // echo $files['file'];
            // exit;
            $got = "./uploads/apanel/mailAttachments/" . $files['file'];
            if (unlink($got)) {
              $this->Mail_model->delete($id[$count]);
            }
          }
        } else {
          $this->Mail_model->delete($id[$count]);
        }
      }
    }
  }
  function download($file)
  {
    $this->load->helper('download');
    $data = file_get_contents('./uploads/apanel/mailAttachments/' . $file); // Read the file's contents
    force_download($file, $data);
  }
  function downloadAll($a_id, $m_id)
  {
    $this->load->library('zip');
    $author = getRecipientUserName($a_id) . rand(1111, 9999);
    $gotAttach = unserialize(urldecode($this->Mail_model->getAttach($m_id)));
    $gotCount = count($gotAttach);
    if ($gotCount > 0  && !empty($gotAttach)) {
      foreach ($gotAttach as $files) {
        $this->zip->read_file('./uploads/apanel/mailAttachments/' . $files['file']); // Read the file's contents

      }
      $this->zip->download($author . '.zip');
    }
  }
}
