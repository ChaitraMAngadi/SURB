<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Localisation extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {

    }

    function languages() {
        $this->data['title'] = 'Languages';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/languages', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function currencies() {
        $this->data['title'] = 'Currencies';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/currencies', $this->data);
        $this->load->view('vendors/includes/footer');
    }

}
