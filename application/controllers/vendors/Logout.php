<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct() {

        parent:: __construct();

        $this->load->helper('url');
    }

    public function index() {
    	 	$this->session->unset_userdata('vendors');
    	 	//print_r($this->session->userdata()); die;
        //$this->session->unset_userdata('vendors_logged_in');
        //$this->session->set_tempdata('success_message', 'Successfully logged out',3);        
        redirect('vendors/login');
    }

}
