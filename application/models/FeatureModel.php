<?php

class FeatureModel extends CI_Model {

    public function get_active_features() {
        $this->db->where('status', 1);
        $query = $this->db->get('features');
        return $query->result();
    }
    public function get_active_features_login() {
        $this->db->select('name');
        $this->db->from('features');
        $this->db->where('status', 1);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'name');
        } else {
            return [];
        }
    }
    
}
