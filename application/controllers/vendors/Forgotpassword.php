<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {
    private $data;
    function __construct() {
        parent::__construct();        
        $this->load->model("vendor_model");
//        if ($this->session->userdata('logged_in') == true) {
//            redirect('admin/dashboard');
//        }
//        $this->data['site_details'] = $this->admin_model->get_row_by_id('1', 'profile');
    }

    public function index() {   
//        $this->data['username'] = 'admin';
//        $this->data['password'] = 'Wido@5454';
        $this->load->view('vendors/forgotpassword', $this->data);
    }
    
        function sendEmail()
    {
        $email = $this->input->get_post('email');
        $subject = 'Password sent';
        
        $chk = $this->vendor_model->check_email($email);
        if($chk==1){
            //print_r($chk);die;
            
            $get_password = $this->vendor_model->get_vendor_password($email);
            //echo"<pre>";
            //($get_password);die;
            $message = 'Password Changed Succeefully.<br>';
            $message .= 'Your Password is: <b>'.$get_password->forgot_password.'</b>';
            $this->load->library('email');

                $config['protocol'] = MAIL_PROTOCOL;
                $config['smtp_host'] = MAIL_SMTP_HOST;
                $config['smtp_port'] = MAIL_SMTP_PORT;
                $config['smtp_timeout'] = '7';
                $config['smtp_user'] = MAIL_SMTP_USER;
                $config['smtp_pass'] = MAIL_SMTP_PASS;
                $config['charset'] = MAIL_CHARSET;
                $config['newline'] = "\r\n";
                $config['mailtype'] = 'text'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config);

                $this->email->from(MAIL_SMTP_USER,'Absolutemens');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send()) {
             //$this->session->sess_destroy();
             $this->session->set_tempdata('mail_sent', 'Mail Sent Successfully.',3);
             redirect("vendors/login");
                } else {
                    $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
                    redirect("vendors/forgotpassword");
                   
                }
        
       
    }else{
        $this->session->set_tempdata('missmatched', 'Email Missmatched.',3);
         redirect("vendors/forgotpassword");
        
                   
    }
    
    }


}
