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

    $name = 'maxMails_' . $this->session->userdata('site_id');
    $getsMax = get_cookie($name);
    $this->data['cokie'] = $getsMax;
  }

  public function index()
  {

    $name = 'maxMails_' . $this->session->userdata('site_id');
    $getsMax = get_cookie($name);
    if (empty($getsMax) || $getsMax == 'undefined' || $getsMax == 'normal') {
      $getsMax = 25;
    }

    // echo $getsMax;
    // exit;
    $this->data['cokie'] = $getsMax;
    if ($getsMax != 10 && $getsMax != 25 && $getsMax != 50 && $getsMax != 100) {

      $cookie = array(
        'name'   => $name,
        'value'  => '25',
        'expire' => 2592000,
        'secure' => FALSE
      );

      $this->input->set_cookie($cookie);
    }
    $this->data['page'] = 'mails';
    $this->data['mode'] = 'inbox';
    $this->load->view('apanel/layout/default', $this->data);
  }
  public function sent()
  {

    $this->data['page'] = 'mails';
    $this->data['mode'] = 'sent';
    $this->load->view('apanel/layout/default', $this->data);
  }
  function fetchMails($count = 1, $max, $mode = '')
  {
    $this->load->helper('cookie');
    $name = 'maxMails_' . $this->session->userdata('site_id');
    $getMax = get_cookie($name);

    if ($max != $getMax) {
      delete_cookie($name);
      $cookie = array(
        'name'   => $name,
        'value'  =>  $max,
        'expire' => 2592000,
        'secure' => FALSE
      );
      $this->input->set_cookie($cookie);
      $count = 1;
    }




    $uID = $this->session->userdata('site_id');
    $fetch_data = $this->Mail_model->make_datatables($uID, $mode);
    $data = array();
    $t_num = count($fetch_data);
    $fetch_Sdata = $this->Mail_model->getUnReadMails($uID);
    $r_num = count($fetch_Sdata);
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
          $sub_array = loadMAils('inbox', $row->m_id, $row->m_author, $row->m_recipient, $row->m_subject, $row->m_date, $row->m_status, $row->m_label, $row->m_attach, $row->m_tags, 'm_label');
          $data[] = $sub_array;
        }
      }
    } else {
      $data = '<li><h5>No mail(s) to show.</h5></li>';
    }
    $output = array(
      'mxe' => $getMax,
      'data' => $data,
      'mode' => $mode,
      'max' => $max,
      'c_page' => $count,
      'r_num' => $r_num,
      't_count' => $t_num,
      'a_count' => $a_num,
      'n_count' => $n_num,
      'p_nxt' => $p_num,
      'm_nxt' => $m_num,
    );


    echo json_encode($output);
    exit;
  }
  function fetchSents($count = 1, $max, $mode = '')
  {
    $name = 'maxMails_' . $this->session->userdata('site_id');
    $this->load->helper('cookie');
    $getMax = get_cookie($name);

    if ($max != $getMax) {
      delete_cookie($name);
      $cookie = array(
        'name'   => $name,
        'value'  =>  $max,
        'expire' => 2592000,
        'secure' => FALSE
      );
      $this->input->set_cookie($cookie);
      $count = 1;
    }



    $uID = $this->session->userdata('site_id');
    $fetch_data = $this->Mail_model->make_sent_datatables($uID, $mode);
    $data = array();
    $t_num = count($fetch_data);
    $fetch_Rdata = $this->Mail_model->getUnReadMails($uID);
    $r_num = count($fetch_Rdata);
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
          $sub_array = loadMAils('sent', $row->m_id, $row->m_author, $row->m_recipient, $row->m_subject, $row->m_date, $row->m_status, 2, $row->m_attach, $row->m_tags, 'm_label');
          $data[] = $sub_array;
        }
      }
    } else {
      $data = '<li><h5>No mail(s) to show.</h5></li>';
    }
    $output = array(
      'data' => $data,
      'mode' => $mode,
      'max' => $max,
      'c_page' => $count,
      'r_num' => $r_num,
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
  public function read($a_id, $m_id)
  {
    $this->data['attachs'] = unserialize(urldecode($this->Mail_model->getAttach($m_id)));
    $m_code = $this->Mail_model->getMailCode($m_id);
    if ($a_id != $this->session->userdata('site_id')) {
      $this->Mail_model->setAsRead($m_code);
      $this->data['readType'] = 'inbox';
    } else {
      $this->data['readType'] = 'sent';
    }
    // pr(unserialize(urldecode($this->Mail_model->getAttach($mail_id[0]))));
    // exit;
    $this->data['row'] = $this->Mail_model->getMail($m_id);
    // echo $m_id;exit;
    if (empty($this->Mail_model->getMail($m_id))) {
      setMsg('error', 'No mail found.');
      redirect(base_url(ADMIN) .  '/inbox', 'refresh');
      exit;
    }
    $this->data['page'] = 'mails';
    $this->data['mode'] = 'read';
    $this->load->view('apanel/layout/default', $this->data);
  }
  function m_read()
  {
    if ($this->input->post('c_box')) {
      $id = $this->input->post('c_box');
      // pr($id);exit;

      for ($count = 0; $count < count($id); $count++) {
        $m_code = $this->Mail_model->getMailCode($id[$count]);
        $this->Mail_model->setAsRead($m_code);
      }
    }
  }
  function m_un_read()
  {
    if ($this->input->post('c_box')) {
      $id = $this->input->post('c_box');
      // pr($id);exit;

      for ($count = 0; $count < count($id); $count++) {
        $m_code = $this->Mail_model->getMailCode($id[$count]);
        $this->Mail_model->setAsUnRead($m_code);
      }
    }
  }
  function m_starred()
  {
    if ($this->input->post('c_box')) {
      $id = $this->input->post('c_box');
      // pr($id);exit;

      for ($count = 0; $count < count($id); $count++) {
        $this->Mail_model->setAsStarred($id[$count]);
      }
    }
  }
  function m_un_starred()
  {
    if ($this->input->post('c_box')) {
      $id = $this->input->post('c_box');
      // pr($id);exit;

      for ($count = 0; $count < count($id); $count++) {
        $this->Mail_model->setAsUnStarred($id[$count]);
      }
    }
  }
  public function sendMail()
  {
    $ct = time() + rand(11111, 99999);
    $vals['m_date'] = date(DATE_RFC2822, time());
    $vals['m_author'] = trim($this->session->userdata('site_id'));
    $vals['m_recipient'] = trim($this->input->post('rep_id'));
    $vals['m_subject'] = trim($this->input->post('m_sub'));
    $vals['m_content'] = trim($this->input->post('m_cont'));
    $vals['m_tags'] = trim($this->input->post('m_tgs'));
    $vals['m_owner'] = trim($this->session->userdata('site_id'));
    $vals['m_code'] = $ct;

    $n_vals['m_date'] = date(DATE_RFC2822, time());
    $n_vals['m_author'] = trim($this->session->userdata('site_id'));
    $n_vals['m_recipient'] = trim($this->input->post('rep_id'));
    $n_vals['m_subject'] = trim($this->input->post('m_sub'));
    $n_vals['m_content'] = trim($this->input->post('m_cont'));
    $n_vals['m_tags'] = trim($this->input->post('m_tgs'));
    $n_vals['m_owner'] = trim($this->input->post('rep_id'));
    $n_vals['m_code'] = $ct;
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
            $y = 1;
          } else {
            $y = 0;
          }
        }
        if ($y == 0) {
          for ($i = 0; $i < $filesCount; $i++) {
            $got = "./uploads/apanel/mailAttachments/" . $_FILES['m_attachs']['name'][$i];
            unlink($got);
          }
          setMsg('error', strip_tags($image['error']));
          redirect(base_url(ADMIN) .  '/compose', 'refresh');
        }

        $vals['m_attach'] = serialize($gotFiles);
        $n_vals['m_attach'] = serialize($gotFiles);
      }

      if ($row1 = $this->Mail_model->sendmail($vals) && $row2 = $this->Mail_model->sendmail($n_vals)) {
        if ($row1 == 1 && $row2 == 1) {
          setMsg('success', 'Mail sent successfully');
        } else {
          setMsg('error', 'Something went wrong!, Try again.');
          $filesCount = count($_FILES['m_attachs']['name']);
          for ($i = 0; $i < $filesCount; $i++) {
            $got = "./uploads/apanel/mailAttachments/" . $_FILES['m_attachs']['name'][$i];
            unlink($got);
          }
        }
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

  function updateLabel()
  {

    $m_id = $this->input->post('id');
    $m_status = $this->input->post('field');
    $getStatusValue = $this->Mail_model->getLabelValue($m_id);

    if ($getStatusValue == 0) {
      $value = 1;
    } else {
      $value = 0;
    }
    $this->Mail_model->updateOrder($m_id, $m_status, $value);
    echo json_encode($value);
    exit;
  }

  function delete($del_id)
  {
    $m_code = $this->Mail_model->getMailCode($del_id);
    $n_code = $this->Mail_model->searchCode($m_code, $del_id);
    $s_code = count($n_code);
    if ($s_code > 0) {
      if ($this->Mail_model->delete($del_id)) {
        setMsg('success', 'Mail deleted successfully');
      } else {
        setMsg('error', 'Something went wrong, Please try later.');
      }
    } else {
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
            } else {
              setMsg('error', 'Something went wrong, Please try later.');
            }
          }
        }
      } else {
        if ($this->Mail_model->delete($del_id)) {
          setMsg('success', 'Mail deleted successfully');
        } else {
          setMsg('error', 'Something went wrong, Please try later.');
        }
      }
    }
    redirect(base_url(ADMIN) .  '/inbox', 'refresh');
  }

  function m_delete()
  {
    if ($this->input->post('c_box')) {
      $id = $this->input->post('c_box');
      // pr($id);exit;

      for ($count = 0; $count < count($id); $count++) {
        $m_code = $this->Mail_model->getMailCode($id[$count]);
        $n_code = $this->Mail_model->searchCode($m_code, $id[$count]);
        $s_code = count($n_code);
        if ($s_code > 0) {
          $this->Mail_model->delete($id[$count]);
        } else {
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
