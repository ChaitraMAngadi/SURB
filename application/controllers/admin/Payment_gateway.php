<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Payment_gateway extends MY_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');

        }

    }



    function index() {

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/payment_gateway');

        $this->load->view('admin/includes/footer');

    }



}

