<?php
class Gallery_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    function table_name()
    {
        return "gallery";
    }

    function getGall($g_id)
    {
        $this->db->where('g_id', $g_id);
        $query = $this->db->get($this->table_name());
        return $query->row();
    }
    function getAttach($g_id)
    {
        $this->db->where('g_id', $g_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->g_image;
    }
    function getStatusValue($g_id)
    {
        $this->db->where('g_id', $g_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->g_status;
    }
    function getLabelValue($g_id)
    {
        $this->db->where('g_id', $g_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->g_label;
    }
    function getGallery($start = '', $offset = '')
    {

        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->order_by('g_date', 'ASC');
        $query = $this->db->get($this->table_name());
        return $query->result();
    }
    function getParent1Gallery($start = '', $offset = '')
    {
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('g_status', '1');
        $this->db->where('g_type', '0');
        $par_que = $this->db->get($this->table_name());
        return $par_que->result();
    }
    function getParent2Gallery($start = '', $offset = '')
    {
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('g_status', '1');
        $this->db->where('g_type', '1');
        $par_que = $this->db->get($this->table_name());
        return $par_que->result();
    }
    function getSubGallery($start = '', $offset = '', $parent = '')
    {

        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->where('g_parent1', $parent);
        $query = $this->db->get($this->table_name());
        return $query->result();
    }
    function save($vals, $g_id = '')
    {
        $this->db->set($vals);
        if ($g_id != '') {
            $this->db->where('g_id', $g_id);
            $this->db->update($this->table_name());
        } else {
            $this->db->insert($this->table_name());
        }
        return $vals;
    }
    function isAlreadyExist($title)
    {

        $this->db->where('g_title', $title);
        $query = $this->db->get($this->table_name());
        return $query->row()->g_title;
    }
    function isAlreadyExistEdit($title, $id)
    {

        $this->db->where('g_title', $title);
        $this->db->where('g_id <>', $id, FALSE);
        $query = $this->db->get($this->table_name());
        $rslt = $query->result_array();
        if (count($rslt) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function delete($g_id)
    {
        $this->db->where('g_id', $g_id);
        $this->db->delete($this->table_name());
        return $g_id;
    }


    function updateOrder($g_id, $g_order, $value)
    {
        $data = array($g_order => $value);
        $this->db->where('g_id', $g_id);
        $this->db->update($this->table_name(), $data);
    }


    var $select_column = array("g_id", "g_title", "g_status", "g_date", "g_image");
    var $order_column = array("g_id", "g_title", "g_status", "g_date", "g_image");
    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table_name());
        if (isset($_POST["search"]["value"])) {
            $this->db->or_like("g_id", $_POST["search"]["value"]);
            $this->db->or_like("g_title", $_POST["search"]["value"]);
            $this->db->or_like("g_status", $_POST["search"]["value"]);
            $this->db->or_like("g_date", $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('g_date', 'ASC');
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
