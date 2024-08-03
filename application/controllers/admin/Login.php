<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    private $data;
    function __construct() {
        parent::__construct();        
        $this->load->model("admin_model");
//        if ($this->session->userdata('logged_in') == true) {
//            redirect('admin/dashboard');
//        }
//        $this->data['site_details'] = $this->admin_model->get_row_by_id('1', 'profile');
    } 

    public function index() {  
//        $this->data['username'] = 'admin';
//        $this->data['password'] = 'Wido@5454';
        $this->load->view('admin/login', $this->data);
    }

    public function admin_login() { 
           
         $ip = $_SERVER['REMOTE_ADDR'];

//        $ipcheck = $this->admin_model->ip_checking($ip);
        //log_message('error', json_encode($ipcheck)); 

//        if ($ipcheck != '') {
            $username = $this->input->get_post('email', TRUE);
             $password = $this->input->get_post('password', TRUE); 
            $password1 = md5($password); 
            $row = $this->admin_model->admin_login($username, $password1); 
            //echo $this->db->last_query(); die; 

            if ($row=="false")
            {
                 $this->session->set_tempdata('error_message', 'Invalid Username Or Password',3);
                 redirect('admin/login');
            } else {
                $this->load->model('FeatureModel');
                $features = $this->FeatureModel-> get_active_features_login();
                $sess_arr = array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'logged_in' => true,
                    'role_name' => 'Admin',
                    'features' => $features,
                ); 

                $this->session->set_tempdata('msg', 'Welcome',3);
                $this->session->set_userdata('admin_login', $sess_arr);
               // $this->session->set_userdata('admin',$sess_arr);
//                $this->session->set_tempdata('login_id', $row->id,3);

                redirect('admin/dashboard');
            }
//        } else {
//            $this->session->set_tempdata('error', 'Access Denied',3);
//            redirect('admin/login');
//        }
    }
    
    function forgot_password(){
        
        $this->load->view('admin/includes/header', $data);

       $this->load->view('admin/forgot_password', $this->data);
        $this->load->view('admin/includes/footer');
        
        
    }

}
