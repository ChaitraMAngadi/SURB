<?php
class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function markAsRead($id) {
        $this->db->set('is_read', 1);
        $this->db->where('id', $id);
        return $this->db->update('admin_notifications');
    }

    // public function get_admin_preferences($admin_id) {
    //     $this->db->select('notification_preferences');
    //     // die();
    //     $this->db->from('admin');
    //     $this->db->where('id', $admin_id);
    //     $result = $this->db->get()->row();
    //     // var_dump($result);
      
    //     return json_decode($result->notification_preferences, true); // Decode preferences from JSON
    // }
//    public function order_statitics($preferences) {
//         $table = 'admin_notifications';
//         $this->db->select('*');
        
//            // Check if 'all' is selected or if preferences are empty
//     $all_selected = isset($preferences['all']) && $preferences['all'] == 'on';
//     $allowed_types = [];

//     if (!$all_selected) {
//         foreach ($preferences as $key => $value) {
//             if ($value == 'on') {
//                 $allowed_types[] = $key;
//             }
//         }
//     }

//     // Apply filtering based on allowed types if 'all' is not selected
//     if (!$all_selected && !empty($allowed_types)) {
//         $this->db->group_start();  // Group conditions to ensure they are encapsulated correctly
//         foreach ($allowed_types as $type) {
//             $this->db->or_like('message', $type);  // Check if message contains the keyword
//         }
//         $this->db->group_end();
//     }

//     $this->db->order_by('id', 'desc');
//     $res = $this->db->get($table)->result();

   
    
//         foreach ($res as $row) {
//             $row->vendor_data = $this->db->where('id', $row->vendor_id)->get('vendor_shop')->row();
//             $row->user_data = $this->db->where('id', $row->user_id)->get('users')->row();
//         }
//         // var_dump($res);
//         // die();
//         return $res;
//     }
}