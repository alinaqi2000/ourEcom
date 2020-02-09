<?php
class Page_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    function table_name()
    {
        return "pages";
    }

    function getPage($page_id)
    {
        $this->db->where('page_id', $page_id);
        $query = $this->db->get($this->table_name());
        return $query->row();
    }
    function getStatusValue($page_id)
    {
        $this->db->where('page_id', $page_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->page_status;
    }
    function getPages($start = '', $offset = '')
    {

        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->order_by('page_order');
        $query = $this->db->get($this->table_name());
        return $query->result();
    }
    function getParentPages($start = '', $offset = '')
    {
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('page_type', '0');
        $this->db->where('page_status', '1');
        $par_que = $this->db->get($this->table_name());
        return $par_que->result();
    }
    function getSubPages($start = '', $offset = '', $parent = '')
    {

        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('page_parent', $parent);
        $query = $this->db->get($this->table_name());
        return $query->result();
    }
    function save($vals, $page_id = '')
    {
        $this->db->set($vals);
        if ($page_id != '') {
            $this->db->where('page_id', $page_id);
            $this->db->update($this->table_name());
        } else {
            $this->db->select_max('page_order');
            $ord_que = $this->db->get($this->table_name());
            $ord_rt = $ord_que->row()->page_order;
            $new_order = $ord_rt + 1;
            $this->db->set('page_order', $new_order, FALSE);
            $this->db->insert($this->table_name());
        }
        return $vals;
    }
    function isAlreadyExist($title)
    {

        $this->db->where('page_title', $title);
        $query = $this->db->get($this->table_name());
        return $query->row()->page_title;
    }
    function isAlreadyExistEdit($title, $id)
    {

        $this->db->where('page_title', $title);
        $this->db->where('page_id <>', $id, FALSE);
        $query = $this->db->get($this->table_name());
        $rslt = $query->result_array();
        if (count($rslt) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function delete($page_id)
    {
        $this->db->where('page_id', $page_id);
        $this->db->delete($this->table_name());
        return $page_id;
    }


    function updateOrder($page_id, $page_order, $value)
    {
        $data = array($page_order => $value);
        $this->db->where('page_id', $page_id);
        $this->db->update($this->table_name(), $data);
    }


    var $select_column = array("page_id", "page_name", "page_title", "page_parent", "page_detail", "page_status");
    var $order_column = array("page_id", "page_name", "page_title", "page_parent", "page_detail", "page_status");
    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table_name());
        if (isset($_POST["search"]["value"])) {
            $this->db->like("page_name", $_POST["search"]["value"]);
            $this->db->or_like("page_id", $_POST["search"]["value"]);
            $this->db->or_like("page_title", $_POST["search"]["value"]);
            $this->db->or_like("page_parent", $_POST["search"]["value"]);
            $this->db->or_like("page_detail", $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('page_modify_date', 'DESC');
        }
    }
    function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data()
    {
        $this->make_query();
        return $this->db->count_all_results();
    }
    function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table_name());
        return $this->db->count_all_results();
    }
}
