<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {
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
        $this->load->view('admin/forgotpassword', $this->data);
    }

//    public function sendEmail() {
//           
//        
//            $username = $this->input->get_post('email', TRUE);
//            $check_email_qry = $this->db->query("select * from admin where email='".$username."'");
//            $check_email_row = $check_email_qry->row();
//                $otp = rand(1000,10000);
//
//            if ($check_email_qry->num_rows()>0)
//            {
//
//                $from_email=$this->input->post('email');
//                
//                 $to_mail ='ankadisatish1919@gmail.com';
//                 $from_email = 'ankadisatish1919@gmail.com';
//
//               
//                $site_name = 'Forgot Password';
//                $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;height: 100vh">
//                                                    <tr>
//                                                        <td align="center"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td>
//                                                    </tr>   
//                                                    <tr>
//                                                        <td align="center">
//                                                            <h1 style="margin:0px; padding:0px; text-align: center; font-weight: 300; color:#666"><span style="color:#f47a20">REGISTRATION OTP FROM Sector6</span></h1>
//                                                            <p style="text-align: center; color:#333; line-height: 24px; font-size: 16px; padding-bottom: 20px;">OTP : '.$otp.' <br>
//                                                            
//                                                            </td>
//                                                    </tr>
//                                                    
//                                                </table>';
//                $this->load->library('email');
//                
//                $this->email->initialize(array(
// 'protocol' => 'smtp',
// 'smtp_host' => 'smtp.sendgrid.net',
// 'smtp_user' => 'satishprominere',
// 'smtp_pass' => 'satish19@prominere.com',
// 'smtp_port' => 587,
// 'crlf' => "\r\n",
// 'newline' => "\r\n",
// 'mailtype' =>'html'
//));
//
//  
//$this->email->from($from_email, 'SECTOR6');
//$this->email->to($to_mail);
//$this->email->subject('Forgot Password');
//$this->email->message($email_message);
//$this->email->send();
//
//print_r($this->email->send()); die;
//
//$this->email->print_debugger();
//
//
//
//                                
//                                    
//
//                                        $this->session->set_tempdata('error_message', "sendt successfully",3);
//                                        redirect('admin/forgotpassword');
//            } 
//            else 
//            {
//
//                $this->session->set_tempdata('error_message', 'Invalid Email ID ',3);
//                 redirect('admin/forgotpassword');
//
//               
//                $this->session->set_tempdata('msg', 'Welcome',3);
//                $this->session->set_userdata('admin_login', $sess_arr);
//
//                redirect('admin/dashboard');
//            }
//
//    }
    
    function sendEmail()
    {
        $email = $this->input->get_post('email');
        $subject = 'Password sent';
        
        $chk = $this->admin_model->check_email($email);
        if($chk==1){
            //print_r($chk);die;
            
            $get_password = $this->admin_model->get_admin_password($email);
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
             redirect("admin/login");
                } else {
                    $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
                    redirect("admin/forgotpassword");
                   
                }
        
       
    }else{
        $this->session->set_tempdata('missmatched', 'Email Missmatched.',3);
         redirect("admin/forgotpassword");
        
                   
    }
    
    }

}
