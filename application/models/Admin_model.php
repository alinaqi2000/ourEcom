<?php
class Admin_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	function table_name()
	{
		return "siteadmin";
	}
	function getSearchAdmins($field, $value, $id = '1')
	{

		$this->db->like($field, $value);
		$this->db->where('site_id <>' . $id);
		$query = $this->db->get($this->table_name());
		return $query->result();
	}
	function getSettings()
	{
		$query = $this->db->get($this->table_name());
		$rs = $query->result();
		return $rs;
	}

	function getAdmin()
	{
		$this->db->where('site_id', '1');
		$query = $this->db->get($this->table_name());
		return $query->row();
	}


	function checkOldPswd($site_id, $password)
	{
		$this->db->where('site_id', $site_id);
		$this->db->where('site_pswd', md5($password));
		$query = $this->db->get($this->table_name());
		$rs = $query->row();
		return $rs;
	}

	function saveSettings($vals, $site_id)
	{
		$this->db->set($vals);
		$this->db->where('site_id', $site_id);
		$this->db->update($this->table_name());
		return TRUE;
	}

	function updateStats()
	{
		$this->db->where('site_id', '1');
		$query = $this->db->get($this->table_name());
		$rs = $query->row();

		$this->saveSettings($vals);
	}
	function authenticate($username, $password)
	{

		$this->db->where('site_login', $username);
		$this->db->where('site_pswd', md5($password));

		$query = $this->db->get($this->table_name());
		if ($row = $query->row()) {
			return $row;
		}
		return FALSE;
	}

	function isAlreadyExistEdit($title, $id)
	{

		$this->db->where('site_login', $title);
		$this->db->where('site_id <>', $id, FALSE);
		$query = $this->db->get($this->table_name());
		$rslt = $query->result_array();
		if (count($rslt) > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
