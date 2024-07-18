<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Transaction');
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
        if (!in_array('Transaction', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }

        // $this->db->where('name', 'Transaction');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }
        $this->load->model("admin_model");
    }

    function index() {
        $data['page_name'] = 'transactions';
        $qry=$this->db->query("select * from transactions");
        $data['transactions']=$qry->result();

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/transactions', $data);
        $this->load->view('admin/includes/footer');

    }

     function delete($user_id) {
        $this->db->where('id', $user_id);
       $del = $this->db->delete('users');

        //echo$del = $this->db->last_query(); die;
        if($del)
        {
            $this->session->set_tempdata('success_message', 'User Deleted Successfully',3);
            redirect('admin/users');
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/users');
        }
    }



}

