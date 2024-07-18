<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    private $data;
    function __construct() {
        parent::__construct();        
        $this->load->model("vendor_model");
//        if ($this->session->userdata('logged_in') == true) {
//            redirect('vendors/dashboard');
//        }
//        $this->data['site_details'] = $this->vendor_model->get_row_by_id('1', 'profile');
    }

    public function index() {   
//        $this->data['username'] = 'admin';
//        $this->data['password'] = 'Wido@5454';
        $this->load->view('vendors/login', $this->data);
    }

    public function admin_login() {
           
         $ip = $_SERVER['REMOTE_ADDR'];

//        $ipcheck = $this->vendor_model->ip_checking($ip);
        //log_message('error', json_encode($ipcheck));

//        if ($ipcheck != '') {
            $username = $this->input->get_post('email', TRUE);

            if($username=='' || $this->input->get_post('password')=='')
            {
                $this->session->set_tempdata('error_message', 'Enter Mobile Number & Password',3);
                redirect('vendors/login');
            }
            else
            {

                    if($this->input->post('md5')==1)
                    {
                        $password =$this->input->get_post('password', TRUE);
                    }
                    else
                    {
                        $password = $this->input->get_post('password', TRUE);
                        $password = md5($password);
                    }
                    $row = $this->vendor_model->admin_login($username, $password);  
                    if ($row != ""){
                        $sess_arr = array(
                            'vendor_id' => $row->id,
                            'owner_name' => $row->owner_name,
                            'vendors_logged_in' => true
                        ); 
                        $this->session->set_tempdata('msg', 'Welcome',3);
                        //$this->session->set_userdata($sess_arr);
                        $this->session->set_userdata('vendors', $sess_arr);
        //                $this->session->set_tempdata('login_id', $row->id,3);
                        redirect('vendors/dashboard');
                    } else {
                        $this->session->set_tempdata('error_message', 'Invalid Mobile Number Or Password',3);
                        redirect('vendors/login');
                    }

                }
//        } else {
//            $this->session->set_tempdata('error', 'Access Denied',3);
//            redirect('vendors/login');
//        }
    }

}
