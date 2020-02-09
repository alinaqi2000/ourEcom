<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Admin extends CI_Controller
{

  /**
   *
   * @var array 
   */
  protected $data = array();

  /**
   * Loading site settings
   */
  public function __construct()
  {
    parent::__construct();

    $site = $this->getSiteSettings();
  


    $info_data = unserialize(urldecode($site->site_info_data));
    stripcslashes($info_data);
    $theme_data = unserialize(urldecode($site->site_theme_data));
    stripcslashes($theme_data);

    $social_data = unserialize(urldecode($site->site_social_data));
    stripcslashes($social_data);
    $contact_data = unserialize(urldecode($site->site_contact_data));
    stripcslashes($contact_data);
    $social_data = unserialize(urldecode($site->site_social_data));
    stripcslashes($social_data);


    $this->data['site_info_data'] = $info_data;
    $this->data['site_theme_data'] = $theme_data;

    $this->data['site_social_data'] = $social_data;
    $this->data['site_contact_data'] = $contact_data;
    $this->data['site_social_data'] = $social_data;


    $st_id = $this->session->userdata('site_id');
    $siteLocals = $this->getSiteSettingsLocals($st_id);
    $admin_data = unserialize(urldecode($siteLocals->site_admin_data));
    stripcslashes($admin_data);
    $this->data['site_admin_data'] = $admin_data;

    $this->data['site_type'] = 'super_admin';
    if (!empty($site_type)) {
      $this->data['site_type'] = $site_type;
    }
    if ($this->session->userdata('d_id') != '') {
      $this->load->model('Dealer_model');
      $this->data['dealer_data'] = $this->Dealer_model->getDealer($this->session->userdata('d_id'));
    }
    unset($this->data['apanel']->site_pswd);
  }

  /**
   * Returns website settings
   * 
   * @return object
   */
  private function getSiteSettings()
  {
    $this->db->where('site_id', '1');
    $query = $this->db->get('siteadmin');
    return $query->row();
  }
  private function getSiteSettingsLocals($site_id)
  {
    $this->db->where('site_id', $site_id);
    $query = $this->db->get('siteadmin');
    return $query->row();
  }

  /**
   * Check if the user is logged
   */
  public function isLogged()
  {
    if (!($this->session->userdata('site_id')) > 0 && !($this->session->userdata('site_type') == 'super_admin' || $this->session->userdata('site_type') == 'local_admin')) {
      redirect('apanel/logout', 'refresh');
      exit;
    }
  }
  public function isLoggedAdmin()
  {
    if (!($this->session->userdata('site_type') == 'super_admin')) {
      redirect('apanel/logout', 'refresh');
      exit;
    }
  }
}
