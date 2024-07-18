<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        $data['page_name'] = 'users';
        $qry=$this->db->query("select * from users");
        $data['users']=$qry->result();

        $this->load->view('vendors/includes/header', $data);

        $this->load->view('vendors/users', $data);
        $this->load->view('vendors/includes/footer');

    }

     function delete($user_id) {
        $this->db->where('id', $user_id);
       $del = $this->db->delete('users');

        //echo$del = $this->db->last_query(); die;
        if($del)
        {
            $this->session->set_tempdata('success_message', 'User Deleted Successfully',3);
            redirect('vendors/users');
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('vendors/users');
        }
    }



}

