<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Login_role extends CI_Controller {
    private $data;
    
    function __construct() {
        parent::__construct();        
        $this->load->model("admin_model");
        $this->load->model("UserModel");
    }

    public function index() {  
        $this->load->view('admin/login_role', $this->data);
    }

    public function admin_login() {
        $email = $this->input->get_post('email', TRUE);
        $password = $this->input->get_post('password', TRUE);
        
        // print_r("run");
        // exit();
        $user = $this->UserModel->get_user_by_email($email);


        if ($user && password_verify($password, $user->password)) {
            // Fetch user features based on their role
        
            $features = $this->UserModel->get_user_features($user->role_id);
            $role_name = $this->UserModel->get_role_name_by_id($user->role_id);
            $sess_arr = array(
                'id' => $user->id,
                'username' => $user->name,
                'role_id' => $user->role_id,
                'role_name' => $role_name,
                'features' => $features,
                'logged_in' => true
            );

            $this->session->set_userdata('admin_login', $sess_arr);
            $this->session->set_tempdata('msg', 'Welcome', 3);

            redirect('admin/dashboard');
        } else {
            $this->session->set_tempdata('error_message', 'Invalid Username Or Password', 3);
            redirect('admin/login_role');
        }
    }


    // public function logout() {
    //     $this->session->sess_destroy();
    //     redirect('admih/login');
    // }
}
