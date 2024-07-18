<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_gateway extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/payment_gateway');
        $this->load->view('vendors/includes/footer');
    }

}
