<?php

class Purchase_model extends CI_Model {

    public function get_purchase() {
        $this->db->select('*');
        $this->db->from('Purchase');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function add_purchase($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

}
