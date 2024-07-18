<?php
class NotificationVender_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function markAsRead($id) {
        $this->db->set('is_read_vender', 1);
        $this->db->where('id', $id);
        return $this->db->update('admin_notifications');
    }
}