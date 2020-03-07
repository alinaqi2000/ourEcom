<?php
class Index_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	function getUnReadCount($st_id)
	{
		$this->db->where('m_status', '0');
		$this->db->where('m_recipient', $st_id);
		$query = $this->db->get('tbl_mails');
		$rs = $query->result();
		return $rs;
	}
	function getSliders()
	{
		$this->db->where('slider_status', '1');
		$this->db->order_by('slider_order', 'ASC');
		$query = $this->db->get('tbl_slider');
		$rs = $query->result();
		return $rs;
	}
	function getParentPages()
	{
		$this->db->where('page_status', '1');
		$this->db->where('page_menu', '1');
		$this->db->where('page_type', '0');
		$this->db->order_by('page_order', 'ASC');
		$query = $this->db->get('tbl_pages');
		$rs = $query->result();
		return $rs;
	}
	function getFPages()
	{
		$this->db->where('page_status', '1');
		$this->db->where('page_label', '1');
		$this->db->order_by('page_order', 'ASC');
		$query = $this->db->get('tbl_pages');
		$rs = $query->result();
		return $rs;
	}

	function getParentMCats()
	{
		$this->db->where('cat_status', '1');
		$this->db->where('cat_type', '0');
		$this->db->where('cat_menu', '1');
		$this->db->order_by('cat_order', 'ASC');
		$query = $this->db->get('tbl_categories');
		$rs = $query->result();
		return $rs;
	}

	function getSubMCats()
	{
		$this->db->where('cat_status', '1');
		$this->db->where('cat_type', '1');
		$this->db->where('cat_menu', '1');
		$this->db->where('cat_label', '1');
		$this->db->order_by('cat_order', 'ASC');
		$query = $this->db->get('tbl_categories');
		$rs = $query->result();
		return $rs;
	}
	function getDProducts()
	{
		$this->db->where('p_status', '1');
		$this->db->where("p_discount != ''");
		$this->db->order_by('p_discount', 'DESC');
		$query = $this->db->get('tbl_products');
		$rs = $query->result();
		return $rs;
	}
	function getFProducts()
	{
		$this->db->where('p_status', '1');
		$this->db->where("p_label", '1');
		$this->db->order_by('p_discount', 'DESC');
		$query = $this->db->get('tbl_products');
		$rs = $query->result();
		return $rs;
	}
	function getNProducts()
	{
		$this->db->where('p_label', '1');
		$this->db->where('p_status', '1');
		$this->db->order_by('p_date', 'DESC');
		$this->db->limit(12);
		$query = $this->db->get('tbl_products');
		$rs = $query->result();
		return $rs;
	}

	function searchQuery($cat = '', $query)
	{

		$this->db->where('p_status', '1');
		if ($cat != '') {

			$this->db->like('p_cat', $cat);
			$this->db->or_like('p_pcat', $cat);
			$this->db->or_like('p_title', $query);
			$this->db->or_like('p_desc', $query);
		} else {

			$this->db->like('p_title', $query);
			$this->db->or_like('p_desc', $query);
		}

		$this->db->order_by('p_date', 'DESC');
		$query = $this->db->get('tbl_products');
		// echo $this->db->last_query();exit;
		$rs = $query->result();
		return $rs;
	}
	function searchCat($cat)
	{
		$this->db->where('p_status', '1');
		$this->db->where('p_cat', $cat);
		$this->db->or_where('p_pcat', $cat);
		$this->db->order_by('p_date', 'DESC');
		$query = $this->db->get('tbl_products');
		// echo $this->db->last_query();exit;
		$rs = $query->result();
		return $rs;
	}
}
