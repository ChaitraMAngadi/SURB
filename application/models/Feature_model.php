<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature_model extends CI_Model {

    public function get_features() {
        $query = $this->db->get('features');
        return $query->result();
    }

    public function update_feature_status($id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        return $this->db->update('features');
    }
}