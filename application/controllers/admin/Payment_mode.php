<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_mode extends MY_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');
        }
        $this->db->where('name', 'Payment_mode');
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
        if (!in_array('Payment_mode', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        // $this->db->where('name', 'Payment_mode');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'payment_mode';
        $this->data['title'] = 'Payment mode';

        $this->data['payment_mode'] = $this->common_model->get_data_row(['id' => 1], 'payment_mode');

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/payment_mode', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function edit($id) {
        $this->data['page_name'] = 'payment_mode';
        $this->data['title'] = 'Edit Payment Mode';

        $this->data['payment_mode'] = $this->db->get_where('payment_mode', ['id' => $id])->row();
        
        $this->load->view('admin/includes/header');

        $this->load->view('admin/edit_payment_mode', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function update() {
        
        $id = $this->input->post('id');

        $data = array(
            'payment_mode' => $this->input->post('payment_mode'),
            'updated_at' => time()
        );

        $this->db->where('id', $id);
        $update_query = $this->db->update('payment_mode', $data);
        if ($update_query) {
            $this->session->set_tempdata('success_message', 'Payment mode updated Successfully.',3);
            redirect('admin/payment_mode');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
            redirect('admin/payment_mode/edit/' . $id);
            die();
        }
    }

}