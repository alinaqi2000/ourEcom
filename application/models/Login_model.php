<?php
class Login_model extends CI_Model {

  var $cus_table = "customers"; 

  public function __construct() {
    $this->load->database();
  }

  function table_name() {
    return "siteadmin";
  }

  function getSettings() {
    $query = $this->db->get($this->table_name());
    return $query->row();
  }
  
  function isExistCustomer($cus_email) {

    $this->db->where('cus_email', $cus_email);
    $query = $this->db->get($this->cus_table);
    return $query->row();
  }
  function isExistAdmin($site_login) {

    $this->db->where('site_login', $site_login);
    $query = $this->db->get($this->table_name());
    return $query->row();
  }
  function authenticate($username,$password) {

    $this->db->where('site_login', $username);
    $this->db->where('site_pswd', md5($password));

    $query = $this->db->get($this->table_name());
    if ($row=$query->row()) {
      return $row;
    }    
    return FALSE;
  }

  function authenticateCustomer($username,$password) {

    $this->db->where('cus_email', $username);
    $this->db->where('cus_password', md5($password));
    // $this->db->limit(0,1);
    $query = $this->db->get($this->cus_table);
    if ($row=$query->row()) {
      return $row;
    }    
    
    return FALSE;
  }



}
?>