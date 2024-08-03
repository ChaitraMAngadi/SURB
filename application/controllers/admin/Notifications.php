<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Notifications');
        $query = $this->db->get('features');
        $feature = $query->row();
        $role_name = $this->session->userdata('admin_login')['role_name'];
        if ($feature && $feature->status == 0) {
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
           redirect($redirect_url);
            exit(); // Stop further execution
        }

        $features = $this->session->userdata('admin_login')['features'];
        if (!in_array('Notifications', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        // $this->db->where('name', 'Notifications');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }



        $this->load->model('Notification_model');
        $this->load->model("admin_model");
        $this->load->library('pagination');
    }

    function push_notification_android($device_id, $message, $title) {

        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';

        /* api_key available in:
          Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key */
        $api_key = 'AAAAkpaJlU0:APA91bFtR5W87oDNlnaW4dgXbTXZAENAiPOx7D9to-h-GujBPC0Eo5bKsvVz2RkdNA5pTs8ffAZXgyOESL59o6IDwdci5dvmHJCd6B4ppbg5vPHxxw6tr3wnaEB9sbtsOcPIk9E8J9mf';

        $fields = array(
            'registration_ids' => array(
                $device_id
            ),
            'data' => array(
                "title" => $title,
                "body" => $message,
                'sound' => 'vendor_delivery_notification'
            )
        );

        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        print_r($result);
        die;
        return $result;
    }

    public function notification_preferences() {
        $admin_login = $this->session->userdata('admin_login');
        $admin_id = isset($admin_login['id']) ? $admin_login['id'] : null;

        if (!$admin_id) {
           
            $this->session->set_tempdata('error_message', 'Please log in to access this page', 3);
            redirect('admin/login');
            return; // Stop further execution of the code.
        }
    
       
        if ($this->input->post('preferences')) {  // Ensure we specifically check for 'preferences' key.
            $preferences = $this->input->post('preferences');
            $preferencesJSON = json_encode($preferences);
    
            $this->db->where('id',1);
            if ($this->db->update('admin', ['notification_preferences' => $preferencesJSON])) {
                // Update successful
                $this->session->set_tempdata('success_message', 'Preferences updated successfully', 3);
            } else {
                // Update failed
                $this->session->set_tempdata('error_message', 'Failed to update preferences', 3);
            }
    
            redirect('admin/notifications/notification_preferences');
            return;
        }
    
      
        $data['page_name'] = 'notification_preferences';
    
        $this->db->select('notification_preferences');
        $this->db->where('id', 1);
        $admin = $this->db->get('admin')->row();
    
        $data['preferences'] = json_decode($admin->notification_preferences, true) ?: [];  // Default to an empty array if null.
    
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/notification_preferences', $data);
        $this->load->view('admin/includes/footer');
    }


    function index() {

        $admin_id = $this->session->userdata('admin_login')['id'];  // Get admin ID from session data
        
                                                                            
        $preferences = $this->admin_model->get_admin_preferences(1);  // Method to fetch preferences
    
        
        $data['page_name'] = 'notifications';

        $action = $this->input->get_post('action');
        if ($action == 'clear') {
            $markasread = $this->db->where('status', 0)->update('admin_notifications', ['status' => 1]);
            if ($markasread == true) {
                $this->session->set_tempdata('success_message', 'Notifications cleared successfully',3);
                redirect('admin/notifications');
            }
        }
        $data['notifications'] = $this->admin_model->order_statitics($preferences);
        
      
        $data['count_data'] = sizeof($data['notifications']);

        $config['base_url'] = base_url() . 'admin/notifications';
        $config['total_rows'] = $data['count_data'];
        $config['per_page'] = 10;
        $config['page_query_string'] = true;
        $config['num_links'] = 5;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['reuse_query_string'] = true;
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li class="button grey">';
        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li class="button grey">';
        $config['next_tag_close'] = '</li>';

        $start = ($this->input->get_post('per_page')) ? $this->input->get_post('per_page') : 0;
        if ($start == "") {
            $data['kk'] = 1;
        } else {
            $data['kk'] = $start + 1;
        }
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page_start'] = $start - $config['per_page'] + 11;
        $this->db->limit($config['per_page'], $start);
        $data['notifications'] = $this->admin_model->order_statitics($preferences);
        //pr($data['notifications']);
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/notifications', $data);
        $this->load->view('admin/includes/footer');
    }

    function delete($user_id) {
        $this->db->where('id', $user_id);
        $del = $this->db->delete('users');

        //echo$del = $this->db->last_query(); die;
        if ($del) {
            $this->session->set_tempdata('success_message', 'User Deleted Successfully',3);
            redirect('admin/users');
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/users');
        }
    }

    function new_notification() {
        if ($this->session->userdata('new_notification_id')) {
            $last_id = $this->db->order_by('id', 'desc')->limit(1)->get('admin_notifications')->row()->id;
            if ($this->session->userdata('new_notification_id') != $last_id) {
                $this->session->unset_userdata('new_notification_id');
                $this->session->set_userdata('new_notification_id', $last_id);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            $last_id = $this->db->order_by('id', 'desc')->limit(1)->get('admin_notifications')->row()->id;
            $this->session->set_userdata('new_notification_id', $last_id);
            echo 0;
        }
    }
    public function mark_as_read() {
        $notification_id = $this->input->post('id');
        if ($this->Notification_model->markAsRead($notification_id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

}
