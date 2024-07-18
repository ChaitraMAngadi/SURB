<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Termsandconditions extends CI_Controller {

     private $data; 
        function __construct() {  
            parent::__construct();
    //        if ($this->session->userdata('logged_in') != true) {
    //            //$this->session->set_tempdata('error', 'Session Timed Out',3);
    //            redirect('admin/login');
    //        }      
        } 
    public function index()
    {   
                $this->data['title'] = 'Welcome';
        $this->load->view('terms', $this->data);
    }
}
