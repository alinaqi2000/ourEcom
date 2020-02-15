<?php
class Category_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    function table_name()
    {
        return "categories";
    }

    function getCategory($cat_id)
    {
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get($this->table_name());
        return $query->row();
    }
    function getStatusValue($cat_id)
    {
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->cat_status;
    }
    function getLabelValue($cat_id)
    {
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->cat_label;
    }
    function getCategories($start = '', $offset = '')
    {

        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->order_by('cat_order');
        $query = $this->db->get($this->table_name());
        return $query->result();
    }
    function getParent1Categories($start = '', $offset = '')
    {
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('cat_status', '1');
        $this->db->where('cat_type', '0');
        $par_que = $this->db->get($this->table_name());
        return $par_que->result();
    }
    function getParent2Categories($start = '', $offset = '')
    {
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('cat_status', '1');
        $this->db->where('cat_type', '1');
        $par_que = $this->db->get($this->table_name());
        return $par_que->result();
    }
    function getSubCategories($start = '', $offset = '', $parent = '')
    {

        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('cat_parent1', $parent);
        $query = $this->db->get($this->table_name());
        return $query->result();
    }
    function save($vals, $cat_id = '')
    {
        $this->db->set($vals);
        if ($cat_id != '') {
            $this->db->where('cat_id', $cat_id);
            $this->db->update($this->table_name());
        } else {
            $this->db->select_max('cat_order');
            $ord_que = $this->db->get($this->table_name());
            $ord_rt = $ord_que->row()->cat_order;
            $new_order = $ord_rt + 1;
            $this->db->set('cat_order', $new_order, FALSE);
            $this->db->insert($this->table_name());
        }
        return $vals;
    }
    function isAlreadyExist($title)
    {

        $this->db->where('cat_title', $title);
        $query = $this->db->get($this->table_name());
        return $query->row()->cat_title;
    }
    function isAlreadyExistEdit($title, $id)
    {

        $this->db->where('cat_title', $title);
        $this->db->where('cat_id <>', $id, FALSE);
        $query = $this->db->get($this->table_name());
        $rslt = $query->result_array();
        if (count($rslt) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function delete($cat_id)
    {
        $this->db->where('cat_id', $cat_id);
        $this->db->delete($this->table_name());
        return $cat_id;
    }


    function updateOrder($cat_id, $cat_order, $value)
    {
        $data = array($cat_order => $value);
        $this->db->where('cat_id', $cat_id);
        $this->db->update($this->table_name(), $data);
    }


    var $select_column = array("cat_id", "cat_slug", "cat_title", "cat_parent1", "cat_parent2", "cat_status", "cat_order", "cat_label");
    var $order_column = array("cat_id", "cat_slug", "cat_title", "cat_parent1", "cat_parent2", "cat_status", "cat_order", "cat_label");
    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table_name());
        if (isset($_POST["search"]["value"])) {
            $this->db->like("cat_slug", $_POST["search"]["value"]);
            $this->db->or_like("cat_id", $_POST["search"]["value"]);
            $this->db->or_like("cat_title", $_POST["search"]["value"]);
            $this->db->or_like("cat_parent1", $_POST["search"]["value"]);
            $this->db->or_like("cat_parent2", $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('cat_parent1', 'ASC');
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
