<?php
class Master_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function getRow($table, $field, $id) {
        $this->db->where($field, $id);
        $query = $this->db->get($table);
        return $query->row()->site_info_data;
    }

    function getSpecCol($table, $field, $id,$col) {
        $this->db->where($field, $id);
        $query = $this->db->get($table);
        return $query->row()->$col;
    }

    function getRowWhere($table, $where = '') {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->get($table);
        return $query->result();
    }

    function getRows($table, $where = '', $start = '', $offset = '') {
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }

        if (!empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->get($table);
        return $query->result();
    }
    
    function exQuery($query) {
        if (!empty($query)) {
            $this->db->query($query);
        }
    }

    function delete($table, $field, $value) {
        $this->db->where($field, $value);
        $this->db->delete($table);
    }

    function save($table, $vals, $field = '', $value = '') {
        $this->db->set($vals);

        if ($value != '') {
            $this->db->where($field, $value);
            $this->db->update($table);
            return $value;
        } else {
            $this->db->insert($table);
            return $this->db->insert_id();
        }
    }
    function saveTexts($table, $type, $vals) {
     $this->db->set($vals);

     $this->db->where('txt_type', $type);
     $query = $this->db->get($table);
     $exist = $query->row()->txt_id;


     if ($exist != '') {
        $this->db->where('txt_type', $type);
        $this->db->update($table);
        return $vals;
    } else {
     $this->db->set('txt_type' , $type);
     $this->db->insert($table);
     return $vals;
 }
}
function getTexts($table, $type) {

    $this->db->where('txt_type' , $type);
    $query = $this->db->get($table);
    $rslt = $query->row()->txt_data;
    return $rslt;

}

function update($table, $vals, $where) {
    if (is_array($where) && count($where) > 0) {
        $this->db->set($vals);
        $this->db->where($where);
        $this->db->update($table);
        return true;
    }
    return false;
}
}
?>