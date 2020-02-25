<?php
class Mail_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        // $this->load->sessions();
    }

    function table_name()
    {
        return "mails";
    }
    function cur_id()
    {
        return  $this->session->userdata('site_id');
    }

    function getMail($m_id)
    {
        $this->db->where('m_id', $m_id);
        $query = $this->db->get($this->table_name());
        return $query->row();
    }
    function getAttach($m_id)
    {
        $this->db->where('m_id', $m_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->m_attach;
    }
    function setAsRead($m_id)
    {
        $this->db->set('m_status', '1');
        $this->db->where('m_id', $m_id);
        $this->db->update($this->table_name());
    }
    function getStatusValue($m_id)
    {
        $this->db->where('m_id', $m_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->m_status;
    }
    function getLabelValue($m_id)
    {
        $this->db->where('m_id', $m_id);
        $query = $this->db->get($this->table_name());
        return $query->row()->m_label;
    }
    function getMails($start = '', $offset = '')
    {

        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $this->db->order_by('m_date', 'DESC');
        $query = $this->db->get($this->table_name());
        return $query->result();
    }



    function sendmail($vals)
    {
        $this->db->set($vals);
        $this->db->insert($this->table_name());
        return $vals;
    }
    function save($vals, $m_id = '')
    {
        $this->db->set($vals);
        if ($m_id != '') {
            $this->db->where('m_id', $m_id);
            $this->db->update($this->table_name());
        } else {
            $this->db->select_max('m_order');
            $ord_que = $this->db->get($this->table_name());
            $ord_rt = $ord_que->row()->m_order;
            $new_order = $ord_rt + 1;
            $this->db->set('m_order', $new_order, FALSE);
            $this->db->insert($this->table_name());
        }
        return $vals;
    }
    function isAlreadyExist($title)
    {

        $this->db->where('m_title', $title);
        $query = $this->db->get($this->table_name());
        return $query->row()->m_title;
    }
    function isAlreadyExistEdit($title, $id)
    {

        $this->db->where('m_title', $title);
        $this->db->where('m_id <>', $id, FALSE);
        $query = $this->db->get($this->table_name());
        $rslt = $query->result_array();
        if (count($rslt) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function delete($m_id)
    {
        $this->db->where('m_id', $m_id);
        $this->db->delete($this->table_name());
        return $m_id;
    }


    function updateOrder($m_id, $m_order, $value)
    {
        $data = array($m_order => $value);
        $this->db->where('m_id', $m_id);
        $this->db->update($this->table_name(), $data);
    }


    var $select_column = array("m_id", "m_author", "m_subject", "m_content", "m_status", "m_tags", "m_attach", "m_label", "m_date");
    var $order_column = array("m_id", "m_author", "m_subject", "m_content", "m_status", "m_tags", "m_label", "m_attach", "m_date");

    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->where('m_author <>' . $this->cur_id());
        $this->db->where('m_recipient', $this->cur_id());
        $this->db->from($this->table_name());
        if (isset($_POST["search"]["value"])) {
            $this->db->or_like("m_id", $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('m_order', 'DESC');
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
