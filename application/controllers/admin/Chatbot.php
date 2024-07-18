<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends MY_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');
        }
        $this->db->where('name', 'Chatbot');
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
        if (!in_array('Chatbot', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }

        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'chatbot';
        $this->data['title'] = 'Chatbot';

        $this->data['chatbot'] = $this->common_model->get_data_row(['id' => 1], 'chatbot');

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/chatbot', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function edit($id) {
        $this->data['page_name'] = 'chatbot';
        $this->data['title'] = 'Edit chatbot';

        $this->data['chatbot'] = $this->db->get_where('chatbot', ['id' => $id])->row();
        
        $this->load->view('admin/includes/header');

        $this->load->view('admin/edit_chatbot', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function update() {
        
        $id = $this->input->post('id');

        $data = array(
            'script' => $this->input->post('script'),
            'status' => $this->input->post('status'),
            'updated_at' => time()
        );

        $this->db->where('id', $id);
        $update_query = $this->db->update('chatbot', $data);
        if ($update_query) {
            $this->session->set_tempdata('success_message', 'Chatbot updated Successfully.',3);
            redirect('admin/chatbot');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
            redirect('admin/chatbot/edit/' . $id);
            die();
        }
    }

}
