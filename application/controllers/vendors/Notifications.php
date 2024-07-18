<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->db->where('name', 'Notifications');
        $query = $this->db->get('features');
        $feature = $query->row();
        if ($feature && $feature->status == 0) {
           redirect('vendors/dashboard');
            exit(); // Stop further execution
        }



        $this->load->model('NotificationVender_model');
        $this->load->model('web_model');
        $this->load->model('vendor_model');
        $this->load->library('pagination');
        $this->data['vendor_id'] = $this->session->userdata('vendors')['vendor_id'];


    }

    function index() {

        $preferences = $this->vendor_model->get_vendor_preferences($this->data['vendor_id']);



        $data['page_name'] = 'notifications';
        $action = $this->input->get_post('action');
        if ($action == 'clear') {
            $markasread = $this->db->where(['vendor_read_status' => 0, 'vendor_id' => $this->data['vendor_id']])->update('admin_notifications', ['vendor_read_status' => 1]);
            if ($markasread == true) {
                $this->session->set_tempdata('success_message', 'Notifications cleared successfully',3);
                redirect('vendors/notifications');
            }
        }

        $data['notifications'] = $this->vendor_model->order_statitics($this->data['vendor_id'],$preferences);
        
      
        $data['count_data'] = sizeof($data['notifications']);

        $data['count_data'] = sizeof($this->vendor_model->order_statitics($this->data['vendor_id'],$preferences));

        $config['base_url'] = base_url() . 'vendors/notifications';
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
        $data['notifications'] = $this->vendor_model->order_statitics($this->data['vendor_id'],$preferences);
        //pr($data['notifications']);
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/notifications', $data);
        $this->load->view('vendors/includes/footer');
    }
    public function notification_preferences() {
        // var_dump($this->data['vendor_id']);
        // die();    
       
        if ($this->input->post('preferences')) {  // Ensure we specifically check for 'preferences' key.
            $preferences = $this->input->post('preferences');
            $preferencesJSON = json_encode($preferences);
    
            $this->db->where('id', $this->data['vendor_id']);
            if ($this->db->update('vendor_shop', ['notification_preferences' => $preferencesJSON])) {
                // Update successful
                $this->session->set_tempdata('success_message', 'Preferences updated successfully', 3);
            } else {
                // Update failed
                $this->session->set_tempdata('error_message', 'Failed to update preferences', 3);
            }
    
            redirect('vendors/notifications/notification_preferences');
            return;
        }
    
      
        $data['page_name'] = 'notification_preferences';
    
        $this->db->select('notification_preferences');
        $this->db->where('id',$this->data['vendor_id']);
        $vendor= $this->db->get('vendor_shop')->row();
    
        $data['preferences'] = json_decode($vendor->notification_preferences, true) ?: [];  // Default to an empty array if null.
    
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/notification_preferences', $data);
        $this->load->view('vendors/includes/footer');
    }

    public function mark_as_read() {
        $notification_id = $this->input->post('id');
        if ($this->NotificationVender_model->markAsRead($notification_id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

}
