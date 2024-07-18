<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct() {

        parent:: __construct();

        $this->load->helper('url');
    }

    public function index() {
        $role_name = $this->session->userdata('admin_login')['role_name'];
    	 $this->session->unset_userdata('admin_login');
        //$this->session->unset_userdata('admin');
        //$this->session->set_tempdata('success_message', 'Successfully logged out',3); 
       
        $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';       
        redirect($redirect_url);
    }

}
