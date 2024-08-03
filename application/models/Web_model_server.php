<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Web_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        //load database library

        $this->load->database();
    }



    function send_message($message = "", $mobile_number, $template_id="") {

        if ($this->is_rate_limited($mobile_number, 5, 60)) {
            echo "Rate limit exceeded. Try again later.";
            return false;
        }
        // $ip_address = $this->input->ip_address();
        // if ($this->is_rate_limited_by_ip($ip_address, 5, 60)) {
        //     echo "Rate limit exceeded. Try again later.";
        //     return false;
        // }


        $message = urlencode($message);
        $template_name = urlencode('Registration OTP Verification');
        $URL = "https://2factor.in/API/R1/"; // connecting url
        $mobile_number = urlencode($mobile_number); 
        $template_id = urlencode($template_id);


  


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://2factor.in/API/R1/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'module=TRANS_SMS&apikey=a08b66ad-8118-11ed-9158-0200cd936042&to='.$mobile_number.'&from=abmens&msg='.$message
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        $this->log_sms_request($mobile_number);
        // $this->log_request_by_ip($ip_address);
        return true;
    }

    public function log_sms_request($mobile_number) {
        $data = array(
            'mobile_number' => $mobile_number,
            // 'timestamp' => time() // current Unix timestamp
        );
        $this->db->insert('sms_log', $data);
    }


    // public function log_request_by_ip($ip_address) {
    //     $data = array(
    //         'ip_address' => $ip_address,
    //         'timestamp' => time()
    //     );
    //     $this->db->insert('sms_log', $data);
    // }

    public function is_rate_limited($mobile_number, $limit, $interval) {
        // $time_limit = time() - $interval;
        $time_limit = date('Y-m-d H:i:s', time() - $interval); // Format for TIMESTAMP comparison

        $this->db->where('mobile_number', $mobile_number);
        $this->db->where('timestamp >', $time_limit);
        $query = $this->db->get('sms_log');
        return $query->num_rows() >= $limit;
    }
    // public function is_rate_limited_by_ip($ip_address, $limit, $interval) {
    //     $time_limit = time() - $interval;
    //     $this->db->where('ip_address', $ip_address);
    //     $this->db->where('timestamp >', $time_limit);
    //     $query = $this->db->get('sms_log');
    //     return $query->num_rows() >= $limit;
    // }
    
    function email_send($to, $subject, $msg) {
        $config['protocol'] = MAIL_PROTOCOL;
        $config['smtp_host'] = MAIL_SMTP_HOST;
        $config['smtp_port'] = MAIL_SMTP_PORT;
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = MAIL_SMTP_USER;
        $config['smtp_pass'] = MAIL_SMTP_PASS;
        $config['charset'] = MAIL_CHARSET;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from(MAIL_SMTP_USER, "Absolutemens");
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($msg);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    function rand_string($length) {

        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        return substr(str_shuffle($chars), 0, $length);
    }

    

    // function verify_OTP($user_id, $otp, $email_otp,$first_name,$last_name,$mobile,$email,$password,$otp_mob,$otp_mail) {


    //     if ($otp_mob == $otp) {
    //         if ($otp_mail == $email_otp) {
    //             $existingTags = ['NEW_USER'];;
                

    //             $ar = array(
    //                 'first_name' => $first_name, 'last_name' => $last_name, 
    //                 'email' => $email, 'password' =>  md5($password), 
    //                 'phone' => $mobile, 'token' => '',
    //                 'otp'=>$otp,
    //                 'email_otp'=>$email_otp,
    //                 'otp_status' => 1, 'email_otp_status' => 1,
    //             'Tag'=>json_encode($existingTags));

    //             // $wr = array('id' => $user_id);

    //             $ins = $this->db->insert("users", $ar);
    //             // print_r($ins);
    //             $last_id = $this->db->insert_id($ins);
    //             // print_r("inserted id".$last_id);
    //             // exit;die;
    //             if ($ins) {
    //                 $qry = $this->db->query("select * from users where id='" .  $last_id . "' and otp='" . $otp . "'");
    //                 $stu_row = $qry->row();
    //                 // print_r($otp);
    //                 // exit;

    //                 $phone = $stu_row->phone;

    //                 $otp_message = "Dear " . str_replace(' ', '', $stu_row->first_name) . ", Thank you for registering with us. We welcome you to our Absolutmens.com community. Thank you for choosing us Team Absolutemens.com";
    //                 $otp_message1 = "Dear Customer, <br>Welcome to AbsoluteMens.com! <br>We are so glad to have you on board.  At AbsoluteMens.com, we provide you with a curated range of personal care, cosmetics, and fitness products, allowing you to discover, compare, and shop for the best products that fit your needs. <br>You can find a wide selection of the latest products from trusted brands, as well as expert advice and reviews to help you make the right choice. <br>We strive to provide a one-stop shop for all your personal care and fitness needs, and we work hard to ensure that you have the best shopping experience possible. <br>If you have any questions or need help, please don't hesitate to contact us. <br>Again, welcome to AbsoluteMens.com! <br>Sincerely, <br>The AbsoluteMens.com Team";
    //                 $template_id = "1407167151633883322";

    //                 $this->send_message($otp_message, $phone, $template_id);

    //                 //send mail for registration complete

    //                 $config1['protocol'] = MAIL_PROTOCOL;
    //                 $config1['smtp_host'] = MAIL_SMTP_HOST;
    //                 $config1['smtp_port'] = MAIL_SMTP_PORT;
    //                 $config1['smtp_timeout'] = '7';
    //                 $config1['smtp_user'] = MAIL_SMTP_USER;
    //                 $config1['smtp_pass'] = MAIL_SMTP_PASS;
    //                 $config1['charset'] = MAIL_CHARSET;
    //                 $config1['newline'] = "\r\n";
    //                 $config1['mailtype'] = 'html'; // or html
    //                 $config1['validation'] = TRUE; // bool whether to validate email or not      

    //                 $this->email->initialize($config1);

    //                 $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
    //                 $this->email->to($stu_row->email);
    //                 $this->email->subject('Welcome to AbsoluteMens.com');
    //                 $this->email->message($otp_message1);

    //                 $this->email->send();

    //                 $row = $qry->row();
                   

    //                 $name = $row->first_name . " " . $row->last_name;

    //                 $sess_arr = array(
    //                     'user_id' => $row->id,
    //                     'email' => $row->email,
    //                     'phone' => $row->phone,
    //                     'name' => $name,
    //                     'logged_in' => true
    //                 );

    //                 $this->session->set_userdata('userdata', $sess_arr);

    //                 $session_id = generate_session_id();
    //                 $sess = array(
    //                     'session_id' => $session_id
    //                 );
    //                 $this->session->set_userdata('session_data', $sess);

    //                 echo '@success';
    //                 die;
    //             }
    //         } else {

    //             echo '@email_otp_err';
    //             die;
    //         }
    //     } else {

    //         echo '@mobile_otp_err';
    //         die;
    //     }
    // }

    function verify_OTP($user_id, $otp, $email_otp,$first_name,$last_name,$mobile,$email,$password,$otp_mob,$otp_mail) {
        // print_r($user_id);
        // exit;
           
            // $user_data = $userdata['user_data'];
            // $user_id=$_SESSION['userdata']['user_id'];
            // print_r($user_data );
            // print_r("otp".$otp); 
            // print_r("email otp".$email_otp);
            // exit;
    
            // $qry = $this->db->query("select * from users where id='" . $user_id . "' and otp='" . $otp . "'");
            // $qry1 = $this->db->query("select * from users where id='" . $user_id . "' and email_otp='" . $email_otp . "'");
    
            if ($otp_mob == $otp) {
                if ($otp_mail == $email_otp) {
                    $existingTags = ['NEW_USER'];;
                    
    
                    $ar = array(
                        'first_name' => $first_name, 'last_name' => $last_name, 
                        'email' => $email, 'password' =>  md5($password), 
                        'phone' => $mobile, 'token' => '',
                        'otp'=>$otp,
                        'email_otp'=>$email_otp,
                        'otp_status' => 1, 'email_otp_status' => 1,
                    'Tag'=>json_encode($existingTags));
    
                    // $wr = array('id' => $user_id);
    
                    $ins = $this->db->insert("users", $ar);
                    // print_r($ins);
                    $last_id = $this->db->insert_id($ins);
                    // print_r("inserted id".$last_id);
                    // exit;die;
                    if ($ins) {
                        $qry = $this->db->query("select * from users where id='" .  $last_id . "' and otp='" . $otp . "'");
                        $stu_row = $qry->row();
                        // print_r($otp);
                        // exit;
    
                        $phone = $stu_row->phone;
    
                        $otp_message = "Dear " . str_replace(' ', '', $stu_row->first_name) . ", Thank you for registering with us. We welcome you to our Absolutmens.com community. Thank you for choosing us Team Absolutemens.com";
                        $otp_message1 = "Dear Customer, <br>Welcome to AbsoluteMens.com! <br>We are so glad to have you on board.  At AbsoluteMens.com, we provide you with a curated range of personal care, cosmetics, and fitness products, allowing you to discover, compare, and shop for the best products that fit your needs. <br>You can find a wide selection of the latest products from trusted brands, as well as expert advice and reviews to help you make the right choice. <br>We strive to provide a one-stop shop for all your personal care and fitness needs, and we work hard to ensure that you have the best shopping experience possible. <br>If you have any questions or need help, please don't hesitate to contact us. <br>Again, welcome to AbsoluteMens.com! <br>Sincerely, <br>The AbsoluteMens.com Team";
                        $template_id = "1407167151633883322";
    
                        $this->send_message($otp_message, $phone, $template_id);
    
                        //send mail for registration complete
    
                        $config1['protocol'] = MAIL_PROTOCOL;
                        $config1['smtp_host'] = MAIL_SMTP_HOST;
                        $config1['smtp_port'] = MAIL_SMTP_PORT;
                        $config1['smtp_timeout'] = '7';
                        $config1['smtp_user'] = MAIL_SMTP_USER;
                        $config1['smtp_pass'] = MAIL_SMTP_PASS;
                        $config1['charset'] = MAIL_CHARSET;
                        $config1['newline'] = "\r\n";
                        $config1['mailtype'] = 'html'; // or html
                        $config1['validation'] = TRUE; // bool whether to validate email or not      
    
                        $this->email->initialize($config1);
    
                        $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                        $this->email->to($stu_row->email);
                        $this->email->subject('Welcome to AbsoluteMens.com');
                        $this->email->message($otp_message1);
    
                        $this->email->send();
    
                        $row = $qry->row();
                       
    
                        $name = $row->first_name . " " . $row->last_name;
    
                        $sess_arr = array(
                            'user_id' => $row->id,
                            'email' => $row->email,
                            'phone' => $row->phone,
                            'name' => $name,
                            'logged_in' => true
                        );
    
                        $this->session->set_userdata('userdata', $sess_arr);
    
                        $session_id = generate_session_id();
                        $sess = array(
                            'session_id' => $session_id
                        );
                        $this->session->set_userdata('session_data', $sess);
    
                        echo '@success';
                        die;
                    }
                } else {
    
                    echo '@email_otp_err';
                    die;
                }
            } else {
    
                echo '@mobile_otp_err';
                die;
            }
        }
    function verifyloginotp($otp, $user_mobile) {
        $qry = $this->db->query("select * from users where ( phone='" . $user_mobile . "' or email='" . $user_mobile . "' ) and otp_status=1 and email_otp_status=1");

        if ($qry->num_rows() > 0) {

            $row = $qry->row();

            $is_email = $this->db->get_where('users', ['email' => $user_mobile])->num_rows();

            if ($is_email > 0) {
                $ar = $this->db->where('email_otp', $otp);
            } else {
                $ar = $this->db->where('otp', $otp);
            }
            $this->db->where('id', $row->id);
            $chk = $this->db->get('users')->num_rows();
            if ($chk > 0) {
                $name = $row->first_name . " " . $row->last_name;

                $sess_arr = array(
                    'user_id' => $row->id,
                    'email' => $row->email,
                    'phone' => $row->phone,
                    'name' => $name,
                    'logged_in' => true
                );

                $this->session->set_userdata('userdata', $sess_arr);

                $session_id = generate_session_id();
                $sess = array(
                    'session_id' => $session_id
                );
                $this->session->set_userdata('session_data', $sess);
                
                //check for user cart data
                $chk = $this->db->where(['user_id' => $row->id, 'is_checkout' => null])->get('cart')->result();
                if (sizeof($chk) > 0) {
                    $this->db->where(['user_id' => $row->id, 'is_checkout' => null])->update('cart', ['session_id' => $_SESSION['session_data']['session_id']]);
                }

                echo '@success';
                die;
            } else {
                echo '@invalid';
                die;
            }
        } else {

            echo '@invalid';
            die;
        }
    }

    function checkLogin($username, $password, $token) {

        $chk = $this->db->query("select * from users where ( email='" . $username . "' or phone='" . $username . "' ) and password='" . $password . "' and otp_status=1 and email_otp_status=1");

        if ($chk->num_rows() > 0) {

            $row = $chk->row();

            $name = $row->first_name . " " . $row->last_name;

            $this->db->update("users", array('login_time' => time()), array('email' => $row->email));

            $sess_arr = array(
                'user_id' => $row->id,
                'email' => $row->email,
                'phone' => $row->phone,
                'name' => $name,
                'logged_in' => true
            );

            $this->session->set_userdata('userdata', $sess_arr);

            $session_id = generate_session_id();
            $sess = array(
                'session_id' => $session_id
            );
            $this->session->set_userdata('session_data', $sess);
            
            //check for user cart data
                $chk = $this->db->where(['user_id' => $row->id, 'is_checkout' => null])->get('cart')->result();
                if (sizeof($chk) > 0) {
                    $this->db->where(['user_id' => $row->id, 'is_checkout' => null])->update('cart', ['session_id' => $_SESSION['session_data']['session_id']]);
                }

            echo '@success@' . $row->id;
            die;
        } else {

            echo '@invalid';
            die;
        }
    }

    function resendOTP($user_id) {

        $chk = $this->db->query("select * from users where id='" . $user_id . "'");

        if ($chk->num_rows() > 0) {

            $row = $chk->row();

           $otp = rand(1111, 9999);
           $otp1 = rand(1111, 9999);

              // $otp = 1234;
              // $otp1 = 1234;

            $phone = $row->phone;

            $otp_message = "Dear customer " . $otp . " is OTP to register with Absolute Mens. Pls do not share OTP to anyone for security reasons. Thanks and Regards Absolute Mens";
            // $otp_message1 = "Dear customer " . $otp1 . " is OTP to register with Absolute Mens. Pls do not share OTP to anyone for security reasons. Thanks and Regards Absolute Mens";

            $otp_message1 = "Dear Customer,  This is to inform you that your OTP for registration is " . $otp . " . Please use this OTP to complete your registration and to begin enjoying our services.  We thank you for registering with us and look forward to a long and fruitful relationship.  <br> Regards, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";

            $template_id = '1407165995845244807';

            $ar = array('otp' => $otp, 'email_otp' => $otp1);

            $wr = array('id' => $user_id);

            $upd = $this->db->update("users", $ar, $wr);

            if ($upd) {
                $this->send_message($otp_message, $phone, $template_id);
                //send mail otp

                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($row->email);
                $this->email->subject('Email Verification OTP');
                $this->email->message($otp_message1);

                $this->email->send();

                echo '@success';
                die;
            }

            //}
        } else {

            echo '@error';
            die;
        }
    }

    function checkForgot($phone) {

        $chk = $this->db->query("select * from users where ( phone='" . $phone . "' or email='" . $phone . "' ) and otp_status=1 and email_otp_status=1");
        $user_details = $chk->row();

        if ($chk->num_rows() > 0) {

            $is_email = $this->db->get_where('users', ['email' => $phone])->num_rows();

            $otp = rand(1111, 9999);
            // $otp = 1234;
            if ($is_email > 0) {
                $is = 'email';
                $ar = array('email_otp' => $otp);
            } else {
                $is = 'phone';
                $ar = array('otp' => $otp);
            }

            $otp_message = "Dear " . str_replace(' ', '', $user_details->first_name) . ", " . $otp . " is your new OTP for logging in to Absolutemens.com Happy to serve you, Team Absolutemenes.com";
            $otp_message1 = "Dear Customer, <br>OTP to reset your password is " . $otp . ". <br>Please use this OTP to reset your password. <br>Regards, <br>Team Absolutemens.com";
            $template_id = "1407167151649972177";

            $this->db->where('id', $user_details->id);
            $upd = $this->db->update('users', $ar);

            if ($is == 'phone') {
                $this->send_message($otp_message, $phone, $template_id);
            } else if ($is == 'email') {

                //send mail otp for forgot password

                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($user_details->email);
                $this->email->subject('Reset Password');
                $this->email->message($otp_message1);

                $this->email->send();
            }

            if ($upd) {

                $stu_row = $chk->row();

                $user_id = $stu_row->id;

                echo '@success@' . $user_id;
                die;
            }

            //}
        } else {

            //return array('status' =>FALSE, 'message'=>"Invalid Email or Phone Number");

            echo '@error';
            die;
        }
    }

    function sendloginotp($phone) {

        $chk = $this->db->query("select * from users where ( phone='" . $phone . "' or email='" . $phone . "' ) and otp_status=1 and email_otp_status=1");
        $user_details = $chk->row();

        if ($chk->num_rows() > 0) {

            $is_email = $this->db->get_where('users', ['email' => $phone])->num_rows();
            if ($is_email > 0) {
                $is = 'email';
            } else {
                $is = 'phone';
            }

            $otp = rand(1111, 9999);
            // echo "<pre>";
            // print_r($otp);
            // exit;
            // $otp = 1234;
            
            $otp_message = "Dear Customer, " . $otp . " is your OTP for logging in to Absolutemens.com. Happy to serve you, Team Absolutemens.com";
            
            if ($is_email > 0) {
                $is = 'email';
                $ar = array('email_otp' => $otp);
                $user_phone_email = $user_details->email;
                $wr = array('email' => $user_details->email);
            } else {
                $is = 'phone';
                $ar = array('otp' => $otp);
                $user_phone_email = $user_details->phone;
                $wr = array('phone' => $user_details->phone);
            }

            $template_id = "1407167151617392747";

            if ($is == 'phone') {
                $this->send_message($otp_message, $user_details->phone, $template_id);
            } else if ($is == 'email') {

                //send mail otp for forgot password

                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($user_details->email);
                $this->email->subject('Login OTP');
                $this->email->message($otp_message);

                $this->email->send();

              
            }

            $upd = $this->db->update('users', $ar, $wr);

            if ($upd) {

                // echo '#success#' . $user_phone_email."#".$otp;
                echo '#success#' . $user_phone_email;
                // return $otp;
                die;
            }
            // echo "<pre>";
            // print_r($otp);
            // exit;

            //}
            // return $otp;
        } else {

            //return array('status' =>FALSE, 'message'=>"Invalid Email or Phone Number");

            echo '@error';
            die;
        }
    }
    function resetPassword($user_id, $otp, $password) {

        // print_r($otp);
        // print_r($user_id);
        // print_r($password);
        // exit;die;

        $qry = $this->db->query("select * from users where id='" . $user_id . "' and (otp='" . $otp . "' or email_otp ='" . $otp . "')");
// print_r($qry->result());
        if ($qry->num_rows() > 0) {

            $ar = array(
                'password' => md5($password));

            $wr = array('id' => $user_id);

            $upd = $this->db->update("users", $ar, $wr );

            if ($upd) {

                $row = $qry->row();

                $name = $row->first_name . " " . $row->last_name;

                $sess_arr = array(
                    'user_id' => $row->id,
                    'email' => $row->email,
                    'phone' => $row->phone,
                    'name' => $name,
                    'logged_in' => true
                );

                $this->session->set_userdata('userdata', $sess_arr);

                $session_id = generate_session_id();
                $sess = array(
                    'session_id' => $session_id
                );
                $this->session->set_userdata('session_data', $sess);

                echo '@success';
                die;
            }
        } else {

            echo '@invalid';
            die;
        }
    }

    function profileDetails($user_id) {

        $qry = $this->db->query("select * from users where id='" . $user_id . "'");

        if ($qry->num_rows() > 0) {

            $row = $qry->row();

            if ($row->image != '') {

                $image = base_url() . "uploads/users/" . $row->image;
            } else {

                $image = base_url() . "uploads/profile-icon-3.png";
            }



            return array('id' => $row->id, 'first_name' => $row->first_name, 'last_name' => $row->last_name, 'email' => $row->email, 'phone' => $row->phone, 'image' => $image);

            //return array('status' =>TRUE,'profile_details'=>$ar);
        }
    }

    function updateProfile($user_id, $first_name, $last_name,$mobile,$email) {

        $upd = $this->db->update("users", array('first_name' => $first_name, 'last_name' => $last_name,'email'=>$email,'phone'=>$mobile), array('id' => $user_id));

        if ($upd) {

            //return array('status' =>TRUE,'message'=>"Profile Updated successfully");

            echo '@success';
            die;
        } else {

            //return array('status' =>FALSE,'message'=>"Something went Wrong , Please try again");

            echo '@invalid';
            die;
        }
    }

    function myAccount($user_id) {

        $qry = $this->db->query("select * from users where id='" . $user_id . "'");

        $row = $qry->row();

        $login_time = date("d-m-Y, h:i A", $row->login_time);

        $ord_qry = $this->db->query("select * from orders where user_id='" . $user_id . "'");

        $orders_num = $ord_qry->num_rows();

        $onoingord_qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and order_status in (1,2,3,4)");

        $ongoing = $onoingord_qry->num_rows();

        $completed_qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and order_status=5");

        $completed = $completed_qry->num_rows();

        $cancelled_qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and order_status=6");

        $cancelled = $cancelled_qry->num_rows();

        $bidqry = $this->db->query("SELECT * from user_bids WHERE user_id='" . $user_id . "' and bid_status=0");

        $bids = $bidqry->num_rows();

        return array('login_time' => $login_time, 'order_total' => $orders_num, 'ongoing_orders' => $ongoing, 'completed_orders' => $completed, 'cancelled_orders' => $cancelled, 'bids' => $bids);
    }

    function orderList($user_id, $order_status) {

        if ($order_status == 'total_orders') {

            $qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and payment_status=1 group by session_id order by id desc");
        } else if ($order_status == 'ongoing_orders') {

            $qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and order_status in (1,2,3,4) group by session_id order by id desc");
        } else if ($order_status == 'completed_orders') {

            $qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and order_status=5 group by session_id order by id desc");
        } else if ($order_status == 'cancelled_orders') {

            $qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and order_status=6 group by session_id order by id desc");
        } else if ($order_status == 'my_orders') {

            $qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and payment_status=1 group by session_id order by id desc");
        }





        if ($qry->num_rows() > 0) {

            $result = $qry->result();
            foreach ($result as $res) {
                $orders = $this->common_model->get_data_with_condition(['session_id' => $res->session_id], 'orders', 'id', 'desc');
                $order_status_arr = array_column($orders, 'order_status');
                $display_status = min($order_status_arr);
                if ($display_status == 1) {

                    $res->order_status = "Pending";
                } else if ($display_status == 2) {

                    $res->order_status = "Accepted";
                } else if ($display_status == 3) {

                    $res->order_status = "Assign to Courier";
                } else if ($display_status == 4) {

                    $res->order_status = "Shipped";
                } else if ($display_status == 5) {

                    $res->order_status = "Delivered";
                } else if ($display_status == 6) {

                    $res->order_status = "Cancelled";
                } else if ($display_status == 7) {

                    $res->order_status = "Return";
                }
            }

            $ar = [];
            // echo "<pre>";
            // print_r($result);
            // exit;

            foreach ($result as $value) {
                $review = $value->review;
                $comment = $value->comments;

                $qry = $this->db->query("select * from users where id='" . $value->user_id . "'");

                $users = $qry->row();

                $name = $users->first_name . " " . $users->last_name;

                $ven = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");

                $vendor = $ven->row();

                $adrs = $this->db->query("select * from user_address where id='" . $value->deliveryaddress_id . "'");

                $address = $adrs->row();

                $full_address = $address->address . "," . $address->landmark . "," . $address->city . "," . $address->state . "," . $address->pincode;

                if ($value->payment_status == 0) {

                    $payment_status = "UnPaid";
                } else {

                    $payment_status = "Paid";
                }



//                if ($value->order_status == 1) {
//
//                    $order_status = "Pending";
//                } else if ($value->order_status == 2) {
//
//                    $order_status = "Proccessing";
//                } else if ($value->order_status == 3) {
//
//                    $order_status = "Assigned to delivery to pick up";
//                } else if ($value->order_status == 4) {
//
//                    $order_status = "Delivery Boy On the way";
//                } else if ($value->order_status == 5) {
//
//                    $order_status = "Delivered";
//                } else if ($value->order_status == 6) {
//
//                    $order_status = "Cancelled";
//                } else if ($value->order_status == 7) {
//
//                    $order_status = "Refund Completed";
//                }

                $ven1 = $this->db->query("select * from user_reviews where user_id='" . $user_id . "' and order_id='" . $value->id . "'");

                if ($ven1->num_rows() > 0) {

                    $review_status = 'true';
                } else {

                    $review_status = 'false';
                }





                if ($value->coupon_id == 0) {

                    $coupon_disount = "0";

                    $sub_t = $value->sub_total;
                    if ($value->gst == "") {
                        $value->gst = "0";
                        $amount = (float)$sub_t + (float)$value->gst + (float)$value->deliveryboy_commission;

                    }
                } else {

                    $coupon_disount = $value->coupon_disount;

                    $sub_t = $value->sub_total - $coupon_disount;

                    $amount = (float)$sub_t + (float)$value->gst + (float)$value->deliveryboy_commission;

                }



                $ar[] = array('id' => $value->id, 'session_id' => $value->session_id, 'customer_name' => $name, 'vendor_name' => $vendor->shop_name, 'address' => $full_address, 'payment_status_name' => $payment_status, 'payment_type' => $value->payment_option, 'service_status' => $value->order_status, 'amount' => $amount, 'created_date' => date('d-m-Y', $value->created_at), 'order' => $value->order_status, 'review_status' => $review_status, 'vendor_id' => $value->vendor_id, 'user_id' => $value->user_id, 'payment_status' => $value->payment_status, 'review' => $review, 'comments' => $comment, 'total_price' => $value->total_price, 'coupon_discount' => $value->coupon_disount,'waybill_generated'=>$value->waybill_generated);
            }

            return array('status' => TRUE, 'orders' => $ar);
        } else {

            return array('status' => FALSE, 'message' => "No Orders");
        }
    }

    function orderDetails($oid) {

        $qry = $this->db->query("select * from orders where id='" . $oid . "'");
        // echo "<Pre>";
        if ($qry->num_rows() > 0) {

            $value = $qry->row();

            $cart = $this->db->query("select * from cart where session_id='" . $value->session_id . "' and vendor_id='" . $value->vendor_id . "'");

            $cartdetails = $cart->result();
            // echo "<pre>";
            // print_r($cartdetails);
            // exit;

            $cartdata = [];

            $unit_price = 0;

            foreach ($cartdetails as $c) {

                $var = $this->db->query("select * from link_variant where id='" . $c->variant_id . "'");

                $variants = $var->row();
                //echo "<pre>";
               // print_r($variants);//price,saleprice
              //  exit;

                if ($c->status == 1) {

                    $refundmsg = "Return Request sent";
                } else if ($c->status == 2) {

                    $refundmsg = "Refund Completed";
                } else {

                    $refundmsg = "";
                }



                $im = $this->db->query("select * from product_images where product_id='" . $variants->product_id . "' and variant_id='" . $variants->id . "' order by priority asc");

                $images = $im->row();

                if ($images->image != '') {

                    $img = base_url() . "uploads/products/" . $images->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }





                $or = $this->db->query("select * from orders where vendor_id='" . $c->vendor_id . "' and session_id='" . $c->session_id . "'");

                $ord_s = $or->row();

                if ($ord_s->order_status == 5 || $ord_s->order_status == 7) {

                    $pro = $this->db->query("select * from products where id='" . $variants->product_id . "' and delete_status=0");

                    $products = $pro->row();

                    $cancel_status = $products->cancel_status;

                    $return_status = $products->return_status;

                    if ($cancel_status == 'yes' || $return_status == 'yes') {

                        $orderDate = $ord_s->created_date;

                        $days = $products->return_noof_days;

                        $ldate = strtotime(date("Y-m-d", strtotime($orderDate)) . " +" . $days . "days");

                        $odr_start_date = time();

                        if ($ldate < $odr_start_date) {

                            $refund_status = false;
                        } else {

                            $refund_status = true;
                        }
                    } else {

                        $refund_status = false;
                    }
                } else {

                    $refund_status = false;
                }







                $jsondata = json_decode($variants->jsondata);

                $attributes = [];

                foreach ($jsondata as $val) {

                    $attribute_type = $val->attribute_type;

                    $attribute_value = $val->attribute_value;

                    $type = $this->db->query("select * from attributes_title where id='" . $attribute_type . "'");

                    $types = $type->row();

                    $val12 = $this->db->query("select * from attributes_values where id='" . $attribute_value . "'");

                    $value12 = $val12->row();
                    

                    $attributes[] = array('attribute_type' => $types->title, 'attribute_values' => $value12->value);
                }
                

                $pro = $this->db->query("select * from products where id='" . $variants->product_id . "' and delete_status=0");

                $products = $pro->row();
               


                $ven_q = $this->db->query("select * from vendor_shop where id='" . $c->vendor_id . "'");

                $ven_row = $ven_q->row();
                

                $cartdata[] = array('cartid' => $c->id, 'productname' => $products->name, 'price' => $c->price,'saleprice' => $variants->price, 'quantity' => $c->quantity, 'total_price' => $c->unit_price, 'image' => $img, 'attributes' => $attributes, 'refund_status' => $refund_status, 'product_id' => $variants->product_id, 'refundmsg' => $refundmsg, 'status' => $c->status, 'shop_name' => $ven_row->shop_name);

                $unit_price = $c->unit_price + $unit_price;
            }


            $add = $this->db->query("select * from user_address where id='" . $value->deliveryaddress_id . "'");

            $address = $add->row();

            $user_full_address = $address->address . "," . $address->landmark . "<br>" . $address->state . "," . $address->city . "," . $address->pincode;

            $qry = $this->db->query("select * from users where id='" . $value->user_id . "'");

            $users = $qry->row();

            $name = $users->first_name . " " . $users->last_name;

            $email = $users->email;

            $ven = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");

            $vendor = $ven->row();

            $adrs = $this->db->query("select * from user_address where id='" . $value->deliveryaddress_id . "'");
            // $address_id=$value->deliveryaddress_id;

            $address = $adrs->row();

            $city_qry = $this->db->query("select * from cities where id='" . $address->city . "'");

            $city_row = $city_qry->row();

            $state_qry = $this->db->query("select * from states where id='" . $address->state . "'");

            $state_row = $state_qry->row();

            $area_qry = $this->db->query("select * from areas where id='" . $address->area . "'");

            $area_row = $area_qry->row();

            $full_address = $address->address . ", " . $address->landmark . ", <br> " . $address->city . ", " . $state_row->state_name . ", " . $address->pincode;

            if ($value->payment_status == 0) {

                $payment_status = "UnPaid";
            } else {

                $payment_status = "Paid";
            }



            if ($value->order_status == 1) {

                $order_status = "Pending";
            } else if ($value->order_status == 2) {

                $order_status = "Accepted";
            } else if ($value->order_status == 3) {

                $order_status = "Assign to Courier";
            } else if ($value->order_status == 4) {

                $order_status = "Shipped";
            } else if ($value->order_status == 5) {

                $order_status = "Delivered";
            } else if ($value->order_status == 6) {

                $order_status = "Cancelled";
            } else if ($value->order_status == 7) {

                $order_status = "Return";
            }



            if ($value->coupon_id == 0) {

                $coupon_disount = "0";
            } else {

                $coupon_disount = $value->coupon_disount;
            }



            $deliv = $this->db->query("select * from deliveryboy where id='" . $value->delivery_boy . "'");

            if ($deliv->num_rows() > 0) {

                $delivery_boy = $deliv->row();

                $dl_name = $delivery_boy->name;

                $dl_phone = $delivery_boy->phone;

                $alternative_mobiles = $delivery_boy->alternative_mobiles;
            } else {

                $dl_name = "";

                $dl_phone = "";

                $alternative_mobiles = "";
            }



            if ($value->order_status == 3 || $value->order_status == 4 || $value->order_status == 5) {

                $show = 'show';
            } else {

                $show = 'hide';
            }





            if ($value->bid_id == 0) {

                $bid_status = 'no';
            } else {

                $bid_status = 'yes';
            }

            $review = $this->db->where(array("product_id" => $variants->product_id, "user_id" => $value->user_id, "order_id" => $oid))->get("user_reviews")->row();
            $refund_return = $this->db->where(array("product_id" => $variants->product_id, "session_id" => $value->session_id))->get("refund_exchange")->row();
            $created_date = date('d-m-Y,h:i A', $value->created_at);
           

            // print_r($value);
            
            $ar = array('id' => $value->id, 'address_id'=>$value->deliveryaddress_id,'bid_status' => $bid_status, 'session_id' => $value->session_id, 'delivery_date' => $value->delivery_timeslots, 'order_status' => $order_status, 'vendor_name' => $vendor->shop_name, 'useraddress' => $full_address, 'payment_status' => $payment_status, 'payment_type' => $value->payment_option, 'amount' => $value->total_price, 'sub_total' => $value->sub_total, 'created_date' => $value->created_date, 'placed_on' => date('d-m-Y', $value->created_at), 'tracking_name' => $value->tracking_name, 'tracking_id' => $value->tracking_id, 'cartdetails' => $cartdata, 'customer_name' => $name, 'email' => $email, 'mobile' => $address->mobile, 'coupon_disount' => $coupon_disount, 'deliveryboy_commission' => $value->deliveryboy_commission, 'gst' => $value->gst, 'delivery_name' => $dl_name, 'delivery_phone' => $dl_phone, 'alternative_mobiles' => $alternative_mobiles, 'order_status1' => $show, 'vendor_id' => $value->vendor_id, 'user_id' => $value->user_id, 'owner_name' => $vendor->owner_name, 'vendor_mobile' => $vendor->mobile, 'address' => $vendor->address, 'city' => $vendor->city, 'order_condition' => $value->order_status, 'user_address' => $value->user_address, 'accept_status' => $value->accept_status, 'created_date' => $created_date, 'review' => $review->review, 'comments' => $review->comments, 'return_refund_status' => $refund_return->status,'order_date'=>$value->order_date);

            return array('status' => TRUE, 'ordersdetails' => $ar);
        } else {

            return array('status' => FALSE, 'message' => "Order ID Wrong");
        }
        // exit;
    }

    function whishList($user_id) {

        $qry = $this->db->query("select * from whish_list where user_id='" . $user_id . "'");

        $dat = $qry->result();
        $wish_count=$qry->num_rows();
       

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $wl) {

                $pid = $this->db->where('id', $wl->variant_id)->get('link_variant')->row()->product_id;

                $prod = $this->db->query("SELECT vendor_shop.shop_name,vendor_shop.seo_url as shop_seo_url,link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.id='" . $wl->variant_id . "' and link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and  products.id='" . $pid . "' and products.status=1 and products.delete_status=0 and vendor_shop.status=1 group by link_variant.product_id order by products.id ASC");

                $value = $prod->row();
               

                $jsondata = json_decode($value->jsondata);

                $attributes = [];

                foreach ($jsondata as $val) {

                    $attribute_type = $val->attribute_type;

                    $attribute_value = $val->attribute_value;

                    $type = $this->db->query("select * from attributes_title where id='" . $attribute_type . "'");

                    $types = $type->row();

                    $val12 = $this->db->query("select * from attributes_values where id='" . $attribute_value . "'");

                    $value12 = $val12->row();

                    $attributes[] = array('type_id' => $types->id, 'attribute_type' => $types->title, 'value_id' => $value12->id, 'attribute_values' => $value12->value);
                }

                /* $qry1 = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 and product_id='".$value->id."'");

                  $value12 = $qry1->row(); */
// echo "<pre>";
// print_r($pid);
// exit;
// echo "<pre>";
$variants_wish['wish_details'] = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
// print_r($variants_wish);echo "</pre>";
// exit;
// print_r($variants_wish['wish_details']);exit;

                $im = $this->db->query("select * from product_images where product_id='" . $pid . "' and variant_id='" . $wl->variant_id . "' order by priority asc");

                $images = $im->row();

                if ($images->image != '') {

                    $img = base_url() . "uploads/products/" . $images->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }





                $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

                $category = $cat->row();

                $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                $subcategory = $subcat->row();

                $brnd = $this->db->query("select * from attr_brands where id='" . $value->brand . "'");

                $brand = $brnd->row();

                $vendo = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

                $vendor = $vendo->row();

                $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");


                if ($wish->num_rows() > 0) {

                    $stat = true;
                    $wish_row=$wish->row();
                    $wishlist_id=$wish_row->id;
                    $userid=$wish_row->user_id;
                
                } else {

                    $stat = false;
                }



                if ($value->saleprice != '') {

                    $slaeprice = $value->saleprice;
                } else {

                    $slaeprice = 0;
                }



                if ($value->price != '') {

                    $price = $value->price;
                } else {

                    $price = 0;
                }
                $cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;

                if ($value->id != '' && $category->status > 0) {

                    $ar[] = array('id' => $value->id, 'variant_id' => $value->variant_id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $brand->brand_name, 'shop' => $value->shop_name, 'shop_seo_url' => $value->shop_seo_url, 'price' => $price, 'saleprice' => $slaeprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'attribute' => $attributes,'wish_details'=>$variants_wish['wish_details'],'wishlist_id'=>$wishlist_id,'userid'=>$userid,'cart_limit'=>$cart_limit);
                }
            }

            return array('status' => TRUE, 'product_list' => $ar,'wish_count'=> $wish_count);
        } else {

            return array('status' => FALSE, 'message' => "No Whishlist Products",'wish_count'=> $wish_count);
        }
    }

    function getUserLocation($user_id, $selectedlocation, $lat1, $lng1) {
        if ($lat1 == '' && $lng1 == '') {
            $prepAddr = str_replace(' ', '+', $selectedlocation);
            $apiKey = 'AIzaSyAA5vejn8Hc8jurJu88B1MX_bDrHC7Utus'; // Google maps now requires an API key.
            $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($prepAddr) . '&sensor=false&key=' . $apiKey);
            $output = json_decode($geocode);

            $lat = $output->results[0]->geometry->location->lat;
            $lng = $output->results[0]->geometry->location->lng;
        } else {
            $lat = $lat1;
            $lng = $lng1;
        }

        $shop_qry = $this->db->query("SELECT id FROM vendor_shop");
        //having distance<'".$search_distance."'
        if ($shop_qry->num_rows() > 0) {
            if ($user_id == 'guest') {
                $shop_qry = $this->db->query("SELECT id FROM vendor_shop");
                if ($shop_qry->num_rows() > 0) {
                    //'lat'=>$lat,'lng'=>$lng,
                    $ins = $this->db->insert("guest_users", array('location' => $selectedlocation), array('id' => $user_id));
                    if ($ins) {
                        $last_id = $this->db->insert_id();
                        $g_sess_arr = array(
                            'guest_user_id' => $last_id,
                            'guest_logged_in' => true
                        );
                        $this->session->set_userdata('userdata', $g_sess_arr);
                        echo '@success';
                        die;
                    }
                } else {
                    echo '@error';
                    die;
                }
            } else {
                //'lat'=>$lat,'lng'=>$lng,
                $upd = $this->db->update("users", array('home_location' => $selectedlocation), array('id' => $user_id));
                //echo $this->db->last_query(); die;
                if ($upd) {
                    echo '@success';
                    die;
                } else {
                    echo '@error';
                    die;
                }
            }
        } else {
            echo '@error';
            die;
        }
    }

    function checkValidLocation($user_id) {

        $shop_qry = $this->db->query("SELECT id FROM vendor_shop");
        //having distance<'".$search_distance."'
        if ($shop_qry->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getBanners($user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $users = $this->db->query("select * from users where id='" . $user_id . "'");

            $users_row = $users->row();

            $address = $users_row->address_id;

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $shop_qry = $this->db->query("SELECT id, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop");
        //having distance<'".$search_distance."'
        $shops = $shop_qry->result();

        $shop_ids = array_column($shops, 'id');

        $imp = implode(",", $shop_ids);

        $qry = $this->db->query("select * from banners WHERE position=1 and status=1 order by priority asc");

        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                if ($value->web_image != '') {

                    $img = base_url() . "uploads/banners/" . $value->web_image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                if ($value->type == 'products') {

                    $prod_qry = $this->db->query("select * from products where id='" . $value->product_id . "' and delete_status=0");

                    $dat1 = $prod_qry->row();

                    $title = $dat1->name;

                    $shop_id = $dat1->shop_id;

                    $product_details = array('product_title' => $title, 'product_id' => $dat1->id, 'seo_url' => $dat1->seo_url, 'shop_id' => $shop_id);
                } else {

                    $prod_qry = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

                    $dat1 = $prod_qry->row();

                    $adm_qry = $this->db->query("select * from admin_comissions where shop_id='" . $value->shop_id . "' order by id desc");

                    $adm_row = $adm_qry->row();

                    $product_details = array('shop_name' => $dat1->shop_name, 'cat_id' => $adm_row->cat_id, 'seo_url' => $dat1->seo_url, 'shop_id' => $value->shop_id);
                }



                $ar[] = array('id' => $value->id, 'random_number' => $value->random_number, 'title' => $value->title, 'image' => $img, 'type' => $value->type, 'product_details' => $product_details,'tag_id'=>$value->tag_id);
            }
        } else {

            $ar = array();
        }

        return $ar;
    }

    function getHomeLimitCategories() {

        $qry = $this->db->query("select * from categories where status=1 order by priority asc");
        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];
            foreach ($dat as $value) {

                $sub_cat_data = $this->db->where(array("cat_id" => $value->id, 'status' => 1))->get("sub_categories")->num_rows();

                $questionary = $this->db->where(array("cat_id" => $value->id))->get("questionaries")->result();

                //$options = $this->db->where(array("ques_id"=>$questionary->id))->get("options")->result();
                //echo $this->db->last_query(); die;

                $seo_url = $value->seo_url;
                if ($value->app_image != '') {
                    $img = base_url() . "uploads/categories/" . $value->app_image;
                } else {
                    $img = base_url() . "uploads/noproduct.png";
                }

//                $adm = $this->db->query("select * from admin_comissions where cat_id='" . $value->id . "' and subcategory_ids!=''");
//                $admin = $adm->num_rows();
//                if ($admin > 0) {
//                    $admin_row = $adm->row();
//                    $vendor_qry = $this->db->query("select * from vendor_shop where id='" . $admin_row->shop_id . "'");
//                    $vendor_row = $vendor_qry->row();
                //if (sizeof($questionary) > 0) {
                $ar[] = array('id' => $value->id, 'title' => $value->category_name, 'image' => $img, 'products_count' => "", 'seo_url' => $value->seo_url, 'sub_cat_rows' => $sub_cat_data, 'seo_url' => $seo_url, 'question' => $questionary);
                //}
            }
            return $ar;
        } else {

            return array();
        }
    }

    function getHomeAllCategories() {

        $qry = $this->db->query("select * from categories where status=1 order by priority asc");

        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                if ($value->app_image != '') {

                    $img = base_url() . "uploads/categories/" . $value->app_image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                $adm = $this->db->query("select * from admin_comissions where cat_id='" . $value->id . "' and subcategory_ids!=''");

                $admin = $adm->num_rows();

                if ($admin > 0) {

                    $ar[] = array('id' => $value->id, 'title' => $value->category_name, 'image' => $img, 'products_count' => "", 'seo_url' => $value->seo_url);
                }
            }

            return $ar;
        } else {

            return array();
        }
    }

    function allSubCategories($seo_url, $subcat_id = null) {
        $active = [];
        $cat_row = $this->db->where(array('seo_url' => $seo_url))->get('categories')->row();
        if (empty($subcat_id)) {
            $subcat_result = $this->db->where(array('cat_id' => $cat_row->id, 'status' => 1))->get('sub_categories')->result();
        } else {
            $subcat_result = $this->db->where(array('id' => $subcat_id, 'status' => 1))->get('sub_categories')->result();
        }
        foreach ($subcat_result as $value) {
            if ($value->app_image != '') {
                $value->app_image = base_url() . "uploads/sub_categories/" . $value->app_image;
            } else {
                $value->app_image = base_url() . "uploads/noproduct.png";
            }
            $question_row = $this->db->where(array('cat_id' => $cat_row->id, 'sub_cat_id' => $value->id))->get('questionaries')->row();
            //if ($question_row) {
            $value->question = $question_row->question;
            $value->question_id = $question_row->id;
            $value->options = $this->db->where(array('ques_id' => $question_row->id))->get('options')->result();
            array_push($active, $value);
            //}
        }
        return $active;
    }

    function InsertOption($question, $message) {
        print_r($question);
        die;

        $this->db->select('id,ques_id');
        $this->db->where('find_in_set("' . $question . '", ques_id)');
        $p_data = $this->db->get("products")->result();
        echo $this->db->last_query();
        die;
        if (count($p_data) > 0) {
            $array = [];
            foreach ($p_data as $ques) {
                $this->db->select('*');
                $this->db->where_in("id", $questionary->id);
                $getdata = $this->db->get("options")->result();
            }
            $array[] = array('id' => $ques->id,);
            return redirect()->to('/user/profile/');
        }
    }

    public function get_count($user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {



            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT vendor_shop.*,admin_comissions.shop_id, admin_comissions.cat_id, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN admin_comissions ON vendor_shop.id=admin_comissions.shop_id INNER JOIN products ON vendor_shop.id=products.shop_id where vendor_shop.status=1 and products.status=1 and products.delete_status=0 group by products.shop_id order by distance asc");
        //having distance<".$search_distance."
        return $qry->num_rows();
    }

    function getAllshopsWithoutcategoriesList($limit, $start, $user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {



            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT vendor_shop.*,admin_comissions.shop_id, admin_comissions.cat_id, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN admin_comissions ON vendor_shop.id=admin_comissions.shop_id INNER JOIN products ON vendor_shop.id=products.shop_id where vendor_shop.status=1 and products.status=1 and products.delete_status=0 group by products.shop_id  order by distance asc LIMIT " . $start . "," . $limit);
        //having distance<".$search_distance."
        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                if ($value->shop_logo != '') {

                    $img = base_url() . "uploads/shops/" . $value->shop_logo;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                    ;
                }







                $shop_qry = $this->db->query("select * from shop_favorites where shop_id='" . $value->id . "' and user_id='" . $user_id . "'");

                if ($shop_qry->num_rows() > 0) {

                    $shop_not = true;
                } else {

                    $shop_not = false;
                }



                $pro = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.shop_id='" . $value->id . "' and products.status=1 and products.delete_status=0 group by link_variant.product_id order by products.id ASC");

                $product_total = $pro->num_rows();

                $dealpro = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.shop_id='" . $value->id . "' and products.status=1 and products.top_deal='yes' and products.delete_status=0 group by link_variant.product_id order by products.id ASC");

                $dealproduct_total = $dealpro->num_rows();

                if ($value->status == 1) {

                    $stat = "Open";
                } else {

                    $stat = "Closed";
                }



                $ar[] = array('id' => $value->id, 'cat_id' => $value->cat_id, 'shop_name' => $value->shop_name, 'description' => $value->description, 'image' => $img, 'status' => $stat, 'shop_not' => $shop_not, 'distance' => round($value->distance), 'product_total' => $product_total, 'address' => $value->city, 'deal_products' => $dealproduct_total, 'seo_url' => $value->seo_url);
            }

            return $ar;
        } else {

            return array();
        }
    }

    function getVendorBanners($vendor_id, $user_id) {

        if ($user_id == 'guest') {
            
        } else {

            $this->db->insert("shop_visit", array('shop_id' => $vendor_id, 'user_id' => $user_id));
        }


        $bannerad = $this->db->query("select * from bannerads where shop_id='" . $vendor_id . "' and blocks=1");
        $bannerads = $bannerad->row();

        if ($bannerads->app_image != '') {

            $ban1 = base_url() . "uploads/bannerads/" . $bannerads->app_image;
        } else {

            $ban1 = "";
        }

        $bannerad1 = $this->db->query("select * from bannerads where shop_id='" . $vendor_id . "' and blocks=2");

        $bannerads1 = $bannerad1->row();

        if ($bannerads1->app_image != '') {

            $ban2 = base_url() . "uploads/bannerads/" . $bannerads1->app_image;
        } else {

            $ban2 = "";
        }







        $qry = $this->db->query("select * from vendor_shop_banners where shop_id='" . $vendor_id . "'");

        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                if ($value->app_banner != '') {

                    $img = base_url() . "uploads/banners/" . $value->web_banner;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                $ar[] = array('id' => $value->id, 'title' => $value->title, 'image' => $img);
            }

            return array('bannerslist' => $ar, 'banneradd1' => $ban1, 'banneradd2' => $ban2);
        } else {

            $ar = array();

            return array('bannerslist' => $ar, 'banner_ads' => $ban);
        }
    }

    function getcategoryWithshopID($shop_id) {

        $admin = $this->db->query("SELECT cat_id,sub_cat_id FROM `products` where shop_id='" . $shop_id . "' and status=1 and delete_status=0 GROUP by sub_cat_id");

        $admin_result = $admin->result();

        if ($admin->num_rows() > 0) {

            foreach ($admin_result as $admin_row) {

                $prod = $this->db->query("SELECT id FROM `products` where shop_id='" . $shop_id . "' and cat_id='" . $admin_row->cat_id . "' and sub_cat_id='" . $admin_row->sub_cat_id . "' and status=1 and delete_status=0");

                $prod_total_rows = $prod->num_rows();

                $subcategory_ids = $admin_row->sub_cat_id;

                $qry = $this->db->query("select * from sub_categories where id='" . $subcategory_ids . "'");

                $value = $qry->row();

                if ($value->app_image != '') {

                    $img = base_url() . "uploads/sub_categories/" . $value->app_image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                if ($qry->num_rows() > 0) {

                    /* $ar[]=array('id'=>$value->id,'cat_id'=>$value->cat_id,'sub_cat_id'=>$admin_row->sub_cat_id,'title'=>$value->sub_category_name,'image'=>$img,'products'=>$prod_total_rows); */



                    $ar[] = array('id' => $value->id, 'category_name' => $value->sub_category_name, 'description' => $value->description, 'image' => $img, 'seo_url' => $value->seo_url);
                }
            }



            if (count($ar) == 0) {

                return array();
            } else {

                return $ar;
            }
        } else {

            return array('status' => FALSE, 'message' => "No Sub Categories", 'best_products' => $products);
        }
    }

    /* function getcategoryWithshopID($shop_id)

      {

      $qry = $this->db->query("SELECT * FROM `admin_comissions` where shop_id='".$shop_id."'");

      $result = $qry->result();

      if($qry->num_rows()>0)

      {

      $ar=[];

      foreach ($result as $value)

      {

      $cat = $this->db->query("SELECT * FROM `categories` where id='".$value->cat_id."'");

      $categories = $cat->row();



      if($categories->app_image!='')

      {

      $img = base_url()."uploads/categories/".$categories->app_image;

      }

      else

      {

      $img = base_url()."uploads/noproduct.png";

      }



      $ar[]=array('id'=>$categories->id,'category_name'=>$categories->category_name,'description'=>$categories->description,'image'=>$img,'seo_url'=>$categories->seo_url);

      }

      return $ar;

      }

      else

      {

      return array();

      }

      } */

    function bestSeller($shop_id, $user_id) {

        $qry = $this->db->query("SELECT cart.variant_id FROM orders INNER JOIN cart ON orders.session_id=cart.session_id where orders.vendor_id='" . $shop_id . "' group by cart.variant_id");

        $result = $qry->result();

        $prod_ar = [];

        foreach ($result as $value) {

            $link = $this->db->query("select * from link_variant where status=1 and id='" . $value->variant_id . "'");

            $link_row = $link->row();

            $prod = $this->db->query("select * from products where id='" . $link_row->product_id . "' and status=1 and delete_status=0");

            $products = $prod->row();

            $im = $this->db->query("select * from product_images where product_id='" . $link_row->product_id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

            $images = $im->row();

            if ($images->image != '') {

                $img = base_url() . "uploads/products/" . $images->image;
            } else {

                $img = base_url() . "uploads/noproduct.png";
            }

            $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

            if ($wish->num_rows() > 0) {

                $stat = true;
            } else {

                $stat = false;
            }



            if ($prod->num_rows() > 0) {



                $shps = $this->db->query("select * from vendor_shop where id='" . $products->shop_id . "' and delete_status=0");

                $shps_row = $shps->row();

                $prod_ar[] = array('id' => $products->id, 'variant_id' => $value->variant_id, 'name' => $products->name, 'shop_id' => $products->shop_id, 'shop' => $shps_row->shop_name, 'cat_id' => $products->cat_id, 'image' => $img, 'saleprice' => $link_row->saleprice, 'whishlist_status' => $stat, 'seo_url' => $products->seo_url);
            }
        }

        return $prod_ar;
    }

    function getProductDetails($pid, $user_id, $attrdata = null) {

        $this->db->insert("most_viewed_products", array('product_id' => $pid));

        $qry = $this->db->query("select * from products where id='" . $pid . "' and delete_status=0 and status=1 and availabile_stock_status='available'");

        $value = $qry->row();

        $value->brand_name = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;

        if ($qry->num_rows() > 0) {

            $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");
            $category = $cat->row();
            if ($category->status == 1) {
                $link_vari11 = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'saleprice >' => 0, 'status' => 1], 'link_variant', 'id', 'desc');

                $link_variants111 = $link_vari11;

                $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $link_variants111[0]->id . "' order by priority asc");

                $images1 = $im->row();

                if ($images1->image != '') {

                    $img = base_url() . "uploads/products/" . $images1->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                $var1 = $this->db->query("select * from add_variant where product_id='" . $value->id . "'");

                $variants1 = $var1->result();

                $att1 = [];
                $attr_final = [];

                foreach ($link_vari11 as $row) {
                    $json = json_decode($row->jsondata);
                    $attributes = [];

                    foreach ($json as $row1) {
                        // echo "<pre>";
                        // print_r($value);
                        // exit;
                        $att_type_qry = $this->db->query("select * from attributes_title where id='" . $row1->attribute_type . "'");
                        $types = $att_type_qry->row();

                        $values_qry = $this->db->query("select * from attributes_values where id='" . $row1->attribute_value . "'");
                        $values = $values_qry->row();

                        $attributes[] = array('type_id' => $types->id, 'type' => $types->title, 'value' => $values->value, 'value_id' => $values->id);
                    }

//                     $qry_var = $this->db->query("SELECT variant_id, vendor_id, COUNT(*) as row_count
//                     FROM cart
//                     WHERE variant_id = '" . $row->id . "' 
//                     AND vendor_id = '" . $value->shop_id . "' 
//                     AND is_checkout = 1 
//                     AND check_out = 0
//                     GROUP BY variant_id, vendor_id
//                     ORDER BY row_count DESC
//                     LIMIT 3");

// $re_var = $qry_var->result();

// // If you also want to see the result set, you can print it
// // echo "<pre>";

// $count_arr=array();
// foreach($re_var as $va){
// $count_arr[]=$va->row_count;


// }
// print_r($count_arr[0]);
// exit;



                    $att1[] = array('id' => $row->id, 'varient_id' => $row->id, 'status' => $row->status, 'product_id' => $row->product_id, 'price' => $row->price, 'saleprice' => $row->saleprice, 'stock' => $row->stock, 'attributes' => $attributes);
                }

                foreach ($att1 as $item) {
                    $attrs = $item["attributes"];
                    foreach ($attrs as $key => $att) {
                        $has_val = false;
                        foreach ($attr_final[$key] as $hh) {
                            if ($hh["value"] == $att["value"]) {
                                $has_val = true;
                            }
                        }
                        if (!$has_val) {
                            $current = [
                                "varient_id" => $item["varient_id"],
                                "type_id" => $att["type_id"],
                                "type" => $att["type"],
                                "value_id" => $att["value_id"],
                                "value" => $att["value"],
                                "stock" => $item["stock"]
                            ];
                            $attr_final[$key][] = $current;
                        }
                    }
                }


//            $att1 = array_map("unserialize", array_unique(array_map("serialize", $att11)));
//            $ex = array_column($attr_val, 'attr_value');

                $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                $subcategory = $subcat->row();

                $brnd = $this->db->query("select * from attr_brands where id='" . $value->brand . "'");

                $brand = $brnd->row();

                $vendo = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

                $vendor = $vendo->row();

//            $link_vari = $this->db->query("select * from link_variant where product_id='" . $value->id . "' and status=1 ");
                if (empty($attrdata)) {
                    $link_variants1 = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'status' => 1], 'link_variant', 'id', 'desc');
                } else {
                    $avail_link = [];
                    $link = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'status' => 1], 'link_variant', 'id', 'desc');
                    foreach ($link as $li) {
                        $json_attr = json_decode($li->jsondata, true);
                        $chk = array_diff_assoc_recursive($json_attr, $attrdata);
                        if ($chk == 0) {
                            array_push($avail_link, $li);
                        }
                    }
                    $link_variants1 = $avail_link;
//                pr($link_variants1);
                }

                $link_variants = [];

                foreach ($link_variants1 as $link_value) {

                    $im1 = $this->db->query("select * from product_images where product_id='" . $link_value->product_id . "' and variant_id='" . $link_value->id . "' order by priority asc");

                    $img_result1 = $im1->result();

                    $img_ar1 = [];

                    if ($im1->num_rows() > 0) {

                        foreach ($img_result1 as $images1) {

                            if ($images1->image != '') {

                                $img = base_url() . "uploads/products/" . $images1->image;
                            } else {

                                $img = base_url() . "uploads/noproduct.png";
                            }



                            $img_ar1[] = array('image' => $img);
                        }
                    } else {

                        $img = base_url() . "uploads/noproduct.png";

                        $img_ar1[] = array('image' => $img);
                    }

                    if ($link_value->stock > 10) {

                        $stock = "Instock";
                    } else {

                        $stock = $link_value->stock . " Left";
                    }

                    $wish = $this->db->query("select * from whish_list where variant_id='" . $link_value->id . "' and user_id='" . $user_id . "'");

                    if ($wish->num_rows() > 0) {

                        $stat = true;
                    } else {

                        $stat = false;
                    }

                    //check already in cart or not
                    $session_id = $_SESSION['session_data']['session_id'];
                    $in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $link_value->id])->get('cart')->num_rows();
                    $stockNumber = (int)$stock;
if($stockNumber>0 || $stock =="Instock"){
                    $link_variants[] = array('id' => $link_value->id, 'price' => $link_value->price, 'saleprice' => $link_value->saleprice, 'jsondata' => json_decode($link_value->jsondata), 'imageslist' => $img_ar1, 'stock' => $stock, 'in_cart' => $in_cart, 'whishlist_status' => $stat);

                }
            }
            $pro_qry=$this->db->query("select orders_placed from products where id='".$value->id."'");
$pro_res=$pro_qry->row();
$cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;
            if($stockNumber>0 || $stock =="Instock"){
                $ar = array('id' => $value->id, 'return_noof_days' => $value->return_noof_days, 'shop_id' => $value->shop_id, 'seo_url' => $vendor->seo_url, 'vendor_description' => $vendor->description, 'location' => $vendor->city, 'name' => $value->name, 'description' => $value->descp, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand_name, 'brand_id' => $value->brand, 'shop' => $vendor->shop_name, 'product_tags' => $value->product_tags, 'meta_tag_title' => $value->meta_tag_title, 'meta_tag_description' => $value->meta_tag_description, 'meta_tag_keywords' => $value->meta_tag_keywords, 'key_features' => $value->key_features, 'cancel_status' => $value->cancel_status, 'return_status' => $value->return_status, 'attributes' => $attr_final, 'link_variants' => $link_variants, 'image' => $img, 'selling_date' => date('d-m-Y', strtotime($value->selling_date)), 'taxname' => $value->taxname, 'manage_stock' => $value->manage_stock, 'variant_product' => $value->variant_product, 'status' => $value->status, 'cat_id' => $value->cat_id, 'sub_cat_id' => $value->sub_cat_id, 'tax_class' => $value->tax_class, 'availabile_stock_status' => $value->availabile_stock_status, 'maximum_quantity' => $link_value->stock, 'about' => $value->about, 'how_to_use' => $value->how_to_use,'orders_placed'=>$pro_res->orders_placed,'product_stock'=>$link_value->stock,'cart_limit'=>$cart_limit);
            }
                return $ar;
            } else {

                return 'false';
            }
        } else {

            return 'false';
        }
    }

    function productDetailsFilter($pid, $json_data) {

        $jsons = json_encode($json_data);

        $qry = $this->db->query("select * from products where id='" . $pid . "' and delete_status=0");

        $value = $qry->row();

        if ($qry->num_rows() > 0) {

            $var1 = $this->db->query("select * from add_variant where product_id='" . $value->id . "'");

            $variants1 = $var1->result();

            $att1 = [];

            foreach ($variants1 as $value1) {

                $type = $this->db->query("select * from attributes_title where id='" . $value1->attribute_type . "'");

                $types = $type->row();

                $ex = explode(",", $value1->attribute_values);

                $values = [];

                for ($i = 0; $i < count($ex); $i++) {

                    $val = $this->db->query("select * from attributes_values where id='" . $ex[$i] . "'");

                    $value1 = $val->row();

                    $values[] = array('id' => $value1->id, 'value' => $value1->value);
                }



                $att1[] = array('id' => $types->id, 'attribute_type' => $types->title, 'attribute_values' => $values);
            }







            $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

            $category = $cat->row();

            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

            $subcategory = $subcat->row();

            $brnd = $this->db->query("select * from attr_brands where id='" . $value->brand . "'");

            $brand = $brnd->row();

            $vendo = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

            $vendor = $vendo->row();

            $link_vari = $this->db->query("select * from link_variant where product_id='" . $value->id . "' and status=1 and jsondata LIKE " . $jsons);

            $link_variants1 = $link_vari->result();

            $link_variants = [];

            foreach ($link_variants1 as $link_value) {

                $im1 = $this->db->query("select * from product_images where product_id='" . $link_value->product_id . "' and variant_id='" . $link_value->id . "' order by priority asc");

                $img_result1 = $im1->result();

                $img_ar1 = [];

                if ($im1->num_rows() == 0) {

                    $img = base_url() . "uploads/noproduct.png";

                    $img_ar1[] = array('image' => $img);
                } else {

                    foreach ($img_result1 as $images1) {

                        if ($images1->image != '') {

                            $img = base_url() . "uploads/products/" . $images1->image;
                        } else {

                            $img = base_url() . "uploads/noproduct.png";
                        }



                        $img_ar1[] = array('image' => $img);
                    }
                }



                if ($link_value->stock > 10) {

                    $stock = "Instock";
                } else {

                    $stock = $link_value->stock . " Left";
                }



                $link_variants[] = array('id' => $link_value->id, 'price' => $link_value->price, 'saleprice' => $link_value->saleprice, 'jsondata' => json_decode($link_value->jsondata), 'imageslist' => $img_ar1, 'stock' => $stock);
            }



            if ($link_vari->num_rows() > 0) {

                $ar = array('id' => $value->id, 'shop_id' => $value->shop_id, 'name' => $value->name, 'description' => $value->descp, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $brand->brand_name, 'brand_id' => $value->brand, 'shop' => $vendor->shop_name, 'product_tags' => $value->product_tags, 'meta_tag_title' => $value->meta_tag_title, 'meta_tag_description' => $value->meta_tag_description, 'meta_tag_keywords' => $value->meta_tag_keywords, 'key_features' => $value->key_features, 'cancel_status' => $value->cancel_status, 'return_status' => $value->return_status, 'attributes' => $att1, 'link_variants' => $link_variants, 'image' => $img, 'selling_date' => date('d-m-Y', strtotime($value->selling_date)), 'taxname' => $value->taxname, 'manage_stock' => $value->manage_stock, 'variant_product' => $value->variant_product, 'status' => $value->status, 'cat_id' => $value->cat_id, 'sub_cat_id' => $value->sub_cat_id, 'tax_class' => $value->tax_class, 'availabile_stock_status' => $value->availabile_stock_status);

                return $ar;
            } else {

                return 'false';
            }
        } else {

            return 'false';
        }
    }


function getNewtreDeals() {

        // $this->db->limit(6);
      
            $dat = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');

        if (sizeof($dat) > 0) {

            $ar = [];

            foreach ($dat as $value) {
                $category = $this->common_model->get_data_row(['id' => $value->cat_id, 'status' => 1], 'categories');
                if ($category) {
                    $shop = $this->common_model->get_data_row(['id' => $value->shop_id, 'status' => 1], 'vendor_shop');
                    if ($shop) {
                        $variants = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                        if (sizeof($variants) > 0) {
                            $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;
                            $im = $this->db->query("select * from product_images where variant_id='" . $variants[0]->id . "' order by priority asc");
                            $images = $im->row();
                            if ($images->image != '') {
                                $img = base_url() . "uploads/products/" . $images->image;
                            } else {
                                $img = base_url() . "uploads/noproduct.png";
                            }
                            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                            $subcategory = $subcat->row();

                            $wish = $this->db->query("select * from whish_list where variant_id='" . $variants[0]->id . "' and user_id='" . $user_id . "'");

                            if ($wish->num_rows() > 0) {

                                $stat = true;
                            } else {

                                $stat = false;
                            }

                            $session_id = $_SESSION['session_data']['session_id'];
                            $in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $variants[0]->id])->get('cart')->num_rows();
                         
                                $date = strtotime("-30 day");
                                if ($value->created_at >= $date) {
                                    $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'in_cart' => $in_cart);
                                }
                            
                        }
                    }
                }
            }

            return $ar;
        } else {
            return array();
        }
    }

    function getTopDeals($user_id, $new_arrival = null) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

//        $admin = $this->db->query("select * from admin where id=1");
//
//        $search_distance = $admin->row()->distance;
        // $this->db->limit(6);
        if ($new_arrival == null) {
            $dat = $this->common_model->get_data_with_condition(['top_deal' => 'yes', 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
        } else {
            $dat = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');

        }

        if (sizeof($dat) > 0) {

            $ar = [];
            // echo "<pre>";
            foreach ($dat as $value) {
                

                $category = $this->common_model->get_data_row(['id' => $value->cat_id, 'status' => 1], 'categories');
                if ($category) {
                    $shop = $this->common_model->get_data_row(['id' => $value->shop_id, 'status' => 1], 'vendor_shop');
                    if ($shop) {
                        $variants = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                        if (sizeof($variants) > 0) {
                            $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;
                            $im = $this->db->query("select * from product_images where variant_id='" . $variants[0]->id . "' order by priority asc");
                            $images = $im->row();
                            if ($images->image != '') {
                                $img = base_url() . "uploads/products/" . $images->image;
                            } else {
                                $img = base_url() . "uploads/noproduct.png";
                            }
                            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                            $subcategory = $subcat->row();

                            $wish = $this->db->query("select * from whish_list where variant_id='" . $variants[0]->id . "' and user_id='" . $user_id . "'");

                            if ($wish->num_rows() > 0) {

                                $stat = true;
                            } else {

                                $stat = false;
                            }
                            // echo "<pre>";
                            // print_r($variants);
                            // exit;
                            // $qry_var = $this->db->query("SELECT * FROM cart WHERE variant_id='" . $variants[0]->id . "' AND vendor_id='" . $value->shop_id . "' AND is_checkout = 1 AND check_out = 0");
                            // $re_var = $qry_var->result();
                            
                            // // Get the number of rows
                            // $row_count = $qry_var->num_rows();
                            // echo "Number of rows: " . $row_count. "<br>";
                            // echo "variant_id".$variants[0]->id."<br>";
                            // // echo $value->id ."<br>";
                           
                            // // echo "<pre>";
                            // // print_r($re_var);
                            // echo "<br>";
                            // print_r($value->id. "<br>");

                            // echo "<br>";


//                             $qry_var = $this->db->query("SELECT variant_id, vendor_id, COUNT(*) as row_count
//                              FROM cart
//                              WHERE variant_id = '" . $variants[0]->id . "' 
//                              AND vendor_id = '" . $value->shop_id . "' 
//                              AND is_checkout = 1 
//                              AND check_out = 0
//                              GROUP BY variant_id, vendor_id
//                              ORDER BY row_count DESC
//                              LIMIT 3");

// $re_var = $qry_var->result();

// // If you also want to see the result set, you can print it
// // echo "<pre>";
// // print_r($re_var);
// $count_arr=array();
// foreach($re_var as $va){
//     $count_arr[]=$va->row_count;
    
   
// }
// print_r($count_arr[0]);
// $one[]=$count_arr[0];
// print_r($one);



// $sorted_arr[]=sort($count_arr[0]);
// print_r(sort($count_arr[0]));

$pro_qry=$this->db->query("select orders_placed from products where id='".$value->id."'");
$pro_res=$pro_qry->row();
// echo "<pre>";
// print_r($pro_res);
// exit;

                            
                            // If you also want to see the result set, you can still print it
                            
                            

                            //check already in cart or not
                            $session_id = $_SESSION['session_data']['session_id'];
                            // echo $session_id ."<br>";
                            $in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $variants[0]->id])->get('cart')->num_rows();
                            $cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;
                            if ($new_arrival == null) {
                                $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'in_cart' => $in_cart,'stock'=>$variants[0]->stock,'orders_placed'=>$pro_res->orders_placed,'cart_limit'=> $cart_limit);
                            } else {
                                $date = strtotime("-30 day");
                                if ($value->created_at >= $date) {
                                    $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'in_cart' => $in_cart,'stock'=>$variants[0]->stock,'orders_placed'=>$pro_res->orders_placed,'cart_limit'=> $cart_limit);
                                }
                            }
                        }
                    }
                }
            }
            
                            // exit;
                            // sort($one);
                            // print_r($one);
                            // exit;

            return $ar;
        } else {
            return array();
        }
    }

    function getTrendingProductspagination($limit, $start, $user_id) {

        // if ($limit) {
        //     $no = 6;
        // } else {
        //     $no = 100;
        // }

        //$this->db->limit($no);
         $this->db->limit($limit, $start);
        $dat = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');

        if (sizeof($dat) > 0) {

            $ar = [];

            foreach ($dat as $value) {
                $category = $this->common_model->get_data_row(['id' => $value->cat_id, 'status' => 1], 'categories');
                if ($category) {
                    $shop = $this->common_model->get_data_row(['id' => $value->shop_id, 'status' => 1], 'vendor_shop');
                    if ($shop) {
                        $variants = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                        if (sizeof($variants) > 0) {
                            $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;
                            $im = $this->db->query("select * from product_images where variant_id='" . $variants[0]->id . "' order by priority asc");
                            $images = $im->row();
                            if ($images->image != '') {
                                $img = base_url() . "uploads/products/" . $images->image;
                            } else {
                                $img = base_url() . "uploads/noproduct.png";
                            }
                            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                            $subcategory = $subcat->row();

                            $wish = $this->db->query("select * from whish_list where variant_id='" . $variants[0]->id . "' and user_id='" . $user_id . "'");

                            if ($wish->num_rows() > 0) {

                                $stat = true;
                            } else {

                                $stat = false;
                            }
                            $rating=$this->web_model->rating_data($value->id);
                            $pro_qry=$this->db->query("select orders_placed from products where id='".$value->id."'");
                            $pro_res=$pro_qry->row();
                            // echo "<pre>";
                            // print_r($variants[0]->stock);
                            // exit;

                            //check already in cart or not
                            $session_id = $_SESSION['session_data']['session_id'];
                            $in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $variants[0]->id])->get('cart')->num_rows();
                            $cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;
                            $count = $this->common_model->count_rows_with_conditions('most_viewed_products', ['product_id' => $value->id]);
                            $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'visited_count' => $count, 'in_cart' => $in_cart,'rating'=>$rating,'stock'=>$variants[0]->stock,'orders_placed'=>$pro_res->orders_placed,'cart_limit'=>$cart_limit);
                        }
                    }
                }
            }

            $columns = array_column($ar, 'visited_count');
            rsort($columns);
            $new = array_slice($columns, 0, $no);
            $final = [];
            foreach ($ar as $r) {
                if (in_array($r['visited_count'], $new)) {
                    array_push($final, $r);
                }
            }

            return $final;
        } else {
            return array();
        }
    }

    function getTrendingProducts($user_id) {

        // if ($limit) {
        //     $no = 6;
        // } else {
        //     $no = 100;
        // }

        //$this->db->limit($no);
        $dat = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');

        if (sizeof($dat) > 0) {

            $ar = [];

            foreach ($dat as $value) {
                $category = $this->common_model->get_data_row(['id' => $value->cat_id, 'status' => 1], 'categories');
                if ($category) {
                    $shop = $this->common_model->get_data_row(['id' => $value->shop_id, 'status' => 1], 'vendor_shop');
                    if ($shop) {
                        $variants = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                        if (sizeof($variants) > 0) {
                            $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;
                            $im = $this->db->query("select * from product_images where variant_id='" . $variants[0]->id . "' order by priority asc");
                            $images = $im->row();
                            if ($images->image != '') {
                                $img = base_url() . "uploads/products/" . $images->image;
                            } else {
                                $img = base_url() . "uploads/noproduct.png";
                            }
                            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                            $subcategory = $subcat->row();

                            $wish = $this->db->query("select * from whish_list where variant_id='" . $variants[0]->id . "' and user_id='" . $user_id . "'");

                            if ($wish->num_rows() > 0) {

                                $stat = true;
                            } else {

                                $stat = false;
                            }
                            // echo "<pre>";
                            // print_r($variants[0]->stock);
                            // exit;

//                             $qry_var = $this->db->query("SELECT variant_id, vendor_id, COUNT(*) as row_count
//                             FROM cart
//                             WHERE variant_id = '" . $variants[0]->id . "' 
//                             AND vendor_id = '" . $value->shop_id . "' 
//                             AND is_checkout = 1 
//                             AND check_out = 0
//                             GROUP BY variant_id, vendor_id
//                             ORDER BY row_count DESC
//                             LIMIT 3");

// $re_var = $qry_var->result();

// // If you also want to see the result set, you can print it
// // echo "<pre>";
// // print_r($re_var);
// $count_arr=array();
// foreach($re_var as $va){
//    $count_arr[]=$va->row_count;
   
  

$pro_qry=$this->db->query("select orders_placed from products where id='".$value->id."'");
$pro_res=$pro_qry->row();



                            //check already in cart or not
                            $session_id = $_SESSION['session_data']['session_id'];
                            $in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $variants[0]->id])->get('cart')->num_rows();
                            $cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;
                            $count = $this->common_model->count_rows_with_conditions('most_viewed_products', ['product_id' => $value->id]);
                            $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'visited_count' => $count, 'in_cart' => $in_cart,'stock'=>$variants[0]->stock,'orders_placed'=>$pro_res->orders_placed,'cart_limit'=>$cart_limit);
                        }
                    }
                }
            }
// exit;
            $columns = array_column($ar, 'visited_count');
            rsort($columns);
            $new = array_slice($columns, 0, $no);
            $final = [];
            foreach ($ar as $r) {
                if (in_array($r['visited_count'], $new)) {
                    array_push($final, $r);
                }
            }

            return $final;
        } else {
            return array();
        }
    }

    function getTrendingProductsCount($user_id, $limit = null) {
        // if ($limit) {
        //     $no = 6;
        // } else {
        //     $no = 100;
        // }
        //$this->db->limit($no);
        $dat = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');

        if (sizeof($dat) > 0) {

            $ar = [];

            foreach ($dat as $value) {
                $category = $this->common_model->get_data_row(['id' => $value->cat_id, 'status' => 1], 'categories');
                if ($category) {
                    $shop = $this->common_model->get_data_row(['id' => $value->shop_id, 'status' => 1], 'vendor_shop');
                    if ($shop) {
                        $variants = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                        if (sizeof($variants) > 0) {
                            $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;
                            $im = $this->db->query("select * from product_images where variant_id='" . $variants[0]->id . "' order by priority asc");
                            $images = $im->row();
                            if ($images->image != '') {
                                $img = base_url() . "uploads/products/" . $images->image;
                            } else {
                                $img = base_url() . "uploads/noproduct.png";
                            }
                            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                            $subcategory = $subcat->row();

                            $wish = $this->db->query("select * from whish_list where variant_id='" . $variants[0]->id . "' and user_id='" . $user_id . "'");

                            if ($wish->num_rows() > 0) {

                                $stat = true;
                            } else {

                                $stat = false;
                            }
                            
                            $count = $this->common_model->count_rows_with_conditions('most_viewed_products', ['product_id' => $value->id]);
                            $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'visited_count' => $count);
                        }
                    }
                }
            }

            $columns = array_column($ar, 'visited_count');
            rsort($columns);
            $new = array_slice($columns, 0, $no);
            $final = [];
            foreach ($ar as $r) {
                if (in_array($r['visited_count'], $new)) {
                    array_push($final, $r);
                }
            }

            return sizeof($final);
        } else {
            return array();
        }
    }

    function getmostViewedProducts($user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT link_variant.id as variant_id ,link_variant.saleprice,link_variant.price,link_variant.stock,most_viewed_products.product_id,count(most_viewed_products.id) as cnt,products.*,vendor_shop.id as vendor_id,vendor_shop.shop_name FROM most_viewed_products INNER JOIN products ON products.id =most_viewed_products.product_id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id INNER JOIN link_variant ON link_variant.product_id=most_viewed_products.product_id WHERE products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' and vendor_shop.status=1 and link_variant.saleprice!='0' and link_variant.stock > 0 and link_variant.status=1 GROUP by most_viewed_products.product_id order by most_viewed_products.id DESC LIMIT 6");
        //having distance<'".$search_distance."'
        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;

                /* $qry1 = $this->db->query("SELECT * FROM `link_variant` where saleprice!='0' and status=1 and product_id='".$value->id."'");

                  $value12 = $qry1->row(); */



                $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

                $images = $im->row();

                if ($images->image != '') {

                    $img = base_url() . "uploads/products/" . $images->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }





                $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

                $category = $cat->row();

                $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                $subcategory = $subcat->row();

                $state_id = $row->state_id;

                $city_id = $row->address_id;

                $pincode_id = $row->pincode_id;

                if ($value->status == 1) {

                    $shopstat = "Open";
                } else {

                    $shopstat = "Closed";
                }





                $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

                if ($wish->num_rows() > 0) {

                    $stat = true;
                } else {

                    $stat = false;
                }

                if ($value->saleprice != '') {

                    $slaeprice = $value->saleprice;
                } else {

                    $slaeprice = 0;
                }



                if ($value->price != '') {

                    $price = $value->price;
                } else {

                    $price = 0;
                }



                $name = $value->name;
                if ($category->status == 1) {
                    $ar[] = array('id' => $value->id, 'variant_id' => $value->variant_id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $value->shop_name, 'price' => $price, 'saleprice' => $slaeprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'shop_status' => $shopstat, 'distance' => round($value->distance), 'seo_url' => $value->seo_url);
                }
            }



            return $ar;
        } else {

            return array();
        }
    }

    function addToCart($variant_id, $vendor_id, $user_id, $price, $quantity, $session_id) {

        $shop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_id . "'");
        $shop_num = $shop_qry->row();
        if ($shop_num->status == 0) {
            //$msg = "Shop Closed";
            //return array('status' =>FALSE,'message'=>$msg);
            echo '@shopclosed';
            die;
        }

        $session_vendor_id = $_SESSION['session_data']['vendor_id'];

        $session_id = $_SESSION['session_data']['session_id'];

        $chk_quant_qry = $this->db->query("select * from link_variant where id='" . $variant_id . "' and status = 1 and stock > 0 and saleprice > 0");

        $chk_quant_row = $chk_quant_qry->row();

        if (empty($chk_quant_row)) {
            $msg = "Product out of stock";
            echo '@error';
            die;
        } else {
            $products_get = $this->common_model->get_data_row(['id' => $chk_quant_row->product_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
            if (empty($products_get)) {
                $msg = "Product out of stock";
                echo '@error';
                die;
            } else {
                $category = $this->common_model->get_data_row(['id' => $products_get->cat_id, 'status' => 1], 'categories');
                if (empty($category)) {
                    $msg = "Currently not selling " . $category->category_name . " category products";
                    echo '@error';
                    die;
                }
                if($quantity > $products_get->cart_limit) {
                    echo '@cart_limit@'.$products_get->cart_limit;
                    die;
                }
            }
        }

        $stock = $chk_quant_row->stock;

        $chk = $this->db->query("select * from cart where session_id='" . $session_id . "'");

        if ($chk->num_rows() > 0) {

            $qry_chk = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "' and variant_id='" . $variant_id . "'");

            if ($qry_chk->num_rows() > 0) {

                $row = $qry_chk->row();
                $qty = $row->quantity;
                $quantity_f = $quantity + $qty;
                if ($stock < $quantity_f) {
                    $msg = "Left only " . $stock . " Products";
                    echo '@error';
                    die;
                    //return array('status' =>FALSE,'message'=>$msg);
                }


                $un_pric = $price * $quantity_f;

                $ar = array('quantity' => $quantity_f, 'unit_price' => $un_pric);

                $wr = array('session_id' => $session_id, 'variant_id' => $variant_id, 'vendor_id' => $vendor_id, 'user_id' => $user_id);

                $ins = $this->db->update("cart", $ar, $wr);
                if ($ins) {

                    //remove from user wishlist if there
                    $chk_in_wishlist = $this->db->where(['user_id' => $user_id, 'variant_id' => $variant_id])->get('whish_list')->num_rows();
                    if ($chk_in_wishlist > 0) {
                        $this->db->where(['user_id' => $user_id, 'variant_id' => $variant_id])->delete('whish_list');
                    }

                    $sess_arr = array(
                        'session_id' => $session_id,
                        'vendor_id' => $vendor_id,
                        'session_status' => true
                    );

                    $this->session->set_userdata('session_data', $sess_arr);

                    $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "'");

                    $cart_count = $cart_qry->num_rows();
                    //return array('status' =>TRUE,'message'=>"Product added to cart");
                    echo '@success_quantity@' . $cart_count . '@' . $session_id;
                    die;
                }
            } else {

                if ($stock < $quantity) {

                    $msg = "Left only " . $stock . " Products";

                    //return array('status' =>FALSE,'message'=>$msg);

                    echo '@error';
                    die;
                }

                $tprice = $price * $quantity;

                $ar = array('session_id' => $session_id, 'variant_id' => $variant_id, 'vendor_id' => $vendor_id, 'user_id' => $user_id, 'price' => $price, 'quantity' => $quantity, 'unit_price' => $tprice);

                $ins = $this->db->insert("cart", $ar);

                if ($ins) {

                    //remove from user wishlist if there
                    $chk_in_wishlist = $this->db->where(['user_id' => $user_id, 'variant_id' => $variant_id])->get('whish_list')->num_rows();
                    if ($chk_in_wishlist > 0) {
                        $this->db->where(['user_id' => $user_id, 'variant_id' => $variant_id])->delete('whish_list');
                    }

                    $sess_arr = array(
                        'session_id' => $session_id,
                        'vendor_id' => $vendor_id,
                        'session_status' => true
                    );

                    $this->session->set_userdata('session_data', $sess_arr);

                    $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "'");

                    $cart_count = $cart_qry->num_rows();

                    //return array('status' =>TRUE,'message'=>"Product added to cart");

                    echo '@success@' . $cart_count . '@' . $session_id;
                    die;
                }
            }
        } else {

            $session_id1 = generate_session_id();

            $sess_arr = array(
                'session_id' => $session_id1,
                'vendor_id' => $vendor_id,
                'session_status' => true
            );

            $this->session->set_userdata('session_data', $sess_arr);

            $session_id = $_SESSION['session_data']['session_id'];

            if ($stock < $quantity) {

                $msg = "Left only " . $stock . " Products";

                //return array('status' =>FALSE,'message'=>$msg);

                echo '@error';
                die;
            }

            $tprice = $price * $quantity;

            $ar = array('session_id' => $session_id, 'variant_id' => $variant_id, 'vendor_id' => $vendor_id, 'user_id' => $user_id, 'price' => $price, 'quantity' => $quantity, 'unit_price' => $tprice);

            $ins = $this->db->insert("cart", $ar);

            if ($ins) {

                //remove from user wishlist if there
                $chk_in_wishlist = $this->db->where(['user_id' => $user_id, 'variant_id' => $variant_id])->get('whish_list')->num_rows();
                if ($chk_in_wishlist > 0) {
                    $this->db->where(['user_id' => $user_id, 'variant_id' => $variant_id])->delete('whish_list');
                }

                $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "'");

                $cart_count = $cart_qry->num_rows();

                //return array('status' =>TRUE,'message'=>"Product added to cart");

                echo '@success@' . $cart_count . '@' . $session_id1;
                die;
            }



            //}
        }
    }

    function getshopwiseProducts($cat_id, $shop_id, $user_id, $subcat_id, $searchdata) {



        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $user_qry = $this->db->query("select * from users where id='" . $user_id . "'");

            $user_row = $user_qry->row();

            $lat = $user_row->lat;

            $lng = $user_row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        if ($cat_id == 'shop' && $subcat_id == 'nosubcat') {

            $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' and products.name LIKE '%" . $searchdata . "%' group by link_variant.product_id order by products.id ASC");
        } else if ($cat_id == 'shop' && $subcat_id != 'nosubcat') {



            $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.sub_cat_id='" . $subcat_id . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' and products.name LIKE '%" . $searchdata . "%' group by link_variant.product_id order by products.id ASC");
        } else if ($cat_id != 'shop' && $subcat_id == 'nosubcat') {

            $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.cat_id='" . $cat_id . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' and products.name LIKE '%" . $searchdata . "%' group by link_variant.product_id order by products.id ASC");
        } else if ($cat_id != 'shop' && $subcat_id != 'nosubcat') {



            $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.delete_status=0 and products.cat_id='" . $cat_id . "' and products.sub_cat_id='" . $subcat_id . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.availabile_stock_status='available' and products.name LIKE '%" . $searchdata . "%' group by link_variant.product_id order by products.id ASC");
        }







        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

                $images = $im->row();

                if ($images->image != '') {

                    $img = base_url() . "uploads/products/" . $images->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }





                $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

                $category = $cat->row();

                $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                $subcategory = $subcat->row();

                /* $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");

                  $brand = $brnd->row(); */



                $vendo = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

                $vendor = $vendo->row();

                // print_r($value);

                $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

                if ($wish->num_rows() > 0) {

                    $stat = true;
                } else {

                    $stat = false;
                }



                $ar[] = array('id' => $value->id, 'seo_url' => $value->seo_url, 'variant_id' => $value->variant_id, 'shop_id' => $vendor->id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $vendor->shop_name, 'price' => $value->price, 'saleprice' => $value->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat);
            }





            return $ar;
        } else {



            return array();
        }
    }

    function getProducts($cat_id, $shop_id, $user_id, $subcat_id) {



        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $user_qry = $this->db->query("select * from users where id='" . $user_id . "'");

            $user_row = $user_qry->row();

            $lat = $user_row->lat;

            $lng = $user_row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        if ($cat_id == 'shop') {

            $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.sub_cat_id='" . $subcat_id . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by products.id ASC");
        } else {



            $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.cat_id='" . $cat_id . "' and products.sub_cat_id='" . $subcat_id . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by products.id ASC");
        }





        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

                $images = $im->row();

                if ($images->image != '') {

                    $img = base_url() . "uploads/products/" . $images->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }





                $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

                $category = $cat->row();

                $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                $subcategory = $subcat->row();

                /* $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");

                  $brand = $brnd->row(); */



                $vendo = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

                $vendor = $vendo->row();

                // print_r($value);

                $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

                if ($wish->num_rows() > 0) {

                    $stat = true;
                } else {

                    $stat = false;
                }



                $ar[] = array('id' => $value->id, 'seo_url' => $value->seo_url, 'variant_id' => $value->variant_id, 'shop_id' => $vendor->id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $vendor->shop_name, 'price' => $value->price, 'saleprice' => $value->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat);
            }





            return $ar;
        } else {



            return array();
        }
    }

    function getsortProducts($cat_id, $shop_id, $user_id, $type, $subcatid) {



        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $user_qry = $this->db->query("select * from users where id='" . $user_id . "'");

        $user_row = $user_qry->row();

        $lat = $user_row->lat;

        $lng = $user_row->lng;

        if ($type == 0) {

            if ($cat_id == 'shop') {

                $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.sub_cat_id='" . $subcatid . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by link_variant.id desc");
            } else {

                $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.cat_id='" . $cat_id . "' and products.sub_cat_id='" . $subcatid . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by link_variant.id desc");
            }
        } else if ($type == 1) {

            if ($cat_id == 'shop') {

                $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.sub_cat_id='" . $subcatid . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by link_variant.saleprice desc");
            } else {

                $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.cat_id='" . $cat_id . "' and products.sub_cat_id='" . $subcatid . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by link_variant.saleprice desc");
            }
        } else if ($type == 2) {

            if ($cat_id == 'shop') {

                $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.sub_cat_id='" . $subcatid . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by link_variant.saleprice asc");
            } else {



                $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.cat_id='" . $cat_id . "' and products.sub_cat_id='" . $subcatid . "' and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' group by link_variant.product_id order by link_variant.saleprice asc");
            }
        }





        $dat = $qry->result();

        $ar = [];

        foreach ($dat as $value) {

            $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

            $images = $im->row();

            if ($images->image != '') {

                $img = base_url() . "uploads/products/" . $images->image;
            } else {

                $img = base_url() . "uploads/noproduct.png";
            }





            $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

            $category = $cat->row();

            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

            $subcategory = $subcat->row();

            /* $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");

              $brand = $brnd->row(); */



            $vendo = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

            $vendor = $vendo->row();

            // print_r($value);

            $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

            if ($wish->num_rows() > 0) {

                $stat = true;

                $fav = 'fas';
            } else {

                $stat = false;

                $fav = 'fal';
            }



            $ar[] = array('id' => $value->id, 'variant_id' => $value->variant_id, 'shop_id' => $vendor->id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $vendor->shop_name, 'price' => $value->price, 'saleprice' => $value->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat);

            $output .= '<div class="col-lg-2 col-md-3 col-sm-4 col-6" >

                        <div class="single_product">

                            <div class="product_thumb">

                                <a class="primary_img" href="' . base_url() . 'web/product_view/' . $value->seo_url . '"><img src="' . $img . '" alt=""></a>

                                <a class="secondary_img" href="' . base_url() . 'web/product_view/' . $value->seo_url . '"><img src="' . $img . '" alt=""></a>

                                <div class="label_product">

                                </div>

                                <div class="wishlist">

                                    <a title="Add to Wishlist" onclick="addFavorite(' . $value->id . ')">

                                      <span id="bestselling_pro_' . $value->id . '" class="' . $fav . ' fa-heart"></span>

                                    </a>

                                  </div>





                            </div>

                            <div class="product_content grid_content">

                                <div class="product_content_inner">

                                    <h4 class="product_name"><a href="' . base_url() . 'web/product_view/' . $value->seo_url . '">' . $value->name . '</a></h4>

                                    <div class="price_box">

                                        <span class="current_price"><i class="fal fa-rupee-sign"></i> ' . $value->saleprice . '</span>

                                    </div>

                                </div>

                                <div class="add_to_cart">

                                    <a onclick="addtocart(' . $value->variant_id . ',' . $value->shop_id . ',' . $value->saleprice . ',1)"><i class="fal fa-shopping-cart fa-lg"></i> Add to cart</a>

                                </div>

                            </div>



                        </div>

                    </div>';
        }





        print_r($output);

        die;
    }

    function getAddress($user_id) {

        $qry = $this->db->query("select * from user_address where user_id='" . $user_id . "'");

        $result = $qry->result();

        $ar = [];

        foreach ($result as $value) {

            $city_qry = $this->db->query("select * from cities where id='" . $value->city . "'");

            $city_row = $city_qry->row();

            $state_qry = $this->db->query("select * from states where id='" . $value->state . "'");

            $state_row = $state_qry->row();

            if ($value->address_type == 1) {

                $addres_type = "Home";
            } else if ($value->address_type == 2) {

                $addres_type = "Office/Commercial";
            }
            else if($value->address_type ==3) {
                $addres_type ="Default address";
            }

           

            $ar[] = array('id' => $value->id, 'name' => $value->name, 'address' => $value->address, 'city' => $value->city, 'state' => $state_row->state_name, 'pincode' => $value->pincode, 'mobile' => $value->mobile, 'city_id' => $value->city, 'landmark' => $value->landmark, 'address_type' => $addres_type, 'address_status' => $value->address_type, 'state_id' => $value->state);
        }



        return $ar;
    }

    function getstates() {

        $qry = $this->db->query("select * from states order by id desc");

        if ($qry->num_rows() > 0) {

            $state = $qry->result();

            return $state;
        } else {

            return array();
        }
    }

    function fetchCities($state_id) {



        $qry = $this->db->query("select * from cities where state_id='" . $state_id . "'");

        $query = $qry->result();

        $output = '<option value="">Select City</option>';

        foreach ($query as $row) {

            $output .= '<option value="' . $row->id . '">' . $row->city_name . '</option>';
        }

        print_r($output);
        die;
    }

    function getPincodes($state_id, $city_id, $vendor_id) {

        /* $vendor_qry = $this->db->query("SELECT * FROM `vendor_shop` WHERE state_id='".$state_id."' and city_id='".$city_id."' and id='".$vendor_id."'"); */
        /* $vendor_qry = $this->db->query("SELECT * FROM `pincodes` WHERE state_id='".$state_id."' and city_id='".$city_id."'");


          if($vendor_qry->num_rows()>0)
          {
          $pincode_ar = $vendor_qry->result();
          return array('status' =>TRUE, 'pincodes'=>$pincode_ar);

          }
          else
          {
          return array('status' =>TRUE, 'message'=>"There is no pincodes");
          }
          print_r($output); die; */


        /* if($vendor_qry->num_rows()>0)

          {

          $pincode_list = explode(",", $vendor_row->vendor_pincodes);

          $pincode_ar=[];

          foreach ($pincode_list as $value)

          {

          $chk_qry = $this->db->query("select * from pincodes where id='".$value."'");

          $chk_pincode = $chk_qry->row();

          if($chk_qry->num_rows()>0)

          {

          //$pincode_ar[]=$chk_pincode;



          $output .= '<option value="'.$chk_pincode->id.'">'.$chk_pincode->pincode.'</option>';

          }



          }

          print_r($output); die;}
         */















        $qry = $this->db->query("select * from pincodes where state_id='" . $state_id . "' and city_id='" . $city_id . "' order by pincode asc");

        $query = $qry->result();

        $output = '<option value="">Select Pincode</option>';

        foreach ($query as $row) {

            $output .= '<option value="' . $row->id . '">' . $row->pincode . '</option>';
        }

        print_r($output);
        die;
    }

    function getaddresspincodes($state_id, $city_id) {

        $qry = $this->db->query("select * from pincodes where state_id='" . $state_id . "' and city_id='" . $city_id . "' order by pincode asc");

        $query = $qry->result();

        $output = '<option value="">Select Pincode</option>';

        foreach ($query as $row) {

            $output .= '<option value="' . $row->id . '">' . $row->pincode . '</option>';
        }

        print_r($output);
        die;
    }

    function addAddress($user_id, $name, $mobile, $address, $state, $city, $pincode, $landmark, $address_type) {

        /* $chk = $this->db->query("SELECT * FROM `vendor_shop` where state_id='".$state."' and city_id='".$city."' and find_in_set('".$pincode."',vendor_pincodes)");

          if($chk->num_rows()>0)

          { */



        $data = array('user_id' => $user_id, 'name' => $name, 'mobile' => $mobile, 'address' => $address, 'city' => $city, 'state' => $state, 'pincode' => $pincode, 'landmark' => $landmark, 'address_type' => $address_type);

        $ins = $this->db->insert("user_address", $data);

        if ($ins) {

            echo '@success';
            die;
        } else {

            echo '@error';
            die;
        }

        /* }

          else

          {

          echo '@nolocation'; die;


          } */
    }

    function addBookAddress($user_id, $name, $mobile, $address, $state, $city, $pincode, $landmark, $address_type,$status) {

        $data = array('user_id' => $user_id, 'name' => $name, 'mobile' => $mobile, 'address' => $address, 'city' => $city, 'state' => $state, 'pincode' => $pincode, 'landmark' => $landmark, 'address_type' => $address_type,'isdefault'=> $status);

        $ins = $this->db->insert("user_address", $data);

        if ($ins) {

            echo '@success';
            die;
        } else {

            echo '@error';
            die;
        }
    }

    function deleteAddress($user_id, $aid) {

        $del = $this->db->delete("user_address", array('id' => $aid));

        if ($del) {

            return 'true';
        } else {

            return FALSE;
        }
    }

    function updateAddress($address_id, $user_id, $name, $mobile, $address, $state, $city, $pincode, $landmark, $address_type) {



//        $chk = $this->db->query("SELECT * FROM `vendor_shop` where state_id='" . $state . "' and city_id='" . $city . "' and find_in_set('" . $pincode . "',vendor_pincodes)");
//
//        if ($chk->num_rows() > 0) {
//
// $isdefault='no';
// if($address_type ==3){
//     $isdefault='yes';
//                 }
//                 else{
//                     $isdefault='no';
//                 }


        $data = array('user_id' => $user_id, 'name' => $name, 'mobile' => $mobile, 'address' => $address, 'city' => $city, 'state' => $state, 'pincode' => $pincode, 'landmark' => $landmark, 'address_type' => $address_type);

        $wr = array('id' => $address_id);

        $upd = $this->db->update("user_address", $data, $wr);

        //echo $this->db->last_query(); die;

        if ($upd) {

            echo '@success';
            die;
        } else {

            echo '@error';
            die;
        }
        //} 
//        else {
//
//            echo '@nolocation';
//            die;
        //return array('status' =>FALSE, 'message'=>'No shops in this location,Please change your location');
        //}
    }

    function updateBookAddress($address_id, $user_id, $name, $mobile, $address, $state, $city, $pincode, $landmark, $address_type,$status) {



        $data = array('user_id' => $user_id, 'name' => $name, 'mobile' => $mobile, 'address' => $address, 'city' => $city, 'state' => $state, 'pincode' => $pincode, 'landmark' => $landmark, 'address_type' => $address_type,'isdefault'=>$status);

        $wr = array('id' => $address_id);

        $upd = $this->db->update("user_address", $data, $wr);

        //echo $this->db->last_query(); die;

        if ($upd) {

            echo '@success';
            die;
        } else {

            echo '@error';
            die;
        }
    }

    function getCartList($session_id, $user_id) {

        $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");

        $del_b = $qry->row();

        $shop = $this->db->query("select * from vendor_shop where id='" . $del_b->vendor_id . "'");

        $shopdat = $shop->row();

        $min_order_amount = $shopdat->min_order_amount;

        $result = $qry->result();

        $ar = [];

        if ($qry->num_rows() > 0) {

            $unitprice = 0;

            $gst = 0;

            foreach ($result as $value) {

                $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");

                $product = $pro->row();

                if ($product->image != '') {

                    $img = base_url() . "uploads/products/" . $product->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                //$value->variant_id

                $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");

                $link = $var1->row();

                $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "' and delete_status=0");

                $product1 = $pro1->row();

                $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");

                if ($adm_qry->num_rows() > 0) {

                    $adm_comm = $adm_qry->row();

                    $p_gst = $adm_comm->gst;
                } else {

                    $p_gst = '0';
                }



                $class_percentage = ($value->unit_price / 100) * $p_gst;

                $variants1 = $var1->result();

                $att1 = [];

                foreach ($variants1 as $value1) {







                    $jsondata = $value1->jsondata;

                    $values_ar = [];

                    $json = json_decode($jsondata);

                    foreach ($json as $value123) {

                        $type = $this->db->query("select * from attributes_title where id='" . $value123->attribute_type . "'");

                        $types = $type->row();

                        $val = $this->db->query("select * from attributes_values where id='" . $value123->attribute_value . "'");

                        $value1 = $val->row();

                        $values_ar[] = array('id' => $value1->id, 'title' => $types->title, 'value' => $value1->value);
                    }
                }





                $ar[] = array('id' => $value->id, 'price' => $value->price, 'quantity' => $value->quantity, 'unit_price' => $value->unit_price, 'image' => $img, 'attributes' => $values_ar, 'product_name' => $product1->name, 'shop_name' => $shopdat->shop_name, 'shop_id' => $del_b->vendor_id, 'gst' => $class_percentage, 'maximum_quantity' => $link->stock);

                $unitprice = $value->unit_price + $unitprice;

                $gst = $class_percentage + $gst;
            }







            $grand_t = $min_order_amount + $unitprice + $gst;

            return array('cartlist' => $ar, 'total_price' => $unitprice, 'delivery_amount' => $min_order_amount, 'grand_total' => $grand_t, 'gst' => $gst);
        } else {

            return array();
        }
    }

    function doOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $order_id, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge) {


        $delivery_ad_row = $this->db->where(array('id' => $deliveryaddress_id))->get('user_address')->row();

        $state_qry_row = $this->db->where(array('id' => $delivery_ad_row->state))->get('states')->row();

        $cities_qry_row = $this->db->where(array('id' => $delivery_ad_row->city))->get('cities')->row();

        $pincode_qry_row = $this->db->where(array('id' => $delivery_ad_row->pincode))->get('pincodes')->row();

        if ($delivery_ad_row->address_type == 1) {

            $add_type = "Home";
        } else if ($delivery_ad_row->address_type == 1) {

            $add_type = "Office";
        }

        //$user_address = $add_type . ": " . $delivery_ad_row->name . ", " . $state_qry_row->state_name . ", " . $cities_qry_row->city_name . ", " . $pincode_qry_row->pincode . ", " . $delivery_ad_row->address . ", " . $delivery_ad_row->landmark;

         $user_address = $delivery_ad_row->address.", ".$delivery_ad_row->landmark.", ".$delivery_ad_row->city.", ".$state_qry_row->state_name.",".$delivery_ad_row->pincode;

        $this->db->group_by("vendor_id");
        $result = $this->db->where(array('session_id' => $session_id))->get('cart')->result();
        $ar = [];

        foreach ($result as $value) {
            $shop_num = $this->db->where(array('id' => $value->vendor_id))->get('vendor_shop')->row();

            $delivery_boy_amount = $shop_num->min_order_amount ? $shop_num->min_order_amount : 0;
            if ($shop_num->status == 0) {
                /* $msg = "Shop Closed";
                  return array('status' =>FALSE,'message'=>$msg); */

                echo '@shopclosed';
                exit;
            }


            $cart_result = $this->db->where(array('session_id' => $session_id, 'vendor_id' => $value->vendor_id))->get('cart')->result();
            $unitprice = 0;
            $admin_total = 0;
            $gst_amount = 0;
            foreach ($cart_result as $cart_value) {
                $link_variants = $this->db->where(array('id' => $cart_value->variant_id))->get('link_variant')->row();

                $product = $this->db->where(array('id' => $link_variants->product_id, 'delete_status' => 0))->get('products')->row();

                $adm = $this->db->query("select * from  admin_comissions where shop_id='" . $cart_value->vendor_id . "' and cat_id='" . $product->cat_id . "'");
                $admin = $adm->row();

                $admin_price = ($admin->admin_comission / 100) * $cart_value->unit_price;

                // $gst = ($admin->gst / 100) * $cart_value->unit_price;
                $gst = ($admin->gst / 100) * $admin_price;
                $gst_amount = $gst + $gst_amount;
                $unitprice = $cart_value->unit_price + $unitprice;
                $admin_total = $admin_price + $admin_total;

                
            }
            // $vendor = ($unitprice - $admin_total) + $delivery_boy_amount + $gst_amount;
            $vendor = $unitprice - ($admin_total + $gst_amount);

            $coupon_qry = $this->db->query("select * from coupon_codes where id='" . $coupon_id . "'");
            $coupon_row = $coupon_qry->row();
            if ($coupon_qry->num_rows() > 0) {
                if ($coupon_row->shop_id == 0) {
                    $admin_total1 = $admin_total - $coupon_disount;
                    $vendor1 = $vendor;
                } else {
                    $vendor1 = $vendor - $coupon_disount;
                    $admin_total1 = $admin_total;
                }
            } else {
                $admin_total1 = $admin_total;
                $vendor1 = $vendor;
            }

            $date = date("Y-m-d");

            $total_price = $unitprice  ;
            $ar = array('session_id' => $session_id, 'user_id' => $user_id, 'vendor_id' => $value->vendor_id, 'deliveryaddress_id' => $deliveryaddress_id, 'user_address' => $user_address, 'payment_option' => $payment_option, 'order_status' => $order_status, 'pay_orderid' => $order_id, 'deliveryboy_commission' => $delivery_boy_amount, 'created_at' => $created_at, 'sub_total' => $unitprice, 'total_price' => $total_price, 'admin_commission' => $admin_total1, 'vendor_commission' => $vendor1, 'coupon_code' => $coupon_code, 'coupon_id' => $coupon_id, 'coupon_disount' => $coupon_disount, 'gst' => $gst_amount, 'order_date' => $date);
            $chk_failed_order = $this->db->where(['session_id' => $session_id, 'vendor_id' => $value->vendor_id, 'payment_status' => null])->get('orders')->num_rows();
            if ($chk_failed_order > 0) {
                $this->db->where(['session_id' => $session_id, 'vendor_id' => $value->vendor_id, 'payment_status' => null])->delete('orders');
            }
            $this->db->insert("orders", $ar);
           

            
            




            // echo $this->db->last_query(); die;

            // $order_message = "Dear vendor new order no." . $session_id . " is in your dashboard. Please accept it for confirmation.";
            
//            $vendor_shop_qry = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");
//            $vendor_shop_row = $vendor_shop_qry->row(); 
//            $vendor_phone = $vendor_shop_row->mobile;
//            $order_message = "Dear ".$vendor_shop_row->owner_name.", You have a new order no ".$session_id." please check the order contents and delivery details on our platform Happy Business:) Team Absolutemens.com";
//            $this->send_message($order_message,$vendor_phone);

            /* $this->db->insert("sms_notifications",array('order_id'=>$session_id,'receiver_id'=>$value->vendor_id,'sender_id'=>$user_id,'created_at'=>time(),'message'=>$order_message)); */
        }

//        $order_message = "Order Placed";
//        $this->db->insert("sms_notifications", array('order_id' => $session_id, 'receiver_id' => $user_id, 'sender_id' => $value->vendor_id, 'created_at' => time(), 'message' => $order_message, 'view_status' => 'order_placed'));

        //return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$session_id);


        $order_arr = ['status' => '@success', 'session_id' => $session_id];
        return $order_arr;
    }

//    function checkOut(){
//       $table = "cart";
//       $array = array("check_out"=>$check_out);
//       $where = array("session_id",$session_id);
//       $this->db->update();        
//    }


    function biddoOrder($user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $razorpay_payment_id, $coupon_id, $coupon_code, $coupon_disount, $vendor_id, $bid_id) {





        $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");

        $result = $qry->result();

        $ar = [];

        $unitprice = 0;

        $admin_total = 0;

        foreach ($result as $value) {

            $link = $this->db->query("select * from  link_variant where id='" . $value->variant_id . "'");

            $link_variants = $link->row();

            $pro = $this->db->query("select * from  products where id='" . $link_variants->product_id . "' and delete_status=0");

            $product = $pro->row();

            $adm = $this->db->query("select * from  admin_comissions where shop_id='" . $vendor_id . "' and cat_id='" . $product->cat_id . "' and find_in_set('" . $product->sub_cat_id . "',subcategory_ids)");

            $admin = $adm->row();

            $admin_price = ($admin->admin_comission / 100) * $value->price;

            $ar[] = array('id' => $value->id, 'price' => $value->price, 'quantity' => $value->quantity, 'unit_price' => $value->unit_price, 'image' => $img);

            $unitprice = $value->unit_price + $unitprice;

            $admin_total = $admin_price + $admin_total;

            $total = $link_variants->stock - $value->quantity;

            $ar = array('varient_id' => $value->variant_id, 'product_id' => $link_variants->product_id, 'quantity' => $value->quantity, 'paid_status' => 'Debit', 'message' => 'New Order', 'total_stock' => $total, 'created_at' => time());

            $ins11 = $this->db->insert("stock_management", $ar);

            if ($ins11) {

                $qty = $link_variants->stock - $value->quantity;

                $this->db->update("link_variant", array('stock' => $qty), array('id' => $value->variant_id));
            }
        }

        $vendor = $unitprice - $admin_total;

        $coupon_qry = $this->db->query("select * from coupon_codes where id='" . $coupon_id . "'");

        $coupon_row = $coupon_qry->row();

        if ($coupon_qry->num_rows() > 0) {

            if ($coupon_row->shop_id == 0) {

                $admin_total1 = $admin_total - $coupon_disount;

                $vendor1 = $vendor;
            } else {

                $vendor1 = $vendor - $coupon_disount;

                $admin_total1 = $admin_total;
            }
        } else {

            $admin_total1 = $admin_total;

            $vendor1 = $vendor;
        }



        $vendor_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");

        $vendor_row = $vendor_qry->row();

        $vendorshop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_id . "'");

        $vendorshop_row = $vendorshop_qry->row();

        $delivery_amount = $vendorshop_row->min_order_amount;

        $delivery_ad_qry = $this->db->query("select * from user_address where id='" . $deliveryaddress_id . "'");

        $delivery_ad_row = $delivery_ad_qry->row();

        $state_qry = $this->db->query("select * from states where id='" . $delivery_ad_row->state . "'");

        $state_qry_row = $state_qry->row();

        $cities_qry = $this->db->query("select * from cities where id='" . $delivery_ad_row->city . "'");

        $cities_qry_row = $cities_qry->row();

        $pincode_qry = $this->db->query("select * from pincodes where id='" . $delivery_ad_row->pincode . "'");

        $pincode_qry_row = $pincode_qry->row();

        if ($delivery_ad_row->address_type == 1) {

            $add_type = "Home";
        } else if ($delivery_ad_row->address_type == 1) {

            $add_type = "Office";
        }

        $user_address = $add_type . ": " . $delivery_ad_row->name . ", " . $state_qry_row->state_name . ", " . $delivery_ad_row->city . ", " . $pincode_qry_row->pincode . ", " . $delivery_ad_row->address . ", " . $delivery_ad_row->landmark;

        $shop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_id . "'");

        $shop_num = $shop_qry->row();

        if ($shop_num->status == 0) {

            $msg = "Shop Closed";

            echo '@shopclosed';
            exit;
        }





        $bid_qry = $this->db->query("select * from user_bids where id='" . $bid_id . "'");

        $bid_row = $bid_qry->row();

        $session_id = $bid_row->session_id;

        $ar = array('bid_id' => $bid_id, 'session_id' => $session_id, 'user_id' => $user_id, 'vendor_id' => $vendor_id, 'deliveryaddress_id' => $deliveryaddress_id, 'user_address' => $user_address, 'payment_option' => $payment_option, 'order_status' => $order_status, 'deliveryboy_commission' => $delivery_amount, 'created_at' => $created_at, 'sub_total' => $unitprice, 'total_price' => $grand_total, 'admin_commission' => $admin_total1, 'vendor_commission' => $vendor1, 'pay_transaction_id' => $razorpay_payment_id, 'payment_status' => 1, 'delivery_timeslots' => 0, 'delivery_boy' => 0, 'coupon_id' => 0, 'coupon_code' => 0, 'coupon_disount' => 0, 'pay_orderid' => 0, 'pay_razerpay_id' => 0, 'bonus_points' => 0, 'wallet_amount' => 0, 'gst' => 0, 'accept_status' => 0);

        //,'coupon_code'=>$coupon_code,'coupon_id'=>$coupon_id,'coupon_disount'=>$coupon_disount,'gst'=>$gst



        $ins = $this->db->insert("orders", $ar);

        if ($ins) {

            $this->db->update("user_bids", array('bid_status' => 2), array('id' => $bid_id));

            $sess_arr = array(
                'session_id' => $session_id,
                'vendor_id' => $vendor_row->vendor_id,
                'session_status' => false
            );

            $this->session->unset_userdata('session_data', $sess_arr);

            $last_id = $this->db->insert_id();

            $title = "New Order From Dhukanam";

            $message = "You Have new Order";

            $this->onesignalnotification($vendor_row->vendor_id, $title, $message);

            $msg = "New Order Created ";

            /* $ins = $this->db->insert("wallet_transactions",array('user_id'=>$user_id,'price'=>$wallet_used_amount,'message'=>$msg,'status'=>'minus','created_at'=>time(),'order_id'=>$last_id)); */



            $vendor_shop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_row->vendor_id . "'");

            $vendor_shop_row = $vendor_shop_qry->row();

            $vendor_phone = $vendor_shop_row->mobile;

            $order_message = "Dear vendor new order no." . $last_id . " is in your dashboard. Please accept it for confirmation.";

            $vendortemplat_id = '1407161900279488583';

            /* if($this->send_message($order_message,$vendor_phone,$vendortemplat_id))

              { */

            $this->db->insert("sms_notifications", array('order_id' => $last_id, 'receiver_id' => $vendor_row->vendor_id, 'sender_id' => $user_id, 'created_at' => time(), 'message' => $order_message));

            /* } */







            $user_sms_qry = $this->db->query("select * from users where id='" . $user_id . "'");

            $user_sms_row = $user_sms_qry->row();

            $user_phone = $user_sms_row->phone;

            $user_name = $user_sms_row->first_name . " " . $user_sms_row->last_name;

            $templat_id_user = '1407161900222278373';

            $user_order_message = "Dear " . $user_name . " your order no." . $last_id . " is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.";

            /* if($this->send_message($user_order_message,$user_phone,$templat_id_user))

              { */

            $this->db->insert("sms_notifications", array('order_id' => $last_id, 'receiver_id' => $user_id, 'sender_id' => $vendor_row->vendor_id, 'created_at' => time(), 'message' => $user_order_message));

            /* } */

            //return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$last_id);

            echo '@success';
            exit;
        } else {

            echo '@error';
            exit;
        }
    }

    function doUserCODOrder($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge) {

        $delivery_ad_row = $this->db->where(array('id' => $deliveryaddress_id))->get('user_address')->row();

        $state_qry_row = $this->db->where(array('id' => $delivery_ad_row->state))->get('states')->row();

        $cities_qry_row = $this->db->where(array('id' => $delivery_ad_row->city))->get('cities')->row();

        $pincode_qry_row = $this->db->where(array('id' => $delivery_ad_row->pincode))->get('pincodes')->row();

        if ($delivery_ad_row->address_type == 1) {

            $add_type = "Home";
        } else if ($delivery_ad_row->address_type == 1) {

            $add_type = "Office";
        }

        $user_address = $add_type . ": " . $delivery_ad_row->name . ", " . $state_qry_row->state_name . ", " . $delivery_ad_row->city . ", " . $pincode_qry_row->pincode . ", " . $delivery_ad_row->address . ", " . $delivery_ad_row->landmark;

        $this->db->group_by("vendor_id");
        $result = $this->db->where(array('session_id' => $session_id))->get('cart')->result();
        $ar = [];
        foreach ($result as $value) {
            $shop_num = $this->db->where(array('id' => $value->vendor_id))->get('vendor_shop')->row();

            $delivery_boy_amount = $shop_num->min_order_amount;
            if ($shop_num->status == 0) {
                /* $msg = "Shop Closed";
                  return array('status' =>FALSE,'message'=>$msg); */

                echo '@shopclosed';
                exit;
            }


            $cart_result = $this->db->where(array('session_id' => $session_id, 'vendor_id' => $value->vendor_id))->get('cart')->result();
            $unitprice = 0;
            $admin_total = 0;
            $gst_amount = 0;

            foreach ($cart_result as $cart_value) {
                $vendor_mail = $this->db->where(array('id' => $cart_value->vendor_id))->get('vendor_shop')->row()->email;
                $link_variants = $this->db->where(array('id' => $cart_value->variant_id))->get('link_variant')->row();

                $product = $this->db->where(array('id' => $link_variants->product_id, 'delete_status' => 0))->get('products')->row();

                $adm = $this->db->query("select * from  admin_comissions where shop_id='" . $cart_value->vendor_id . "' and cat_id='" . $product->cat_id . "'");
                $admin = $adm->row();

                $admin_price = ($admin->admin_comission / 100) * $cart_value->unit_price;

                $gst = ($admin->gst / 100) * $cart_value->unit_price;
                $gst_amount = $gst + $gst_amount;
                $unitprice = $cart_value->unit_price + $unitprice;
                $admin_total = $admin_price + $admin_total;

                $row = json_decode(json_encode(['variant_id' => $link_variants->id, 'quantity' => $cart_value->quantity]));

                //send notification to vendor regarding stock reduce

                $row->variant = $this->common_model->get_data_row(['id' => $row->variant_id], 'link_variant');
                $row->product = $this->common_model->get_data_row(['id' => $row->variant->product_id], 'products');
                $this->db->order_by('priority','asc');
                $product_image = $this->common_model->get_data_row(['variant_id' => $row->variant_id], 'product_images')->image;
                $row->product_image = base_url('uploads/products/') . $product_image;
                $row->vendor = $this->common_model->get_data_row(['id' => $row->product->shop_id], 'vendor_shop');
                $row->stock_left = (int) $row->variant->stock - (int) $row->quantity;
                $attribute = (json_decode($row->variant->jsondata))[0];
                $row->attr_title = $this->common_model->get_data_row(['id' => $attribute->attribute_type], 'attributes_title')->title;
                $row->attr_value = $this->common_model->get_data_row(['id' => $attribute->attribute_value], 'attributes_values')->value;

                //check stock limit set
                $stock_limit = $this->data['site']->stock_limit;
                if ($row->stock_left <= $stock_limit) {
                    $subject = 'Stock Deducted';
                    $message = 'Dear Vendor,<br>';
                    $message .= 'Find out the stock details for your product ID: #' . $row->product->id . '<br>';
                    $message .= '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: auto;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(' . base_url('web_assets/img/') . 'dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 87px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.9em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
                ;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
            </div>
            <h1>Stock Notification</h1>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Product</th>
                        <th class="desc">Product Name</th>
                        <th class="desc">Total Stock</th>
                        <th class="desc">Stock Deducted</th>
                        <th class="desc">Final Stock</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                            <td class="service">1</td>
                            <td class="service"><img src ="' . $row->product_image . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                            ' . $row->product->name . '<br>
                                [' . ucfirst($row->attr_title) . ': ' . $row->attr_value . ']
                            </td>
                            <td class="desc">' . $row->variant->stock . '</td>
                            <td class="desc">' . $row->quantity . '</td>
                            <td class="desc">' . $row->stock_left . '</td>

                        </tr>
                </tbody>
            </table>
        </main>
    </body>
</html>';

                    $config1['protocol'] = MAIL_PROTOCOL;
                    $config1['smtp_host'] = MAIL_SMTP_HOST;
                    $config1['smtp_port'] = MAIL_SMTP_PORT;
                    $config1['smtp_timeout'] = '7';
                    $config1['smtp_user'] = MAIL_SMTP_USER;
                    $config1['smtp_pass'] = MAIL_SMTP_PASS;
                    $config1['charset'] = MAIL_CHARSET;
                    $config1['newline'] = "\r\n";
                    $config1['mailtype'] = 'html'; // or html
                    $config1['validation'] = TRUE; // bool whether to validate email or not      

                    $this->email->initialize($config1);

                    $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                    $this->email->to($vendor_mail);
                    $this->email->subject($subject);
                    $this->email->message($message);

                    $this->email->send();
                    $this->email->clear();
                }
                $total = $link_variants->stock - $cart_value->quantity;

                $ar = array('varient_id' => $cart_value->variant_id, 'product_id' => $link_variants->product_id, 'quantity' => $cart_value->quantity, 'paid_status' => 'Debit', 'message' => 'New Order', 'total_stock' => $total, 'created_at' => time());

                $ins11 = $this->db->insert("stock_management", $ar);

                if ($ins11) {
                    $this->db->update("link_variant", array('stock' => $total), array('id' => $cart_value->variant_id));
                }
            }
            $vendor = ($unitprice - $admin_total) + $delivery_boy_amount + $gst_amount;

            $coupon_qry = $this->db->query("select * from coupon_codes where id='" . $coupon_id . "'");
            $coupon_row = $coupon_qry->row();
            if ($coupon_qry->num_rows() > 0) {
                if ($coupon_row->shop_id == 0) {
                    $admin_total1 = $admin_total - $coupon_disount;
                    $vendor1 = $vendor;
                } else {
                    $vendor1 = $vendor - $coupon_disount;
                    $admin_total1 = $admin_total;
                }
            } else {
                $admin_total1 = $admin_total;
                $vendor1 = $vendor;
            }

            $date = date("Y-m-d");

            $total_price = $unitprice + $gst_amount + $delivery_boy_amount;
            $ar = array('session_id' => $session_id, 'user_id' => $user_id, 'vendor_id' => $value->vendor_id, 'deliveryaddress_id' => $deliveryaddress_id, 'user_address' => $user_address, 'payment_option' => $payment_option, 'order_status' => $order_status, 'deliveryboy_commission' => $delivery_boy_amount, 'created_at' => $created_at, 'sub_total' => $unitprice, 'total_price' => $total_price, 'admin_commission' => $admin_total1, 'vendor_commission' => $vendor1, 'coupon_code' => $coupon_code, 'coupon_id' => $coupon_id, 'coupon_disount' => $coupon_disount, 'gst' => $gst_amount, 'order_date' => $date);
            $chk_failed_order = $this->db->where(['session_id' => $session_id, 'vendor_id' => $value->vendor_id])->get('orders')->num_rows();
            if ($chk_failed_order > 0) {
                $this->db->where(['session_id' => $session_id, 'vendor_id' => $value->vendor_id])->delete('orders');
            }
            $this->db->insert("orders", $ar);
            // echo $this->db->last_query(); die;

            $order_message = "Dear vendor new order no." . $session_id . " is in your dashboard. Please accept it for confirmation.";
            $vendor_shop_qry = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");
            $vendor_shop_row = $vendor_shop_qry->row();
            $vendor_phone = $vendor_shop_row->mobile;
            //$this->send_message($order_message,$vendor_phone);

            /* $this->db->insert("sms_notifications",array('order_id'=>$session_id,'receiver_id'=>$value->vendor_id,'sender_id'=>$user_id,'created_at'=>time(),'message'=>$order_message)); */
        }

        $order_message = "Order Placed";
        $this->db->insert("sms_notifications", array('order_id' => $session_id, 'receiver_id' => $user_id, 'sender_id' => $value->vendor_id, 'created_at' => time(), 'message' => $order_message, 'order_status' => $order_message, 'status' => 'order_placed'));

        //return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$session_id);
        $sess_arr = array(
            'session_id' => $session_id,
            'session_status' => false
        );
        $this->session->unset_userdata('session_data', $sess_arr);

        $order_arr = ['status' => '@success', 'session_id' => $session_id];
        return $order_arr;
        exit;
    }

    function doOrderCOD($session_id, $user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $coupon_id, $coupon_code, $coupon_disount, $gst, $shipping_charge) {

        $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "' group by vendor_id");

        $result = $qry->result();

        $ar = [];

        $unitprice = 0;

        $admin_total = 0;

        $vendor_quanity_arr = [];

        foreach ($result as $value) {

            $link = $this->db->query("select * from  link_variant where id='" . $value->variant_id . "'");

            $link_variants = $link->row();

            $stock = $link_variants->stock;

            $cart_qry = $value->quantity;

            if ($stock < $cart_qry) {

                $msg = "OUT OF STOCK";

                echo '@noprod@' . $msg;
                die;

                //return array('status' =>FALSE,'message'=>$msg);
            }


            $pro = $this->db->query("select * from  products where id='" . $link_variants->product_id . "' and delete_status=0");

            $product = $pro->row();

            $adm = $this->db->query("select * from  admin_comissions where shop_id='" . $vendor_id . "' and cat_id='" . $product->cat_id . "' and find_in_set('" . $product->sub_cat_id . "',subcategory_ids)");

            $admin = $adm->row();

            $admin_price = ($admin->admin_comission / 100) * $value->price;

            $ar[] = array('id' => $value->id, 'price' => $value->price, 'quantity' => $value->quantity, 'unit_price' => $value->unit_price, 'image' => $img);

            $unitprice = $value->unit_price + $unitprice;

            $admin_total = $admin_price + $admin_total;

            array_push($vendor_quanity_arr, ['variant_id' => $link_variants->id, 'quantity' => $value->quantity]);

            $total = $link_variants->stock - $value->quantity;

            $ar = array('varient_id' => $value->variant_id, 'product_id' => $link_variants->product_id, 'quantity' => $value->quantity, 'paid_status' => 'Debit', 'message' => 'New Order', 'total_stock' => $total, 'created_at' => time());

            $ins11 = $this->db->insert("stock_management", $ar);

            if ($ins11) {

                $qty = $link_variants->stock - $value->quantity;

                $this->db->update("link_variant", array('stock' => $qty), array('id' => $value->variant_id));
            }
        }

        $stockObj = json_decode(json_encode($vendor_quanity_arr));

        //send notification to vendor regarding stock reduce
        foreach ($stockObj as $row) {
            $row->variant = $this->common_model->get_data_row(['id' => $row->variant_id], 'link_variant');
            $row->product = $this->common_model->get_data_row(['id' => $row->variant->product_id], 'products');
            $this->db->order_by('priority','asc');
            $product_image = $this->common_model->get_data_row(['variant_id' => $row->variant_id], 'product_images')->image;
            $row->product_image = base_url('uploads/products/') . $product_image;
            $row->vendor = $this->common_model->get_data_row(['id' => $row->product->shop_id], 'vendor_shop');
            $row->stock_left = (int) $row->variant->stock - (int) $row->quantity;
            $attribute = (json_decode($row->variant->jsondata))[0];
            $row->attr_title = $this->common_model->get_data_row(['id' => $attribute->attribute_type], 'attributes_title')->title;
            $row->attr_value = $this->common_model->get_data_row(['id' => $attribute->attribute_value], 'attributes_values')->value;

            //check stock limit set
            $stock_limit = $this->data['site']->stock_limit;
            if ($row->stock_left <= $stock_limit) {
                $subject = 'Stock Deducted';
                $message = 'Dear Vendor,<br>';
                $message .= 'Find out the stock details for your product ID: #' . $row->product->id . '<br>';
                $message .= '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: auto;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(' . base_url('web_assets/img/') . 'dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 87px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.9em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
                ;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
            </div>
            <h1>Stock Notification</h1>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Product</th>
                        <th class="desc">Product Name</th>
                        <th class="desc">Total Stock</th>
                        <th class="desc">Stock Deducted</th>
                        <th class="desc">Final Stock</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                            <td class="service">1</td>
                            <td class="service"><img src ="' . $row->product_image . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                            ' . $row->product->name . '<br>
                                [' . ucfirst($row->attr_title) . ': ' . $row->attr_value . ']
                            </td>
                            <td class="desc">' . $row->variant->stock . '</td>
                            <td class="desc">' . $row->quantity . '</td>
                            <td class="desc">' . $row->stock_left . '</td>

                        </tr>
                </tbody>
            </table>
        </main>
    </body>
</html>';

                $config1['protocol'] = MAIL_PROTOCOL;
                $config1['smtp_host'] = MAIL_SMTP_HOST;
                $config1['smtp_port'] = MAIL_SMTP_PORT;
                $config1['smtp_timeout'] = '7';
                $config1['smtp_user'] = MAIL_SMTP_USER;
                $config1['smtp_pass'] = MAIL_SMTP_PASS;
                $config1['charset'] = MAIL_CHARSET;
                $config1['newline'] = "\r\n";
                $config1['mailtype'] = 'html'; // or html
                $config1['validation'] = TRUE; // bool whether to validate email or not      

                $this->email->initialize($config1);

                $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                $this->email->to($row->vendor->email);
                $this->email->subject($subject);
                $this->email->message($message);

                $this->email->send();
                $this->email->clear();
            }
        }

        $vendor = $unitprice - $admin_total;

        $coupon_qry = $this->db->query("select * from coupon_codes where id='" . $coupon_id . "'");

        $coupon_row = $coupon_qry->row();

        if ($coupon_qry->num_rows() > 0) {

            if ($coupon_row->shop_id == 0) {

                $admin_total1 = $admin_total - $coupon_disount;

                $vendor1 = $vendor;
            } else {

                $vendor1 = $vendor - $coupon_disount;

                $admin_total1 = $admin_total;
            }
        } else {

            $admin_total1 = $admin_total;

            $vendor1 = $vendor;
        }



        $vendor_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");

        $vendor_row = $vendor_qry->row();

//        $vendorshop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_row->vendor_id . "'");
//
//        $vendorshop_row = $vendorshop_qry->row();

        $delivery_amount = $shipping_charge;

        $delivery_ad_qry = $this->db->query("select * from user_address where id='" . $deliveryaddress_id . "'");

        $delivery_ad_row = $delivery_ad_qry->row();

        $state_qry = $this->db->query("select * from states where id='" . $delivery_ad_row->state . "'");

        $state_qry_row = $state_qry->row();

        $cities_qry = $this->db->query("select * from cities where id='" . $delivery_ad_row->city . "'");

        $cities_qry_row = $cities_qry->row();

        $pincode_qry = $this->db->query("select * from pincodes where id='" . $delivery_ad_row->pincode . "'");

        $pincode_qry_row = $pincode_qry->row();

        if ($delivery_ad_row->address_type == 1) {

            $add_type = "Home";
        } else if ($delivery_ad_row->address_type == 1) {

            $add_type = "Office";
        }

        $user_address = $add_type . ": " . $delivery_ad_row->name . ", " . $state_qry_row->state_name . ", " . $delivery_ad_row->city . ", " . $pincode_qry_row->pincode . ", " . $delivery_ad_row->address . ", " . $delivery_ad_row->landmark;

        $shop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_row->vendor_id . "'");

        $shop_num = $shop_qry->row();

        if ($shop_num->status == 0) {

            $msg = "Shop Closed";

            echo '@shopclosed';
            exit;
        }

        $ar = array('session_id' => $session_id, 'user_id' => $user_id, 'vendor_id' => $vendor_row->vendor_id, 'deliveryaddress_id' => $deliveryaddress_id, 'user_address' => $user_address, 'payment_option' => $payment_option, 'order_status' => $order_status, 'deliveryboy_commission' => $delivery_amount, 'created_at' => $created_at, 'sub_total' => $unitprice, 'total_price' => $grand_total, 'admin_commission' => $admin_total1, 'vendor_commission' => $vendor1, 'coupon_code' => $coupon_code, 'coupon_id' => $coupon_id, 'coupon_disount' => $coupon_disount, 'gst' => $gst);

        //,'gst'=>$gst



        $ins = $this->db->insert("orders", $ar);

        //echo $this->db->last_query(); die;

        if ($ins) {



            $sess_arr = array(
                'session_id' => $session_id,
                'vendor_id' => $vendor_row->vendor_id,
                'session_status' => false
            );

            $this->session->unset_userdata('session_data', $sess_arr);

            $last_id = $this->db->insert_id();

            $title = "New Order From Dhukanam";

            $message = "You Have new Order";

            $this->onesignalnotification($vendor_row->vendor_id, $title, $message);

            $msg = "New Order Created ";

            $vendor_shop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_row->vendor_id . "'");

            $vendor_shop_row = $vendor_shop_qry->row();

            $vendor_phone = $vendor_shop_row->mobile;

            $order_message = "Dear vendor new order no." . $last_id . " is in your dashboard. Please accept it for confirmation.";

            $vendortemplat_id = '1407161900279488583';

            /* if($this->send_message($order_message,$vendor_phone,$vendortemplat_id))

              { */

            $this->db->insert("sms_notifications", array('order_id' => $last_id, 'receiver_id' => $vendor_row->vendor_id, 'sender_id' => $user_id, 'created_at' => time(), 'message' => $order_message));

            /* } */

            $user_sms_qry = $this->db->query("select * from users where id='" . $user_id . "'");

            $user_sms_row = $user_sms_qry->row();

            $user_phone = $user_sms_row->phone;

            $user_name = $user_sms_row->first_name . " " . $user_sms_row->last_name;

            $templat_id_user = '1407161900222278373';

            $user_order_message = "Dear " . $user_name . " your order no." . $last_id . " is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.";

            /* if($this->send_message($user_order_message,$user_phone,$templat_id_user))

              { */

            $this->db->insert("sms_notifications", array('order_id' => $last_id, 'receiver_id' => $user_id, 'sender_id' => $vendor_row->vendor_id, 'created_at' => time(), 'message' => $user_order_message));

            //}
            //return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$last_id);
            $order_arr = ['status' => '@success', 'order_id' => $last_id];
            return $order_arr;
        } else {

            echo '@error';
            exit;
        }
    }

    function doBidOrderCOD($user_id, $deliveryaddress_id, $payment_option, $created_at, $order_status, $grand_total, $coupon_id, $coupon_code, $coupon_disount, $bid_id, $vendor_id) {





        // $qry = $this->db->query("select * from cart where session_id='".$session_id."' and user_id='".$user_id."'");

        $qry = $this->mybidDetails($user_id, $bid)['products'];

        $result = $qry;

        $ar = [];

        $unitprice = 0;

        $admin_total = 0;

        foreach ($result as $value) {





            $link = $this->db->query("select * from  link_variant where id='" . $value['variant_id'] . "'");

            $link_variants = $link->row();

            $pro = $this->db->query("select * from  products where id='" . $link_variants->product_id . "' and delete_status=0");

            $product = $pro->row();

            $adm = $this->db->query("select * from  admin_comissions where shop_id='" . $value['vendor_id'] . "' and cat_id='" . $product->cat_id . "' and find_in_set('" . $product->sub_cat_id . "',subcategory_ids)");

            $admin = $adm->row();

            $admin_price = ($admin->admin_comission / 100) * $value['price'];

            $ar[] = array('id' => $value['id'], 'price' => $value['price'], 'quantity' => $value['quantity'], 'unit_price' => $value['unit_price'], 'image' => ['img']);

            $unitprice = $value['unit_price'] + $unitprice;

            $admin_total = $admin_price + $admin_total;

            $total = $link_variants->stock - $value['quantity'];

            $ar = array('varient_id' => $value['variant_id'], 'product_id' => $link_variants->product_id, 'quantity' => $value['quantity'], 'paid_status' => 'Debit', 'message' => 'New Order', 'total_stock' => $total, 'created_at' => time());

            $ins11 = $this->db->insert("stock_management", $ar);

            /* if($ins11)

              {

              $qty = $link_variants->stock-$value->quantity;

              $this->db->update("link_variant",array('stock'=>$qty),array('id'=>$value['variant_id']));

              } */
        }













        $vendor = $unitprice - $admin_total;

        $coupon_qry = $this->db->query("select * from coupon_codes where id='" . $coupon_id . "'");

        $coupon_row = $coupon_qry->row();

        if ($coupon_qry->num_rows() > 0) {

            if ($coupon_row->shop_id == 0) {

                $admin_total1 = $admin_total - $coupon_disount;

                $vendor1 = $vendor;
            } else {

                $vendor1 = $vendor - $coupon_disount;

                $admin_total1 = $admin_total;
            }
        } else {

            $admin_total1 = $admin_total;

            $vendor1 = $vendor;
        }



        $vendor_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");

        $vendor_row = $vendor_qry->row();

        $vendorshop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_id . "'");

        $vendorshop_row = $vendorshop_qry->row();

        $delivery_amount = $vendorshop_row->min_order_amount;

        $delivery_ad_qry = $this->db->query("select * from user_address where id='" . $deliveryaddress_id . "'");

        $delivery_ad_row = $delivery_ad_qry->row();

        $state_qry = $this->db->query("select * from states where id='" . $delivery_ad_row->state . "'");

        $state_qry_row = $state_qry->row();

        $cities_qry = $this->db->query("select * from cities where id='" . $delivery_ad_row->city . "'");

        $cities_qry_row = $cities_qry->row();

        $pincode_qry = $this->db->query("select * from pincodes where id='" . $delivery_ad_row->pincode . "'");

        $pincode_qry_row = $pincode_qry->row();

        if ($delivery_ad_row->address_type == 1) {

            $add_type = "Home";
        } else if ($delivery_ad_row->address_type == 1) {

            $add_type = "Office";
        }

        $user_address = $add_type . ": " . $delivery_ad_row->name . ", " . $state_qry_row->state_name . ", " . $delivery_ad_row->city . ", " . $pincode_qry_row->pincode . ", " . $delivery_ad_row->address . ", " . $delivery_ad_row->landmark;

        $shop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_id . "'");

        $shop_num = $shop_qry->row();

        if ($shop_num->status == 0) {

            $msg = "Shop Closed";

            echo '@shopclosed';
            exit;
        }



        $bid_qry = $this->db->query("select * from user_bids where id='" . $bid_id . "'");

        $bid_row = $bid_qry->row();

        $session_id = $bid_row->session_id;

        $ar = array('session_id' => $session_id, 'user_id' => $user_id, 'vendor_id' => $vendor_id, 'deliveryaddress_id' => $deliveryaddress_id, 'user_address' => $user_address, 'payment_option' => $payment_option, 'order_status' => $order_status, 'deliveryboy_commission' => $delivery_amount, 'created_at' => $created_at, 'sub_total' => $unitprice, 'total_price' => $grand_total, 'admin_commission' => $admin_total1, 'vendor_commission' => $vendor1, 'coupon_code' => $coupon_code, 'coupon_id' => $coupon_id, 'coupon_disount' => $coupon_disount, "bid_id" => $bid_id);

        //,'gst'=>$gst



        $ins = $this->db->insert("orders", $ar);

        //echo $this->db->last_query(); die;

        if ($ins) {



            $this->db->update("user_bids", array('bid_status' => 2), array('id' => $bid_id));

            // echo $this->db->last_query(); die;

            $sess_arr = array(
                'session_id' => $session_id,
                'vendor_id' => $vendor_row->vendor_id,
                'session_status' => false
            );

            $this->session->unset_userdata('session_data', $sess_arr);

            $last_id = $this->db->insert_id();

            $title = "New Order From Dhukanam";

            $message = "You Have new Order";

            $this->onesignalnotification($vendor_row->vendor_id, $title, $message);

            $msg = "New Order Created ";

            $vendor_shop_qry = $this->db->query("select * from vendor_shop where id='" . $vendor_row->vendor_id . "'");

            $vendor_shop_row = $vendor_shop_qry->row();

            $vendor_phone = $vendor_shop_row->mobile;

            $order_message = "Dear vendor new order no." . $last_id . " is in your dashboard. Please accept it for confirmation.";

            $vendortemplat_id = '1407161900279488583';

            /* if($this->send_message($order_message,$vendor_phone,$vendortemplat_id))

              { */

            $this->db->insert("sms_notifications", array('order_id' => $last_id, 'receiver_id' => $vendor_row->vendor_id, 'sender_id' => $user_id, 'created_at' => time(), 'message' => $order_message));

            /* } */







            $user_sms_qry = $this->db->query("select * from users where id='" . $user_id . "'");

            $user_sms_row = $user_sms_qry->row();

            $user_phone = $user_sms_row->phone;

            $user_name = $user_sms_row->first_name . " " . $user_sms_row->last_name;

            $templat_id_user = '1407161900222278373';

            $user_order_message = "Dear " . $user_name . " your order no." . $last_id . " is successfully placed, awaiting for vendors confirmation. Thank u for shopping with us.";

            /* if($this->send_message($user_order_message,$user_phone,$templat_id_user))

              { */

            $this->db->insert("sms_notifications", array('order_id' => $last_id, 'receiver_id' => $user_id, 'sender_id' => $vendor_row->vendor_id, 'created_at' => time(), 'message' => $user_order_message));

            //}
            //return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$last_id);

            echo '@success';
            exit;
        } else {

            echo '@error';
            exit;
        }
    }

    function becomeVendor($data) {

        $ins = $this->db->insert("become_a_vendor", $data);

        if ($ins) {

            //$ar = array('status' =>TRUE,'message'=>"Vendor Added Successfully");

            echo '@success';
            die;
        } else {

            //$ar = array('status' =>FALSE,'message'=>"Something went Wrong");

            echo '@error';
            die;
        }
    }

    function add_most_viewed_removewhishList($variant_id, $user_id) {

        $qry = $this->db->query("select * from whish_list where variant_id='" . $variant_id . "' and user_id='" . $user_id . "'");

        if ($qry->num_rows() > 0) {

            $upd = $this->db->delete("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id));

            if ($upd) {

                echo '@remove';
                die;
            }
        } else {





            $ins = $this->db->insert("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id));

            if ($ins) {

                echo '@add';
                die;
            }
        }
    }

    function addRemoveTopdealWhishList($variant_id, $user_id) {
        $session_id = $_SESSION['session_data']['session_id'];
        $qry = $this->db->query("select * from whish_list where variant_id='" . $variant_id . "' and user_id='" . $user_id . "'");

        if ($qry->num_rows() > 0) {

            $upd = $this->db->delete("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id));

            if ($upd) {

                echo '@remove';
                die;
            }
        } else {

            $ins = $this->db->insert("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id, 'created_date' => time()));

            if ($ins) {
                //remove that variant from cart if exists
                // $this->db->where(['session_id' => $session_id, 'user_id' => $user_id, 'variant_id' => $variant_id])->delete('cart');
                echo '@add';
                die;
            }
        }
    }

    function moveToWishlist($variant_id, $user_id){

        $session_id = $_SESSION['session_data']['session_id'];
        $qry = $this->db->query("select * from whish_list where variant_id='" . $variant_id . "' and user_id='" . $user_id . "'");

        if ($qry->num_rows() > 0) {

            $upd = $this->db->delete("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id));

            if ($upd) {

                echo '@remove';
                die;
            }
        } else {
            
            $ins = $this->db->insert("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id, 'created_date' => time()));
            
            if ($ins) {

                //remove that variant from cart if exists
                $this->db->where(['session_id' => $session_id, 'user_id' => $user_id, 'variant_id' => $variant_id])->delete('cart');
                echo '@add';
                die;
            }
        }
    }

    function addedWhistlisthtmldata() {





        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT most_viewed_products.product_id,count(most_viewed_products.id) as cnt,products.*,vendor_shop.id as vendor_id,vendor_shop.shop_name FROM most_viewed_products INNER JOIN products ON products.id =most_viewed_products.product_id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id WHERE products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' and vendor_shop.status=1 GROUP by most_viewed_products.product_id order by most_viewed_products.id DESC LIMIT 10");
        //having distance<'".$search_distance."'
        $dat = $qry->result();

        $ar = [];

        foreach ($dat as $value) {





            $qry1 = $this->db->query("SELECT * FROM `link_variant` where saleprice!='0' and status=1 and product_id='" . $value->id . "'");

            $value12 = $qry1->row();

            $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' order by priority asc");

            $images = $im->row();

            if ($images->image != '') {

                $img = base_url() . "uploads/products/" . $images->image;
            } else {

                $img = base_url() . "uploads/noproduct.png";
            }





            $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

            $category = $cat->row();

            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

            $subcategory = $subcat->row();

            $state_id = $row->state_id;

            $city_id = $row->address_id;

            $pincode_id = $row->pincode_id;

            if ($value->status == 1) {

                $shopstat = "Open";
            } else {

                $shopstat = "Closed";
            }





            $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

            if ($wish->num_rows() > 0) {

                $stat = true;
            } else {

                $stat = false;
            }

            if ($value12->saleprice != '') {

                $slaeprice = $value12->saleprice;
            } else {

                $slaeprice = 0;
            }



            if ($value12->price != '') {

                $price = $value12->price;
            } else {

                $price = 0;
            }



            $name = $value->name;

            /* $ar[]=array('id'=>$value->id,'variant_id'=>$value12->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$value->shop_name,'price'=>$price,'saleprice'=>$slaeprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat,'shop_status'=>$shopstat,'distance'=>round($value->distance),'seo_url'=>$value->seo_url); */











            $output .= '<div class="col-lg-3">

                        <article class="single_product">

                              <span id="favorites<?php echo $value->id; ?>"></span>

                                <figure>

                                    <div class="product_thumb">

                                        <a class="primary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value->seo_url; ?>"><img src="<?php echo $value->image; ?>" alt=""></a>

                                        <a class="secondary_img" href="<?php echo base_url(); ?>web/product_view/<?php echo $value->seo_url; ?>"><img src="<?php echo $value->image; ?>" alt=""></a>

                                        <div class="label_product">

                                            <span class="label_sale">Sale</span>

                                        </div>

                                        <div class="action_links">

                                            <ul>

                                                <li class="quick_button"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $value->seo_url; ?>" title="View Details"> <span class="pe-7s-search"></span></a></li>

                                                <li class="wishlist" onclick="addFavorite(<?php echo $value->id; ?>)"><a href="" title="Add to Wishlist" <?php if($value->whishlist_status==true){ ?>class="fav"<?php } ?>><span class="pe-7s-like"></span></a></li>

                                            </ul>

                                        </div>

                                    </div>

                                    <figcaption class="product_content">

                                        <div class="product_content_inner">

                                            <h4 class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $value->seo_url; ?>"><?php echo $value->name; ?></a></h4>

                                            <div class="price_box">

                                                <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $value->saleprice; ?></span>





                                            </div>

                                        </div>

                                        <div class="add_to_cart">

                                            <a onclick="addtocart(<?php echo $value->variant_id; ?>,<?php echo $value->shop_id; ?>,"<?php echo $value->saleprice; ?>",1)" ><i class="fal fa-shopping-cart fa-lg"></i> Add to cart</a>

                                        </div>

                                    </figcaption>

                                </figure>

                        </article>

                   </div>';
        }



        print_r($output);
        die;
    }

    function removewhishList($variant_id, $user_id) {

        $upd = $this->db->delete("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id));

        if ($upd) {

            return TRUE;
        }
    }

    function getBannerads($user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $users = $this->db->query("select * from users where id='" . $user_id . "'");

            $users_row = $users->row();

            $address = $users_row->address_id;

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        }







        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $shop_qry = $this->db->query("SELECT id, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop");
        //having distance<'".$search_distance."'
        $shops = $shop_qry->result();

        $shop_ids = array_column($shops, 'id');

        $imp = implode(",", $shop_ids);

        $qry = $this->db->query("select * from banners WHERE status = 1 and position=2  order by priority asc LIMIT 3");

        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {





                if ($value->web_image != '') {

                    $img = base_url() . "uploads/banners/" . $value->web_image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }



                if ($value->type == 'products') {

                    $prod_qry = $this->db->query("select * from products where id='" . $value->product_id . "' and delete_status=0");

                    $dat1 = $prod_qry->row();

                    $title = $dat1->name;

                    $shop_id = $dat1->shop_id;

                    $product_details = array('product_title' => $title, 'product_id' => $dat1->id, 'shop_id' => $shop_id, 'seo_url' => $dat1->seo_url);
                } else {

                    $prod_qry = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

                    $dat1 = $prod_qry->row();

                    $adm_qry = $this->db->query("select * from admin_comissions where shop_id='" . $value->shop_id . "' order by id desc");

                    $adm_row = $adm_qry->row();

                    $product_details = array('shop_name' => $dat1->shop_name, 'cat_id' => $adm_row->cat_id, 'shop_id' => $value->shop_id, 'seo_url' => $dat1->seo_url);
                }



                $ar[] = array('id' => $value->id, 'random_number' => $value->random_number, 'title' => $value->title, 'image' => $img, 'type' => $value->type, 'product_details' => $product_details, 'flat_discount' => $value->flat_discount);
            }
        } else {

            $ar = array();
        }





        return $ar;
    }

    function getLastBannerads($user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $users = $this->db->query("select * from users where id='" . $user_id . "'");

            $users_row = $users->row();

            $address = $users_row->address_id;

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        }



        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $shop_qry = $this->db->query("SELECT id, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop");
        //having distance<'".$search_distance."'
        $shops = $shop_qry->result();

        $shop_ids = array_column($shops, 'id');

        $imp = implode(",", $shop_ids);

        $qry = $this->db->query("select * from banners WHERE status=1 and position=3 order by priority asc LIMIT 3");

        $lastbanner = $qry->result();
        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($lastbanner as $value) {

                if ($value->web_image != '') {

                    $img = base_url() . "uploads/banners/" . $value->web_image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }



                if ($value->type == 'products') {

                    $prod_qry = $this->db->query("select * from products where id='" . $value->product_id . "' and delete_status=0");

                    $dat1 = $prod_qry->row();

                    $title = $dat1->name;

                    $shop_id = $dat1->shop_id;

                    $product_details = array('product_title' => $title, 'product_id' => $dat1->id, 'shop_id' => $shop_id, 'seo_url' => $dat1->seo_url);
                } else {

                    $prod_qry = $this->db->query("select * from vendor_shop where id='" . $value->shop_id . "'");

                    $dat1 = $prod_qry->row();

                    $adm_qry = $this->db->query("select * from admin_comissions where shop_id='" . $value->shop_id . "' order by id desc");

                    $adm_row = $adm_qry->row();

                    $product_details = array('shop_name' => $dat1->shop_name, 'cat_id' => $adm_row->cat_id, 'shop_id' => $value->shop_id, 'seo_url' => $dat1->seo_url);
                }



                $ar[] = array('id' => $value->id, 'random_number' => $value->random_number, 'title' => $value->title, 'image' => $img, 'type' => $value->type, 'product_details' => $product_details, 'flat_discount' => $value->flat_discount);
            }
        } else {

            $ar = array();
        }
        return $ar;
    }

    function fetchProducts($keyword, $user_id) {

//        if ($user_id == 'guest') {
//
//            $guest_id = $_SESSION['userdata']['guest_user_id'];
//
//            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");
//
//            $users_row = $users->row();
//
//            $lat = $users_row->lat;
//
//            $lng = $users_row->lng;
//        } else {
//
//            $users = $this->db->query("select * from users where id='" . $user_id . "'");
//
//            $users_row = $users->row();
//
//            $address = $users_row->address_id;
//
//            $lat = $users_row->lat;
//
//            $lng = $users_row->lng;
//        }
//
//        $admin = $this->db->query("select * from admin where id=1");
//
//        $search_distance = $admin->row()->distance;
//
//        $qry = $this->db->query("SELECT vendor_shop.shop_name,link_variant.id as variant_id,products.*, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and  products.name LIKE '%" . $keyword . "%' and vendor_shop.status=1 and products.status=1 and products.delete_status=0 group by link_variant.product_id order by products.id ASC LIMIT 6");
//        //having distance<".$search_distance."
//        $dat = $qry->result();
//
//        $ar1 = [];
//
//        foreach ($dat as $value) {
//
//            $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "'");
//
//            $images = $im->row();
//
//            if ($images->image != '') {
//
//                $img = base_url() . "uploads/products/" . $images->image;
//            } else {
//
//                $img = base_url() . "uploads/noproduct.png";
//            }
//
//
//            $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");
//
//            $category = $cat->row();
//
//            /* $ar1[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'title'=>$value->name,'image'=>$img,'cat_id'=>$value->cat_id); */
//
//            if ($category->status == 1) {
//
//                $output .= '<li><a href="' . base_url() . 'web/product_view/' . $value->seo_url . '">' . $value->name . '</a></li>';
//            }
//        }
//        $row = $this->db->query("select * from vendor_shop where shop_name LIKE '%" . $keyword . "%' order by id desc LIMIT 6");
//
//        $dat = $row->result();
//
//        $ar2 = [];
//
//        foreach ($dat as $value) {
//
//
//
//            if ($value->shop_logo != '') {
//
//                $img = base_url() . "uploads/shops/" . $value->shop_logo;
//            } else {
//
//                $img = base_url() . "uploads/noproduct.png";
//            }
//
//
//
//
//
//            $admin = $this->db->query("select * from admin where id=1");
//
//            $admin_row = $admin->row();
//
//            $pro = $this->db->query("select * from products where shop_id='" . $value->id . "' and delete_status=0");
//
//            $prod_row = $pro->row();
//
//            if ($pro->num_rows() > 0) {
//
//                if ($value->status == 1) {
//
//                    $stat = "Open";
//                } else {
//
//                    $stat = "Closed";
//                }
//
//                /* $ar2[]=array('id'=>$value->id,'shop_name'=>$value->shop_name,'description'=>$value->description,'image'=>$img,'status'=>$stat,'cat_id'=>$prod_row->cat_id); */
//
//
//
//                $output .= '<li><a href="' . base_url() . 'web/store/' . $value->seo_url . '/shop">' . $value->shop_name . '</a></li>';
//            }
//        }
        //search products by name & brand & category & subcategory
        // $this->db->where(['status' => 1, 'availabile_stock_status' => 'available']);
        // $this->db->like('name', $keyword);
        // $prod = $this->db->get('products')->row()->id;
        $this->db->where(['status' => 1, 'availabile_stock_status' => 'available']);
        $this->db->like('LOWER(REPLACE(name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        $prod = $this->db->get('products')->row()->id;
        // $this->db->like('brand_name', $keyword);
        // $brand = $this->db->get('attr_brands')->row()->id;
        $this->db->like('LOWER(REPLACE(brand_name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        $brand = $this->db->get('attr_brands')->row()->id;

        $this->db->like('LOWER(REPLACE(descp, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        $descp = $this->db->get('products')->row()->id;

        // $this->db->where(['status' => 1]);
        // $this->db->like('category_name', $keyword);
        // $cat_id = $this->db->get('categories')->row()->id;
        $this->db->where('status', 1);
$this->db->like('LOWER(REPLACE(category_name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
$category = $this->db->get('categories')->row();
if ($category) {
    $cat_id = $category->id;
} else {
    // Handle case where no matching category is found
    $cat_id = null;
}

        // $this->db->where(['status' => 1]);
        // $this->db->like('sub_category_name', $keyword);
        // $sub_cat_id = $this->db->get('sub_categories')->row()->id;

        $this->db->where(['status' => 1]);
        $this->db->like('LOWER(REPLACE(sub_category_name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        $sub_cat_id = $this->db->get('sub_categories')->row()->id;
        
        // $this->db->like('options', $keyword);
        // $filter_option_id = $this->db->get('filter_options')->row()->id;
        $this->db->like('LOWER(REPLACE(options, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        $filter_option_id = $this->db->get('filter_options')->row()->id;

        // $this->db->like('option', $keyword);
        // $quest_option_id = $this->db->get('options')->row()->id;

        // $this->db->like('LOWER(REPLACE(option, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        // $quest_option_id = $this->db->get('options')->row()->id;
        $this->db->select('*');
        $this->db->where("LOWER(REPLACE(`option`, ' ', '')) LIKE '%" . strtolower(str_replace(' ', '', $keyword)) . "%'", NULL, FALSE);
        $quest_option = $this->db->get('options')->row();
        if ($quest_option) {
            $quest_option_id = $quest_option->id;
        } else {
            $quest_option_id = null; // or handle the case when no result is found
        }
        
        // $this->db->like('title', $keyword);
        // $tag_id = $this->db->get('tags')->row()->id;

        $this->db->like('LOWER(REPLACE(title, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        $tag_id = $this->db->get('tags')->row()->id;
        
        // $this->db->like('meta_tag_keywords', $keyword);
        // $meta_keywords = $this->db->get('products')->num_rows();
        $this->db->like('LOWER(REPLACE(meta_tag_keywords, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
        $meta_keywords = $this->db->get('products')->num_rows();


        // if ($prod > 0) {
        //     $this->db->like('name', $keyword);
        //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        // } else if ($brand > 0) {
        //     $this->db->where('brand', $brand);
        //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        // } else if ($cat_id > 0) {
        //     $this->db->where('cat_id', $cat_id);
        //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        // } else if ($sub_cat_id > 0) {
        //     $this->db->where('sub_cat_id', $sub_cat_id);
        //     $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        // } else if ($filter_option_id > 0) {
        //         $products_get = [];
        //         $products_getto = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        //         foreach ($products_getto as $getto) {
        //             $this->db->where("(FIND_IN_SET($filter_option_id, filter_options))");
        //             $this->db->where("product_id",$getto->id);
        //             $chk = $this->db->get('product_filter')->num_rows();
        //             if ($chk > 0) {
        //                 array_push($products_get, $getto);
        //             }
        //         }
        //     } else if ($quest_option_id > 0) {
        //         $this->db->where("(FIND_IN_SET($quest_option_id, option_id))");
        //         $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        //     } else if ($tag_id > 0) {
        //         $this->db->where("(FIND_IN_SET($tag_id, product_tags))");
        //         $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        //     } else if ($meta_keywords > 0) {
        //         $this->db->like('meta_tag_keywords', $keyword);
        //         $products_get = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        //     }

         $products_get = [];

            if ($prod > 0) {
                // $this->db->like('name', $keyword);
                $this->db->like('LOWER(REPLACE(name, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
                $products_get2 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get2);
            } if ($brand > 0) {
                $this->db->where('brand', $brand);
                $products_get3 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                array_push($products_get, $products_get3);
            } if ($cat_id > 0) {
                $this->db->where('cat_id', $cat_id);
                $products_get4 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get4);
            } if ($sub_cat_id > 0) {
                $this->db->where('sub_cat_id', $sub_cat_id);
                $products_get5 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                  array_push($products_get, $products_get5);
            } if ($filter_option_id > 0) {
                $products_get1 = [];
                $products_getto = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                foreach ($products_getto as $getto) {
                    $this->db->where("(FIND_IN_SET($filter_option_id, filter_options))");
                    $this->db->where("product_id", $getto->id);
                    $chk = $this->db->get('product_filter')->num_rows();
                    if ($chk > 0) {
                        array_push($products_get, $getto);
                    }
                    array_push($products_get, $products_get1);
                }
               

            } if ($quest_option_id > 0) {
                $this->db->where("(FIND_IN_SET($quest_option_id, option_id))");
                $products_get6 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get6);
            } if ($tag_id > 0) {
                $this->db->where("(FIND_IN_SET($tag_id, product_tags))");
                $products_get7 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get7);
            } if ($meta_keywords > 0) {
                // $this->db->like('meta_tag_keywords', $keyword);
                $this->db->like('LOWER(REPLACE(meta_tag_keywords, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
                $products_get8 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get8);
            }
            if($descp>0){
                $this->db->like('LOWER(REPLACE(descp, " ", ""))', strtolower(str_replace(' ', '', $keyword)));
                $products_get9 = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
                 array_push($products_get, $products_get9);
            }


        foreach ($products_get[0] as $product) {
            $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
            $stockArr = $this->common_model->get_data_with_condition(['product_id' => $product->id, 'stock >' => 0, 'status' => 1], 'link_variant');
            $stock = sizeof($stockArr);
            $category_status = $this->common_model->count_rows_with_conditions('categories', ['id' => $product->cat_id, 'status' => 1]);

            if ($chk_shop_status == 1 && $stock > 0 && $category_status > 0) {
                $output .= '<li><a href="' . base_url() . 'web/product_view/' . $product->seo_url . '">' . $product->name . '</a></li>';
            }
        }

        print_r($output);
        die;
    }

    function searchAllProductsandShops($keyword, $user_id) {



        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $users = $this->db->query("select * from users where id='" . $user_id . "'");

            $users_row = $users->row();

            $address = $users_row->address_id;

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        }









        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT vendor_shop.shop_name,link_variant.id as variant_id,link_variant.saleprice,products.*, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.delete_status=0 and  products.name LIKE '%" . $keyword . "%' and vendor_shop.status=1 and products.status=1 group by link_variant.product_id order by products.id ASC");
        //having distance<".$search_distance."
        $dat = $qry->result();

        $ar1 = [];

        foreach ($dat as $value) {

            $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

            $images = $im->row();

            if ($images->image != '') {

                $img = base_url() . "uploads/products/" . $images->image;
            } else {

                $img = base_url() . "uploads/noproduct.png";
            }



            $ar1[] = array('id' => $value->id, 'variant_id' => $value->variant_id, 'shop_id' => $value->shop_id, 'name' => $value->name, 'image' => $img, 'cat_id' => $value->cat_id, 'seo_url' => $value->seo_url, 'shop' => $value->shop_name, 'saleprice' => $value->saleprice, 'distance' => $value->distance);
        }







        $row = $this->db->query("select * from vendor_shop where shop_name LIKE '%" . $keyword . "%' and status=1 order by distance ASC");
        //having distance<".$search_distance."
        $dat = $row->result();

        $ar2 = [];

        foreach ($dat as $value) {



            if ($value->shop_logo != '') {

                $img = base_url() . "uploads/shops/" . $value->shop_logo;
            } else {

                $img = base_url() . "uploads/noproduct.png";
            }





            $admin = $this->db->query("select * from admin where id=1");

            $admin_row = $admin->row();

            $pro = $this->db->query("select * from products where shop_id='" . $value->id . "' and delete_status=0 and status=1");

            $prod_row = $pro->row();

            if ($pro->num_rows() > 0) {

                if ($value->status == 1) {

                    $stat = "Open";
                } else {

                    $stat = "Closed";
                }

                $ar2[] = array('id' => $value->id, 'shop_name' => $value->shop_name, 'description' => $value->description, 'image' => $img, 'status' => $stat, 'cat_id' => $prod_row->cat_id, 'seo_url' => $value->seo_url, 'shop_name' => $value->shop_name, 'distance' => round($value->distance), 'product_total' => $pro->num_rows());
            }
        }

        $shop_total = count($ar1);

        $product_total = count($ar2);

        $search_count = $shop_total + $product_total;

        return array('products' => $ar1, 'shops' => $ar2, 'search_count' => $search_count);
    }

    function fetchstorewisesearchProducts($keyword, $user_id, $shop_id) {



        $users = $this->db->query("select * from users where id='" . $user_id . "'");

        $users_row = $users->row();

        $address = $users_row->address_id;

        $lat = $users_row->lat;

        $lng = $users_row->lng;

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT link_variant.id as variant_id,products.*, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and  products.name LIKE '%" . $keyword . "%' and vendor_shop.status=1 and products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 group by link_variant.product_id order by products.id ASC");
        //having distance<".$search_distance."
        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar1 = [];

            foreach ($dat as $value) {

                $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

                $images = $im->row();

                if ($images->image != '') {

                    $img = base_url() . "uploads/products/" . $images->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                $output .= '<li><a href="' . base_url() . 'web/product_view/' . $value->seo_url . '">' . $value->name . '</a></li>';
            }

            print_r($output);
            die;
        } else {

            $output = '<li></li><li style="color:red; text-align:center;"><a>No Products Found </a></li>';

            print_r($output);
            die;
        }
    }

    function deleteCartRow($cart_id, $user_id) {

        $del = $this->db->delete("cart", array('id' => $cart_id));

        if ($del) {

            echo '@success';
            die;
        } else {

            echo '@error';
            die;
        }
    }

    function getSMSContent($type) {

        $qry = $this->db->query("select id,title,description from content where id='" . $type . "'");

        return $qry->row();
    }

    function docancelOrder($user_id, $orderid) {

        $ar = array('order_status' => '6');

        $wr = array('id' => $orderid);

        $upd = $this->db->update("orders", $ar, $wr);
        // $client_name='BARTEST-B2C';
        // $count=1;
        // $waybill=$this->fetchWayBill($client_name,$count);
        // echo "<pre>";
        // print_r($waybill);
        
        // $update=$this->cancelRequest($waybill);
        // echo "<pre>";
        // print_r($update);
        

        if ($upd) {

            $msg = "Order Cancelled by ";

            $aar = array('user_id' => $user_id, 'order_id' => $orderid, 'message' => $msg);

            $this->db->insert("admin_notifications", $aar);

            $qry = $this->db->query("select * from orders where id='" . $orderid . "'");

            $row = $qry->row();

            $usr_qry = $this->db->query("select * from vendor_shop where id='" . $row->vendor_id . "'");

            $usr_row = $usr_qry->row();

            $phone = $usr_row->mobile;

            $msg = "Dear vendor order no." . $orderid . " is cancelled by user, kindly collect return goods and confirm items are in good order.";

            $template_id = "1407161900188019493";

            // $this->send_message($msg,$phone,$template_id);





            $title = "Order Cancelled";

            $this->onesignalnotification($row->vendor_id, $title, $msg);

            if ($row->bid_id == 0) {



                $usr_qry = $this->db->query("select * from vendor_shop where id='" . $row->vendor_id . "'");

                $usr_row = $usr_qry->row();

                $phone = $usr_row->mobile;

                $qry = $this->db->query("select * from cart where session_id='" . $row->session_id . "'");

                $result = $qry->result();

                $ar = [];

                foreach ($result as $value) {

                    $link = $this->db->query("select * from  link_variant where id='" . $value->variant_id . "'");

                    $link_variants = $link->row();

                    $pro = $this->db->query("select * from  products where id='" . $link_variants->product_id . "' and delete_status=0");

                    $product = $pro->row();

                    $adm = $this->db->query("select * from  admin_comissions where shop_id='" . $vendor_id . "' and cat_id='" . $product->cat_id . "' and find_in_set('" . $product->sub_cat_id . "',subcategory_ids)");

                    $admin = $adm->row();

                    $admin_price = ($admin->admin_comission / 100) * $value->price;

                    $total = $link_variants->stock + $value->quantity;

                    $ar = array('varient_id' => $value->variant_id, 'product_id' => $link_variants->product_id, 'quantity' => $value->quantity, 'paid_status' => 'Credit', 'message' => 'Order cancelled by user', 'total_stock' => $total, 'created_at' => time());

                    $ins11 = $this->db->insert("stock_management", $ar);

                    if ($ins11) {

                        $qty = $link_variants->stock + $value->quantity;

                        $this->db->update("link_variant", array('stock' => $qty), array('id' => $value->variant_id));
                    }
                }
            }

            echo '@success';
        } else {

            echo '@error';
        }
        // exit;
    }

    function cancelRequest($waybill){
        $apiUrl=SHIPMENT_UPDATE_URL;
        $api_key=TEST_KEY;
        $data=['waybill'=>$waybill,'cancellation'=>"true"];
          // cURL setup
          $ch = curl_init($apiUrl . '?' . http_build_query($data));
          curl_setopt($ch, CURLOPT_HTTPGET, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
              'Authorization: Token ' .$api_key
          ));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
          // Execute cURL request
          $response = curl_exec($ch);
        
          // Check for cURL errors
          if (curl_errno($ch)) {
              return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
          }
        
          // Close cURL session
          curl_close($ch);
        
          return $response;
    }
    function fetchWayBill($client_name,$pieces){
       
     $apiUrl=WAY_BILL_URL;
   $api_key=TEST_KEY;
   $data=['cl'=>$client_name,'count'=>$pieces];
     // cURL setup
     $ch = curl_init($apiUrl . '?' . http_build_query($data));
     curl_setopt($ch, CURLOPT_HTTPGET, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         'Content-Type: application/json',
         'Authorization: Token ' .$api_key
     ));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
     // Execute cURL request
     $response = curl_exec($ch);
   
     // Check for cURL errors
     if (curl_errno($ch)) {
         return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
     }
   
     // Close cURL session
     curl_close($ch);
   
     return $response;
   
   }
    function exchangeRefund($session_id, $product_id, $user_id, $vendor_id, $cartid, $delivery_type, $reson) {

        $chk = $this->db->query("select * from refund_exchange where session_id='" . $session_id . "' and product_id='" . $product_id . "' and user_id='" . $user_id . "' and cartid='" . $cartid . "'");

        if ($chk->num_rows() > 0) {

            return array('status' => FALSE, 'message' => "your request already sent Successfully");
        } else {

            $shop = $this->db->query("select * from vendor_shop where id='" . $vendor_id . "'");

            $shop_data = $shop->row();

            $phone = $shop_data->mobile;

            $pro = $this->db->query("select * from products where id='" . $product_id . "' and delete_status=0");

            $product = $pro->row();

            $order_id = ($this->common_model->get_data_row(['session_id' => $session_id, 'vendor_id' => $vendor_id], 'orders'))->id;

            $otp_message = "Dear vendor order no: " . $session_id . " is requested for return by the customer. please review and and confirm. Contact customer care for more details. Thanks and Regards Absolute Mens";

            $template_id = "1407165996076194982";

            $this->send_message($otp_message, $phone, $template_id);

            $ar = array('session_id' => $session_id, 'user_id' => $user_id, 'product_id' => $product_id, 'vendor_id' => $vendor_id, 'cartid' => $cartid, 'delivery_type' => $delivery_type, 'message' => $reson, 'status' => 0);

            $ins = $this->db->insert("refund_exchange", $ar);

            if ($ins) {

                //notification to admin
                $msg = "Customer applied for return";
                $array = array('session_id' => $session_id, 'vendor_id' => $vendor_id, 'user_id' => $user_id, 'order_id' => $order_id, 'message' => $msg, 'status' => 0, 'created_date' => time());
                $this->db->insert("admin_notifications", $array);
                //email to customer
                $order_details = $this->web_model->orderDetails($order_id);
                $cart_details = $this->common_model->get_data_row(['id' => $cartid], 'cart');
                $link_varient = $this->common_model->get_data_row(['id' => $cart_details->variant_id], 'link_variant');
                $attr_jsondata = json_decode($link_varient->jsondata);
                $attribute_type = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_type], 'attributes_title'))->title;
                $attribute_value = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_value], 'attributes_values'))->value;
                $product_image = $this->common_model->get_data_row(['variant_id' => $link_varient->id], 'product_images');


                
                // sms to customer for Return Request
                $userorderid =  $order_details['ordersdetails']['session_id'];
                $userphone = $order_details['ordersdetails']['mobile'];
                $usersmsmessage = "Dear customer, we have received your return request for your order id " . $userorderid . ". Our team will review and process it within 24-48 hours. Thank you Team Absolutemens.com";
                $template_id = "1407165996076194982";
                 $this->send_message($usersmsmessage, $userphone, $template_id);


                
                $subject = $this->data['order_refund_invoice']->subject;
                $title = $this->data['order_refund_invoice']->title;
                $message = $this->data['order_refund_invoice']->message;
                $footer = $this->data['order_refund_invoice']->footer;
                
                $message .= '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
    
        a {
            color: #5D6975;
            text-decoration: underline;
        }
    
        body {
            position: relative;
            width: 21cm;
            height: auto;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }
    
        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }
    
        #logo {
            text-align: center;
            margin-bottom: 10px;
        }
    
        #logo img {
            width: 90px;
        }
    
        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(' . base_url('web_assets/img/') . 'dimension.png);
        }
    
        #project {
            float: left;
            inline-height:1.5em;
        }
    
        #project span {
            color: #5D6975;
            text-align: right;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.9em;
            inline-height:1.5em;
        }
        #company {
            float: right;
            text-align: right;
            inline-height:1.5em;
        }
    
        #project div,
        #company div {
            white-space: nowrap;
            inline-height:1.5em;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }
    
        table th,
        table td {
            text-align: center;
        }
    
        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }
    
        table .service,
        table .desc {
            text-align: center;
        }
    
        table td {
            padding: 10px;
            text-align: right;
        }
    
        table td.service,
        table td.desc {
            vertical-align: top;
        }
    
        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }
    
        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }
    
        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }
    
        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
            margin-bottom:10px;
        }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="' . base_url('uploads/images/') . $this->data['site']->logo . '">
            </div>
            <h1>[ ' . $title . ' ]</h1>
            <div id="company" class="clearfix">
                <div>' . $order_details['ordersdetails']['customer_name'] . '</div>
                <div><a href="mailto:' . $order_details['ordersdetails']['email'] . '">' . $order_details['ordersdetails']['email'] . '</a></div>
                <div>' . $order_details['ordersdetails']['mobile'] . '</div>
                <div>' . $order_details['ordersdetails']['useraddress'] . '</div>
            </div><br>
            <div id="project">
                <div><span>Order ID</span> #' . $order_details['ordersdetails']['session_id'] . '</div>
                <div><span>Placed On</span> ' . $order_details['ordersdetails']['created_date'] . '</div>
                <div><span>Payment Status</span> ' . $order_details['ordersdetails']['payment_status'] . '</div>
                <div><span>Payment Method</span> ' . $order_details['ordersdetails']['payment_type'] . '</div>
            </div><br>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Product</th>
                        <th class="desc">Product Name</th>
                        <th class="desc">Price</th>
                        <th class="desc">Quantity</th>
                        <th class="desc">Total</th>
                        <th class="desc">Return Status</th>
                    </tr>
                </thead>
                <tbody>';

        $count = 1;

        $message .= '<tr>
                            <td class="service">' . $count . '</td>
                            <td class="service"><img src ="' . base_url("uploads/products/") . $product_image->image . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                                ' . $product->name . '<br>
                                [' . ucfirst($attribute_type) . ': ' . $attribute_value . ']
                            </td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $cart_details->price . '</td>
                            <td class="desc">' . $cart_details->quantity . '</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $cart_details->unit_price . '</td>
                            <td class="desc">Request Sent</td>    
                            </tr>
                        </tbody></table></main>
        <footer>
            ' . $footer . '
        </footer>
    </body>
</html>';
        
        //send mail to customer

        $config1['protocol'] = MAIL_PROTOCOL;
        $config1['smtp_host'] = MAIL_SMTP_HOST;
        $config1['smtp_port'] = MAIL_SMTP_PORT;
        $config1['smtp_timeout'] = '7';
        $config1['smtp_user'] = MAIL_SMTP_USER;
        $config1['smtp_pass'] = MAIL_SMTP_PASS;
        $config1['charset'] = MAIL_CHARSET;
        $config1['newline'] = "\r\n";
        $config1['mailtype'] = 'html'; // or html
        $config1['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config1);

        $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
        $this->email->to($order_details['ordersdetails']['email']);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

                $cart_ar = array('status' => $delivery_type);

                $upd_ar = array('id' => $cartid);

                $this->db->update("cart", $cart_ar, $upd_ar);

                if ($delivery_type == 1) {

                    //return array('status' =>TRUE,'message'=>"Your Exchange Request sent Successfully");

                    echo '@success';
                    die;
                } else if ($delivery_type == 2) {

                    // return array('status' =>TRUE,'message'=>"Your Refund Request sent Successfully");

                    echo '@success';
                    die;
                }
            } else {

                //return array('status' =>FALSE,'message'=>"Something went wrong");

                echo '@error';
                die;
            }

            //}
        }
    }

    function getHomeCategories($catid) {

        $category = $this->db->query("select * from categories where id='" . $catid . "'");
        $category_row = $category->row();

        $subcat = $this->db->query("select * from sub_categories where cat_id='" . $catid . "'");
        $subcat_row1 = $subcat->result();
        if ($subcat->num_rows() > 0) {
            foreach ($subcat_row1 as $subcat_row) {

                if ($subcat_row->app_image != '') {
                    $img1 = base_url() . "uploads/sub_categories/" . $subcat_row->app_image;
                } else {
                    $img1 = base_url() . "uploads/noproduct.png";
                }

                $prod1 = $this->db->query("select * from products where cat_id='" . $catid . "' and sub_cat_id='" . $subcat_row->id . "' and delete_status=0");
                $products1 = $prod1->num_rows();
                if ($products1 > 0) {
                    $ar[] = array('id' => $subcat_row->id, 'title' => $subcat_row->sub_category_name, 'image' => $img1, 'products_count' => $products1, 'seo_url' => $subcat_row->seo_url);
                }
            }



            return array('sub_category_list' => $ar, 'category_name' => $category_row->category_name);
        } else {

            return array('status' => FALSE, 'message' => "No Data found");
        }
    }

    function getshopsWithcategoryID($cat_id, $subcatid, $user_id) {



        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $users = $this->db->query("select * from users where id='" . $user_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        }







        $qry = $this->db->query("select shop_id from admin_comissions where cat_id='" . $cat_id . "' and find_in_set('" . $subcatid . "',subcategory_ids) group by shop_id");

        $dat = $qry->result();

        /* $shop_ids = array_column($dat, 'shop_id');



          $im = implode(",", $shop_ids);

          print_r($im); die; */

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value1) {



                $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

                $row = $qry->row();

                $admin = $this->db->query("select * from admin where id=1");

                $search_distance = $admin->row()->distance;

                $row = $this->db->query("SELECT vendor_shop.*,products.status, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN products ON vendor_shop.id=products.shop_id where vendor_shop.id='" . $value1->shop_id . "' and products.status=1 and products.delete_status=0 and vendor_shop.status=1 group by products.shop_id order by distance asc");

                //having distance<".$search_distance."

                $value = $row->row();

                if ($value->shop_logo != '') {

                    $img = base_url() . "uploads/shops/" . $value->shop_logo;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                    ;
                }







                $shop_qry = $this->db->query("select * from shop_favorites where shop_id='" . $value->id . "' and user_id='" . $user_id . "'");

                if ($shop_qry->num_rows() > 0) {

                    $shop_not = true;
                } else {

                    $shop_not = false;
                }



                $pro = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.cat_id='" . $cat_id . "' and products.shop_id='" . $value->id . "' and products.status=1 and products.delete_status=0 group by link_variant.product_id order by products.id ASC");

                $product_total = $pro->num_rows();

                if ($pro->num_rows() > 0) {

                    if ($value->status == 1) {

                        $stat = "Open";
                    } else {

                        $stat = "Closed";
                    }



                    $ar[] = array('id' => $value->id, 'shop_name' => $value->shop_name, 'description' => $value->description, 'image' => $img, 'status' => $stat, 'shop_not' => $shop_not, 'distance' => round($value->distance), 'product_total' => $product_total, 'address' => $value->city, 'seo_url' => $value->seo_url);
                }
            }

            return array('shop_list' => $ar);
        } else {

            return array('message' => "No Shops");
        }
    }

    function getbrands() {

        $brnd = $this->db->query("select id,brand_name from attr_brands ");

        return $brnd->result();
    }

    function getfilterProducts($json_data, $shop_id, $cat_id, $user_id) {



        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $user_qry = $this->db->query("select * from users where id='" . $user_id . "'");

            $user_row = $user_qry->row();

            $lat = $user_row->lat;

            $lng = $user_row->lng;
        }









        $str = json_decode($json_data);

        $sp = [];

        //echo "<pre>"; print_r($json_data); die;

        foreach ($str as $value) {

            $str = json_encode($value);

            $filt_qry = "and link_variant.jsondata LIKE '%" . $str . "%'";

            $admin = $this->db->query("select * from admin where id=1");

            $search_distance = $admin->row()->distance;

            $qry = $this->db->query("SELECT vendor_shop.id as shop_id,vendor_shop.shop_name,link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and  products.cat_id='" . $cat_id . "' and  products.shop_id='" . $shop_id . "' and products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' and vendor_shop.status=1 " . $filt_qry . " group by link_variant.product_id order by link_variant.id desc ");
            //having distance<".$search_distance."
            //$qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 ".$filt_qry);

            $dat = $qry->result();

            if ($qry->num_rows() > 0) {

                $ar = [];

                foreach ($dat as $value) {

                    /* $qry11 = $this->db->query("select * from products where cat_id='".$cat_id."' and sub_cat_id='".$subcat_id."' and shop_id='".$shop_id."' and id='".$value12->product_id."'");

                      $value = $qry11->row(); */



                    $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

                    $images = $im->row();

                    if ($images->image != '') {

                        $img = base_url() . "uploads/products/" . $images->image;
                    } else {

                        $img = base_url() . "uploads/noproduct.png";
                    }





                    $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

                    $category = $cat->row();

                    $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                    $subcategory = $subcat->row();

                    /* $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");

                      $vendor = $vendo->row(); */







                    $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

                    if ($wish->num_rows() > 0) {

                        $stat = true;
                    } else {

                        $stat = false;
                    }





                    $ar[] = array('id' => $value->id, 'variant_id' => $value->variant_id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $value->shop_name, 'price' => $value->price, 'saleprice' => $value->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url);
                }

                return $ar;
            } else {

                return array();
            }
        }
    }

    function attributesWithCategory($cat_id) {

        $qry = $this->db->query("select * from manage_attributes where categories='" . $cat_id . "'");

        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {

                $att = $this->db->query("select * from attributes_title where id='" . $value->attribute_titleid . "'");

                $attribute = $att->row();

                $typ = $this->db->query("select * from attributes_values where attribute_titleid='" . $attribute->id . "'");

                $datails = $typ->result();

                $ar_val = [];

                foreach ($datails as $valuesdata) {

                    $ar_val[] = array('id' => $valuesdata->id, 'title' => $valuesdata->value);
                }

                $ar[] = array('id' => $attribute->id, 'title' => $attribute->title, 'attributes_values' => $ar_val);
            }

            return $ar;
        } else {

            return array();
        }
    }

    function getContactDetails() {

        $qry = $this->db->query("select * from admin where id=1");

        return $qry->row();
    }

    function saveContact($ar) {

        $ins = $this->db->insert("contact_us", $ar);

        if ($ins) {

            //send mail to admin

            $msg = '<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<p>Dear Admin,</p>
<p>You received new enquiry request.</p><br><br>

<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Company Name</th>
    <th>Designation</th>
    <th>Phone</th>
    <th>Request Type</th>
    <th>Message</th>
  </tr>
  <tr>
    <td>' . $ar['name'] . '</td>
    <td>' . $ar['email'] . '</td>
    <td>' . $ar['company_name'] . '</td>
    <td>' . $ar['Designation'] . '</td>
    <td>' . $ar['mobile'] . '</td>
    <td>' . $ar['request_type'] . '</td>
    <td>' . $ar['message'] . '</td>
  </tr>
</table>

</body>
</html>';

            $config1['protocol'] = MAIL_PROTOCOL;
            $config1['smtp_host'] = MAIL_SMTP_HOST;
            $config1['smtp_port'] = MAIL_SMTP_PORT;
            $config1['smtp_timeout'] = '7';
            $config1['smtp_user'] = MAIL_SMTP_USER;
            $config1['smtp_pass'] = MAIL_SMTP_PASS;
            $config1['charset'] = MAIL_CHARSET;
            $config1['newline'] = "\r\n";
            $config1['mailtype'] = 'html'; // or html
            $config1['validation'] = TRUE; // bool whether to validate email or not      

            $this->email->initialize($config1);

            $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
            $this->email->to($this->data['site']->getin_receive_mail);
            $this->email->subject('Enquiry');
            $this->email->message($msg);

            $this->email->send();

            echo '@success';
            die;
        } else {

            echo '@error';
            die;
        }
    }

    function updateCart($cartid, $quantity) {

        $cart_qry = $this->db->query("select * from cart where id='" . $cartid . "'");
        $cart_row = $cart_qry->row();

        $chk_quant_qry = $this->db->query("select * from link_variant where id='" . $cart_row->variant_id . "'");

        $chk_quant_row = $chk_quant_qry->row();
        
        $products_get = $this->common_model->get_data_row(['id' => $chk_quant_row->product_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');

        $stock = $chk_quant_row->stock;
        

        $qty = $cart_row->quantity;

        $quantity_f = $quantity;

        if ($stock < $quantity_f) {
            $msg = "Left only " . $stock . " Products";
            echo '@error@' . $msg;
            die;
            //return array('status' =>FALSE,'message'=>$msg);
        }
        
        if($quantity > $products_get->cart_limit) {
                    echo '@cart_limit@'.$products_get->cart_limit;  
                    die;
                }

        $unitprice = $quantity * $cart_row->price;

        $upd = $this->db->update("cart", array('quantity' => $quantity, 'unit_price' => $unitprice), array('id' => $cartid));

        if ($upd) {
            ?>

           
<div id="display_msg" style="text-align: center;font-size: 26px;"></div>
<div class="shopping_cart_area" id="loadCartdiv">
<div class="container">
                    <div class="row">
                       
                   
                    <div class=" myboard col-lg-2 scrollable-div links-column" id="dashMenu">
		<a href="<?= base_url('web/myprofile') ?>"> <img src="<?php echo base_url(); ?>uploads/images/person.svg" alt="noimg" width= "20px"
height=" 20px" style="margin-right:10px;"> Profile</a>
                    <a href="<?= base_url('web/my_addressbook') ?>"><img src="<?php echo base_url(); ?>uploads/images/manageaddress.svg" alt="noimg" width= "20px"
height=" 20px" style="margin-right:10px;"> Manage Address</a>
                    <a href="<?= base_url('web/checkout') ?>"><img src="<?php echo base_url(); ?>uploads/images/cart.svg" alt="noimg" width= "18px"
height=" 18px" style="margin-right:10px;"> My Cart</a>
                    <a href="<?= base_url('web/my_wishlist') ?>"><img src="<?php echo base_url(); ?>uploads/images/wishlist.svg" alt="noimg" width= "18px"
height=" 18px" style="margin-right:10px;"> My Wishlist</a>
<a href="<?php echo base_url(); ?>web/my_orders"><img src="<?php echo base_url(); ?>uploads/images/Myorders.svg" alt="noimg" width= "20px"
height=" 20px" style="margin-right:10px;"> My Orders</a>
		 
                    </div><div class="col-lg-6 mycart" style="display: none;">
                    <div class="cart_address_box" style="display: none;"> 
                        <?php
                                        $session_id = $_SESSION['session_data']['session_id'];
                                        $user_id = $_SESSION['userdata']['user_id'];
                                        $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                                        $cart_count = $cart_qry->num_rows();
                                        ?>
                   <h4>My Cart <span class="item_counts" id="cart_count">(<?php echo $cart_count ." items"; ?>)</span></h4>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        $(document).ready(function(e) {
            // Get the count value from PHP
            var count = <?php echo $cart_count; ?>;
            
            // Check the count and hide/show the div accordingly
            if (count > 0) {
                $('.mycategorybox').show();
                $('.box').show();
                $('.mycart').show();
                $('.cart_address_box').show();
            } else {
                $('.mycategorybox').hide();
                $('.box').hide();
                $('.mycart').hide();
                $('.cart_address_box').hide();
            }
        });
    </script>


                   <h5>Delievery Address </h5>
                   
                  <?php  $addresslist = $this->Web_model->getAddress($user_id);
                  ?>
                  <?php 
                //   echo "<pre>";print_r($addresslist[0]['id']);exit;?>
                <div class="custom-dropdown">
    <div class="dropdown-toggle custom-select check_address_back" name="flexRadioDefault" id="dropdownToggle" onclick="
        var dropdownMenu = document.querySelector('.custom-dropdown .dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
    ">Choose One of the Delivery address
    <!-- <?php print_r($addresslist[0]['name'] . ', ' . $addresslist[0]['address'] . ', ' . $addresslist[0]['landmark'] . ', ' . $addresslist[0]['city'] . ', ' . $addresslist[0]['state'] . ', PinCode: ' . $addresslist[0]['pincode'] . ', Ph: ' . $addresslist[0]['mobile']);?>
    <span class="badge badge-pill"><span class="colortype"><?php echo $addresslist[0]['address_type']; ?></span></span> -->
</div>
    <div class="dropdown-menu">
        <?php foreach ($addresslist as $address) { ?>
            <?php 
            $optionText = $address['name'] . ', ' . $address['address'] . ', ' . $address['landmark'] . ', ' . $address['city'] . ', ' . $address['state'] . ', PinCode: ' . $address['pincode'] . ', Ph: ' . $address['mobile'];
            
            // Truncate the option text if it's too long
            if (strlen($optionText) > 100) {
                $optionText = substr($optionText, 0, 78) . '...';
            }
            ?>
            <div class="dropdown-item" onclick="
                var dropdownToggle = document.getElementById('dropdownToggle');
                var hiddenInput = document.querySelector('.custom-dropdown input[type=\'hidden\']');

                dropdownToggle.innerHTML = '<?php echo $optionText; ?> ';

// Create a new span element for the badge
var badgeSpan = document.createElement('span');
badgeSpan.className = 'badge badge-pill';

// Create a nested span element for the address type
var colortypeSpan = document.createElement('span');
colortypeSpan.className = 'colortype';
colortypeSpan.textContent = '<?php echo $address['address_type']; ?>';

// Append the nested span to the badge span
badgeSpan.appendChild(colortypeSpan);

// Append the badge span to the dropdownToggle
dropdownToggle.appendChild(badgeSpan);

dropdownToggle.setAttribute('data-selected-id', '<?php echo $address['id']; ?>');
hiddenInput.value = '<?php echo $address['id']; ?>';

var dropdownMenu = document.querySelector('.custom-dropdown .dropdown-menu');
dropdownMenu.style.display = 'none';

getDeliveryAddressID('<?php echo $address['id']; ?>');
">
                <input type="hidden" value="<?php echo $address['id']; ?>">
                <?php echo $optionText; ?>
                <span class="badge badge-pill"><span class="colortype"><?php echo $address['address_type']; ?></span></span>
            </div>
        <?php } ?>
    </div>
</div>
<br></div><br>
                        <div class="mycategorybox" style="display: none;">
                       
   
                        

                            <?php
                            $session_id = $_SESSION['session_data']['session_id'];
                            $user_id = $_SESSION['userdata']['user_id'];
                            $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");

                            $result = $qry->result();

                            $unitprice = 0;
                            $gst = 0;
                            $shop_ids = [];
                            $totalPriceDiscount = 0;
                            if (sizeof($result) > 0) {
                                foreach ($result as $key => $value) {

                                    $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");
                                    $product = $pro->row();
                                     
                  

                                    $shop = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");
                                    $shopid = $shop->row()->id;
                                    array_push($shop_ids, $shopid);

                                    if ($product->image != '') {
                                        $img = base_url() . "uploads/products/" . $product->image;
                                    } else {
                                        $img = base_url() . "uploads/noproduct.png";
                                    }
                                    $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");
                                    $link = $var1->row();
                                    // print_r($link->price);

                                    $jsondata_row = $link->jsondata;
                                    $jsonrow = json_decode($jsondata_row);

                                    $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "'");
                                    $product1 = $pro1->row();
                                    // print_r($product1);
                                    

                                    $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

                                    if ($wish->num_rows() > 0) {

                                        $stat = true;
                                    } else {

                                        $stat = false;
                                    }



                                    $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");

                                    if ($adm_qry->num_rows() > 0) {
                                        $adm_comm = $adm_qry->row();
                                        // $p_gst = $adm_comm->gst;
                                        $p_gst = '0';
                                        
                                    } else {
                                        $p_gst = '0';
                                    }

                                    $class_percentage = ($value->unit_price / 100) * $p_gst;

                                    $variants1 = $var1->result();
                                    $att1 = [];
                                    foreach ($variants1 as $value1) {

                                        $jsondata = $value1->jsondata;
                                        $values_ar = [];
                                        $json = json_decode($jsondata);
                                        foreach ($json as $value123) {
                                            $type = $this->db->query("select * from attributes_title where id='" . $value123->attribute_type . "'");
                                            $types = $type->row();

                                            $val = $this->db->query("select * from attributes_values where id='" . $value123->attribute_value . "'");
                                            $value1 = $val->row();
                                            $values_ar[] = array('id' => $value1->id, 'title' => $types->title, 'value' => $value1->value);
                                        }
                                    }
                                    // echo $unitprice;

                                    $unitprice = $value->unit_price + $unitprice;
                                    $gst = $class_percentage + $gst;
                                    ?>

                                    <div class="cartproductrow">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-4 col-xs-2 col-sm-3  position-relative image_cartpage">
                                            <a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><img src="<?php echo $img; ?>" alt="" class="img-responsive img-thumbnail pro_img"></a>
                    <!--                                        <a href="#" class="crtwsh"><i class="fal fa-heart"></i></a>-->
                                                <!--                                        <div class="crtwsh">
                                                                                            <a title="Add to Wishlist" onclick="addremoveTOpDealsFavorite(<?php echo $product1->id; ?>)"><i id="favoritecls_<?php echo $product1->id; ?>" class="<?php
                                                if ($stat == true) {
                                                    echo 'fas';
                                                } else {
                                                    echo 'fal';
                                                }
                                                ?> fa-heart"></i></a>
                                                                                        </div>-->
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-8 col-xs-10 col-sm-9 details_cartpage">
                                            <span class="text-center"><a onclick="deletecartitems(<?php echo $value->id; ?>)" class="remove-item"><i class="fas fa-times"></i></a></span>
                                            <div class="details_gap"> <span class="prod_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><?php echo $product1->name; ?></a></span>
                                                <?php
                                                if ($value->variant_id > 0) {
                                                    foreach ($jsonrow as $row) {
                                                        $type_row = $this->db->query("select * from attributes_title where id='" . $row->attribute_type . "'");
                                                        $type_get = $type_row->row();
                                                        $val_row = $this->db->query("select * from attributes_values where id='" . $row->attribute_value . "'");
                                                        $value_get = $val_row->row();
                                                        ?>
                                                       <!-- <select style="border:none;width: 120px;
height: 25px;font-weight:bold;border-radius: 4px;background: var(--unnamed-color-2556b91a) 0% 0% no-repeat padding-box;
background: #2556B91A 0% 0% no-repeat padding-box;;"> <option> -->
<span class="volume_quant">
     <b class="volume_option"><?= ucfirst($type_get->title) ?>:</b> <span class="volume_value"><?= ucfirst($value_get->value) ?></span>
    <!-- </option></select> -->
     
                                                        <?php
                                                    }
                                                }
                                                ?>
                                               <span class="bg-grey">
    <span>Qty.</span>
    <select name="quantity" id="quantity<?php echo $value->id; ?>" onchange="increaseQuantity(<?php echo $value->id; ?>)" class="cart_quant">
        <?php for ($i = 1; $i <= $product1->cart_limit; $i++): ?>
            <option value="<?php echo $i; ?>" <?php if ($i == $value->quantity) echo 'selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
</span></span><?php $price_discount=$link->price - $value->price;
$totalPriceDiscount +=$price_discount;
 $discountpercent=  round(($price_discount) * 100 / $link->price); ?>
                                                   <div class="pro-price"> <span><i class="fal fa-rupee-sign"></i><?php echo $value->price; ?></span>
                                                   <?php if($value->price != $link->price){?><span><del><i class="fal fa-rupee-sign"></i>  <?php echo $link->price; ?></del></span>
                                                    <span class="discount-text"><?php echo $discountpercent; ?>% OFF</span><?php } ?></div>
                                                
                                                    <div class="coupon_inner"> 
                                                        <a title="Add to Wishlist"><i id="favoritecls_<?php echo $value->variant_id; ?>"></i>
                                                            <?php if ($stat == false) { ?>
                                                                <button type="button" onclick="addremoveTOpDealsFavorite(<?php echo $value->variant_id; ?>,<?= $key ?>)" id="wish_list_btn_<?= $key ?>" class="checkout_btn text-white">Move to Wishlist</button>
                                                            <?php } ?>
                                                            <!--                                                                
                                                                                                                            <button type="button" onclick="addremoveTOpDealsFavorite(<?php echo $product1->id; ?>,<?= $key ?>)" id="wish_list_btn_<?= $key ?>" class="checkout_btn" style="font-size: 15px; font-size-adjust: 1px; background: #0857c0; color: white">Remove from Wishlist</button>
                                                            -->
                                                        </a>
                                                    </div>
                                                
                                            
                                                            </div> </div>
                                           
                                        </div>
                                    </div>
                                    <?php
                                }
                                $unique_shop_ids = array_unique($shop_ids);
                                $shipping_charge = array_sum(array_column($this->common_model->get_data_where_in('id', $unique_shop_ids, 'vendor_shop'), 'min_order_amount'));
                                $grand_t = $shipping_charge + $unitprice + $gst;
                                ?>
                                <!-- <div class="row">
                                    <div class="col-lg-12">
                                        <a class="btn-cnt-shopping" href="<?php echo base_url(); ?>">Continue Shopping</a>
                                    </div>
                                </div> -->
                            <?php } ?>
                            <div class="table_desc" style="display:none">
                                <div class="cart_page table-responsive">
                                    <table>
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <!-- <th class="product_remove">Delete</th> -->
                                                <th class="product_thumb">Image</th>
                                                <th class="product_name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product_quantity">Quantity</th>
                                                <th class="product_total">Total</th>
                                                <th class="product_total">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="product_thumb"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><img src="<?php echo $img; ?>" alt=""></a></td>
                                                <td class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><?php echo $product1->name; ?></a><br>

                                                    <?php /* <p class="mb-0"><a href="<?php echo base_url(); ?>web/store/<?php echo $shopdat->seo_url; ?>/shop"><b>Shop Name :</b> <?php echo $shopdat->shop_name; ?></a></p>

                                                      <p><b>Location:</b><?php echo $shopdat->city; ?></p> */ ?>
                                                </td>
                                                <td class="product-price"><i class="fal fa-rupee-sign"></i> <?php echo $value->price; ?></td>
                                        <form class="form-horizontal" enctype="multipart/form-data"  >
                                            <td class="product_quantity"><label></label>
                                                <a  onclick="decreaseQuantity(<?php echo $value->id; ?>)"><i class="fas fa-minus"></i></a>
                                                <input min="0" max="100" name="quantity" id="quantity<?php echo $value->id; ?>" value="<?php echo $value->quantity; ?>" type="text" readonly>
                                                <a onclick="increaseQuantity(<?php echo $value->id; ?>)"><i class="fas fa-plus"></i></a>
                                                <div id="quantityshow<?php echo $value->id; ?>"></div>
                                            </td>
                                            <td class="product_total"><i class="fal fa-rupee-sign"></i> <?php echo $value->unit_price; ?></td>
                                            <td>
                                                <a onclick="deletecartitems(<?php echo $value->id; ?>)" class="remove-item"><i class="fal fa-trash-alt"></i></a>
                                            </td>
                                        </form>
                                        </tr>

                                        <tr>
                                            <td colspan="6">
                                                <a class="btn pink-btn float-right" href="<?php echo base_url(); ?>">Continue Shopping</a>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div></div>
                        <?php if (sizeof($result) == 0) { ?>
                            <div class="col-lg-10 cartempty"><center><img src="<?php echo base_url();?>web_assets/img/cartempty.jpg"/></center></div>
                        <center>
                            <div class="cart_page" style=" display: flex;
            justify-content: center;
            align-items: center; margin: 0;
            padding: 0;">
                                
                                    <a class="btn-cnt-shopping" href="<?php echo base_url(); ?>">START SHOPPING!</a>
                                
                            </div><br><br><br><br><br><br><br><br><br><br><br>
                        </center>  
                        <?php } ?>
                        <?php if (sizeof($result) > 0) { ?>
                        <div class="col-lg-4 box" style="display: none;">
                            <h4 style="font-weight: 900;padding-left:10px;">Order Summary</h4><br>
                            <div class="coupon_code left">
                                <!-- <h3><i class="fal fa-tag"></i> Apply Coupon</h3> -->

                                <div class="coupon_inner">
                                    <!-- <p class="pl-3">Enter coupon code.</p> -->
                                    <div id="coupon_msg"></div>

                                    <form class="form-horizontal d-flex pl-2" enctype="multipart/form-data"  >
                                        <input placeholder="Coupon Code" class="couponcode" type="text" autocomplete="off">
                                        <button type="button" class="apply" onclick="validatecouponcode()">Apply</button>
                                        
                                        <button type="button" class="remove"  onclick="remove()" style="display:none">Remove</button>
                                    </form>
                                    <!-- <a data-toggle="modal"  onclick="showhide()" data-target="#viewcoup" style="color: #2556B9;;text-align:right;text-decoration:underline;padding-right:55px;">View Coupon</a> -->
                                </div>

                                    <?php
                                    $coupons = $this->getCouponcodes($user_id, $session_id);
                                    if (count($coupons) > 0) {
                                        ?>
                                        <div class="row justify-content-center" id="show_button">
                                            <div class="">
                                            <a   onclick="showhide()" style="color: #2556B9;float:right;text-align:right;text-decoration:underline;">View Coupon</a>
                                            </div>
                                        </div>
                                        <!-- <div class="row justify-content-center" id="close_button" style="display: none;">
                                            <div class="">
                                                <a  class="btn-viewcoup mr-3" onclick="closecoupon()">Hide Coupons</a>
                                            </div>
                                        </div> -->
                                    <?php } ?>
                               
                                    <div class="couponlist-box modal" id="viewcoup">
<div class="modal-dialog">

<div class="modal-content">

    <div class="modal-body">

    <button type="button" class="btn-close" onclick="closeModalBox()" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
    <h4>Apply Coupon</h4>
    <?php if (sizeof($result) > 0) { ?>
    <div class="coupon_inner">
                                    <!-- <p class="pl-3">Enter coupon code.</p> -->
                                    <div id="coupon_msg"></div>

                                    <form class="form-horizontal d-flex pl-2" enctype="multipart/form-data"  >
                                        <input placeholder="Coupon Code" class="couponcode" type="text"  autocomplete="off">
                                        <button type="button" class="apply" onclick="validatecouponcode()">Apply</button>
                                        
                                        <button type="button" class="remove" onclick="remove()" style="display:none">Remove</button>
                                    </form>
                                    <!-- <a data-toggle="modal"  onclick="showhide()" data-target="#viewcoup" style="color: #2556B9;;text-align:right;text-decoration:underline;padding-right:55px;">View Coupon</a> -->
    </div>
<?php }?>
   

<?php foreach ($coupons as $coup) { ?>
    <div class="row">
        <div style="display:flex;gap:1.2rem;">
            <div>
                <form class="form-horizontal">
                    <!-- Use a unique identifier for each checkbox -->
                    <!-- <input type="checkbox" name="mycheck" class="coupon-checkbox" id="myInput<?php echo $coup['id']; ?>"
                        value="<?php echo $coup['coupon_code']; ?>"
                        onchange="(this.checked) ? applyCouponcode('<?php echo $coup['coupon_code']; ?>') : remove('<?php echo $coup['coupon_code']; ?>')"> -->

                        <input type="checkbox" name="mycheck" class="coupon-checkbox" id="myInput<?php echo $coup['id']; ?>"
       value="<?php echo $coup['coupon_code']; ?>"
       onchange="(this.checked) ? $('.couponcode').val('<?php echo $coup['coupon_code']; ?>') : $('.couponcode').val(''); this.enabled = this.checked;" style="text-align:center;justify-content: center;align-items: center;margin-top:10px;"> 


                        <!-- <h6><input type="text" style="width: 100px; border: none; background: none; cursor: pointer" value="<?php echo $coup['coupon_code']; ?>" id="myInput<?php echo $coup['id']; ?>" onclick="applyCouponcode('<?php echo $coup['coupon_code']; ?>')" title="Apply this coupon" class="coupontoggle" readonly=""></h6> -->
            </div>
            <div>
                <h6><input type="text" class="myinput" value="<?php echo $coup['coupon_code']; ?>" id="myInput<?php echo $coup['id']; ?>" readonly=""></h6>
                </form>
            </div>
        </div>
        <h5><?php echo $coup['percentage']; ?>% OFF</h5>
        <p><strong><?php echo $coup['description']; ?></strong></p>
    </div>
<?php } ?>

<script>
const couponCheckboxes = document.querySelectorAll('.coupon-checkbox');

couponCheckboxes.forEach(checkbox => {
    checkbox.checked = false;
});

couponCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            couponCheckboxes.forEach(otherCheckbox => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        }
    });
});

</script>



                                <div class="coupon_inner">
                                <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer;float:left;" title="Remove Coupon"></p>
                                <button type="button" style="float:right;width: 150px;height: 40px;background: var(--unnamed-color-2556b9) 0% 0% no-repeat padding-box;background: #2556B9 0% 0% no-repeat padding-box;border-radius: 25px;opacity: 1;" class="apply1" onclick="validatecouponcode()">Apply</button>
                                </div>

                            </div>
                                </div>
                                </div>
                                </div>
 </div>
                                <div class="coupon_code right" style="display: block;">
                                    <!-- <h3 class="pb-2"><i class="fal fa-shopping-bag"></i> Cart Totals</h3> -->
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Subtotal</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i> <?php echo number_format($unitprice, 2); ?></p>
                                            <input type="hidden" id="sub_total" value="<?php echo $unitprice; ?>" >
                                        </div>
                                        <div class="cart_subtotal ">
                                            <p>Shipping Charges</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo number_format($shipping_charge, 2); ?></p>
                                            <input type="hidden" id="min_order_amount" value="<?php echo $shipping_charge; ?>" >
                                        </div>
                                        <div class="cart_subtotal">
                                            <p>GST</p>
                                            <!-- <p class="cart_amount" id="gst"><i class="fal fa-rupee-sign"></i> <?= number_format($gst, 2) ?></p> -->
                                            <p class="cart_amount" id="gst"><i class="fal fa-rupee-sign"></i>0</p>
                                        </div>
                                        <div class="cart_subtotal">
                                        <p> Coupon Discount</p>
                                        <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer" title="Remove Coupon" onclick="remove()"></p>
                                        <p class="cart_amount" id="discount" style="font-weight:bold;"><i class="fal fa-rupee-sign"></i> 0</p>
                                    </div>
                                    <div class="cart_subtotal">
                                        <p>Discount</p>
                                        <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer"></p>
                                        <p class="cart_amount1" id="discount1" style="font-weight:bold;"><i class="fal fa-rupee-sign" style="font-size:12px;"></i><?php echo $totalPriceDiscount;?></p>
                                    </div>
                                        <div class="cart_subtotal" id="total_default">
                                            <p>Total</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i> <input type="hidden" id="cart_total" value="<?php echo $grand_t; ?>" > <?php echo number_format($grand_t, 2); ?></p>
                                        </div>
                                        <div class="cart_subtotal" id="total_default_show" style="display: none;">
                                            <p>Total</p>
                                            <p class="cart_amount" id="total_p"><?php echo number_format($grand_t, 2); ?></p>
                                        </div>
                                        <div class="text-center">
                                <form method="post" id="checkout-form" class="form-horizontal" onclick="return chk_address_place_order()">
                                <input type="hidden" name="aid" id="selected_address" value="<?php echo $address['id']; ?>">
                                   
                                    <input type="hidden" name="gst" value="0">
                                    <input type="hidden" name="shipping_charge" id="shipping_charge" value="<?php echo $shipping_charge; ?>">
                                    <input type="hidden" name="coupon_id" id="coupon_id" value="<?php echo $coupon_id;?>">
                                        <input type="hidden" name="coupon_code" id="applied_coupon_code" value="<?php echo $coupon_code; ?>">
                                        <input type="hidden" name="coupon_discount" id="coupon_discount" value="<?php echo $coupon_discount; ?>">
                                        <input type="hidden" name="total_price" id="order_total_payment">
                                    <button type="button" id="payment_modal" class="btn btn-address">Proceed to Payment</button>
                                </form>
                            </div>

                                                                                                                                                                                                                                                                                                                                                                                                                                                           <!-- <p class="bid-text"><a data-toggle="modal" onclick="doBidProducts()">BID ABOVE PRODUCTS </a> <a href="#bidModal" data-toggle="modal" class="text-dark"><i class="fal fa-comment-exclamation"></i></a></p> -->

                                    </div>
                                </div>
                            </div>
                        <?php 
                    
                    } ?><script>
function getDeliveryAddressID(aid) {
        $('#selected_address').val(aid);
        console.log(aid);
    }

function chk_address_place_order() {
        var selected_address = $('#selected_address').val();

        $('.check_address_back').each(function(){
            if($(this).prop('checked') == true){
                selected_address = $(this).val();
                $('#selected_address').val(selected_address);
                // console.log(selected_address);
            }
        });
        
        if (selected_address == '') {
            toastr.error("Please select delivery address to proceed")
            return false;
        } else {
            $.ajax({
                url: "<?= base_url() ?>web/payment",
                method: "POST",
                data: $('#checkout-form').serialize(),
                success: function (data)
                {
                    var result = $.parseJSON(data);
//                    $('#exampleModalCenter').modal('show');
var price='<?php echo $grand_t; ?>';
        var discount=$('#coupon_discount').val();
        var gst=result.gst;
        var total_price= price-discount;
        // print_r(total_price);

                    var form = `<form method="post" id="payment-form" action="<?= base_url('web/phonepe_payment') ?>">
                            <input type="hidden" name="totalAmount" value="` + total_price + `" />
                            <input type="hidden" name="address_id" value="` + result.aid + `" />
                            <input type="hidden" name="coupon_id" value="` + result.coupon_id + `" />
                            <input type="hidden" name="coupon_code" value="` + result.coupon_code + `" />
                            <input type="hidden" name="coupon_discount" value="` + result.coupon_discount + `" />
                            <input type="hidden" name="gst" value="` + result.gst + `" />
                            <input type="hidden" name="shipping_charge" value="` + result.shipping_charge + `" />
                            <button type="submit" class="btn btn-pink btn-block custom" id="online" style="display: none;position: relative;left: 26%;">Pay Now</button>
                        </form>`;
                    $('#payment').html(form);
                    document.getElementById("payment-form").submit();
                   

// Clear all checkboxes by setting their checked property to false
couponCheckboxes.forEach(checkbox => {
    checkbox.checked = false;
});
                }
            });
        }
    }
                    </script>
                    </div>
                </div>
                </div>
             
                
            

            <?php
        } else {

            echo '@error';
            die;
        }
    }

    function descrementCart($cartid, $quantity) {







        $cart_qry = $this->db->query("select * from cart where id='" . $cartid . "'");

        $cart_row = $cart_qry->row();

        $chk_quant_qry = $this->db->query("select * from link_variant where id='" . $cart_row->variant_id . "'");

        $chk_quant_row = $chk_quant_qry->row();
      

        $stock = $chk_quant_row->stock;

        $qty = $cart_row->quantity;

        $quantity_f = $quantity;

        $unitprice = $quantity * $cart_row->price;

        $upd = $this->db->update("cart", array('quantity' => $quantity, 'unit_price' => $unitprice), array('id' => $cartid));

        if ($upd) {
            ?>

           
            
<div id="display_msg" style="text-align: center;font-size: 26px;"></div>
<div class="shopping_cart_area" id="loadCartdiv">
<div class="container">
                    <div class="row">
                       
                   
                    <div class="col-lg-2 scrollable-div links-column" id="dashMenu">
		<a href="<?= base_url('web/myprofile') ?>"> <img src="<?php echo base_url(); ?>uploads/images/person.svg" alt="noimg" width= "20px"
height=" 20px"> Profile</a>
                    <a href="<?= base_url('web/my_addressbook') ?>"><img src="<?php echo base_url(); ?>uploads/images/manageaddress.svg" alt="noimg" width= "20px"
height=" 20px"> Manage Address</a>
                    <a href="<?= base_url('web/checkout') ?>"><img src="<?php echo base_url(); ?>uploads/images/cart.svg" alt="noimg" width= "18px"
height=" 18px"> My Cart</a>
                    <a href="<?= base_url('web/my_wishlist') ?>"><img src="<?php echo base_url(); ?>uploads/images/wishlist.svg" alt="noimg" width= "18px"
height=" 18px"> My Wishlist</a>
<a href="<?php echo base_url(); ?>web/my_orders"><img src="<?php echo base_url(); ?>uploads/images/Myorders.svg" alt="noimg" width= "20px"
height=" 20px"> My Orders</a>
		 
                    </div>
                        <div class="col-lg-6 col-md-6 mycategorybox" style="display: none;">
                           
                        <?php
                                        $session_id = $_SESSION['session_data']['session_id'];
                                        $user_id = $_SESSION['userdata']['user_id'];
                                        $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");
                                        $cart_count = $cart_qry->num_rows();
                                        ?>
                   <h4 style="color: var(--unnamed-color-2556b9);
text-align: left;
font: normal normal 800 18px/23px Muli;
letter-spacing: 0px;
color: #2556B9;
opacity: 1;">My Cart <span class="item_count" id="cart_count">(<?php echo $cart_count; ?>)</span></h4>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        $(document).ready(function(e) {
            // Get the count value from PHP
            var count = <?php echo $cart_count; ?>;
            
            // Check the count and hide/show the div accordingly
            if (count > 0) {
                $('.mycategorybox').show();
                $('.box').show();
            } else {
                $('.mycategorybox').hide();
                $('.box').hide();
            }
        });
    </script>


                   <h4>Delievery Address </h4>
                   <select style="top: 297px;
                   padding:2px 0px 2px 7px;
                   white-space: nowrap;
                   overflow: hidden;
left: 381px;
width: 650px;
height: 50px;
/* UI Properties */
background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 0.5px solid #707070;
border-radius: 11px;
opacity: 1;">
    <?php    $addresslist = $this->Web_model->getAddress($user_id);
    foreach ($addresslist as $address) { ?>
        <option style="text-overflow: ellipsis;">
            <strong><?php echo $address['name']; ?></strong>&nbsp;
            <?php echo $address['address']; ?>,<?php echo $address['landmark']; ?> ,
            <?php echo $address['city']; ?> , <?php echo $address['state']; ?>&nbsp;
            PinCode: <?php echo $address['pincode']; ?><br>
            Ph: <?php echo $address['mobile']; ?> &nbsp;
          <span style="justify-content:end;color:blue;font-size:20px;text-align:right;"><?php echo $address['address_type']; ?></span>
          <!-- <span><a href="<?php echo base_url(); ?>web/deleteaddressinbook/<?php echo $address['id']; ?>"  onclick="if (!confirm('Are you sure you want to delete this address?'))
              return false;"class="btn btn-outline-danger  btn-sm"><i class="fal fa-trash-alt"></i></a></span> -->
        </option>
    <?php } ?>
</select><br><br>

               
                           <?php
                            $session_id = $_SESSION['session_data']['session_id'];
                            $user_id = $_SESSION['userdata']['user_id'];
                            $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "'");

                            $result = $qry->result();

                            $unitprice = 0;
                            $gst = 0;
                            $shop_ids = [];
                            if (sizeof($result) > 0) {
                                foreach ($result as $key => $value) {

                                    $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");
                                    $product = $pro->row();

                                    $shop = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");
                                    $shopid = $shop->row()->id;
                                    array_push($shop_ids, $shopid);

                                    if ($product->image != '') {
                                        $img = base_url() . "uploads/products/" . $product->image;
                                    } else {
                                        $img = base_url() . "uploads/noproduct.png";
                                    }
                                    $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");
                                    $link = $var1->row();

                                    $jsondata_row = $link->jsondata;
                                    $jsonrow = json_decode($jsondata_row);

                                    $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "'");
                                    $product1 = $pro1->row();

                                    $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");
                                    
                                    if ($wish->num_rows() > 0) {

                                        $stat = true;
                                    } else {

                                        $stat = false;
                                    }



                                    $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");

                                    if ($adm_qry->num_rows() > 0) {
                                        $adm_comm = $adm_qry->row();
                                        $p_gst = $adm_comm->gst;
                                    } else {
                                        $p_gst = '0';
                                    }

                                    $class_percentage = ($value->unit_price / 100) * $p_gst;

                                    $variants1 = $var1->result();
                                    $att1 = [];
                                    foreach ($variants1 as $value1) {

                                        $jsondata = $value1->jsondata;
                                        $values_ar = [];
                                        $json = json_decode($jsondata);
                                        foreach ($json as $value123) {
                                            $type = $this->db->query("select * from attributes_title where id='" . $value123->attribute_type . "'");
                                            $types = $type->row();

                                            $val = $this->db->query("select * from attributes_values where id='" . $value123->attribute_value . "'");
                                            $value1 = $val->row();
                                            $values_ar[] = array('id' => $value1->id, 'title' => $types->title, 'value' => $value1->value);
                                        }
                                    }

                                    $unitprice = $value->unit_price + $unitprice;
                                    $gst = $class_percentage + $gst;
                                    ?>

                                    <div class="cartproductrow">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-4 position-relative">
                                                <a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><img src="<?php echo $img; ?>" alt="" class="img-responsive img-thumbnail"></a>
                    <!--                                        <a href="#" class="crtwsh"><i class="fal fa-heart"></i></a>-->
                                                <!--                                        <div class="crtwsh">
                                                                                            <a title="Add to Wishlist" onclick="addremoveTOpDealsFavorite(<?php echo $product1->id; ?>)"><i id="favoritecls_<?php echo $product1->id; ?>" class="<?php
                                                if ($stat == true) {
                                                    echo 'fas';
                                                } else {
                                                    echo 'fal';
                                                }
                                                ?> fa-heart"></i></a>
                                                                                        </div>-->
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-7">
                                                <h4 style="
font: normal normal normal 14px/17px Rubik;
font-size:17px;
letter-spacing: 0px;
color: #333333;
opacity: 1;"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><?php echo $product1->name; ?></a></h4><br>
                                                <?php
                                                if ($value->variant_id > 0) {
                                                    foreach ($jsonrow as $row) {
                                                        $type_row = $this->db->query("select * from attributes_title where id='" . $row->attribute_type . "'");
                                                        $type_get = $type_row->row();
                                                        $val_row = $this->db->query("select * from attributes_values where id='" . $row->attribute_value . "'");
                                                        $value_get = $val_row->row();
                                                        ?>
                                                         <select style="background-color: #2556B91A ;"> <option> <b><?= ucfirst($type_get->title) ?>:</b> <?= ucfirst($value_get->value) ?></option></select> &nbsp;&nbsp;
                                                        <?php
                                                    }
                                                }
                                                ?>

                                                <span class="bg-grey">
    <span>Qty.</span>
    <select name="quantity" id="quantity<?php echo $value->id; ?>" onchange="increaseQuantity(<?php echo $value->id; ?>)" style="border:none;background:none;border-radius: 4px;">
        <?php for ($i = 1; $i <= $product1->cart_limit; $i++): ?>
            <option value="<?php echo $i; ?>" <?php if ($i == $value->quantity) echo 'selected'; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
</span><br>
                                                   <div class="pro-price"><i class="fal fa-rupee-sign"></i> <span><?php echo $value->unit_price; ?></span><br><br>
                                                <div>
                                                    <div class="coupon_inner"> 
                                                        <a title="Add to Wishlist"><i id="favoritecls_<?php echo $value->variant_id; ?>"></i>
                                                            <?php if ($stat == false) { ?>
                                                                <button type="button" onclick="addremoveTOpDealsFavorite(<?php echo $value->variant_id; ?>,<?= $key ?>)" id="wish_list_btn_<?= $key ?>" class="checkout_btn text-white" style="font-size: 15px; font-size-adjust: 1px;top: 534px;
left: 519px;
width: 201px;
height: 38px;
background: var(--unnamed-color-2556b9) 0% 0% no-repeat padding-box;
background: #2556B9 0% 0% no-repeat padding-box;
border-radius: 10px;
opacity: 1;">Move to Wishlist</button>
                                                            <?php } ?>
                                                            <!--                                                                
                                                                                                                            <button type="button" onclick="addremoveTOpDealsFavorite(<?php echo $product1->id; ?>,<?= $key ?>)" id="wish_list_btn_<?= $key ?>" class="checkout_btn" style="font-size: 15px; font-size-adjust: 1px; background: #0857c0; color: white">Remove from Wishlist</button>
                                                            -->
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>


                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1 text-center"><a onclick="deletecartitems(<?php echo $value->id; ?>)" class="remove-item"><i class="fas fa-times"></i></a></div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                $unique_shop_ids = array_unique($shop_ids);
                                $shipping_charge = array_sum(array_column($this->common_model->get_data_where_in('id', $unique_shop_ids, 'vendor_shop'), 'min_order_amount'));
                                $grand_t = $shipping_charge + $unitprice + $gst;
                                ?>
                                <!-- <div class="row">
                                    <div class="col-lg-12">
                                        <a class="btn-cnt-shopping" href="<?php echo base_url(); ?>">Continue Shopping</a>
                                    </div>
                                </div> -->
                            <?php } ?>
                            <div class="table_desc" style="display:none">
                                <div class="cart_page table-responsive">
                                    <table>
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <!-- <th class="product_remove">Delete</th> -->
                                                <th class="product_thumb">Image</th>
                                                <th class="product_name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product_quantity">Quantity</th>
                                                <th class="product_total">Total</th>
                                                <th class="product_total">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="product_thumb"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><img src="<?php echo $img; ?>" alt=""></a></td>
                                                <td class="product_name"><a href="<?php echo base_url(); ?>web/product_view/<?php echo $product1->seo_url; ?>" ><?php echo $product1->name; ?></a><br>

                                                    <?php /* <p class="mb-0"><a href="<?php echo base_url(); ?>web/store/<?php echo $shopdat->seo_url; ?>/shop"><b>Shop Name :</b> <?php echo $shopdat->shop_name; ?></a></p>

                                                      <p><b>Location:</b><?php echo $shopdat->city; ?></p> */ ?>
                                                </td>
                                                <td class="product-price"><i class="fal fa-rupee-sign"></i> <?php echo $value->price; ?></td>
                                        <form class="form-horizontal" enctype="multipart/form-data"  >
                                            <td class="product_quantity"><label></label>
                                                <a  onclick="decreaseQuantity(<?php echo $value->id; ?>)"><i class="fas fa-minus"></i></a>
                                                <input min="0" max="100" name="quantity" id="quantity<?php echo $value->id; ?>" value="<?php echo $value->quantity; ?>" type="text" readonly>
                                                <a onclick="increaseQuantity(<?php echo $value->id; ?>)"><i class="fas fa-plus"></i></a>
                                                <div id="quantityshow<?php echo $value->id; ?>"></div>
                                            </td>
                                            <td class="product_total"><i class="fal fa-rupee-sign"></i> <?php echo $value->unit_price; ?></td>
                                            <td>
                                                <a onclick="deletecartitems(<?php echo $value->id; ?>)" class="remove-item"><i class="fal fa-trash-alt"></i></a>
                                            </td>
                                        </form>
                                        </tr>

                                        <tr>
                                            <td colspan="6">
                                                <a class="btn pink-btn float-right" href="<?php echo base_url(); ?>">Continue Shopping</a>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <?php if (sizeof($result) == 0) { ?>
                            <center>
                            <div class="cart_page" style=" display: flex;
            justify-content: center;
            align-items: center; margin: 0;
            padding: 0;">
                                <div class="col-lg-12">
                                    <a class="btn-cnt-shopping" href="<?php echo base_url(); ?>" style=" position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);">START SHOPPING!</a>
                                </div>
                            </div><br><br><br><br><br><br><br><br><br><br><br>
                            </center> 
                        <?php } ?>
                        <?php if (sizeof($result) > 0) { ?>
                            <div class="col-lg-4 col-md-4 box" style="display: none;">
                            <h4 style="font-weight: 900;padding-left:10px;">Order Summary</h4><br>
                                <div class="coupon_code left">
                                    <!-- <h3><i class="fal fa-tag"></i> Apply Coupon</h3> -->

                                    <div class="coupon_inner">
                                        <!-- <p class="pl-3">Enter coupon code.</p> -->
                                        <div id="coupon_msg"></div>

                                        <form class="form-horizontal d-flex pl-3" enctype="multipart/form-data"  >
                                            <input placeholder="Coupon code" id="couponcode" type="text">
                                            <button type="button" class="apply" onclick="validatecouponcode()">Apply</button>
                                            <button type="button" class="remove" onclick="remove()" style="display:none">Remove</button>
                                        </form>
                                    </div>

                                    <?php
                                    $coupons = $this->getCouponcodes($user_id, $session_id);
                                    if (count($coupons) > 0) {
                                        ?>
                                        <div class="row justify-content-center" id="show_button">
                                            <div class="">
                                                <a  class="btn-viewcoup mr-3" onclick="showhide()"style="color: #2556B9;float:right;text-align:right;text-decoration:underline;padding-right:15px;">View Coupon</a>
                                            </div>
                                        </div>
                                        <!-- <div class="row justify-content-center" id="close_button" style="display: none;">
                                            <div class="">
                                                <a  class="btn-viewcoup mr-3" onclick="closecoupon()">Hide Coupons</a>
                                            </div>
                                        </div> -->
                                    <?php } ?>
                                </div>
                                <div class="couponlist-box modal" id="viewcoup">
                                <div class="modal-dialog">

<div class="modal-content">

    <div class="modal-body">
    <button type="button" class="btn-close" onclick="closeModalBox()" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
    <h4>Apply Coupon</h4>
    <?php if (sizeof($result) > 0) { ?>
    <div class="coupon_inner">
                                    <!-- <p class="pl-3">Enter coupon code.</p> -->
                                    <div id="coupon_msg"></div>

                                    <form class="form-horizontal d-flex pl-2" enctype="multipart/form-data"  >
                                        <input placeholder="Coupon Code" class="couponcode" type="text"  autocomplete="off" readonly="">
                                        <button type="button" class="apply" onclick="validatecouponcode()">Apply</button>
                                        
                                        <button type="button" class="remove" onclick="remove()" style="display:none">Remove</button>
                                    </form>
                                    <!-- <a data-toggle="modal"  onclick="showhide()" data-target="#viewcoup" style="color: #2556B9;;text-align:right;text-decoration:underline;padding-right:55px;">View Coupon</a> -->
    </div>
<?php }?>

<?php foreach ($coupons as $coup) { ?>
    <div class="row">
        <div style="display:flex;gap:1.2rem;">
            <div>
                <form class="form-horizontal">
                    <!-- Use a unique identifier for each checkbox -->
                    <!-- <input type="checkbox" name="mycheck" class="coupon-checkbox" id="myInput<?php echo $coup['id']; ?>"
                        value="<?php echo $coup['coupon_code']; ?>"
                        onchange="(this.checked) ? applyCouponcode('<?php echo $coup['coupon_code']; ?>') : remove('<?php echo $coup['coupon_code']; ?>')"> -->

                        <input type="checkbox" name="mycheck" class="coupon-checkbox" id="myInput<?php echo $coup['id']; ?>"
                        value="<?php echo $coup['coupon_code']; ?>"
       onchange="(this.checked) ? $('.couponcode').val('<?php echo $coup['coupon_code']; ?>') : $('.couponcode').val(''); this.enabled = this.checked;" style="text-align:center;justify-content: center;align-items: center;margin-top:10px;">

                        <!-- <h6><input type="text" style="width: 100px; border: none; background: none; cursor: pointer" value="<?php echo $coup['coupon_code']; ?>" id="myInput<?php echo $coup['id']; ?>" onclick="applyCouponcode('<?php echo $coup['coupon_code']; ?>')" title="Apply this coupon" class="coupontoggle" readonly=""></h6> -->
            </div>
            <div>
                <h6><input type="text" class="myinput" value="<?php echo $coup['coupon_code']; ?>" id="myInput<?php echo $coup['id']; ?>" readonly=""></h6>
                </form>
            </div>
        </div>
        <h5><?php echo $coup['percentage']; ?>% OFF</h5>
        <p><strong><?php echo $coup['description']; ?></strong></p>
    </div>
<?php } ?>

<!-- <script>
    // JavaScript code to handle checkbox interactions
    const checkboxes = document.querySelectorAll('.coupon-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                checkboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                       
                    }
                });
            }
        });
    });
//     
</script> -->

<div class="coupon_inner">
                                <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer;float:left;" title="Remove Coupon"></p>
                                <button type="button" style="float:right;width: 150px;height: 40px;background: var(--unnamed-color-2556b9) 0% 0% no-repeat padding-box;background: #2556B9 0% 0% no-repeat padding-box;border-radius: 25px;opacity: 1;" class="apply1" onclick="validatecouponcode()">Apply</button>
                                </div>

                            
                                    </div></div></div>
                                </div>
                                <div class="coupon_code right" style="display: block;">
                                    <!-- <h3 class="pb-2"><i class="fal fa-shopping-bag"></i> Cart Totals</h3> -->
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Subtotal</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i> <?php echo number_format($unitprice, 2); ?></p>
                                            <input type="hidden" id="sub_total" value="<?php echo $unitprice; ?>" >
                                        </div>
                                        <div class="cart_subtotal ">
                                            <p>Shipping Charges</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i>  <?php echo number_format($shipping_charge, 2); ?></p>
                                            <input type="hidden" id="min_order_amount" value="<?php echo $shipping_charge; ?>" >
                                        </div>
                                        <div class="cart_subtotal">
                                            <p>GST</p>
                                            <p class="cart_amount" id="gst"><i class="fal fa-rupee-sign"></i> <?= number_format($gst, 2) ?></p>
                                        </div>
                                        <div class="cart_subtotal">
                                            <p>Discount</p>
                                            <p id="couponName" style="color:#0857c0;font-weight: bold;display: none; cursor: pointer" title="Remove Coupon" onclick="remove()"></p>
                                            <p class="cart_amount" id="discount"><i class="fal fa-rupee-sign"></i> 0</p>
                                        </div>
                                        <div class="cart_subtotal" id="total_default">
                                            <p>Total</p>
                                            <p class="cart_amount"><i class="fal fa-rupee-sign"></i> <input type="hidden" id="cart_total" value="<?php echo $grand_t; ?>" > <?php echo number_format($grand_t, 2); ?></p>
                                        </div>
                                        <div class="cart_subtotal" id="total_default_show" style="display: none;">
                                            <p>Total</p>
                                            <p class="cart_amount" id="total_p"><?php echo number_format($grand_t, 2); ?></p>
                                        </div>
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>web/goaddress_page">
                                            <input type="hidden" name="coupon_id" id="coupon_id" value="0">
                                            <input type="hidden" name="applied_coupon_code" id="applied_coupon_code" value="0">
                                            <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
                                            <input type="hidden" name="gst" value="<?php echo $gst; ?>">
                                            <div class="checkout_btn">
                                                <button type="submit">Proceed to Checkout</button>
                                            </div>
                                        </form>

                                                                                                                                                                                                                                                                                                                                                                                                                                                           <!-- <p class="bid-text"><a data-toggle="modal" onclick="doBidProducts()">BID ABOVE PRODUCTS </a> <a href="#bidModal" data-toggle="modal" class="text-dark"><i class="fal fa-comment-exclamation"></i></a></p> -->

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
</div>
               
</div>       

            <?php
        } else {

            echo '@error';
            die;
        }
    }

    function applyCoupon($coupon_code, $session_id, $grand_total, $total_amount, $user_id,$products) {
        
     

        $date = date("Y-m-d");

        $chk_qry = $this->db->query("select * from cash_coupons where user_id='" . $user_id . "' and coupon_code='" . $coupon_code . "'  and ( start_date<='" . $date . "' and expiry_date>='" . $date . "' )");
        
            // print_r($ar2);
        // exit;
       

        if ($chk_qry->num_rows() > 0) {

            $chk_cash_coupon_row = $chk_qry->row();

            $discount = $chk_cash_coupon_row->amount;

            if ($grand_total > $discount) {

                $final_amount = $grand_total - $discount;
            } else {

                $final_amount = 0;
            }



            echo '@success@' . $final_amount . '@' . $discount . '@' . $chk_cash_coupon_row->id . '@' . $coupon_code;
            die;

            // return array('status' =>TRUE,'message'=>"Coupon Applied successfully",'grand_total' =>$final_amount,'discount' =>$discount,'coupon_id'=>$chk_cash_coupon_row->id,'coupon_code'=>$coupon_code);
        } else {


            $date = date("Y-m-d");

            $qry = $this->db->query("select * from coupon_codes where coupon_code='" . $coupon_code . "' and ( start_date<='" . $date . "' and expiry_date>='" . $date . "' )");

            if ($qry->num_rows() > 0) {

                $row = $qry->row();

                $order_qry = $this->db->query("select * from orders where user_id='" . $user_id . "' and coupon_id='" . $row->id . "' group by session_id");

                $order_num_rows = $order_qry->num_rows();

                if ($order_num_rows >= $row->utilization) {
                    echo '@error';
                } else {
                    $brand_matched = false; // Variable to track if any brand matches with the coupon brand

foreach ($products as $product) {
    $brands = json_decode($row->brands, true);
   
    foreach($brands as $brand){
    if ($brand == $product['brand_name']) {
        // print_r($product['brand_name']);
        // exit;
        // Brand matches with the coupon brand
        $brand_matched = true;

        $minimum_order_amount = $row->minimum_order_amount;

        if ($grand_total >= $minimum_order_amount) {
            $cprice = $row->maximum_amount;
            $percentage = $row->percentage;

            $dis_percentage += ($product['price'] / 100) * $percentage;
        }

        if ($cprice < round($dis_percentage)) {
            $final_amount = $grand_total - $cprice;
            $discount = $cprice;
        } else {
            if ($grand_total < round($dis_percentage)) {
                $final_amount = 0;
                $discount = number_format($cprice, 2);
            } else {
                $final_amount = $grand_total - $dis_percentage;
                $discount = $dis_percentage;
            }
        }
       
    }
    
}
   
}
if($brand_matched){
    echo '@success@' . $final_amount . '@' . $discount . '@' . $row->id . '@' . $coupon_code . '@' . $row->percentage;
    die;
}
// If none of the brands match with the coupon brand, apply default discount logic
if (!$brand_matched) {
    // Apply your default discount logic here
    $minimum_order_amount = $row->minimum_order_amount;

    if ($grand_total >= $minimum_order_amount) {
        $cprice = $row->maximum_amount;
        $percentage = $row->percentage;

        $dis_percentage = ($grand_total / 100) * $percentage;

        if ($cprice < round($dis_percentage)) {
            $final_amount = $grand_total - $cprice;
            $discount = $cprice;
        } else {
            if ($grand_total < round($dis_percentage)) {
                $final_amount = 0;
                $discount = number_format($cprice, 2);
            } else {
                $final_amount = $grand_total - $dis_percentage;
                $discount = $dis_percentage;
            }
        }

        echo '@success@' . $final_amount . '@' . $discount . '@' . $row->id . '@' . $coupon_code . '@' . $row->percentage;
        die;
    } else {
        echo '@minorder@' . $minimum_order_amount;
    }
}

                }
            } else {

                echo '@error';
            }
        }
    }

    function getCouponcodes($user_id, $session_id,$brands_array,$total_cart_amount) {
       
    //    print_r($brands_array);
    //    exit;
        $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "' group by session_id");
        
        $cart_row = $cart_qry->row();

        $shop_id = $cart_row->vendor_id;

        $date = date("Y-m-d");

        $cashcoupon_qry = $this->db->query("select * from cash_coupons where user_id='" . $user_id . "' and ( start_date<='" . $date . "' and expiry_date>='" . $date . "' )");
       

        $cashcoupon_result = $cashcoupon_qry->result();

        $ar1 = [];

        foreach ($cashcoupon_result as $value) {

            $order_qry1 = $this->db->query("select * from orders where user_id='" . $user_id . "' and coupon_id='" . $value->id . "'");

            $order_num_rows1 = $order_qry1->num_rows();

          

            if ($order_num_rows1 > 0) {
                
            } else {

                $ar1[] = array('id' => $value->id, 'coupon_code' => $value->coupon_code, 'description' => $value->description, 'percentage' => $value->percentage, 'maximum_amount' => $value->amount, 'minimum_order_amount' => "");
            }
        }

        $order_qry_user = $this->db->query("SELECT * FROM orders WHERE user_id='" . $user_id . "'");
        $order_row_user = $order_qry_user->num_rows();
        $user = $this->db->get_where('users', array('id' => $user_id))->row_array();

        $existing_tags = json_decode($user['Tag'], true);
        
        // Query coupons based on existing tags
        $qry = $this->db->query("
            SELECT * FROM coupon_codes WHERE 
            (shop_id = '" . $shop_id . "' OR shop_id = 0) AND 
            (start_date <= '" . $date . "' AND expiry_date >= '" . $date . "' AND minimum_order_amount <= '" . $total_cart_amount . "') 
        ");
        
        $coupons_related = $qry->result();
        
        $data_coupon = []; // Initialize an array to store all matching data_coupon values
        $brand_coupon = [];
        foreach ($coupons_related as $res) {
            $coup = json_decode($res->Tag, true); // Decode as associative array
            if ($coup !== null && is_array($coup)) {
                // Check if $coup is not null and is an array
                $matched = false; // Variable to track if any tags match existing tags
                foreach ($coup as $tag) {
                    if (is_array($existing_tags) && in_array($tag, $existing_tags)) {
                        // Check if $existing_tags is an array before using in_array()
                        $matched = true;
                        break; // Exit the loop once a match is found
                    }
                }
                if ($matched) {
                    $data_coupon[] = $coup; // Add the matching data_coupon to the array
                }
            }
        
            $existingbrands = $brands_array;
            $brands = json_decode($res->brands, true);
            if ($brands !== null && is_array($brands)) {
                // Check if $brands is not null and is an array
                $matched_brand = false;
                foreach ($brands_array as $brand) {
                    if (is_array($existingbrands) && in_array($brand, $brands)) {
                        // Check if $existingbrands is an array before using in_array()
                        $matched_brand = true;
                        break; // Exit the loop once a match is found
                    }
                }
                if ($matched_brand) {
                    $brand_coupons[] = $brands; // Add the matching brand to the array
                }
            }
        }
        // print_r($brand_coupons);
        // exit;
        
        $data_coupons_flat = [];
        if (!empty($data_coupon)) {
            // Flatten the data_coupon array to extract unique tags
            $data_coupons_flat = array_merge(...$data_coupon);
            $data_coupons_flat = array_unique($data_coupons_flat);
        }
        
        // Ensure $brand_coupons is an array
        $brands_condition = "";
        if (!empty($brand_coupons)) {
            // Flatten the array and get unique brands
            $flattened_brands = array_unique(array_merge(...$brand_coupons));
            $brands_condition = "'" . implode("', '", $flattened_brands) . "'";
            $brands_condition = "brands IN ($brands_condition)";
        }
        
        // Construct the WHERE clause for tags
        $where_clause = "";
        if (!empty($data_coupons_flat)) {
            foreach ($data_coupons_flat as $tag) {
                $where_clause .= " OR JSON_CONTAINS(Tag, '\"$tag\"') ";
            }
            $where_clause = ltrim($where_clause, " OR");
        }
        
        // Construct the WHERE clause for brands
        $brands_where_clause = "";
        if (!empty($brand_coupons)) {
            foreach ($brand_coupons as $brand) {
                $brands_where_clause .= " OR JSON_CONTAINS(brands, '\"$brand\"') ";
            }
            $brands_where_clause = ltrim($brands_where_clause, " OR");
        }
        
        // Additional conditions
        $additional_conditions = "(Tag = '' OR Tag IS NULL OR JSON_LENGTH(Tag) = 0 OR Tag = '[]' OR Tag ='null')";
        $additional_brands = "(brands = '' OR brands IS NULL OR brands ='null' OR JSON_LENGTH(brands) = 0 OR brands = '[]')";
        
        // Construct the SQL query based on conditions
        if (!empty($where_clause) && !empty($brands_condition)) {
            // Condition 4: If both brand and tag are present
            $qry = $this->db->query("
                SELECT * FROM coupon_codes WHERE 
                (shop_id = '" . $shop_id . "' OR shop_id = 0) 
                AND 
                (start_date <= '" . $date . "' AND expiry_date >= '" . $date . "') 
                AND (($where_clause)
                OR   ($additional_conditions)
                OR   ($additional_brands)
                AND   ($brands_where_clause))
            ");
        }
        
        
        elseif (!empty($where_clause) && empty($brands_condition)) {
            // Condition 2: If only tag is present
            $qry = $this->db->query("
                SELECT * FROM coupon_codes WHERE 
                (shop_id = '" . $shop_id . "' OR shop_id = 0) AND 
                (start_date <= '" . $date . "' AND expiry_date >= '" . $date . "') 
                AND (($where_clause) OR $additional_conditions) AND $additional_brands
            ");
        } elseif (!empty($brands_condition) && empty($where_clause)) {
            $qry = $this->db->query("
                SELECT * FROM coupon_codes WHERE 
                (shop_id = '" . $shop_id . "' OR shop_id = 0) AND 
                (start_date <= '" . $date . "' AND expiry_date >= '" . $date . "') 
                AND (($brands_condition) 
                OR $additional_conditions 
                OR NOT ($additional_brands))
            ");
        }
         else {
            // Condition 3: If both brand and tag are absent
            $qry = $this->db->query("
                SELECT * FROM coupon_codes WHERE 
                (shop_id = '" . $shop_id . "' OR shop_id = 0) AND 
                (start_date <= '" . $date . "' AND expiry_date >= '" . $date . "') 
                AND (($additional_conditions OR $additional_brands) AND($additional_conditions AND $additional_brands))
            ");
        }
        
        // Get the result of the query
        $dat = $qry->result();
        // echo "<pre>";
        // print_r($dat);
        // exit;
// foreach ($dat as $value) {
//     $brands_decode = json_decode($value->brands);
    
//     // Check if brands are null or empty
//     if (empty($brands_decode)) {
//         print("Coupon accepted (no specified brands)<br>");
//         continue; // Skip to the next coupon
//     }
    
//     // Check if any brand from $brands_array matches with the decoded brands
//     $match_found = false;
//     foreach ($brands_array as $brand) {
//         if (in_array($brand, $brands_decode)) {
//             $match_found = true;
//             break;
//         }
//     }
    
//     if ($match_found) {
//         print("Coupon accepted (matching brands)<br>");
//     } else {
//         print("Coupon skipped (no matching brands)<br>");
//     }
// }
// exit;

        
        
                            // } 
     

        
        if ($qry->num_rows() > 0) {
            $ar = [];
            // echo "<pre>";
            foreach ($dat as $value) {
                
                $brands_decode = json_decode($value->brands);
    
    // Convert null to an empty array
                if ($brands_decode === null) {
                    $brands_decode = [];
                }
    
    // Check if brands are empty
    // if (empty($brands_decode)) {
    //     // print("Coupon accepted (no specified brands)<br>");
    //     continue; // Skip to the next coupon
    // }
    
    // Check if any brand from $brands_array matches with the decoded brands
                $match_found = false;
                foreach ($brands_array as $brand) {
                    if (in_array($brand, $brands_decode)) {
                        $match_found = true;
                        break;
                    }
                }
                
                // if ($match_found) {
                //     print("Coupon accepted (matching brands)<br>");
                // } else {
                //     print("Coupon skipped (no matching brands)<br>");
                // }
            if($match_found || empty($brands_decode)){
            $order_qry = $this->db->query("SELECT * FROM orders WHERE user_id='" . $user_id . "' AND coupon_id='" . $value->id . "'");
            $order_row2 = $order_qry->row();
    
                $count_qry = $this->db->query("SELECT limit_user FROM coupon_codes WHERE id='" . $value->id . "' AND coupon_code='" . $value->coupon_code . "'");
                $res = $count_qry->row();
                $limit_user = ($res) ? $res->limit_user : 0;
                $count = 0;
                
                
        
                $order_row = $order_qry->row();
                $order_num_rows = $order_qry->num_rows();
                $order_result=$order_qry->result();
                // echo "<pre>";
            //   $custom_count=0;
                foreach($order_result as $re){
                    // print_r($re->coupon_code);
                    if($re->coupon_code == $value->coupon_code){

                    $ins = $this->db->insert("custom_coupons", array('user_id' => $user_id, 'coupon_name' => $value->coupon_code, 'count' => 1));
                    }
                    $count_custom_qry= $this->db->query("SELECT count,coupon_name FROM custom_coupons WHERE user_id='" . $user_id . "' AND coupon_name='" . $re->coupon_code . "'");
                    // echo "<pre>";
                    $custom_res=$count_custom_qry->result();
                    
                  
                }
                if($limit_user>= $order_num_rows){
                $this->db->where(array('user_id' => $user_id, 'coupon_name' => $value->coupon_code));
                $this->db->update('custom_coupons', array('count' => $order_num_rows));
               
                }
        
                if ($order_num_rows >= $limit_user || $order_num_rows >= $value->utilization) {
                   
                   
            
                        // Insert into custom_coupons table for the first time
                       
                }
              
                else {
                    $ar[] = array(
                        'id' => $value->id,
                        'coupon_code' => $value->coupon_code,
                        'description' => $value->description,
                        'percentage' => $value->percentage,
                        'maximum_amount' => $value->maximum_amount,
                        'minimum_order_amount' => $value->minimum_order_amount,
                        'image'=>$value->image
                    );
                }
            }
            }
          
        if (count($ar) > 0) {
            $result = array_merge($ar, $ar1);
            return $result;
        } else {
            if (count($ar1) > 0) {
                return $ar1;
            } else {
                return array();
            }
        }
    } else {
        if (count($ar1) > 0) {
            return $ar1;
        } else {
            return array();
        }
    }
   
    }

    function onesignalnotification($vendor_id, $title, $message) {

        $qr = $this->db->query("select * from vendor_shop where id='" . $vendor_id . "'");

        $res = $qr->row();

        if ($res->token != '') {



            $user_id = $res->token;

            $fields = array(
                'app_id' => '060fc2b8-3d44-4c82-b285-1d3f058f3e2b',
                'include_player_ids' => [$user_id],
                'contents' => array("en" => $message),
                'headings' => array("en" => $title),
                'android_channel_id' => '0646f8b2-a151-443f-ac3a-547061134d54'
            );

            $fields = json_encode($fields);

            //print("\nJSON sent:\n");
            //print($fields);



            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic NzhjMmI5YjItZmViMy00YjNlLWFlMDItY2ZiZTI3OTY0YzYz'
            ));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);

            curl_close($ch);

            //print_r($response); die;
        }
    }

    function getShopdata($shop_id) {

        $qry = $this->db->query("select * from vendor_shop where id='" . $shop_id . "'");

        return $qry->row();
    }

    function checkProductQTY($product_id, $session_id, $user_id) {

        if ($user_id == 'guest') {

            return '1';
        } else {

            $variant = $this->db->query("select * from link_variant where product_id='" . $product_id . "' and status=1 ");

            $variant_row = $variant->row();

            $qry = $this->db->query("select * from cart where session_id='" . $session_id . "' and variant_id='" . $variant_row->id . "' and user_id='" . $user_id . "'");

            if ($qry->num_rows() > 0) {

                $cart_row = $qry->row();

                return $cart_row->quantity;
            } else {

                return '1';
            }
        }
    }

    function add_removewhishList($variant_id, $user_id) {

        $qry = $this->db->query("select * from whish_list where variant_id='" . $variant_id . "' and user_id='" . $user_id . "'");

        if ($qry->num_rows() > 0) {

            $upd = $this->db->delete("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id));

            if ($upd) {

                //return array('status' =>TRUE, 'message'=>"Removed from the Favourites");

                echo '@remove';
                die;
            }
        } else {

            $ins = $this->db->insert("whish_list", array('variant_id' => $variant_id, 'user_id' => $user_id));

            if ($ins) {

                //return array('status' =>TRUE, 'message'=>"Added to Favourites");

                echo '@add';
                die;
            }
        }
    }

    function getTopDealscount($user_id, $new_arrival = null) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        if ($new_arrival == null) {
            $dat = $this->common_model->get_data_with_condition(['top_deal' => 'yes', 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
        } else {
            $dat = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
        }

        $ar = [];

        foreach ($dat as $value) {
            $category = $this->common_model->get_data_row(['id' => $value->cat_id, 'status' => 1], 'categories');
            if ($category) {
                $shop = $this->common_model->get_data_row(['id' => $value->shop_id, 'status' => 1], 'vendor_shop');
                if ($shop) {
                    $variants = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                    if (sizeof($variants) > 0) {
                        $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;
                        $im = $this->db->query("select * from product_images where variant_id='" . $variants[0]->id . "' order by priority asc");
                        $images = $im->row();
                        if ($images->image != '') {
                            $img = base_url() . "uploads/products/" . $images->image;
                        } else {
                            $img = base_url() . "uploads/noproduct.png";
                        }
                        $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                        $subcategory = $subcat->row();

                        $wish = $this->db->query("select * from whish_list where variant_id='" . $variants[0]->id . "' and user_id='" . $user_id . "'");

                        if ($wish->num_rows() > 0) {

                            $stat = true;
                        } else {

                            $stat = false;
                        }
                        // echo "<pre>";
                        // print_r($variants[0]->stock);
                        // exit;
                        $cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;
                        if ($new_arrival == null) {
                            $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url,'stock'=>$variants[0]->stock,'cart_limit'=>$cart_limit);
                        } else {
                            $date = strtotime("-30 day");
                            if ($value->created_at >= $date) {
                                $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url,'stock'=>$variants[0]->stock,'cart_limit'=>$cart_limit);
                            }
                        }
                    }
                }
            }
        }

        return sizeof($ar);
    }

    function getAllTopDeals($limit, $start, $user_id, $new_arrival = null) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        // $this->db->limit($limit, $start);

        if ($new_arrival == null) {

            $this->db->limit($limit, $start);
            $dat = $this->common_model->get_data_with_condition(['top_deal' => 'yes', 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
        } else {
            // $this->db->limit($limit, $start);
            $dat = $this->common_model->get_data_with_condition(['status' => 1, 'availabile_stock_status' => 'available'], 'products');
            // $dat = $this->db->where(['status' => 1, 'availabile_stock_status' => 'available'])->get('products')->result();
        }

        if (sizeof($dat) > 0) {

            $ar = [];

            foreach ($dat as $value) {
                // print_r($value->id);
                // exit;
                $pro_qry=$this->db->query("select orders_placed from products where id='".$value->id."'");
                $pro_res=$pro_qry->row();
                $category = $this->common_model->get_data_row(['id' => $value->cat_id, 'status' => 1], 'categories');
                // $row->rating=$this->Web_model->rating_data($value->id);

                if ($category) {
                    $shop = $this->common_model->get_data_row(['id' => $value->shop_id, 'status' => 1], 'vendor_shop');
                    if ($shop) {
                        $variants = $this->common_model->get_data_with_condition(['product_id' => $value->id, 'stock >' => 0, 'status' => 1], 'link_variant');
                        if (sizeof($variants) > 0) {

                            $value->brand = ($this->common_model->get_data_row(['id' => $value->brand, 'status' => 1], 'attr_brands'))->brand_name;
                            $im = $this->db->query("select * from product_images where variant_id='" . $variants[0]->id . "' order by priority asc");
                            $images = $im->row();
                            if ($images->image != '') {
                                $img = base_url() . "uploads/products/" . $images->image;
                            } else {
                                $img = base_url() . "uploads/noproduct.png";
                            }
                            $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                            $subcategory = $subcat->row();

                            $wish = $this->db->query("select * from whish_list where variant_id='" . $variants[0]->id . "' and user_id='" . $user_id . "'");

                            if ($wish->num_rows() > 0) {

                                $stat = true;
                            } else {

                                $stat = false;
                            }
                            // echo "<pre>";
                            // print_r($variants);
                            // exit;

                            //check already in cart or not
                            $session_id = $_SESSION['session_data']['session_id'];
                            $in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $variants[0]->id])->get('cart')->num_rows();
                            $cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;
                            $rating=$this->web_model->rating_data($value->id);
                            if ($new_arrival == null) {
                                $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'in_cart' => $in_cart,'rating'=>$rating,'stock'=>$variants[0]->stock,'orders_placed'=>$pro_res->orders_placed,'cart_limit'=>$cart_limit);
                            } else {
                                $date = strtotime("-30 day");
                                // pr(date('Y-m-d',$date));
                                // pr(date('Y-m-d',$value->created_at));
                                if ($value->created_at >= $date) {
                                    $ar[] = array('id' => $value->id, 'variant_id' => $variants[0]->id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $value->name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $shop->shop_name, 'price' => $variants[0]->price, 'saleprice' => $variants[0]->saleprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'seo_url' => $value->seo_url, 'in_cart' => $in_cart,'rating'=>$row->rating,'stock'=>$variants[0]->stock,'orders_placed'=>$pro_res->orders_placed,'cart_limit'=>$cart_limit);
                                }
                            }
                        }
                    }
                }
            }
            return $ar;
        } else {                     
          
            return array();
        }
    }

    function getmostViewedProducts_count($user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT link_variant.id as variant_id ,link_variant.saleprice,link_variant.price,link_variant.stock,most_viewed_products.product_id,count(most_viewed_products.id) as cnt,products.*,vendor_shop.id as vendor_id,vendor_shop.shop_name FROM most_viewed_products INNER JOIN products ON products.id =most_viewed_products.product_id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id INNER JOIN link_variant ON link_variant.product_id=most_viewed_products.product_id WHERE products.status=1 and products.availabile_stock_status='available' and vendor_shop.status=1 and link_variant.saleprice!='0' and link_variant.status=1 and products.delete_status=0 GROUP by most_viewed_products.product_id order by most_viewed_products.id DESC LIMIT 10");
        //having distance<'".$search_distance."'
        return $qry->num_rows();
    }

    function getmostViewedProductsAll($limit, $start, $user_id) {

        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $qry = $this->db->query("SELECT * FROM `users` where id='" . $user_id . "'");

            $row = $qry->row();

            $lat = $row->lat;

            $lng = $row->lng;
        }

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $qry = $this->db->query("SELECT link_variant.id as variant_id ,link_variant.saleprice,link_variant.price,link_variant.stock,most_viewed_products.product_id,count(most_viewed_products.id) as cnt,products.*,vendor_shop.id as vendor_id,vendor_shop.shop_name FROM most_viewed_products INNER JOIN products ON products.id =most_viewed_products.product_id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id INNER JOIN link_variant ON link_variant.product_id=most_viewed_products.product_id WHERE products.status=1 and products.delete_status=0 and products.availabile_stock_status='available' and vendor_shop.status=1 and link_variant.saleprice!='0' and link_variant.status=1 GROUP by most_viewed_products.product_id order by most_viewed_products.id DESC LIMIT " . $start . "," . $limit);
        //having distance<'".$search_distance."'
        $dat = $qry->result();

        if ($qry->num_rows() > 0) {

            $ar = [];

            foreach ($dat as $value) {





                /* $qry1 = $this->db->query("SELECT * FROM `link_variant` where saleprice!='0' and status=1 and product_id='".$value->id."'");

                  $value12 = $qry1->row(); */



                $im = $this->db->query("select * from product_images where product_id='" . $value->id . "' and variant_id='" . $value->variant_id . "' order by priority asc");

                $images = $im->row();

                if ($images->image != '') {

                    $img = base_url() . "uploads/products/" . $images->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                $product_status = $this->db->where(array("id" => $images->product_id))->get("products")->row();

                $cat = $this->db->query("select * from categories where id='" . $value->cat_id . "'");

                $category = $cat->row();

                $subcat = $this->db->query("select * from sub_categories where id='" . $value->sub_cat_id . "'");

                $subcategory = $subcat->row();

                $state_id = $row->state_id;

                $city_id = $row->address_id;

                $pincode_id = $row->pincode_id;

                if ($value->status == 1) {

                    $shopstat = "Open";
                } else {

                    $shopstat = "Closed";
                }





                $wish = $this->db->query("select * from whish_list where variant_id='" . $value->variant_id . "' and user_id='" . $user_id . "'");

                if ($wish->num_rows() > 0) {

                    $stat = true;
                } else {

                    $stat = false;
                }

                if ($value->saleprice != '') {

                    $slaeprice = $value->saleprice;
                } else {

                    $slaeprice = 0;
                }



                if ($value->price != '') {

                    $price = $value->price;
                } else {

                    $price = 0;
                }



                $name = $value->name;
                if ($category->status == 1) {
                    $ar[] = array('id' => $value->id, 'variant_id' => $value->variant_id, 'shop_id' => $value->shop_id, 'variant_product' => $value->variant_product, 'name' => $name, 'category_name' => $category->category_name, 'subcategory_name' => $subcategory->sub_category_name, 'brand' => $value->brand, 'shop' => $value->shop_name, 'price' => $price, 'saleprice' => $slaeprice, 'image' => $img, 'availabile_stock_status' => $value->availabile_stock_status, 'whishlist_status' => $stat, 'shop_status' => $shopstat, 'distance' => round($value->distance), 'seo_url' => $value->seo_url, "product_status" => $product_status->status);
                }
            }



            return $ar;
        } else {

            return array();
        }
    }

    function getshopsWithcategoryID_count($cat_id, $subcatid, $user_id) {



        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $users = $this->db->query("select * from users where id='" . $user_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        }







        $qry = $this->db->query("select shop_id from admin_comissions where cat_id='" . $cat_id . "' and find_in_set('" . $subcatid . "',subcategory_ids) group by shop_id");

        $dat = $qry->result();

        $shop_ids = array_column($dat, 'shop_id');

        $shop_im = implode(",", $shop_ids);

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $shop_qry = $this->db->query("SELECT link_variant.id as variant_id,vendor_shop.*,products.status, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN products ON vendor_shop.id=products.shop_id INNER JOIN link_variant ON link_variant.product_id=products.id where find_in_set(vendor_shop.id,'" . $shop_im . "') and link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.status=1 and vendor_shop.status=1 and products.delete_status=0 group by products.shop_id order by distance asc");
        //having distance<".$search_distance."
        return $shop_qry->num_rows();
    }

    function getshopsWithcategoryID_storecat($limit, $start, $cat_id, $subcatid, $user_id) {



        if ($user_id == 'guest') {

            $guest_id = $_SESSION['userdata']['guest_user_id'];

            $users = $this->db->query("select * from guest_users where id='" . $guest_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        } else {

            $users = $this->db->query("select * from users where id='" . $user_id . "'");

            $users_row = $users->row();

            $lat = $users_row->lat;

            $lng = $users_row->lng;
        }







        $qry = $this->db->query("select shop_id from admin_comissions where cat_id='" . $cat_id . "' and find_in_set('" . $subcatid . "',subcategory_ids) group by shop_id");

        $dat = $qry->result();

        $shop_ids = array_column($dat, 'shop_id');

        $shop_im = implode(",", $shop_ids);

        $admin = $this->db->query("select * from admin where id=1");

        $search_distance = $admin->row()->distance;

        $shop_qry = $this->db->query("SELECT link_variant.id as variant_id,vendor_shop.*,products.status, ( 3959 * acos ( cos ( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('" . $lng . "') ) + sin ( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN products ON vendor_shop.id=products.shop_id INNER JOIN link_variant ON link_variant.product_id=products.id where find_in_set(vendor_shop.id,'" . $shop_im . "') and link_variant.saleprice!=0 and link_variant.stock > 0 and link_variant.status=1 and products.status=1 and vendor_shop.status=1 and products.delete_status=0 group by products.shop_id order by distance asc LIMIT " . $start . "," . $limit);
        if ($shop_qry->num_rows() > 0) {

            $shop_result = $shop_qry->result();
            $ar = [];
            foreach ($shop_result as $value) {

                if ($value->shop_logo != '') {
                    $img = base_url() . "uploads/shops/" . $value->shop_logo;
                } else {
                    $img = base_url() . "uploads/noproduct.png";
                    ;
                }

                $shop_qry = $this->db->query("select * from shop_favorites where shop_id='" . $value->id . "' and user_id='" . $user_id . "'");
                if ($shop_qry->num_rows() > 0) {
                    $shop_not = true;
                } else {
                    $shop_not = false;
                }



                $pro = $this->db->query("SELECT * from products where shop_id='" . $value->id . "' and delete_status=0");

                $product_total = $pro->num_rows();

                /* if($pro->num_rows()>0)

                  { */

                if ($value->status == 1) {

                    $stat = "Open";
                } else {

                    $stat = "Closed";
                }



                $ar[] = array('id' => $value->id, 'shop_name' => $value->shop_name, 'description' => $value->description, 'image' => $img, 'status' => $stat, 'shop_not' => $shop_not, 'distance' => round($value->distance), 'product_total' => $product_total, 'address' => $value->city, 'seo_url' => $value->seo_url);

                //}
            }

            return $ar;
        } else {

            return array();
        }
    }

    function createUserBid($ar) {



        if ($ar['grand_total'] < 10000) {

            echo '@minimum';
            die;
        } else {

            if ($ar['grand_total'] != '') {

                $ins = $this->db->insert('user_bids', $ar);

                if ($ins) {



                    $order_message = "Bid Placed : order ID :" . $ar['session_id'] . " amounting to Rs." . $ar['grand_total'] . ". from Dhukanam";

                    $user_sms_qry = $this->db->query("select * from users where id='" . $ar['user_id'] . "'");

                    $user_sms_row = $user_sms_qry->row();

                    $user_phone = $user_sms_qry->mobile;

                    /* if($this->send_message($order_message,$user_phone))

                      { */

                    $this->db->insert("sms_notifications", array('order_id' => $ar['session_id'], 'receiver_id' => $ar['vendor_id'], 'sender_id' => $ar['user_id'], 'created_at' => time(), 'message' => $order_message));

                    $this->session->unset_userdata('session_data');

                    /* } */

                    echo '@success';
                    die;

                    //return array('status' =>TRUE,'message'=>"Bid Created Successfully");
                } else {

                    echo '@error';
                    die;
                }
            }
        }
    }

    function mybids($user_id) {

        $qry = $this->db->query("select * from user_bids where user_id='" . $user_id . "' order by id desc");

        if ($qry->num_rows() > 0) {

            $result = $qry->result();

            $ar = [];

            foreach ($result as $bidds) {

                if ($bidds->bid_status == 0 || $bidds->bid_status == 1) {

                    $status = "Ongoing";
                } else if ($bidds->bid_status == 2) {

                    $status = "Completed";
                } else if ($bidds->bid_status == 3) {

                    $status = "Cancelled";
                }





                $cart = $this->db->query("select * from cart where session_id='" . $bidds->session_id . "'");

                $total_products = $cart->num_rows();

                if ($bidds->bid_status == 0) {

                    $bid_status = "Waiting for Bid";
                } else if ($bidds->bid_status == 1) {

                    $bid_status = "Bid accepted";
                } else if ($bidds->bid_status == 2) {

                    $bid_status = "Bid Completed";
                } else if ($bidds->bid_status == 3) {

                    $bid_status = "Bid Cancelled";
                }





                $quote = $this->db->query("select * from vendor_bids where bid_id='" . $bidds->id . "' and accept='yes'");

                $total_quotes = $quote->num_rows();

                $min_quote = $this->db->query("select MIN(total_price) as minbid from vendor_bids where bid_id='" . $bidds->id . "' and accept='yes'");

                $min_quote_row = $min_quote->row();

                if ($min_quote_row->minbid != '') {

                    $low_bid = $min_quote_row->minbid;
                } else {

                    $low_bid = 'N/A';
                }





                $cart_qry = $this->db->query("select * from cart where session_id='" . $bidds->session_id . "'");

                $cart_result = $cart_qry->result();

                $products_ar = [];

                foreach ($cart_result as $value) {

                    $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");

                    $product = $pro->row();

                    if ($product->image != '') {

                        $img = base_url() . "uploads/products/" . $product->image;
                    } else {

                        $img = base_url() . "uploads/noproduct.png";
                    }

                    //$value->variant_id

                    $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");

                    $link = $var1->row();

                    $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "' and delete_status=0");

                    $product1 = $pro1->row();

                    $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");

                    if ($adm_qry->num_rows() > 0) {

                        $adm_comm = $adm_qry->row();

                        $p_gst = $adm_comm->gst;
                    } else {

                        $p_gst = '0';
                    }



                    $class_percentage = ($value->unit_price / 100) * $p_gst;

                    $variants1 = $var1->result();

                    $att1 = [];

                    foreach ($variants1 as $value1) {







                        $jsondata = $value1->jsondata;

                        $values_ar = [];

                        $json = json_decode($jsondata);

                        foreach ($json as $value123) {

                            $type = $this->db->query("select * from attributes_title where id='" . $value123->attribute_type . "'");

                            $types = $type->row();

                            $val = $this->db->query("select * from attributes_values where id='" . $value123->attribute_value . "'");

                            $value1 = $val->row();

                            $values_ar[] = array('id' => $value1->id, 'title' => $types->title, 'value' => $value1->value);
                        }
                    }



                    $shop = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");

                    $shopdat = $shop->row();

                    $products_ar[] = array('id' => $value->id, 'price' => $value->price, 'quantity' => $value->quantity, 'unit_price' => $value->unit_price, 'image' => $img, 'attributes' => $values_ar, 'product_name' => $product1->name, 'shop_name' => $shopdat->shop_name, 'shop_id' => $value->vendor_id, 'gst' => $class_percentage);
                }





                $quote_qry = $this->db->query("select * from vendor_bids where bid_id='" . $bidds->id . "' and bid_status=1");

                $quote_result = $quote_qry->result();

                $quote_list = [];

                foreach ($quote_result as $val) {

                    $shop_q = $this->db->query("select * from vendor_shop where id='" . $val->vendor_id . "'");

                    $shop_row = $shop_q->row();

                    $qry = $this->db->query("select id,city_name from cities where id='" . $shop_row->city_id . "'");

                    $city = $qry->row();

                    $addrs = $shop_row->address . ", " . $city->city_name;

                    $date = date("d-m-Y h:i A", $val->created_at);

                    if ($val->accept == 'yes') {

                        $accept_status = 1;
                    } else {

                        $accept_status = 0;
                    }



                    if ($val->accept == 'yes') {

                        $finalstatus = 1;
                    }



                    $quote_list[] = array('id' => $val->id, 'bid_value' => $val->total_price, 'vendor_id' => $val->vendor_id, 'shop_name' => $shop_row->shop_name, 'shop_name' => $shop_row->shop_name, 'address' => $addrs, 'date' => $date, 'accept_status' => $accept_status);
                }







                $ar[] = array('id' => $bidds->id, 'order_status' => $status, 'session_id' => $bidds->session_id, 'total_products' => $total_products, 'bid_status' => $bid_status, 'recived_quotes' => $total_quotes, 'lowest_bid' => $low_bid, 'total_price' => $bidds->grand_total, 'products' => $products_ar, 'bidders_list' => $quote_list, 'finalstatus' => $bidds->bid_status);
            }



            return $ar;
        } else {

            return array();
        }
    }

    function mybidDetails($user_id, $bid) {

        $qry = $this->db->query("select * from user_bids where user_id='" . $user_id . "' and id='" . $bid . "' order by id desc");

        if ($qry->num_rows() > 0) {

            $bidds = $qry->row();

            if ($bidds->bid_status == 0 || $bidds->bid_status == 1) {

                $status = "Ongoing";
            } else if ($bidds->bid_status == 2) {

                $status = "Delivered";
            } else if ($bidds->bid_status == 3) {

                $status = "Cancelled";
            }





            $cart = $this->db->query("select * from cart where session_id='" . $bidds->session_id . "'");

            $total_products = $cart->num_rows();

            if ($bidds->bid_status == 0) {

                $bid_status = "Waiting for Bid";
            } else if ($bidds->bid_status == 1) {

                $bid_status = "Bid accepted";
            } else if ($bidds->bid_status == 2) {

                $bid_status = "Bid Completed";
            } else if ($bidds->bid_status == 3) {

                $bid_status = "Bid Cancelled";
            }





            $quote = $this->db->query("select * from vendor_bids where bid_id='" . $bidds->id . "' and bid_status=1");

            $total_quotes = $quote->num_rows();

            $min_quote = $this->db->query("select MIN(total_price) as minbid from vendor_bids where bid_id='" . $bidds->id . "' and bid_status=1");

            $min_quote_row = $min_quote->row();

            if ($min_quote_row->minbid != '') {

                $low_bid = $min_quote_row->minbid;
            } else {

                $low_bid = 'N/A';
            }





            $cart_qry = $this->db->query("select * from cart where session_id='" . $bidds->session_id . "'");

            $cart_result = $cart_qry->result();

            $products_ar = [];

            foreach ($cart_result as $value) {

                $pro = $this->db->query("select * from  product_images where variant_id='" . $value->variant_id . "' order by priority asc");

                $product = $pro->row();

                if ($product->image != '') {

                    $img = base_url() . "uploads/products/" . $product->image;
                } else {

                    $img = base_url() . "uploads/noproduct.png";
                }

                //$value->variant_id

                $var1 = $this->db->query("select * from link_variant where id='" . $value->variant_id . "'");

                $link = $var1->row();

                $pro1 = $this->db->query("select * from  products where id='" . $link->product_id . "' and delete_status=0");

                $product1 = $pro1->row();

                $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='" . $product1->cat_id . "' and shop_id='" . $value->vendor_id . "'");

                if ($adm_qry->num_rows() > 0) {

                    $adm_comm = $adm_qry->row();

                    $p_gst = $adm_comm->gst;
                } else {

                    $p_gst = '0';
                }



                $class_percentage = ($value->unit_price / 100) * $p_gst;

                $variants1 = $var1->result();

                $att1 = [];

                foreach ($variants1 as $value1) {







                    $jsondata = $value1->jsondata;

                    $values_ar = [];

                    $json = json_decode($jsondata);

                    foreach ($json as $value123) {

                        $type = $this->db->query("select * from attributes_title where id='" . $value123->attribute_type . "'");

                        $types = $type->row();

                        $val = $this->db->query("select * from attributes_values where id='" . $value123->attribute_value . "'");

                        $value1 = $val->row();

                        $values_ar[] = array('id' => $value1->id, 'title' => $types->title, 'value' => $value1->value);
                    }
                }



                $shop = $this->db->query("select * from vendor_shop where id='" . $value->vendor_id . "'");

                $shopdat = $shop->row();

                $products_ar[] = array('id' => $value->id, 'price' => $value->price, 'quantity' => $value->quantity, 'unit_price' => $value->unit_price, 'image' => $img, 'variant_id' => $value->variant_id, 'attributes' => $values_ar, 'product_name' => $product1->name, 'shop_name' => $shopdat->shop_name, 'shop_id' => $value->vendor_id, 'gst' => $class_percentage, 'vendor_id' => $value->vendor_id);
            }





            $quote_qry = $this->db->query("select * from vendor_bids where bid_id='" . $bidds->id . "' and bid_status=1");

            $quote_result = $quote_qry->result();

            $quote_list = [];

            foreach ($quote_result as $val) {

                $shop_q = $this->db->query("select * from vendor_shop where id='" . $val->vendor_id . "'");

                $shop_row = $shop_q->row();

                $qry = $this->db->query("select id,city_name from cities where id='" . $shop_row->city_id . "'");

                $city = $qry->row();

                $addrs = $shop_row->address . ", " . $city->city_name;

                $date = date("d-m-Y h:i A", $val->accept_at);

                if ($val->accept == 'yes') {

                    $accept_status = 1;
                } else {

                    $accept_status = 0;
                }



                if ($val->accept == 'yes') {

                    $finalstatus = 1;
                }



                $quote_list[] = array('id' => $val->id, 'bid_value' => $val->total_price, 'vendor_id' => $val->vendor_id, 'shop_name' => $shop_row->shop_name, 'shop_name' => $shop_row->shop_name, 'address' => $addrs, 'date' => $date, 'accept_status' => $accept_status);
            }







            $ar = array('id' => $bidds->id, 'order_status' => $status, 'session_id' => $bidds->session_id, 'total_products' => $total_products, 'bid_status' => $bid_status, 'recived_quotes' => $total_quotes, 'lowest_bid' => $low_bid, 'total_price' => $bidds->grand_total, 'products' => $products_ar, 'bidders_list' => $quote_list, 'finalstatus' => $bidds->bid_status);

            return $ar;
        } else {

            return array();
        }
    }

    function createBid($bid) {

        $ar = array('bid_status' => 3);

        $wr = array('id' => $bid);

        $upd = $this->db->update("user_bids", $ar, $wr);

        if ($upd) {

            echo '@success';
            die;

            //return array('status' =>TRUE, 'message'=>"Bid Cancelled Successfully");
        } else {

            echo '@error';
            die;

            //return array('status' =>FALSE, 'message'=>"Something Went wrong");
        }
    }

    function insertRating($pid, $order_id, $vendor_id, $user_id, $rating, $comments, $createdat) {

        $array = array("product_id" => $pid, "user_id" => $user_id, "vendor_id" => $vendor_id, "order_id" => $order_id, "review" => $rating, "comments" => $comments, "createdat" => $createdat);

        $data = $this->db->insert("user_reviews", $array);
        //echo $this->db->last_query(); die;
        if ($data) {
            echo '@success';
            die;
        } else {
            echo '@error';
            die;
        }
    }

    function re_addToCart($variant_id, $vendor_id, $user_id, $price, $quantity, $session_id) {

        $chk_quant_qry = $this->db->query("select * from link_variant where id='" . $variant_id . "'");

        $chk_quant_row = $chk_quant_qry->row();

        $stock = $chk_quant_row->stock;

        $chk = $this->db->query("select * from cart where session_id='" . $session_id . "'");

        if ($chk->num_rows() > 0) {

            $qry_chk = $this->db->query("select * from cart where session_id='" . $session_id . "' and user_id='" . $user_id . "' and variant_id='" . $variant_id . "'");

            if ($qry_chk->num_rows() > 0) {

                $row = $qry_chk->row();
                $qty = $row->quantity;
                $quantity_f = $quantity + $qty;
                if ($stock < $quantity_f) {
                    $msg = "Left only " . $stock . " Products";
                    echo '@error';
                    die;
                    //return array('status' =>FALSE,'message'=>$msg);
                }


                $un_pric = $price * $quantity_f;

                $ar = array('quantity' => $quantity_f, 'unit_price' => $un_pric);

                $wr = array('session_id' => $session_id, 'variant_id' => $variant_id, 'vendor_id' => $vendor_id, 'user_id' => $user_id);

                $ins = $this->db->update("cart", $ar, $wr);
                if ($ins) {

                    $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "'");

                    $cart_count = $cart_qry->num_rows();
                    echo '@success@' . $cart_count . '@' . $session_id;
                    die;
                }
            } else {

                if ($stock < $quantity) {

                    $msg = "Left only " . $stock . " Products";

                    echo '@error';
                    die;
                }

                $tprice = $price * $quantity;

                $ar = array('session_id' => $session_id, 'variant_id' => $variant_id, 'vendor_id' => $vendor_id, 'user_id' => $user_id, 'price' => $price, 'quantity' => $quantity, 'unit_price' => $tprice);

                $ins = $this->db->insert("cart", $ar);

                if ($ins) {

                    $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "'");

                    $cart_count = $cart_qry->num_rows();

                    echo '@success@' . $cart_count . '@' . $session_id;
                    die;
                }
            }
        } else {

            if ($stock < $quantity) {

                $msg = "Left only " . $stock . " Products";

                echo '@error';
                die;
            }

            $tprice = $price * $quantity;

            $ar = array('session_id' => $session_id, 'variant_id' => $variant_id, 'vendor_id' => $vendor_id, 'user_id' => $user_id, 'price' => $price, 'quantity' => $quantity, 'unit_price' => $tprice);

            $ins = $this->db->insert("cart", $ar);

            if ($ins) {

                $cart_qry = $this->db->query("select * from cart where session_id='" . $session_id . "'");

                $cart_count = $cart_qry->num_rows();

                echo '@success@' . $cart_count . '@' . $session_id;
                die;
            }
        }
    }

    function count_rows($array, $table) {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($array);
        $res = $this->db->get()->num_rows();
        return $res;
    }

    function reOrder($session_id) {
        $table = 'cart';
        $where = array('session_id' => $session_id);
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->result();
        $items = [];
        foreach ($data as $check) {
            $varient = $this->common_model->get_data_row(['id' => $check->variant_id, 'stock >' => 0, 'status' => 1], 'link_variant');
            if ($varient) {
                //check product active or not
                $product = $this->common_model->get_data_row(['id' => $varient->product_id, 'status' => 1, 'availabile_stock_status' => 'available'], 'products');
                if ($product) {
                    $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
                    if ($chk_shop_status) {
                        $chk_cat_status = $this->common_model->count_rows_with_conditions('categories', ['id' => $product->cat_id, 'status' => 1]);
                        if ($chk_cat_status) {
                            $check->price = $varient->saleprice;
                            $check->unit_price = $check->price * $check->quantity;
                            array_push($items, $check);
                        }
                    }
                }
            }
        }
        return $items;
    }

//    function rating_data($product_id){
//       
//        $rating_data = $this->db->where(array("product_id"=>$product_id))->get("user_reviews")->result();
//        if(count($rating_data)>0){
//            $array=[];
//            foreach ($rating_data as $value) {
//               $review = $value->review;
//               $comments = $value->comments;
//               $review_count = $this->db->get("orders")->num_rows();
//               $users = $this->db->where(array("id"=>$value->user_id))->get("users")->row();
//               $array[]=array("review"=>$review,"comments"=>$comments,"review_count"=>$review_count,"user_name"=>$users);
//            } 
//       }
//   }

    function rating_data($product_id) {
        //print_r($product_id); die;
        $rating_data = $this->db->where(array("product_id" => $product_id))->order_by("createdat", "desc")->get("user_reviews")->result();
        // print(sizeof($rating_data));
        //
        //echo "<pre>";print_r($rating_data); die;
        if (count($rating_data) > 0) {
            $array = [];
            //echo "<pre>";print_r($rating_data); die;
            foreach ($rating_data as $value) {
                // echo "<pre>";
                // print_r($value);
                $user_id=$value->user_id;
                $review = $value->review;
                $comments = $value->comments;
                $createdat = $value->createdat;
                // $review_count=sizeof($rating_data);
//               $sdate=date('m/d/y h:i:s a',$value->createdat);
//                  $crrentSysDate = new DateTime(date('m/d/y h:i:s a'));
//                  $userDefineDate = $crrentSysDate->format('m/d/y h:i:s a');
//                   
//                  $start = date_create($userDefineDate);
//                  $end = date_create(date('m/d/y h:i:s a', strtotime($sdate)));
//                   
//                  $diff=date_diff($start,$end);
//                  
//                  if($diff->d>0)
//                  {
//                    $final_values=$diff->d." Days ago ";
//                  }
//                  else if($diff->h>0)
//                  {
//                    $final_values=$diff->h." hours ago";
//                  }
//                  else if($diff->i>0)
//                  {
//                    $final_values=$diff->i." min ago";
//                  }
//                  else if($diff->s>0)
//                  {
//                    $final_values=$diff->s." sec ago";
//                  }
                $users = $this->db->where(array("id" => $value->user_id))->get("users")->row();
                // $review_count=count($review);
                // print(count($review));
                // print($review_count);
             

                $array[] = array("user_id"=>$user_id,"review" => $review, "comments" => $comments, "review_count" => $review_count, "user_firstname" => $users->first_name, "user_lastname" => $users->last_name, "createdat" => $createdat);
            }
            // exit;

            $review_count5 = $this->db->where(array("product_id" => $product_id, "review" => 5))->get("user_reviews")->num_rows();
            //echo $this->db->last_query(); die;
            $review_count4 = $this->db->where(array("product_id" => $product_id, "review" => 4))->get("user_reviews")->num_rows();
            // $review_count4point5 = $this->db->where(array("product_id" => $product_id, "review" => 4.5))->get("user_reviews")->num_rows();
            $review_count3 = $this->db->where(array("product_id" => $product_id, "review" => 3))->get("user_reviews")->num_rows();
            // $review_count3point5 = $this->db->where(array("product_id" => $product_id, "review" => 3.5))->get("user_reviews")->num_rows();
            $review_count2 = $this->db->where(array("product_id" => $product_id, "review" => 2))->get("user_reviews")->num_rows();
            // $review_count2point5 = $this->db->where(array("product_id" => $product_id, "review" => 2.5))->get("user_reviews")->num_rows();
            $review_count1 = $this->db->where(array("product_id" => $product_id, "review" => 1))->get("user_reviews")->num_rows();
            // $review_count1point5 = $this->db->where(array("product_id" => $product_id, "review" => 1.5))->get("user_reviews")->num_rows();
            //rating percentage
                $five_percentage = ($review_count5 / sizeof($rating_data)) * 100;
                $four_percentage = ($review_count4 / sizeof($rating_data)) * 100;
                $three_percentage = ($review_count3 / sizeof($rating_data)) * 100;
                $two_percentage = ($review_count2 / sizeof($rating_data)) * 100;
                $one_percentage = ($review_count1  / sizeof($rating_data)) * 100;
                
                $five_percentage_class = $this->rating_calculator($five_percentage);
                $four_percentage_class = $this->rating_calculator($four_percentage);
                $three_percentage_class = $this->rating_calculator($three_percentage);
                $two_percentage_class = $this->rating_calculator($two_percentage);
                $one_percentage_class = $this->rating_calculator($one_percentage);
                
                
            //print_r($array); die;
            return array("reviews" => $array, "review5" => $review_count5, "review4" => $review_count4, "review3" => $review_count3, "review2" => $review_count2, "review1" => $review_count1, 'five' => $five_percentage_class, 'four' => $four_percentage_class, 'three' => $three_percentage_class, 'two' => $two_percentage_class, 'one' => $one_percentage_class,"rating_data"=>count($rating_data));
        } else {
            return array("review5" => 0, "review4" => 0, "review3" => 0, "review2" => 0, "review1" => 0, 'five' => 0, 'four' => 0, 'three' => 0, 'two' => 0, 'one' => 0);
        }
    }
    
    function rating_calculator($percentage) {
        if(round($percentage) >= 80 && round($percentage) <= 100) {
                    return 5;
                } else if(round($percentage) >= 60 && round($percentage) < 80) {
                    return 4;
                } else if(round($percentage) >= 40 && round($percentage) < 60) {
                    return 3;
                } else if(round($percentage) >= 20 && round($percentage) < 40) {
                    return 2;
                } else if(round($percentage) >= 1 && round($percentage) < 20) {
                    return 1;
                } else {
                    return 0;
                }
    }

    function testimonial() {
        $data = $this->db->get("testimonials")->result();
        return $data;
    }

    function similarProduct($cat_id, $user_id) {

        //print_r($cat_id); die;
        $products_get = $this->db->where(array("cat_id" => $cat_id, 'status' => 1, 'availabile_stock_status' => 'available'))->get("products")->result();
        //echo $this->db->last_query(); die;
        $products = [];
        foreach ($products_get as $product) {
            $chk_shop_status = $this->common_model->count_rows_with_conditions('vendor_shop', ['id' => $product->shop_id, 'status' => 1]);
            $chk_cat_status = $this->common_model->count_rows_with_conditions('categories', ['id' => $product->cat_id, 'status' => 1]);
            if ($chk_shop_status > 0 && $chk_cat_status > 0) {
                array_push($products, $product);
            }
        }
        if (count($products) > 0) {
            //echo "<pre>";print_r($products); die;
            $array = [];
            foreach ($products as $value) {
                // echo "<pre>";
                // print_r($value);
                // exit;
                $p_name = $value->name;
                //$brand_id = $value->brand;
                $brand = $this->db->where(array("id" => $value->brand))->get("attr_brands")->row();
                $brand_name = $brand->brand_name;
                $link_variant = $this->db->where(array("product_id" => $value->id, "saleprice >" => 0, "stock >" => 0, "status" => 1))->get("link_variant")->row();
                $price = $link_variant->price;
                $saleprice = $link_variant->saleprice;
                $this->db->order_by('priority','asc');
                $pro_image = $this->db->where(array("product_id" => $value->id, 'variant_id' => $link_variant->id))->get("product_images")->row();
                $image = $pro_image->image;
                if ($image) {
                    $p_image = $image;
                } else {
                    $p_image = 'noproduct.png';
                }
                $users = $this->db->get("users")->row();
                $whishlist = $this->db->where(array("variant_id" => $link_variant->id, "user_id" => $users->id))->get("whish_list")->num_rows();

                if ($whishlist > 0) {

                    $stat = true;
                } else {

                    $stat = false;
                }


                //                 $qry_var = $this->db->query("SELECT variant_id, vendor_id, COUNT(*) as row_count
//                 FROM cart
//                 WHERE variant_id = '" . $link_variant->id . "' 
//                 AND vendor_id = '" . $value->shop_id . "' 
//                 AND is_checkout = 1 
//                 AND check_out = 0
//                 GROUP BY variant_id, vendor_id
//                 ORDER BY row_count DESC
//                 LIMIT 3");

// $re_var = $qry_var->result();

// // If you also want to see the result set, you can print it
// // echo "<pre>";
// // print_r($re_var);
// // $count_arr=array();
// foreach($re_var as $va){
// $count_arr[]=$va->row_count;
// }

// exit;

                //check already in cart or not
                $session_id = $_SESSION['session_data']['session_id'];
                $in_cart = $this->db->where(['session_id' => $session_id, 'variant_id' => $link_variant->id])->get('cart')->num_rows();
                $rate_data=$this->web_model->rating_data($value->id);
                $pro_qry=$this->db->query("select sub_cat_id,orders_placed from products where id='".$value->id."'");
                $pro_res=$pro_qry->row();
                $cat_query=$this->db->query("select category_name from categories where id='".$cat_id."'");
                $cat_query_res=$cat_query->row();

                $sub_query=$this->db->query("select sub_category_name from sub_categories where id='".$pro_res->sub_cat_id."'");
                $sub_query_res=$sub_query->row();
                $cart_limit = $this->db->where('id', $value->id)->get('products')->row()->cart_limit;
                $arr = array("cat_id" => $cat_id,"rate_data"=>$rate_data, "pid" => $value->id, "p_name" => $p_name, "whishlist_status" => $stat, "variant_id" => $link_variant->id, "seo_url" => $value->seo_url, "brand_name" => $brand_name, "price" => $price, "saleprice" => $saleprice, "p_image" => $p_image, "link_variant" => $link_variant->id, "shop_id" => $value->shop_id, 'in_cart' => $in_cart,'orders_placed'=>$pro_res->orders_placed,'category_name'=>$cat_query_res->category_name,'sub_category_name'=>$sub_query_res->sub_category_name,'stock'=>$link_variant->stock,'cart_limit'=>$cart_limit);
                if ($link_variant) {
                    array_push($array, $arr);
                }
            }
            //echo "<pre>";print_r($array); die;
            return $array;
        }
    }

    function socialMediaLinks() {
        $data = $this->db->where(array("id" => 1))->get("site_settings")->row();
        return $data;
    }

    function update_order_transaction($data) {
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $order = $this->db->get('orders')->row();

        //now update
        $this->db->where('id', $order->id);
        $chk = $this->db->update('orders', $data);
        if ($chk) {

            return $order->user_id;
        } else {
            return 0;
        }
    }

    function home_videos() {
        $data = $this->db->get("site_settings")->row();
        //print_r($data);die;
        return $data;
    }


    function common_filter($cat_id, $sub_cat_id,$question_id,$ques_options,$message)
    {
                
        $data = $this->db->get("products")->result();
        foreach ($data as $value) 
        {
           
        }
        return $data;
    }

    function checkcart_value($user_id,$session_id){

        $cart = $this->common_model->get_data_with_condition_row(['user_id' => $user_id , 'session_id' => $session_id], 'cart');
        $items=[];
        foreach($cart as $crt){
           $check_item = $this->db->get_where('link_variant',['id'=>$crt->variant_id])->row();

           //first check the product active or not
           $check_product = $this->db->get_where('products',['id'=>$check_item->product_id])->row();
           if($check_product->status==0){
            array_push($items, $check_item->product_id);

           }
           else{
            //check the stock now
            $check_stock = $check_item->stock;
            if($check_stock<=0){
                array_push($items, $check_item->product_id);
            }
            else if($check_item->stock < $crt->quantity){
                array_push($items, $check_item->product_id);
            }
           }
        }
        if(sizeof($items) > 0){
            foreach($items as $row){
                //get the item details
                $item = $this->db->get_where('products',['id'=>$row])->row();
                $output .= '<div class="row">
                <div class="col-md-9">
                    <strong>'.$item->name.'</strong>
                    
                </div>
                <div class="col-md-3">
                    <span class="lable lable-primary text-danger">Not available</span>
                </div>
                
            </div>';
            }
        }
        else{
            $output=0;
        }
        

        return $output;

    }
   

}