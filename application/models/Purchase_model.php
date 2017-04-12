<?php

class Purchase_model extends CI_Model {

     /* get purchase */
    public function get_purchase() {
        $this->db->select('*');
        $this->db->from('Purchase');
        $this->db->join('Offering', 'Offering.id = Purchase.offeringID', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    /* add purchase */
    public function add_purchase($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    /* get offering */

    public function getOffering() {
        return $this->db->get('Offering')->result_array();
    }

}
