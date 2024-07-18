<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Localisation extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
    }

    function index() {

    }

    function languages() {
        $this->data['title'] = 'Languages';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/languages', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function currencies() {
        $this->data['title'] = 'Currencies';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/currencies', $this->data);
        $this->load->view('admin/includes/footer');
    }

}
