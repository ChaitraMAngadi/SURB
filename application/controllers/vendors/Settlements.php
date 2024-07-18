<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settlements extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        echo 'Settlemtents functionality under processing';
    }

}
