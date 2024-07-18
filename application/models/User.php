<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        //load database library
        $this->load->database();
    }

    function send_message($message = "", $mobile_number,$template_id) {


         $message = urlencode($message);

         $URL = "http://login.smsmoon.com/API/sms.php"; // connecting url 

         $post_fields = ['username' => 'Absolutemens', 'password' => 'vizag@123', 'from' => 'SCRSIX', 'to' => $mobile_number, 'msg' => $message, 'type' => 1, 'dnd_check' => 0,'template_id'=>$template_id];

         //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $URL);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_exec($ch);
         return true;
      }

      function rand_string( $length ) 
            {
                $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                return substr(str_shuffle($chars),0,$length);
            }

    function doRegister($data)
    { 
        $email = $data['email'];
        $phone = $data['phone'];
        $otp = rand(1000,10000);
        //$otp = '1234';
        $otp_message = $otp."is OTP to register with Sector6. Do not share OTP to anyone. Regards Sector6";
        $template_id = '1407163160043932297';
        $data['otp'] = $otp;
        $email_verify = $this->db->query("select * from users where email='".$email."' and phone!='".$phone."' and otp_status=1");
        $phone_verify = $this->db->query("select * from users where email!='".$email."' and phone='".$phone."' and otp_status=1");
        $both = $this->db->query("select * from users where email='".$email."' and phone='".$phone."' and otp_status=1");
        if($email_verify->num_rows()>0)
        {
            return array('status' =>FALSE, 'message'=>"Email already Exist ");
        }
        else if($phone_verify->num_rows()>0)
        {
            return array('status' =>FALSE, 'message'=>"Phone already Exist ");
        }
        else if($both->num_rows()>0)
        {
            return array('status' =>FALSE, 'message'=>"Phone and Email already Exist ");
        }
        else
        {

             $adm = $this->db->query("select * from admin where id=1");
            $admin_row = $adm->row();

            $coins = $admin_row->registration_coins;
            $data['bonus_points'] = $coins;

            
            $user_refercode = $this->rand_string(8);
            $data['referral_code'] = $user_refercode;


           


            $chk_both = $this->db->query("select * from users where ( email='".$email."' or phone='".$phone."' ) and otp_status=0");
            if($chk_both->num_rows()>0)
            {
                $get = $chk_both->row();
                $wr = array('phone'=>$phone);

                if($this->send_message($otp_message,$phone,$template_id))
                {

                    $ins = $this->db->update("users",$data,$wr);
                    $last_id = $get->id;
                    if($ins)
                    {
                                    $to_mail = $email;
                                    $from_email = 'satish@colourmoon.com';
                                    $site_name = 'Absolutemens';
                                    $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;height: 100vh">
                                                    <tr>
                                                        <td align="center"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td>
                                                    </tr>   
                                                    <tr>
                                                        <td align="center">
                                                            <h1 style="margin:0px; padding:0px; text-align: center; font-weight: 300; color:#666"><span style="color:#f47a20">REGISTRATION OTP FROM Sector6</span></h1>
                                                            <p style="text-align: center; color:#333; line-height: 24px; font-size: 16px; padding-bottom: 20px;">OTP : '.$otp.' <br>
                                                            
                                                            </td>
                                                    </tr>
                                                    
                                                </table>';

                                        $this->load->library('email');
                                        require_once (APPPATH . 'libraries/vendor/autoload.php');
                                        require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/PHPMailer.php');
                                        require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/SMTP.php');
                                        require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/Exception.php');

                                        $mail = new PHPMailer\PHPMailer\PHPMailer();
                                        $mail->From = $from_email;
                                        $mail->FromName = $site_name;
                                        $mail->addAddress($to_mail); 
                                        $mail->addReplyTo($from_email, "Reply");
                                        $mail->isHTML(true);
                                        $mail->Sender = $from_email;
                                        $mail->Subject = "REGISTRATION";
                                        $mail->Body = $email_message;
                                        $sucess = $mail->send();
                                        if($sucess)
                                        {
                                            $data='mail sent successfully';
                                            
                                        }
                                        else
                                        {
                                            $data='mail not sent,Please try again';
                                        }
                        $ar=array('status' =>TRUE,'user_id'=>$last_id,'otp'=>$otp,'phone'=>$phone,'email'=>$email,'message'=>"Please enter your OTP");
                        return $ar;
                    }
                }
            }
            else
            {
                if($this->send_message($otp_message,$phone,$template_id))
                {

                    $ins = $this->db->insert("users",$data);
                    $last_id = $this->db->insert_id($ins);
                    if($ins)
                    {
                        $to_mail = $email;
                                    $from_email = 'satish@colourmoon.com';
                                    $site_name = 'Absolutemens';
                                    $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;height: 100vh">
                                                    <tr>
                                                        <td align="center"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td>
                                                    </tr>   
                                                    <tr>
                                                        <td align="center">
                                                            <h1 style="margin:0px; padding:0px; text-align: center; font-weight: 300; color:#666"><span style="color:#f47a20">REGISTRATION OTP FROM Sector6</span></h1>
                                                            <p style="text-align: center; color:#333; line-height: 24px; font-size: 16px; padding-bottom: 20px;">OTP : '.$otp.' <br>
                                                            
                                                            </td>
                                                    </tr>
                                                    
                                                </table>';

                                        $this->load->library('email');
                                        require_once (APPPATH . 'libraries/vendor/autoload.php');
                                        require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/PHPMailer.php');
                                        require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/SMTP.php');
                                        require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/Exception.php');

                                        $mail = new PHPMailer\PHPMailer\PHPMailer();
                                        $mail->From = $from_email;
                                        $mail->FromName = $site_name;
                                        $mail->addAddress($to_mail); 
                                        $mail->addReplyTo($from_email, "Reply");
                                        $mail->isHTML(true);
                                        $mail->Sender = $from_email;
                                        $mail->Subject = "REGISTRATION";
                                        $mail->Body = $email_message;
                                        $sucess = $mail->send();
                                        if($sucess)
                                        {
                                            $data='mail sent successfully';
                                            
                                        }
                                        else
                                        {
                                            $data='mail not sent,Please try again';
                                        }
                        $ar=array('status' =>TRUE,'user_id'=>$last_id,'otp'=>$otp,'phone'=>$phone,'email'=>$email,'message'=>"Please enter your OTP");
                        return $ar;
                    }
                }
            }
        }
    }


    function becomeVendor($data)
    {
        $ins = $this->db->insert("become_a_vendor",$data);
        if($ins)
        {
            $ar = array('status' =>TRUE,'message'=>"Vendor Added Successfully");
            return $ar;
        }
        else
        {
            $ar = array('status' =>FALSE,'message'=>"Something went Wrong");
            return $ar;
        }
    }


    function resendOTP($user_id)
    {
        $chk = $this->db->query("select * from users where id='".$user_id."'");
        if($chk->num_rows()>0)
        {
            $row = $chk->row();
            $otp = rand(1000,10000);
            //$otp='1234';
            $phone = $row->phone;

            $template_id = '1407163160043932297';

            $otp_message = $otp." is OTP to register with Sector6. Do not share OTP to anyone. Regards Sector6";
            if($this->send_message($otp_message,$phone,$template_id))
            {
                $ar = array('otp'=>$otp);
                $wr = array('id'=>$user_id);
                $upd = $this->db->update("users",$ar,$wr);
                if($upd)
                {
                    $ar = array('status' =>TRUE,'message'=>"OTP sent to your Mobile Number");
                    return $ar;
                }
            }
        }
        else
        {
            $ar = array('status' =>TRUE,'message'=>"Invalid User ID");
            return $ar;
        }
    }

    function doFacebookRegister($data)
    {
        $email = $data['email'];
        $chk = $this->db->query("select * from users where email='".$email."'");
        if($chk->num_rows()>0)
        {
            $get = $chk->row();
            $last_id = $get->id;
            $wr = array('email' =>$email);
            $ins = $this->db->update("users",$data,$wr);
        }
        else
        {
            $ins = $this->db->insert("users",$data);
            $last_id = $this->db->insert_id($ins);
        }

        if($ins)
        {
            $ar=array('status' =>TRUE,'user_id'=>$last_id,'email'=>$email);
            return $ar;
        }
    }

    function verify_OTP($user_id,$otp)
    {
         $qry = $this->db->query("select * from users where id='".$user_id."' and otp='".$otp."'");
         if($qry->num_rows()>0)
         {
            $ar=array('otp_status'=>1);
            $wr=array('id'=>$user_id);
            $ins = $this->db->update("users",$ar,$wr);
            if($ins)
            {

                    $stu_row = $qry->row();
                    $phone =$stu_row->phone;
                   $otp_message = "Dear ".$stu_row->first_name." your successfully registered with Sector6. Enjoy your local shopping experience. Regards Sector6";
                   $template_id ="1407163162802326177";
            if($this->send_message($otp_message,$phone,$template_id))
            {

                    $st_email = $stu_row->email;
                $to_mail = $st_email;
                $from_email = 'satish@colourmoon.com';
                $site_name = 'Absolutemens';
                                        $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;height: 100vh">
                                <tr>
                                    <td align="center"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td>
                                </tr>   
                                <tr>
                                    <td align="center"><img src="http://htmldemo.in/2020/fashionmaa_emails/emailheader.jpg" alt="" height="300"></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <h1 style="margin:0px; padding:0px; text-align: center; font-weight: 300; color:#666"><span style="color:#f47a20">Welcome</span></h1>
                                        <p style="text-align: center; color:#333; line-height: 24px; font-size: 16px; padding-bottom: 20px;">You have successfully created a Sector6 account. <br>
                                        
                                        </td>
                                </tr>
                                <tr>
                                    <td height="30"></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#000" style="padding:30px 10px; text-align: center;">
                                        
                                        <p style="font-weight: 300; color:#fff; font-size: 11px;">&copy; Copyright 2020 Sector6., All Rights Reserved</p>
                                    </td>
                                </tr>
                            </table>';

                $this->load->library('email');
                require_once (APPPATH . 'libraries/vendor/autoload.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/PHPMailer.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/SMTP.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/Exception.php');

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->From = $from_email;
                $mail->FromName = $site_name;
                $mail->addAddress($to_mail); 
                $mail->addReplyTo($from_email, "Reply");
                $mail->isHTML(true);
                $mail->Sender = $from_email;
                $mail->Subject = "Registration successfully";
                $mail->Body = $email_message;
                $sucess = $mail->send();
                if($sucess)
                {
                    $data='mail sent successfully';
                    
                }
                else
                {
                    $data='mail not sent,Please try again';
                }
            }

              $row = $qry->row();
              $name = $row->first_name." ".$row->last_name;
              $res = array('status' =>TRUE,'user_id'=>$row->id,'name'=>$name,'phone'=>$row->phone,'email'=>$row->email,'message'=>"Registration Success");
              return $res;  
            }
         }   
         else
         {
             return array('status' =>FALSE, 'message'=>"Invalid OTP");
         }  
    }
    function checkLogin($username,$password,$token)
    {
        $chk = $this->db->query("select * from users where ( email='".$username."' or phone='".$username."' ) and password='".$password."' and otp_status=1");
        if($chk->num_rows()>0)
        {
             $row = $chk->row();
             $name = $row->first_name." ".$row->last_name;
             $this->db->update("users",array('token'=>$token),array('email'=>$row->email));

             if($row->lat=='' || $row->lng=='')
             {
                $loc_status = 'false';
             }
             else
             {
                 $loc_status = 'true';
             }


             $res = array('status' =>TRUE,'user_id'=>$row->id,'name'=>$name,'phone'=>$row->phone,'email'=>$row->email,'loc_status'=>$loc_status,'message'=>"Login Success");
             return $res;

        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid Login Details");
        }
    }

    function checkForgot($phone)
    {


        $chk = $this->db->query("select * from users where ( phone='".$phone."' or email='".$phone."' ) and otp_status=1");
        if($chk->num_rows()>0)
        {
            $otp = rand(1000,10000);
            
            $otp_message = $otp." is OTP to reset your password. Do not share OTP with anyone";
            $ar=array('otp'=>$otp);
            $wr=array('phone'=>$phone);
            $template_id = "1407163162814519859";
            if($this->send_message($otp_message,$phone,$template_id))
            {
                $upd = $this->db->update('users',$ar,$wr);
                if($upd)
                {

                     $stu_row = $chk->row();
                     $st_email = $stu_row->email;
                $to_mail = $st_email;
                $from_email = 'satish@colourmoon.com';
                $site_name = 'Sector6';
                $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;height: 100vh">
        <tr>
            <td align="center"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td>
        </tr>   
        <tr>
            <td align="center">
                <h1 style="margin:0px; padding:0px; text-align: center; font-weight: 300; color:#666"><span style="color:#f47a20">FORGOT PASSWORD FROM SECTOR6</span></h1>
                <p style="text-align: center; color:#333; line-height: 24px; font-size: 16px; padding-bottom: 20px;">OTP : '.$otp.' <br>
                
                </td>
        </tr>
        
    </table>';

                $this->load->library('email');
                require_once (APPPATH . 'libraries/vendor/autoload.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/PHPMailer.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/SMTP.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/Exception.php');

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->From = $from_email;
                $mail->FromName = $site_name;
                $mail->addAddress($to_mail); 
                $mail->addReplyTo($from_email, "Reply");
                $mail->isHTML(true);
                $mail->Sender = $from_email;
                $mail->Subject = "FORGOT PASSWORD";
                $mail->Body = $email_message;
                $sucess = $mail->send();
                if($sucess)
                {
                    $data='mail sent successfully';
                    
                }
                else
                {
                    $data='mail not sent,Please try again';
                }
                    $res = array('status' =>TRUE,'otp'=>$otp,'phone'=>$phone,'user_id'=>$stu_row->id);
                    return $res;  
                }
            }
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid Email or Phone Number");
        }
    }

    function resetPassword($phone,$otp,$password)
    {
        $qry = $this->db->query("select * from users where phone='".$phone."' and otp='".$otp."'");
        if($qry->num_rows()>0)
        {
              $ar = array('password'=>md5($password));
              $wr = array('phone'=>$phone);
              $upd = $this->db->update("users",$ar,$wr);
             if($upd)
             {
                $row = $qry->row();
                $res = array('status' =>TRUE,'user_id'=>$row->id,'phone'=>$row->phone,'name'=>$row->first_name,'email'=>$row->email);
                return $res;
             }
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid OTP");
        }
    }

    function addAddress($user_id,$name,$mobile,$address,$city,$state,$pincode,$address_type,$landmark)
    {
        $chk = $this->db->query("SELECT * FROM `vendor_shop` where state_id='".$state."' and city_id='".$city."'");
        if($chk->num_rows()>0)
        {

        $data=array('user_id'=>$user_id,'name'=>$name,'mobile'=>$mobile,'address'=>$address,'city'=>$city,'state'=>$state,'pincode'=>$pincode,'landmark'=>$landmark,'address_type'=>$address_type);
        $ins = $this->db->insert("user_address",$data);
        if($ins)
        {
            return array('status' =>TRUE, 'message'=>"Address added successfully");
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Something went wrong");
        }
    }
    else
    {
         return array('status' =>FALSE, 'message'=>'No shops in this location,Please change your location');
    }

}

    function updateAddress($address_id,$user_id,$name,$mobile,$address,$locality,$city,$state,$pincode,$address_type)
    {
        $data=array('user_id'=>$user_id,'name'=>$name,'mobile'=>$mobile,'address'=>$address,'locality'=>$locality,'city'=>$city,'state'=>$state,'pincode'=>$pincode,'landmark'=>$landmark,'address_type'=>$address_type);
        $wr = array('id'=>$address_id);
        $upd = $this->db->update("user_address",$data,$wr);
        if($upd)
        {
            return array('status' =>TRUE, 'message'=>"Address updated successfully");
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Something went wrong");
        }
    }

    function editUseraddress($address_id,$user_id,$name,$mobile,$address,$city,$state,$pincode,$address_type)
    {
        $data=array('user_id'=>$user_id,'name'=>$name,'mobile'=>$mobile,'address'=>$address,'city'=>$city,'state'=>$state,'pincode'=>$pincode,'address_type'=>$address_type);
        $wr = array('id'=>$address_id);
        $upd = $this->db->update("user_address",$data,$wr);
        if($upd)
        {
            return array('status' =>TRUE, 'message'=>"Address updated successfully");
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Something went wrong");
        }
    }

    function getAddress($user_id)
    {
        $qry = $this->db->query("select * from user_address where user_id='".$user_id."'");
        $result = $qry->result();
        $ar=[];
        foreach ($result as $value) 
        {

            $city_qry = $this->db->query("select * from cities where id='".$value->city."'");
            $city_row = $city_qry->row();

            $state_qry = $this->db->query("select * from states where id='".$value->state."'");
            $state_row = $state_qry->row();

            $area_qry = $this->db->query("select * from pincodes where id='".$value->pincode."'");
            $area_row = $area_qry->row();

            if($value->address_type==1)
            {
                $addres_type ="Home";
            }
            else if($value->address_type==2)
            {
                $addres_type ="Office/Commercial";
            }

            $ar[]=array('id'=>$value->id,'name'=>$value->name,'address'=>$value->address,'city'=>$city_row->city_name,'state'=>$state_row->state_name,'pincode'=>$area_row->pincode,'mobile'=>$value->mobile,'city_id'=>$value->city,'pincode_id'=>$value->pincode,'landmark'=>$value->landmark,'address_type'=>$addres_type,'address_status'=>$value->address_type);
        }

        return $ar;
    }

    function getAddress1($user_id)
    {
            $qry = $this->db->query("select * from user_address where user_id='".$user_id."' order by isdefault asc");
        $result = $qry->result();
        $ar=[];
        if($qry->num_rows()>0)
        {

           foreach ($result as $value) 
            {
                
                 $city_qry = $this->db->query("select * from cities where id='".$value->city."'");
            $city_row = $city_qry->row();

            $state_qry = $this->db->query("select * from states where id='".$value->state."'");
            $state_row = $state_qry->row();

            $area_qry = $this->db->query("select * from pincodes where id='".$value->pincode."'");
            $area_row = $area_qry->row();

            if($value->address_type==1)
            {
                $addres_type ="Home";
            }
            else if($value->address_type==2)
            {
                $addres_type ="Office/Commercial";
            }

            $ar[]=array('id'=>$value->id,'user_id'=>$value->id,'mobile'=>$value->mobile,'address'=>$value->address,'address_type'=>$value->address_type,'name'=>$value->name,'city'=>$city_row->city_name,'area'=>$area_row->area,'state'=>$state_row->state_name,'pincode'=>$area_row->pincode,'city_id'=>$value->city,'state_id'=>$value->state,'pincode_id'=>$value->pincode,'landmark'=>$value->landmark,'address_type'=>$addres_type,'address_status'=>$value->address_type,'isdefault'=>$value->isdefault);
            }

             $usr = $this->db->query("select * from users where id='".$user_id."'");
             $users = $usr->row();

            return array('status' =>TRUE, 'user_address'=>$ar,'currentSelectedAddr'=>$users->address_id); 
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid UserId");
        }
        
    }


   /* function userSavedAddress($user_id)
    {
         $chekrow = $this->db->query("select * from user_address where user_id='".$user_id."'");

          $usr = $this->db->query("select * from users where id='".$user_id."'");
          $users = $usr->row(); 
          $address = $users->address_id;

          if($chekrow->num_rows()>0)
          {
            $row = $this->db->query("select * from user_address where id='".$address."' order by id desc");
            $value = $row->row();
            if($row->num_rows()>0)
            {
                $city_qry = $this->db->query("select * from cities where id='".$value->city."'");
                $city_row = $city_qry->row();

                $ar = $value->name.", ".$city_row->city_name."-".$value->pincode;
            }
            else
            {
                $city_qry = $this->db->query("select * from cities where id='".$address."'");
                $city_row = $city_qry->row();
                $ar ="";
            }
          }
          else
          {
                $city_qry = $this->db->query("select * from cities where id='".$address."'");
                $city_row = $city_qry->row();    
                $ar ="";       
          }
        return array('status' =>TRUE, 'address'=>$ar); 
    }*/

     function userSavedAddress($user_id)
    {


          $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
          $row = $qry->row();
                    $state_id = $row->state_id;
                    $city_id = $row->address_id;
                    $pincode_id = $row->pincode_id;


                $state_qry = $this->db->query("select * from states where id='".$state_id."'");
                $state_row = $state_qry->row();

                $city_qry = $this->db->query("select * from cities where id='".$city_id."'");
                $city_row = $city_qry->row();

                $pincode_qry = $this->db->query("select * from pincodes where id='".$pincode_id."'");
                $pincode_row = $pincode_qry->row();

                //$ar = $row->first_name.", ".$state_row->state_name.", ".$city_row->city_name."-".$pincode_row->pincode;
                $ar = ucfirst($row->first_name).", ".$city_row->city_name."-".$pincode_row->pincode;
            if($row->state_id==0)
            {
                return array('status' =>TRUE, 'address'=>""); 
            }
            else
            {
                return array('status' =>TRUE, 'address'=>$ar); 
            }
        
    }

    function getBanners($user_id,$lat,$lng)
    {
       /* $chk_row_qry = $this->db->query("select * from user_address where user_id='".$user_id."'");
        if($chk_row_qry->num_rows()>0)
        {
            $users = $this->db->query("select * from users where id='".$user_id."'");
            $users_row = $users->row();

            $addrs = $this->db->query("select * from user_address where id='".$users_row->address_id."'");
            $addrs_row = $addrs->row();

            $address = $addrs_row->city;
        }
        else
        {*/
            $users = $this->db->query("select * from users where id='".$user_id."'");
            $users_row = $users->row();
            $address = $users_row->address_id;

            $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;
       // }

            $shop_qry = $this->db->query("SELECT id, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop ");
            /*having distance<'".$search_distance."'*/
            $shops=$shop_qry->result();

            $shop_ids = array_column($shops, 'id');
            $imp = implode(",", $shop_ids);
        $qry = $this->db->query("select * from banners WHERE find_in_set(shop_id,'".$imp."') and position=1 and type='shops'");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {
                    

                    if($value->app_image!='')
                    {
                        $img = base_url()."uploads/banners/".$value->app_image;
                    }
                    else
                    {
                        $img = "";
                    }

                    if($value->type=='products')
                        {
                            $prod_qry = $this->db->query("select * from products where id='".$value->product_id."'");
                            $dat1 = $prod_qry->row();
                            $title = $dat1->name;
                            $shop_id = $dat1->shop_id;
                            $product_details = array('product_title'=>$title,'product_id'=>$dat1->id,'shop_id'=>$shop_id);
                        }
                        else
                        {
                            $prod_qry = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                            $dat1 = $prod_qry->row();

                             $adm_qry = $this->db->query("select * from admin_comissions where shop_id='".$value->shop_id."' order by id desc");
                             $adm_row = $adm_qry->row();
                            
                            $product_details = array('shop_name'=>$dat1->shop_name,'cat_id'=>$adm_row->cat_id,'shop_id'=>$value->shop_id);
                        }

                   $ar[]=array('id'=>$value->id,'title'=>$value->title,'image'=>$img,'type'=>$value->type,'product_details'=>$product_details);
                }
                $topbanners = array('status' =>TRUE,'bannerslist'=>$ar);
        }
        else
        {
            $topbanners= array('status' =>FALSE, 'message'=>"No Banners");
        }



        $qry1 = $this->db->query("select * from banners where find_in_set(shop_id,'".$imp."') and position=2");
        $dat1 = $qry1->result();
        if($qry1->num_rows()>0)
        {
                $ar1=[];
                foreach ($dat1 as $value1) 
                {
                    if($value1->app_image!='')
                    {
                        $img1 = base_url()."uploads/banners/".$value1->app_image;
                    }
                    else
                    {
                        $img1 = "";
                    }
                        if($value1->type=='products')
                        {
                            $prod_qry = $this->db->query("select * from products where id='".$value1->product_id."'");
                            $dat1 = $prod_qry->row();
                            $title = $dat1->name;
                            $shop_id = $dat1->shop_id;
                            $product_details = array('product_title'=>$title,'product_id'=>$value1->product_id,'shop_id'=>$shop_id);
                        }
                        else
                        {
                            $prod_qry = $this->db->query("select * from vendor_shop where id='".$value1->shop_id."'");
                            $dat1 = $prod_qry->row();

                             $adm_qry = $this->db->query("select * from admin_comissions where shop_id='".$value1->shop_id."' order by id desc");
                             $adm_row = $adm_qry->row();
                            
                            $product_details = array('shop_name'=>$dat1->shop_name,'cat_id'=>$adm_row->cat_id,'shop_id'=>$value1->shop_id);
                        }

                        

                   $ar1[]=array('id'=>$value1->id,'title'=>$value1->title,'image'=>$img1,'type'=>$value->type,'product_details'=>$product_details);
                }
                $second_banners = array('status' =>TRUE,'secondbannerslist'=>$ar1);
        }
        else
        {
            $second_banners= array('status' =>FALSE, 'message'=>"No Banners");
        }


        $qry2 = $this->db->query("select * from banners where find_in_set(shop_id,'".$imp."') and position=3 order by id desc");
        $dat2 = $qry2->row();
        if($qry2->num_rows()>0)
        {
                    if($dat2->app_image!='')
                    {
                        $img2 = base_url()."uploads/banners/".$dat2->app_image;
                    }
                    else
                    {
                        $img2 = "";
                    }

                       if($dat2->type=='products')
                        {
                            $prod_qry = $this->db->query("select * from products where id='".$dat2->product_id."'");
                            $dat1 = $prod_qry->row();
                            $title = $dat1->name;
                            $shop_id = $dat1->shop_id;
                            $product_details = array('product_title'=>$title,'product_id'=>$dat2->product_id,'shop_id'=>$shop_id);
                        }
                        else
                        {
                            $prod_qry = $this->db->query("select * from vendor_shop where id='".$dat2->shop_id."'");
                            $dat1 = $prod_qry->row();

                             $adm_qry = $this->db->query("select * from admin_comissions where shop_id='".$dat2->shop_id."' order by id desc");
                             $adm_row = $adm_qry->row();
                            
                            $product_details = array('shop_name'=>$dat1->shop_name,'cat_id'=>$adm_row->cat_id,'shop_id'=>$dat2->shop_id);
                        }


                   $third_banner=array('id'=>$dat2->id,'title'=>$dat2->title,'image'=>$img2,'type'=>$value->type,'product_details'=>$product_details);
        }
        else
        {
            $third_banner= array('status' =>FALSE, 'message'=>"No Banners");
        }

        return array('topbanners' =>$topbanners,'second_banners' =>$second_banners,'third_banner' =>$third_banner);
    }

    function getVendorBanners($vendor_id,$user_id)
    {
        $this->db->insert("shop_visit",array('shop_id'=>$vendor_id,'user_id'=>$user_id));

            $bannerad = $this->db->query("select * from bannerads where shop_id='".$vendor_id."' and blocks=1");
            $bannerads = $bannerad->row();

                    if($bannerads->app_image!='')
                    {
                        $ban1 = base_url()."uploads/bannerads/".$bannerads->app_image;
                    }
                    else
                    {
                        $ban1 = "";
                    }
        $bannerad1 = $this->db->query("select * from bannerads where shop_id='".$vendor_id."' and blocks=2");
        $bannerads1 = $bannerad1->row();
                    if($bannerads1->app_image!='')
                    {
                        $ban2 = base_url()."uploads/bannerads/".$bannerads1->app_image;
                    }
                    else
                    {
                        $ban2 = "";
                    }


        $ban =array('banneradd1'=>$ban1,'banneradd2'=>$ban2);

        $qry = $this->db->query("select * from vendor_shop_banners where shop_id='".$vendor_id."'");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {
                    if($value->app_banner!='')
                    {
                        $img = base_url()."uploads/banners/".$value->app_banner;
                    }
                    else
                    {
                        $img = "";
                    }
                   $ar[]=array('id'=>$value->id,'title'=>$value->title,'image'=>$img);
                }
                return array('status' =>TRUE,'bannerslist'=>$ar,'banner_ads'=>$ban);
        }
        else
        {
            $img = base_url()."admin_assets/assets/images/logo.png";
            $ar[] = array('id'=>'','title'=>'','image'=>$img);
            return array('status' =>TRUE, 'message'=>"No Banners",'bannerslist'=>$ar,'banner_ads'=>$ban);
        }
        
           
    }

    function getCategories()
    {
        $qry = $this->db->query("select * from categories");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {
                    $subcat = $this->db->query("select id,sub_category_name as title from sub_categories where cat_id='".$value->id."'");
                    $subcategory = $subcat->result();

                   $ar[]=array('id'=>$value->id,'title'=>$value->category_name,'subcategory_list'=>$subcategory);
                }
                return array('status' =>TRUE,'category_list'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Categories");
        }
    }


    function getHomeLimitCategories($user_id,$lat,$lng)
    {
       

         $qry = $this->db->query("select * from categories where status=1 order by priority asc");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {
                    if($value->app_image!='')
                    {
                        $img = base_url()."uploads/categories/".$value->app_image;
                    }
                    else
                    {
                        $img = "";
                    }

                     $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
                    $row = $qry->row();
                    

                    $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;





                        /*$prod = $this->db->query("select * from products where cat_id='".$value->id."' and status=1 and ");
                        $products = $prod->num_rows();*/
                        /*$pro = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id  INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and products.cat_id='".$value->id."' and products.status=1 group by link_variant.product_id having distance<".$search_distance);
                        $products = $pro->num_rows();*/

                      $adm = $this->db->query("select * from admin_comissions where cat_id='".$value->id."' and subcategory_ids!=''");
                      $admin = $adm->num_rows();
                      if($admin>0)
                      {
                        
                        $ar[]=array('id'=>$value->id,'title'=>$value->category_name,'image'=>$img,'products_count'=>"");
                      }     
                   
                }
                return array('status' =>TRUE,'category_list'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Categories");
        }
    }



    function getHomeCategories()
    {
        $bannerad = $this->db->query("select * from bannerads where shop_id=0 and blocks=1");
        $bannerads = $bannerad->row();

                    if($bannerads->app_image!='')
                    {
                        $ban1 = base_url()."uploads/bannerads/".$bannerads->app_image;
                    }
                    else
                    {
                        $ban1 = "";
                    }
        $bannerad1 = $this->db->query("select * from bannerads where shop_id=0 and blocks=2");
        $bannerads1 = $bannerad1->row();
                    if($bannerads1->app_image!='')
                    {
                        $ban2 = base_url()."uploads/bannerads/".$bannerads1->app_image;
                    }
                    else
                    {
                        $ban2 = "";
                    }


        $ban =array('banneradd1'=>$ban1,'banneradd2'=>$ban2);

         $qry = $this->db->query("select * from categories where status=1 order by priority ASC LIMIT 10");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {
                    if($value->app_image!='')
                    {
                        $img = base_url()."uploads/categories/".$value->app_image;
                    }
                    else
                    {
                        $img = "";
                    }

                        $prod = $this->db->query("select * from products where cat_id='".$value->id."'");
                        $products = $prod->num_rows();

                      $adm = $this->db->query("select * from admin_comissions where cat_id='".$value->id."' and subcategory_ids!=''");
                      $admin = $adm->num_rows();
                      if($admin>0)
                      {
                        $ar[]=array('id'=>$value->id,'title'=>$value->category_name,'image'=>$img,'products_count'=>$products);
                      }     
                   
                }
                return array('status' =>TRUE,'category_list'=>$ar,'banner_ads'=>$ban);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Categories",'banner_ads'=>$ban);
        }
    }

    function getseleHomeCategories($catid)
    {

        if($catid=='all')
        {
            $qry = $this->db->query("select * from categories");
                $dat = $qry->result();
                if($qry->num_rows()>0)
                {
                        $ar=[];
                        foreach ($dat as $value) 
                        {
                            if($value->app_image!='')
                            {
                                $img = base_url()."uploads/categories/".$value->app_image;
                            }
                            else
                            {
                                $img = "";
                            }

                                $prod = $this->db->query("select * from products where cat_id='".$value->id."'");
                                $products = $prod->num_rows();

                           $ar[]=array('id'=>$value->id,'title'=>$value->category_name,'image'=>$img,'products_count'=>$products);
                        }
                        $ar[0]=array('id'=>'all','title'=>'All');
                        return array('status' =>TRUE,'category_list'=>$ar);

                }
                else
                {
                    return array('status' =>FALSE, 'message'=>"No Categories");
                }


        }
        else
        {
            $subcat = $this->db->query("select * from sub_categories where cat_id='".$catid."'");
            $subcat_row1 = $subcat->result();
            if($subcat->num_rows()>0)
            {
             foreach ($subcat_row1 as $subcat_row) 
                {
                        if($subcat_row->app_image!='')
                        {
                            $img1 = base_url()."uploads/sub_categories/".$subcat_row->app_image;
                        }
                        else
                        {
                            $img1 = "";
                        }

                        $prod1 = $this->db->query("select * from products where cat_id='".$catid."' and sub_cat_id='".$subcat_row->id."'");
                        $products1 = $prod1->num_rows();
                        if($products1>0)
                        {
                            $ar[]=array('id'=>$subcat_row->id,'title'=>$subcat_row->sub_category_name,'image'=>$img1,'products_count'=>$products1);
                        }
                     
                }

                 return array('status' =>TRUE,'category_list'=>$ar);
            }
            else
            {
                 return array('status' =>FALSE, 'message'=>"No Sub Categories");
            }

            

           
            

            


           
            

                /* $sin = $this->db->query("select * from categories where id='".$catid."'");
                 $first_row = $sin->row();
                            if($first_row->app_image!='')
                            {
                                $img1 = base_url()."uploads/categories/".$first_row->app_image;
                            }
                            else
                            {
                                $img1 = "";
                            }

                                $prod1 = $this->db->query("select * from products where cat_id='".$first_row->id."'");
                                $products1 = $prod1->num_rows();

                 

                 $qry = $this->db->query("select * from categories where id!='".$catid."'");
                $dat = $qry->result();
                if($qry->num_rows()>0)
                {
                        $ar=[];
                        foreach ($dat as $value) 
                        {
                            if($value->app_image!='')
                            {
                                $img = base_url()."uploads/categories/".$value->app_image;
                            }
                            else
                            {
                                $img = "";
                            }

                                $prod = $this->db->query("select * from products where cat_id='".$value->id."'");
                                $products = $prod->num_rows();

                           $ar[]=array('id'=>$value->id,'title'=>$value->category_name,'image'=>$img,'products_count'=>$products);
                        }
                        $ar[0]=array('id'=>$first_row->id,'title'=>$first_row->category_name,'image'=>$img1,'products_count'=>$products1);
                        return array('status' =>TRUE,'category_list'=>$ar);

                }
                else
                {
                    return array('status' =>FALSE, 'message'=>"No Categories");
                }*/
        }
    }

    function getAllshopsWithoutcategory($user_id,$lat,$lng,$start_from,$perpage)
    {
        $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
        $row = $qry->row();

        $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;

     $tota=$this->db->query("SELECT vendor_shop.*,admin_comissions.shop_id, admin_comissions.cat_id, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN admin_comissions ON vendor_shop.id=admin_comissions.shop_id INNER JOIN products ON vendor_shop.id=products.shop_id where vendor_shop.status=1 and products.status=1 group by products.shop_id ");
     //having distance<".$search_distance
     
     $qry = $this->db->query("SELECT vendor_shop.*,admin_comissions.shop_id, admin_comissions.cat_id, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN admin_comissions ON vendor_shop.id=admin_comissions.shop_id INNER JOIN products ON vendor_shop.id=products.shop_id where vendor_shop.status=1 and products.status=1 group by products.shop_id order by distance asc LIMIT ".$start_from.",".$perpage);
     //having distance<".$search_distance."
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {
                    /*echo "select * from vendor_shop where id='".$value1->shop_id."' and status=1";
                    $row = $this->db->query("select * from vendor_shop where id='".$value1->shop_id."' and status=1");
                    $value = $row->row();*/
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";;
                        }


                        
                        $shop_qry = $this->db->query("select * from shop_favorites where shop_id='".$value->id."' and user_id='".$user_id."'");
                        if($shop_qry->num_rows()>0)
                        {
                            $shop_not = true;
                        }
                        else
                        {
                            $shop_not = false;
                        }

                        $pro = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.status=1 and products.shop_id='".$value->id."' and products.status=1 group by link_variant.product_id order by products.id ASC");
                     //$pro = $this->db->query("select * from products where shop_id='".$value->id."' and status=1");
                     $product_total = $pro->num_rows();
                        if($value->status==1)
                        {
                            $stat = "Open";
                        }
                        else
                        {
                             $stat = "Closed";
                        }


                       
                          
                         
                            /*if($product_total>0)
                            {*/
                                $ar[]=array('id'=>$value->id,'cat_id'=>$value->cat_id,'shop_name'=>$value->shop_name,'description'=>$value->description,'image'=>$img,'status'=>$stat,'shop_not'=>$shop_not,'distance'=>round($value->distance),'product_total'=>$product_total);
                            //}
                         
                     /*}*/
                }
            return array('status' =>TRUE,'shop_list'=>$ar,'shops_count'=>count($ar),'total'=>$tota->num_rows());
        }
        else{
            return array('status' =>FALSE,'message'=>"No Shops",'shops_count'=>count($ar),'total'=>$tota->num_rows());
        }
    

    }
    function getshopsWithcategoryID($cat_id,$subcatid,$user_id,$lat,$lng)
    {
        /*if($cat_id=='all')
        {
            $qry = $this->db->query("select * from admin_comissions group by shop_id");
        }
        else
        {
            
        }*/
        $qry = $this->db->query("select * from admin_comissions where cat_id='".$cat_id."' and find_in_set('".$subcatid."',subcategory_ids) group by shop_id");
        
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value1) 
                {

                     $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
                    $row = $qry->row();
                    

                    
                    $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;


$row=$this->db->query("SELECT vendor_shop.*,products.status, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop INNER JOIN products ON vendor_shop.id=products.shop_id where vendor_shop.id='".$value1->shop_id."' and products.status=1 and vendor_shop.status=1 group by products.shop_id  order by distance asc");
//having distance<".$search_distance."
                    //$row = $this->db->query("select * from vendor_shop where id='".$value1->shop_id."' and status=1 and state_id='".$state_id."' and city_id='".$city_id."' and find_in_set('".$pincode_id."',vendor_pincodes)");
                    $value = $row->row();
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";;
                        }


                        
                        $shop_qry = $this->db->query("select * from shop_favorites where shop_id='".$value->id."' and user_id='".$user_id."'");
                        if($shop_qry->num_rows()>0)
                        {
                            $shop_not = true;
                        }
                        else
                        {
                            $shop_not = false;
                        }

                      $pro = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.status=1 and products.cat_id='".$cat_id."' and products.shop_id='".$value->id."' and products.status=1 group by link_variant.product_id order by products.id ASC");



                     /*$pro = $this->db->query("select * from products where shop_id='".$value->id."' and cat_id='".$cat_id."' and status=1");*/
                     $product_total = $pro->num_rows();
                     if($pro->num_rows()>0)
                     {
                        if($value->status==1)
                        {
                            $stat = "Open";
                        }
                        else
                        {
                             $stat = "Closed";
                        }


                       
                          
                          /*if(round($km)<=$admin_row->distance)
                          {*/
                                $ar[]=array('id'=>$value->id,'shop_name'=>$value->shop_name,'description'=>$value->description,'image'=>$img,'status'=>$stat,'shop_not'=>$shop_not,'distance'=>round($value->distance),'product_total'=>$product_total);
                         /*}*/
                     }
                }
            return array('status' =>TRUE,'shop_list'=>$ar,'shops_count'=>count($ar));
        }
        else{
            return array('status' =>FALSE,'message'=>"No Shops",'shops_count'=>count($ar));
        }
    }
    /* function getAllshopsWithoutcategory($user_id,$lat,$lng,$start_from,$perpage)
    {
        $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
        $row = $qry->row();
        $state_id = $row->state_id;
        $city_id = $row->address_id;
        $pincode_id = $row->pincode_id;

        $tota = $this->db->query("SELECT vendor_shop.*, admin_comissions.shop_id, admin_comissions.cat_id FROM vendor_shop INNER JOIN admin_comissions ON vendor_shop.id=admin_comissions.shop_id where vendor_shop.status=1 and vendor_shop.state_id='".$state_id."' and vendor_shop.city_id='".$city_id."' and find_in_set('".$pincode_id."',vendor_shop.vendor_pincodes) group by admin_comissions.shop_id order by vendor_shop.id");
        
        $qry = $this->db->query("SELECT vendor_shop.*, admin_comissions.shop_id, admin_comissions.cat_id FROM vendor_shop INNER JOIN admin_comissions ON vendor_shop.id=admin_comissions.shop_id where vendor_shop.status=1 and vendor_shop.state_id='".$state_id."' and vendor_shop.city_id='".$city_id."' and find_in_set('".$pincode_id."',vendor_shop.vendor_pincodes) group by admin_comissions.shop_id order by vendor_shop.id LIMIT ".$start_from.",".$perpage);
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {
                    /*echo "select * from vendor_shop where id='".$value1->shop_id."' and status=1";
                    $row = $this->db->query("select * from vendor_shop where id='".$value1->shop_id."' and status=1");
                    $value = $row->row();
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";;
                        }


                        
                        $shop_qry = $this->db->query("select * from shop_favorites where shop_id='".$value->id."' and user_id='".$user_id."'");
                        if($shop_qry->num_rows()>0)
                        {
                            $shop_not = true;
                        }
                        else
                        {
                            $shop_not = false;
                        }


                         $lat1 = $lat; 
                         $lon1 = $lng;

                        $lat2 = $value->lat;
                        $lon2 = $value->lng;

                          if (($lat1 == $lat2) && ($lon1 == $lon2)) 
                          {
                            $km = 0;
                          }
                          else {
                            $theta = $lon1 - $lon2;
                            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                            $dist = acos($dist);
                            $dist = rad2deg($dist);
                            $miles = $dist * 60 * 1.1515;
                            $unit = strtoupper($unit);

                            $km = ($miles * 1.609344);
                          }
                          $admin = $this->db->query("select * from admin where id=1");
                          $admin_row = $admin->row();

                         


                     $pro = $this->db->query("select * from products where shop_id='".$value->id."' and status=1");
                     $product_total = $pro->num_rows();
                     /*if($pro->num_rows()>0)
                     {
                        if($value->status==1)
                        {
                            $stat = "Open";
                        }
                        else
                        {
                             $stat = "Closed";
                        }


                       
                          
                          if(round($km)<=$admin_row->distance)
                          {
                            if($product_total>0)
                            {
                                $ar[]=array('id'=>$value->id,'cat_id'=>$value->cat_id,'shop_name'=>$value->shop_name,'description'=>$value->description,'image'=>$img,'status'=>$stat,'shop_not'=>$shop_not,'distance'=>round($km),'product_total'=>$product_total);
                            }
                         }
                     /*}
                }
            return array('status' =>TRUE,'shop_list'=>$ar,'shops_count'=>count($ar),'total'=>$tota->num_rows());
        }
        else{
            return array('status' =>FALSE,'message'=>"No Shops",'shops_count'=>count($ar),'total'=>$tota->num_rows());
        }
    

    }

    function getshopsWithcategoryID($cat_id,$subcatid,$user_id,$lat,$lng)
    {
        /*if($cat_id=='all')
        {
            $qry = $this->db->query("select * from admin_comissions group by shop_id");
        }
        else
        {
            
        }

        $qry = $this->db->query("select * from admin_comissions where cat_id='".$cat_id."' and find_in_set('".$subcatid."',subcategory_ids)  group by shop_id");
        
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value1) 
                {

                     $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
                    $row = $qry->row();
                    $state_id = $row->state_id;
                    $city_id = $row->address_id;
                    $pincode_id = $row->pincode_id;
                    

                    $row = $this->db->query("select * from vendor_shop where id='".$value1->shop_id."' and status=1 and state_id='".$state_id."' and city_id='".$city_id."' and find_in_set('".$pincode_id."',vendor_pincodes)");
                    $value = $row->row();
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";;
                        }


                        
                        $shop_qry = $this->db->query("select * from shop_favorites where shop_id='".$value->id."' and user_id='".$user_id."'");
                        if($shop_qry->num_rows()>0)
                        {
                            $shop_not = true;
                        }
                        else
                        {
                            $shop_not = false;
                        }


                         $lat1 = $lat; 
                         $lon1 = $lng;

                        $lat2 = $value->lat;
                        $lon2 = $value->lng;

                          if (($lat1 == $lat2) && ($lon1 == $lon2)) 
                          {
                            $km = 0;
                          }
                          else {
                            $theta = $lon1 - $lon2;
                            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                            $dist = acos($dist);
                            $dist = rad2deg($dist);
                            $miles = $dist * 60 * 1.1515;
                            $unit = strtoupper($unit);

                            $km = ($miles * 1.609344);
                          }
                          $admin = $this->db->query("select * from admin where id=1");
                          $admin_row = $admin->row();

                         


                     $pro = $this->db->query("select * from products where shop_id='".$value->id."' and status=1");
                     $product_total = $pro->num_rows();
                     if($pro->num_rows()>0)
                     {
                        if($value->status==1)
                        {
                            $stat = "Open";
                        }
                        else
                        {
                             $stat = "Closed";
                        }


                       
                          
                          /*if(round($km)<=$admin_row->distance)
                          {
                                $ar[]=array('id'=>$value->id,'shop_name'=>$value->shop_name,'description'=>$value->description,'image'=>$img,'status'=>$stat,'shop_not'=>$shop_not,'distance'=>round($km),'product_total'=>$product_total);
                         /*}
                     }
                }
            return array('status' =>TRUE,'shop_list'=>$ar,'shops_count'=>count($ar));
        }
        else{
            return array('status' =>FALSE,'message'=>"No Shops",'shops_count'=>count($ar));
        }
    }
*/


    function getcategoryWithshopID($shop_id)
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

               $ar[]=array('id'=>$categories->id,'category_name'=>$categories->category_name,'description'=>$categories->description,'image'=>$img);
            }
            return array('status' =>TRUE,'categories'=>$ar);
        }
        else
        {
            return array('status' =>FALSE,'message'=>"No Categories");
        }
    }

    /*function getSublimitCategories($shop_id,$cat_id,$user_id)
    {
        $products = $this->bestSeller($shop_id,$user_id);
        if($cat_id=='shop')
        {
            $admin = $this->db->query("SELECT * FROM `admin_comissions` where shop_id='".$shop_id."'");
        }
        else
        {
           $admin = $this->db->query("SELECT * FROM `admin_comissions` where shop_id='".$shop_id."' and cat_id='".$cat_id."'"); 
        }
        
        $admin_result = $admin->result();
        if($admin->num_rows()>0)
        {
            foreach ($admin_result as $admin_row) 
            {
                if($admin_row->subcategory_ids!='')
                {
                        $subcategory_ids =$admin_row->subcategory_ids;
                         $qry = $this->db->query("select * from sub_categories where find_in_set(id,'".$subcategory_ids."')");
                         $value1 = $qry->result();
                         foreach ($value1 as $value) {
                          if($value->app_image!='')
                            {
                                $img = base_url()."uploads/sub_categories/".$value->app_image;
                            }
                            else
                            {
                                $img = base_url()."uploads/noproduct.png";
                            }

                        $ar[]=array('id'=>$value->id,'cat_id'=>$value->cat_id,'title'=>$value->sub_category_name,'image'=>$img);
                    }

                    
                       
                }
            }

            return array('status' =>TRUE,'subcategories'=>$ar,'best_products'=>$products);
         }
         else
        {
            return array('status' =>FALSE,'message'=>"No Sub Categories",'best_products'=>$products);
        }


        

    }*/

    function getSublimitCategories($shop_id,$cat_id,$user_id)
    {
        $products = $this->bestSeller($shop_id,$user_id);
        if($cat_id=='shop')
        {
            $admin = $this->db->query("SELECT cat_id,sub_cat_id FROM `products` where shop_id='".$shop_id."' and status=1 GROUP by sub_cat_id");
        }
        else
        {
           $admin = $this->db->query("SELECT cat_id,sub_cat_id FROM `products` where shop_id='".$shop_id."' and cat_id='".$cat_id."' and status=1 GROUP by sub_cat_id"); 
        }
        
        $admin_result = $admin->result();
        if($admin->num_rows()>0)
        {
            foreach ($admin_result as $admin_row) 
            {
                        $prod = $this->db->query("SELECT id FROM `products` where shop_id='".$shop_id."' and cat_id='".$admin_row->cat_id."' and sub_cat_id='".$admin_row->sub_cat_id."' and status=1");
                        $prod_total_rows = $prod->num_rows();
                        $subcategory_ids = $admin_row->sub_cat_id;
                         $qry = $this->db->query("select * from sub_categories where id='".$subcategory_ids."'");
                         $value = $qry->row();
                          if($value->app_image!='')
                            {
                                $img = base_url()."uploads/sub_categories/".$value->app_image;
                            }
                            else
                            {
                                $img = base_url()."uploads/noproduct.png";
                            }
                            if($qry->num_rows()>0)
                            {
                        $ar[]=array('id'=>$value->id,'cat_id'=>$value->cat_id,'sub_cat_id'=>$admin_row->sub_cat_id,'title'=>$value->sub_category_name,'image'=>$img,'products'=>$prod_total_rows);
                    }
                    

            }

            if(count($ar)==0)
            {
               return array('status' =>FALSE,'message'=>"No Sub Categories",'best_products'=>$products);
            }
            else
            {
                return array('status' =>TRUE,'subcategories'=>$ar,'best_products'=>$products);
            }

            
         }
         else
        {
            return array('status' =>FALSE,'message'=>"No Sub Categories",'best_products'=>$products);
        }


        

    }




    function getSubCategories($shop_id,$cat_id,$user_id)
    {
        $products = $this->bestSeller($shop_id,$user_id);
        $qry = $this->db->query("select * from sub_categories where cat_id='".$cat_id."'");
        $subcategory = $qry->result();
        if($qry->num_rows()>0)
        {
            $ar=[];
            foreach ($subcategory as $value) 
            {
                    if($value->app_image!='')
                    {
                        $img = base_url()."uploads/sub_categories/".$value->app_image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                $ar[]=array('id'=>$value->id,'title'=>$value->sub_category_name,'image'=>$img);
            }
             return array('status' =>TRUE,'subcategories'=>$ar,'best_products'=>$products);
        }
        else{
            return array('status' =>FALSE,'message'=>"No Sub Categories",'best_products'=>$products);
        }

    }

    function bestSeller($shop_id,$user_id)
    {
          $qry = $this->db->query("SELECT cart.variant_id FROM orders INNER JOIN cart ON orders.session_id=cart.session_id where orders.vendor_id='".$shop_id."' group by cart.variant_id");
          $result = $qry->result();
          $prod_ar=[];
          foreach ($result as $value) 
          {
             $link = $this->db->query("select * from link_variant where status=1 and id='".$value->variant_id."'");
             $link_row = $link->row();

             $prod = $this->db->query("select * from products where id='".$link_row->product_id."' and shop_id='".$shop_id."' and status=1");
             $products = $prod->row();
             
                    $im = $this->db->query("select * from product_images where product_id='".$link_row->product_id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }
                $wish = $this->db->query("select * from whish_list where product_id='".$link_row->product_id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }

             if($prod->num_rows()>0)
             {
                $prod_ar[]=array('id'=>$products->id,'name'=>$products->name,'shop_id'=>$products->shop_id,'cat_id'=>$products->cat_id,'image'=>$img,'saleprice'=>$link_row->saleprice,'whishlist_status'=>$stat);
             }
          }
          return $prod_ar;



    }

    function fetchsubcategories($cat_id,$subcat_id,$shop_id)
    {
             $sucat_qry1 = $this->db->query("select * from sub_categories where id='".$subcat_id."'");
                $sucat_row1 = $sucat_qry1->row();
                        if($sucat_row1->app_image!='')
                        {
                            $subcat_img1 = base_url()."uploads/sub_categories/".$sucat_row1->app_image;
                        }
                        else
                        {
                            $subcat_img1 = base_url()."uploads/noproduct.png";
                        }

                

            $sucat_qry = $this->db->query("select * from sub_categories where id='".$subcat_id."'");
                $sucat_row = $sucat_qry->result();
                $subcat_ar=[];
                foreach ($sucat_row as $subcat_value) 
                {
                        if($subcat_value->app_image!='')
                        {
                            $subcat_img = base_url()."uploads/sub_categories/".$subcat_value->app_image;
                        }
                        else
                        {
                            $subcat_img = base_url()."uploads/noproduct.png";
                        }

                    $subcat_ar[]=array('id'=>$subcat_value->id,'title'=>$subcat_value->sub_category_name,'image'=>$subcat_img);
                }

                /* $subcat_ar[0]=array('id'=>$sucat_row1->id,'title'=>$sucat_row1->sub_category_name,'image'=>$subcat_img1);*/
            return array('status' =>TRUE,'subcategories'=>$subcat_ar);
    }

    function getProducts($cat_id,$user_id,$start_from,$perpage,$lat,$lng)
    {
          $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;
        $qry1 = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.status=1 and products.cat_id='".$cat_id."' and products.status=1 group by link_variant.product_id order by products.id ASC");

        $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.status=1 and products.cat_id='".$cat_id."' and products.status=1 group by link_variant.product_id order by products.id ASC LIMIT ".$start_from.",".$perpage);

        //$qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 group by product_id");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {

                    /*$qry11 = $this->db->query("select * from products where cat_id='".$cat_id."' and sub_cat_id='".$subcat_id."'  and shop_id='".$shop_id."' and id='".$value12->product_id."' and status=1");
                    $value = $qry11->row();*/

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }


                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    /*$brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");
                    $brand = $brnd->row();*/

                    $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();


                    // print_r($value); 
                    $wish = $this->db->query("select * from whish_list where product_id='".$value->id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }

                        $ar[]=array('id'=>$value->id,'shop_id'=>$vendor->id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$vendor->shop_name,'price'=>$value->price,'saleprice'=>$value->saleprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat);
                    
                }


            return array('status' =>TRUE,'product_list'=>$ar,'total'=>$qry1->num_rows());
        }
        else
        {
           
            return array('status' =>FALSE, 'message'=>"No Products",'total'=>$qry1->num_rows());
        }

    }

    
    function searchProducts($cat_id,$shop_id,$user_id,$keyword)
    {
        $qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 group by product_id");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value12) 
                {
                    $qry11 = $this->db->query("select * from products where cat_id='".$cat_id."'  and shop_id='".$shop_id."' and id='".$value12->product_id."' and (meta_tag_description LIKE '%".$keyword."%' or name LIKE '%".$keyword."%' or meta_tag_title LIKE '%".$keyword."%' or meta_tag_keywords LIKE '%".$keyword."%' or product_tags LIKE '%".$keyword."%' ) and status=1");
                    $value = $qry11->row();

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value12->id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");
                    $brand = $brnd->row();

                    $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();


                    $wish = $this->db->query("select * from whish_list where product_id='".$value12->product_id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }


                    if($qry11->num_rows()>0)
                    {
                        $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$brand->brand_name,'shop'=>$vendor->shop_name,'price'=>$value12->price,'saleprice'=>$value12->saleprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat);
                    }
                }
            return array('status' =>TRUE,'product_list'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Products");
        }

    }
 
 function filterProductslist($type,$cat_id,$user_id,$lat,$lng)
 {

     $admin = $this->db->query("select * from admin where id=1");
     $search_distance = $admin->row()->distance;

        if($type==0)
        {
            $qry = $this->db->query("SELECT vendor_shop.id as shop_id,vendor_shop.shop_name,link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and  products.cat_id='".$cat_id."' and products.status=1  and vendor_shop.status=1 group by link_variant.product_id order by link_variant.id desc ");
                //having distance<".$search_distance."
            //$qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 group by product_id order by id desc");
        }
        else if($type==1)
        {
            $qry = $this->db->query("SELECT vendor_shop.id as shop_id,vendor_shop.shop_name,link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and  products.cat_id='".$cat_id."' and products.status=1  and vendor_shop.status=1 group by link_variant.product_id order by link_variant.saleprice desc ");
            //having distance<".$search_distance."
             //$qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 group by product_id order by saleprice desc");
        }
        else if($type==2)
        {
            $qry = $this->db->query("SELECT vendor_shop.id as shop_id,vendor_shop.shop_name,link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and  products.cat_id='".$cat_id."' and products.status=1  and vendor_shop.status=1 group by link_variant.product_id order by link_variant.saleprice asc ");
            //having distance<".$search_distance."
            //$qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 group by product_id order by saleprice asc");
        }
        
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {
                    /*$qry11 = $this->db->query("select * from products where cat_id='".$cat_id."' and sub_cat_id='".$subcat_id."' and shop_id='".$shop_id."' and id='".$value12->product_id."' and status=1");
                    $value = $qry11->row();*/

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    

                    /*$vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();*/



                    $wish = $this->db->query("select * from whish_list where product_id='".$value->product_id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }


                    
                       $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$value->shop_name,'price'=>$value->price,'saleprice'=>$value->saleprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat);
                   
                }
            return array('status' =>TRUE,'product_list'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Products");
        }

    

 }

 function fetchProducts($keyword)
 {

        $qry = $this->db->query("select * from products where name LIKE '%".$keyword."%' and status=1");
        $dat = $qry->result();
    
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {
                    $qry1 = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 and product_id='".$value->id."'");
                    $value12 = $qry1->row();

                     $im = $this->db->query("select * from product_images where product_id='".$value->product_id."' and variant_id='".$value->id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");
                    $brand = $brnd->row();

                    $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();



                    $wish = $this->db->query("select * from whish_list where product_id='".$value->id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }
                    if($value12->saleprice!='')
                    {
                       $slaeprice =  $value12->saleprice;
                    }
                    else
                    {
                        $slaeprice=0;
                    }

                    if($value12->price!='')
                    {
                       $price = $value12->price;
                    }
                    else
                    {
                        $price =0;
                    }

                         $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$brand->brand_name,'shop'=>$vendor->shop_name,'price'=>$price,'saleprice'=>$slaeprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat);
                    

                  
                }
            return array('status' =>TRUE,'product_list'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Products");
        }

    

 
 }


 function getProductDetails($pid)
 {
        $this->db->insert("most_viewed_products",array('product_id'=>$pid));

        $qry = $this->db->query("select * from products where id='".$pid."'");
        $value = $qry->row();
        if($qry->num_rows()>0)
        {
            $link_vari11 = $this->db->query("select * from link_variant where product_id='".$value->id."' and status=1 ");
                       $link_variants111 = $link_vari11->row();

                    $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$link_variants111->id."'");
                        $images1 = $im->row();

                        

                        if($images1->image!='')
                        {
                            $img = base_url()."uploads/products/".$images1->image;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";
                        }
                   
                    

                    $var1 = $this->db->query("select * from add_variant where product_id='".$value->id."'");
                    $variants1 = $var1->result();
                    $att1=[];
                    foreach ($variants1 as $value1) 
                    {
                        $type = $this->db->query("select * from attributes_title where id='".$value1->attribute_type."'");
                        $types = $type->row();
                        $ex = explode(",", $value1->attribute_values);
                        $values=[];
                        for ($i=0; $i < count($ex); $i++) 
                        { 
                            $val = $this->db->query("select * from attributes_values where id='".$ex[$i]."'");
                            $value1 = $val->row();
                            $values[]=array('id'=>$value1->id,'value'=>$value1->value);
                        }

                        $att1[]=array('id'=>$types->id,'attribute_type'=>$types->title,'attribute_values'=>$values);
                    }


                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");
                    $brand = $brnd->row();

                    $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();

                    $link_vari = $this->db->query("select * from link_variant where product_id='".$value->id."' and status=1 ");
                    $link_variants1 = $link_vari->result();
                    $link_variants=[];
                    foreach ($link_variants1 as $link_value) 
                    {
                       $im1 = $this->db->query("select * from product_images where product_id='".$link_value->product_id."' and variant_id='".$link_value->id."'");
                        $img_result1 = $im1->result();
                        
                            $img_ar1=[];
                            if($im1->num_rows()>0)
                            {
                                foreach ($img_result1 as $images1) 
                                {
                                    if($images1->image!='')
                                    {
                                        $img = base_url()."uploads/products/".$images1->image;
                                    }
                                    else
                                    {
                                        $img = base_url()."uploads/noproduct.png";
                                    }

                                    $img_ar1[]=array('image'=>$img);
                                }
                            }
                            else
                            {
                                $img = base_url()."uploads/noproduct.png";
                                $img_ar1[]=array('image'=>$img);
                            }
                            

                                if($link_value->stock>10)
                                {
                                    $stock = "Instock";
                                }
                                else
                                {
                                   $stock = $link_value->stock." Left";
                                }
                             $link_variants[]=array('id'=>$link_value->id,'price'=>$link_value->price,'saleprice'=>$link_value->saleprice,'jsondata'=>json_decode($link_value->jsondata),'imageslist'=>$img_ar1,'stock'=>$stock);
                           
                    }

                    
                   $ar=array('id'=>$value->id,'shop_id'=>$value->shop_id,'name'=>$value->name,'description'=>$value->descp,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$brand->brand_name,'brand_id'=>$value->brand,'shop'=>$vendor->shop_name,'product_tags'=>$value->product_tags,'meta_tag_title'=>$value->meta_tag_title,'meta_tag_description'=>$value->meta_tag_description,'meta_tag_keywords'=>$value->meta_tag_keywords,'key_features'=>$value->key_features,'cancel_status'=>$value->cancel_status,'return_status'=>$value->return_status,'attributes'=>$att1,'link_variants'=>$link_variants,'image'=>$img,'selling_date'=>date('d-m-Y',strtotime($value->selling_date)),'taxname'=>$value->taxname,'manage_stock'=>$value->manage_stock,'variant_product'=>$value->variant_product,'status'=>$value->status,'cat_id'=>$value->cat_id,'sub_cat_id'=>$value->sub_cat_id,'tax_class'=>$value->tax_class,'availabile_stock_status'=>$value->availabile_stock_status,'maximum_quantity'=>$link_value->stock);
                
            return array('status' =>TRUE,'product_details'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Products");
        }
    


 }


 function productDetailsFilter($pid,$json_data)
 {
         $jsons = json_encode($json_data); 

        $this->db->insert("most_viewed_products",array('product_id'=>$pid));
        $qry = $this->db->query("select * from products where id='".$pid."'");
        $value = $qry->row();
        if($qry->num_rows()>0)
        {
                    /*$link_vari_img = $this->db->query("select * from link_variant where product_id='".$value->id."' and  status=1 ");
                    $link_vari_img_row = $link_vari_img->row();
                    $im = $this->db->query("select * from product_images where product_id='".$link_vari_img_row->product_id."' and variant_id='".$link_vari_img_row->id."'");
                        $images1 = $im->row();
                        if($images1->image!='')
                        {
                            $img = base_url()."uploads/products/".$images1->image;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";
                        }*/
                   
                    


                    $var1 = $this->db->query("select * from add_variant where product_id='".$value->id."'");
                    $variants1 = $var1->result();
                    $att1=[];
                    foreach ($variants1 as $value1) 
                    {
                        $type = $this->db->query("select * from attributes_title where id='".$value1->attribute_type."'");
                        $types = $type->row();
                        $ex = explode(",", $value1->attribute_values);
                        $values=[];
                        for ($i=0; $i < count($ex); $i++) 
                        { 
                            $val = $this->db->query("select * from attributes_values where id='".$ex[$i]."'");
                            $value1 = $val->row();
                            $values[]=array('id'=>$value1->id,'value'=>$value1->value);
                        }

                        $att1[]=array('id'=>$types->id,'attribute_type'=>$types->title,'attribute_values'=>$values);
                    }


                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");
                    $brand = $brnd->row();

                    $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();
                    $link_vari = $this->db->query("select * from link_variant where product_id='".$value->id."' and status=1 and jsondata LIKE ".$jsons);
                    $link_variants1 = $link_vari->result();
                    $link_variants=[];
                    foreach ($link_variants1 as $link_value) 
                    {
                       $im1 = $this->db->query("select * from product_images where product_id='".$link_value->product_id."' and variant_id='".$link_value->id."'");
                        $img_result1 = $im1->result();
                        
                            $img_ar1=[];
                            if($im1->num_rows()==0)
                            {
                                $img = base_url()."uploads/noproduct.png";
                                $img_ar1[]=array('image'=>$img);
                            }
                            else
                            {
                            foreach ($img_result1 as $images1) 
                            {
                                if($images1->image!='')
                                {
                                    $img = base_url()."uploads/products/".$images1->image;
                                }
                                else
                                {
                                    $img = base_url()."uploads/noproduct.png";
                                }

                                $img_ar1[]=array('image'=>$img);
                            }
                        }

                            if($link_value->stock>10)
                                {
                                    $stock = "Instock";
                                }
                                else
                                {
                                   $stock = $link_value->stock." Left";
                                }
                             $link_variants[]=array('id'=>$link_value->id,'price'=>$link_value->price,'saleprice'=>$link_value->saleprice,'jsondata'=>json_decode($link_value->jsondata),'imageslist'=>$img_ar1,'stock'=>$stock);
                           
                    }


                    if($link_vari->num_rows()>0)
                    {
                   $ar=array('id'=>$value->id,'shop_id'=>$value->shop_id,'name'=>$value->name,'description'=>$value->descp,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$brand->brand_name,'brand_id'=>$value->brand,'shop'=>$vendor->shop_name,'product_tags'=>$value->product_tags,'meta_tag_title'=>$value->meta_tag_title,'meta_tag_description'=>$value->meta_tag_description,'meta_tag_keywords'=>$value->meta_tag_keywords,'key_features'=>$value->key_features,'cancel_status'=>$value->cancel_status,'return_status'=>$value->return_status,'attributes'=>$att1,'link_variants'=>$link_variants,'image'=>$img,'selling_date'=>date('d-m-Y',strtotime($value->selling_date)),'taxname'=>$value->taxname,'manage_stock'=>$value->manage_stock,'variant_product'=>$value->variant_product,'status'=>$value->status,'cat_id'=>$value->cat_id,'sub_cat_id'=>$value->sub_cat_id,'tax_class'=>$value->tax_class,'availabile_stock_status'=>$value->availabile_stock_status);
                
            return array('status' =>TRUE,'product_details'=>$ar);
        }
        else
        {
                return array('status' =>FALSE, 'message'=>"No Products");
        }
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Products");
        }
    


 }


function getDeals()
{
    $date = date("Y-m-d");
    $qry = $this->db->query("select * from deals where ( deal_start<='".$date."' and deal_end>='".$date."' )");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {
                    if($value->app_image!='')
                    {
                        $img = base_url()."uploads/deals/".$value->app_image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }
                    
                    if(strlen($value->title)>=10)
                        {
                            $name = substr($value->title,0,10)."...";
                        }
                        else
                        {
                            $name = $value->title;
                        }

                    $ven = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor_shops = $ven->row();

                                if($vendor_shops->status==1)
                                {
                                    $shopstat = "Open";
                                }
                                else
                                {
                                     $shopstat = "Closed";
                                }

                   $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'title'=>$name,'image'=>$img,'shop_name'=>$vendor_shops->shop_name,'status'=>$shopstat);
                }
                return array('status' =>TRUE,'deals'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Deals");
        }
}


function addToCart($session_id,$variant_id,$vendor_id,$user_id,$price,$quantity)
{
    $chk_quant_qry = $this->db->query("select * from link_variant where id='".$variant_id."'");
    $chk_quant_row = $chk_quant_qry->row();
    $stock=$chk_quant_row->stock;


    $chk = $this->db->query("select * from cart where session_id='".$session_id."'");
    if($chk->num_rows()>0)
    {
        $qry_chk = $this->db->query("select * from cart where session_id='".$session_id."' and user_id='".$user_id."' and vendor_id='".$vendor_id."' and variant_id='".$variant_id."'");
        if($qry_chk->num_rows()>0)
        {
                $row = $qry_chk->row();
                $qty = $row->quantity;
                $quantity_f = $quantity+$qty;
                if($stock<$quantity_f)
                {
                    $msg = "Left only ".$stock." Products";
                    return array('status' =>FALSE,'message'=>$msg);
                }


                $un_pric = $price*$quantity_f;
                $ar = array('quantity'=>$quantity_f,'unit_price'=>$un_pric);
                $wr = array('session_id'=>$session_id,'variant_id'=>$variant_id,'vendor_id'=>$vendor_id,'user_id'=>$user_id);
                $ins = $this->db->update("cart",$ar,$wr);
                if($ins)
            {
                return array('status' =>TRUE,'message'=>"Product added to cart");
            }
        }
        else
        {

                if($stock<$quantity)
                {
                    $msg = "Left only ".$stock." Products";
                    return array('status' =>FALSE,'message'=>$msg);
                }

           $tprice = $price*$quantity;
            $ar = array('session_id'=>$session_id,'variant_id'=>$variant_id,'vendor_id'=>$vendor_id,'user_id'=>$user_id,'price'=>$price,'quantity'=>$quantity,'unit_price'=>$tprice);
            $ins = $this->db->insert("cart",$ar);
            if($ins)
            {
                return array('status' =>TRUE,'message'=>"Product added to cart");
            } 
        }
    }
    else
    {
                if($stock<$quantity)
                {
                    $msg = "Left only ".$stock." Products";
                    return array('status' =>FALSE,'message'=>$msg);
                }

            $tprice = $price*$quantity;
            $ar = array('session_id'=>$session_id,'variant_id'=>$variant_id,'vendor_id'=>$vendor_id,'user_id'=>$user_id,'price'=>$price,'quantity'=>$quantity,'unit_price'=>$tprice);
            $ins = $this->db->insert("cart",$ar);
            if($ins)
            {
                return array('status' =>TRUE,'message'=>"Product added to cart");
            }
    }
}


function getCartList($session_id)
{
    $qry = $this->db->query("select * from cart where session_id='".$session_id."'");
    $del_b = $qry->row();


    $delivery_qry = $this->db->query("select * from deliveryboy_amount where id=1");
    $delivery_row = $delivery_qry->row();
    $min_order_amount = $delivery_row->amount;

    $shop = $this->db->query("select * from vendor_shop where id='".$del_b->vendor_id."'");
    $shopdat = $shop->row();
    
    

    $result = $qry->result();
    $ar=[];
    if($qry->num_rows()>0)
    {
        $unitprice=0;
        $gst=0;
        foreach ($result as $value) 
        {
            $pro = $this->db->query("select * from  product_images where variant_id='".$value->variant_id."'");
            $product = $pro->row();

            if($product->image!='')
            {
                $img = base_url()."uploads/products/".$product->image;
            }
            else
            {
                $img = base_url()."uploads/noproduct.png";
            }
            //$value->variant_id
                $var1 = $this->db->query("select * from link_variant where id='".$value->variant_id."'");
                $link = $var1->row();

                 $pro1 = $this->db->query("select * from  products where id='".$link->product_id."'");
                 $product1 = $pro1->row();

                 $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."' and shop_id='".$value->vendor_id."'");
                 if( $adm_qry->num_rows()>0)
                 {
                    $adm_comm = $adm_qry->row();
                    $p_gst = $adm_comm->gst;

                 }
                 else
                 {
                    $p_gst = '0';
                 }

                 $class_percentage = ($value->unit_price/100)*$p_gst;

                 

                    $variants1 = $var1->result();
                    $att1=[];
                    foreach ($variants1 as $value1) 
                    {

                        

                        $jsondata = $value1->jsondata;

                        $values_ar=[];

                        $json =json_decode($jsondata);
                        foreach ($json as $value123) 
                        {
                            $type = $this->db->query("select * from attributes_title where id='".$value123->attribute_type."'");
                            $types = $type->row();
                        
                            $val = $this->db->query("select * from attributes_values where id='".$value123->attribute_value."'");
                            $value1 = $val->row();
                            $values_ar[]=array('id'=>$value1->id,'title'=>$types->title,'value'=>$value1->value);
                        }

                        

                    }


           $ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img,'attributes'=>$values_ar,'product_name'=>$product1->name,'shop_name'=>$shopdat->shop_name,'shop_id'=>$del_b->vendor_id,'gst'=>$class_percentage,'maximum_quantity'=>$link->stock);
           $unitprice = $value->unit_price+$unitprice;
            $gst = $class_percentage+$gst;
        }

        

        $grand_t =  $min_order_amount+$unitprice+$gst;
        return array('status' =>TRUE,'cartlist'=>$ar,'total_price'=>$unitprice,'delivery_amount'=>$min_order_amount,'grand_total'=>$grand_t,'gst'=>$gst);
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Empty Cart");
    }
    
}

function incrementQuantity($cart_id,$session_id)
{
    $cart_qry = $this->db->query("select * from cart where id='".$cart_id."'");
    if($cart_qry->num_rows()>0)
    {
            $cart_row = $cart_qry->row();
            $quantity = $cart_row->quantity+1;
            $unit_price = $quantity*$cart_row->price;
            $upd = $this->db->update("cart",array('quantity'=>$quantity,'unit_price'=>$unit_price),array('id'=>$cart_id));
            if($upd)
            {
                        $qry = $this->db->query("select * from cart where session_id='".$session_id."'");
                            $del_b = $qry->row();


                            
                            $shop = $this->db->query("select * from vendor_shop where id='".$del_b->vendor_id."'");
                            $shopdat = $shop->row();
                            $min_order_amount = $shopdat->min_order_amount;

                            $result = $qry->result();
                            $ar=[];
                            if($qry->num_rows()>0)
                            {
                                $unitprice=0;
                                $gst=0;
                                foreach ($result as $value) 
                                {
                                    $pro = $this->db->query("select * from  product_images where variant_id='".$value->variant_id."'");
                                    $product = $pro->row();

                                    if($product->image!='')
                                    {
                                        $img = base_url()."uploads/products/".$product->image;
                                    }
                                    else
                                    {
                                        $img = base_url()."uploads/noproduct.png";
                                    }
                                    //$value->variant_id
                                        $var1 = $this->db->query("select * from link_variant where id='".$value->variant_id."'");
                                        $link = $var1->row();
                                         $pro1 = $this->db->query("select * from  products where id='".$link->product_id."'");
                                         $product1 = $pro1->row();

                                         $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."' and shop_id='".$value->vendor_id."'");
                                         if( $adm_qry->num_rows()>0)
                                         {
                                            $adm_comm = $adm_qry->row();
                                            $p_gst = $adm_comm->gst;

                                         }
                                         else
                                         {
                                            $p_gst = '0';
                                         }

                                         $class_percentage = ($value->unit_price/100)*$p_gst;

                                         

                                            $variants1 = $var1->result();
                                            $att1=[];
                                            foreach ($variants1 as $value1) 
                                            {

                                                

                                                $jsondata = $value1->jsondata;

                                                $values_ar=[];

                                                $json =json_decode($jsondata);
                                                foreach ($json as $value123) 
                                                {
                                                    $type = $this->db->query("select * from attributes_title where id='".$value123->attribute_type."'");
                                                    $types = $type->row();
                                                
                                                    $val = $this->db->query("select * from attributes_values where id='".$value123->attribute_value."'");
                                                    $value1 = $val->row();
                                                    $values_ar[]=array('id'=>$value1->id,'title'=>$types->title,'value'=>$value1->value);
                                                }

                                                

                                            }


                                   $ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img,'attributes'=>$values_ar,'product_name'=>$product1->name,'shop_name'=>$shopdat->shop_name,'shop_id'=>$del_b->vendor_id,'gst'=>$class_percentage,'maximum_quantity'=>$link->stock);
                                   $unitprice = $value->unit_price+$unitprice;
                                    $gst = $class_percentage+$gst;
                                }

                                

                                $grand_t =  $min_order_amount+$unitprice+$gst;
                                return array('status' =>TRUE,'cartlist'=>$ar,'total_price'=>$unitprice,'delivery_amount'=>$min_order_amount,'grand_total'=>$grand_t,'gst'=>$gst);
                            }
                            else
                            {
                                return array('status' =>FALSE,'message'=>"Empty Cart");
                            }
            }
    }
    else
    {
            return array('status' =>FALSE,'message'=>"Something went wrong");
    }
}


function decrementQuantity($cart_id,$session_id)
{
    $cart_qry = $this->db->query("select * from cart where id='".$cart_id."'");
    if($cart_qry->num_rows()>0)
    {
            $cart_row = $cart_qry->row();

            if($cart_row->quantity==1)
            {
                $upd = $this->db->delete("cart",array('id'=>$cart_id));
            }
            else
            {
                $quantity = $cart_row->quantity-1;
                $unit_price = $quantity*$cart_row->price;

                $upd = $this->db->update("cart",array('quantity'=>$quantity,'unit_price'=>$unit_price),array('id'=>$cart_id));
            }
            if($upd)
            {
                        $qry = $this->db->query("select * from cart where session_id='".$session_id."'");
                            $del_b = $qry->row();


                            
                            $shop = $this->db->query("select * from vendor_shop where id='".$del_b->vendor_id."'");
                            $shopdat = $shop->row();
                            $min_order_amount = $shopdat->min_order_amount;

                            $result = $qry->result();
                            $ar=[];
                            if($qry->num_rows()>0)
                            {
                                $unitprice=0;
                                $gst=0;
                                foreach ($result as $value) 
                                {
                                    $pro = $this->db->query("select * from  product_images where variant_id='".$value->variant_id."'");
                                    $product = $pro->row();

                                    if($product->image!='')
                                    {
                                        $img = base_url()."uploads/products/".$product->image;
                                    }
                                    else
                                    {
                                        $img = base_url()."uploads/noproduct.png";
                                    }
                                    //$value->variant_id
                                        $var1 = $this->db->query("select * from link_variant where id='".$value->variant_id."'");
                                        $link = $var1->row();
                                         $pro1 = $this->db->query("select * from  products where id='".$link->product_id."'");
                                         $product1 = $pro1->row();

                                         $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."' and shop_id='".$value->vendor_id."'");
                                         if( $adm_qry->num_rows()>0)
                                         {
                                            $adm_comm = $adm_qry->row();
                                            $p_gst = $adm_comm->gst;

                                         }
                                         else
                                         {
                                            $p_gst = '0';
                                         }

                                         $class_percentage = ($value->unit_price/100)*$p_gst;

                                         

                                            $variants1 = $var1->result();
                                            $att1=[];
                                            foreach ($variants1 as $value1) 
                                            {

                                                

                                                $jsondata = $value1->jsondata;

                                                $values_ar=[];

                                                $json =json_decode($jsondata);
                                                foreach ($json as $value123) 
                                                {
                                                    $type = $this->db->query("select * from attributes_title where id='".$value123->attribute_type."'");
                                                    $types = $type->row();
                                                
                                                    $val = $this->db->query("select * from attributes_values where id='".$value123->attribute_value."'");
                                                    $value1 = $val->row();
                                                    $values_ar[]=array('id'=>$value1->id,'title'=>$types->title,'value'=>$value1->value);
                                                }

                                                

                                            }


                                   $ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img,'attributes'=>$values_ar,'product_name'=>$product1->name,'shop_name'=>$shopdat->shop_name,'shop_id'=>$del_b->vendor_id,'gst'=>$class_percentage,'maximum_quantity'=>$link->stock);
                                   $unitprice = $value->unit_price+$unitprice;
                                    $gst = $class_percentage+$gst;
                                }

                                

                                $grand_t =  $min_order_amount+$unitprice+$gst;
                                return array('status' =>TRUE,'cartlist'=>$ar,'total_price'=>$unitprice,'delivery_amount'=>$min_order_amount,'grand_total'=>$grand_t,'gst'=>$gst);
                            }
                            else
                            {
                                return array('status' =>FALSE,'message'=>"Empty Cart");
                            }
            }
    }
    else
    {
            return array('status' =>FALSE,'message'=>"Something went wrong");
    }
}

function removeCart($cart_id)
{
    $del = $this->db->delete("cart",array('id'=>$cart_id));
    if($del)
    {
        return array('status' =>TRUE,'message'=>"Cart delted successfully");
    }
}

function getCouponcodes($shop_id,$user_id)
{
    $date = date("Y-m-d");


        $qry = $this->db->query("select * from coupon_codes where ( shop_id='".$shop_id."' or shop_id=0 ) and ( start_date<='".$date."' and expiry_date>='".$date."' )");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {

                    $order_qry = $this->db->query("select * from orders where user_id='".$user_id."' and coupon_id='".$value->id."'");
                    $order_row = $order_qry->row();

                    $order_num_rows = $order_qry->num_rows();


                     if($order_num_rows==$value->utilization)
                     {}else{
                       $ar[]=array('id'=>$value->id,'coupon_code'=>$value->coupon_code,'description'=>$value->description,'percentage'=>$value->percentage,'maximum_amount'=>$value->maximum_amount,'minimum_order_amount'=>$value->minimum_order_amount);
                     }
                }

                if(count($ar)>0)
                {
                    return array('status' =>TRUE,'coupons'=>$ar);
                }
                else
                {
                    return array('status' =>FALSE, 'message'=>"No Coupons");
                }
                
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Coupons");
        }
}

function applyCoupon($coupon_code,$session_id,$coupon_status,$grand_total)
{
    if($coupon_status=='add')
    {
        $qry = $this->db->query("select * from coupon_codes where coupon_code='".$coupon_code."'");
        if($qry->num_rows()>0)
        {
            $row = $qry->row();


            $cprice = $row->maximum_amount;

            $percentage = $row->percentage;

            $dis_percentage = ($grand_total/100)*$percentage; 

            if($cprice<round($dis_percentage))
            {
                $final_amount = $grand_total-$cprice;
                $discount = number_format($cprice,2);
            }
            else
            {
                    if($grand_total<round($dis_percentage))
                    {
                        $final_amount =0;
                        $discount = number_format($cprice,2);
                    }
                    else
                    {
                        $final_amount = $grand_total-$dis_percentage;
                        $discount = number_format($dis_percentage,2);
                    }
                
            }



            return array('status' =>TRUE,'message'=>"Coupon Applied successfully",'grand_total' =>$final_amount,'discount' =>$discount,'coupon_id'=>$row->id,'coupon_code'=>$coupon_code);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid Coupon");
        }
    }
    else
    {
        $qry = $this->db->query("select * from coupon_codes where coupon_code='".$coupon_code."'");
        if($qry->num_rows()>0)
        {
            $row = $qry->row();

            $cprice = $row->maximum_amount;
            $cart = $this->db->query("select SUM(unit_price) as total_price from cart where session_id='".$session_id."'");
            $cart_row = $cart->row();

            $cart_price = $cart_row->total_price;
            return array('status' =>TRUE,'message'=>"Coupon removed successfully",'cart_total' =>$cart_price);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid Coupon");
        }
    }
    
}

function doOrder($session_id,$user_id,$deliveryaddress_id,$payment_option,$created_at,$order_status,$sub_total,$delivery_amount,$grand_total,$coupon_id,$coupon_code,$coupon_disount,$gst)
{
    $vendor_qry = $this->db->query("select * from cart where session_id='".$session_id."' group by vendor_id");
    $vendor_result = $vendor_qry->result();
    $vendor_ar=[];
    foreach ($vendor_result as $vendor_value) 
    {
        $vendor_ar[]=$vendor_value->vendor_id;
    }

    $sub_total=0;
    foreach ($vendor_ar as $vendor_ids) 
    {
        $qry = $this->db->query("select * from cart where session_id='".$session_id."' and vendor_id='".$vendor_ids."'");
        $result = $qry->result();
            $ar=[];
            $unitprice=0;
            $admin_total=0;
            foreach ($result as $value) 
            {
                $link = $this->db->query("select * from  link_variant where id='".$value->variant_id."'");
                $link_variants = $link->row();

                $pro = $this->db->query("select * from  products where id='".$link_variants->product_id."'");
                $product = $pro->row();

                $adm = $this->db->query("select * from  admin_comissions where shop_id='".$vendor_id."' and cat_id='".$product->cat_id."' and find_in_set('".$product->sub_cat_id."',subcategory_ids)");
                $admin = $adm->row();
                
                $admin_price = ($admin->admin_comission /100)*$value->price;
                

                

               $ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img);
               $unitprice = $value->unit_price+$unitprice;

               $admin_total = $admin_price+$admin_total;

               $total=$link_variants->stock-$value->quantity;



                $ar = array('varient_id'=>$value->variant_id,'product_id'=>$link_variants->product_id,'quantity'=>$value->quantity,'paid_status'=>'Debit','message'=>'New Order','total_stock'=>$total,'created_at'=>time());
                $ins11 = $this->db->insert("stock_management",$ar);

                if($ins11)
                {
                    $qty = $link_variants->stock-$value->quantity;
                   $this->db->update("link_variant",array('stock'=>$qty),array('id'=>$value->variant_id));
                } 
            }


            $admin_qry = $this->db->query("select * from  admin where id=1");
                $admin_row = $admin_qry->row();
                $admin_order_amount = $admin_row->order_amount;
                $coins = $admin_row->coins;

                $bonus = $grand_total/$admin_order_amount;
                $total_bonus = $bonus*$coins;
                $u_w = $this->db->query("select * from users where id='".$user_id."'");
                $wallet_row = $u_w->row();


                    $vendor =$unitprice-$admin_total; 

                    $coupon_qry = $this->db->query("select * from coupon_codes where id='".$coupon_id."'");
                    $coupon_row = $coupon_qry->row();
                    if($coupon_qry->num_rows()>0)
                    {
                        if($coupon_row->shop_id==0)
                        {
                            $admin_total1=$admin_total-$coupon_disount;
                            $vendor1=$vendor;
                        }
                        else
                        {
                            $vendor1=$vendor-$coupon_disount;
                            $admin_total1=$admin_total;
                        }

                    }
                    else
                    {
                        $admin_total1=$admin_total;
                        $vendor1=$vendor;
                    }


                $delivery_ad_qry = $this->db->query("select * from user_address where id='".$deliveryaddress_id."'");
                $delivery_ad_row = $delivery_ad_qry->row();

                /*$state_qry = $this->db->query("select * from states where id='".$delivery_ad_row->state."'");
                $state_qry_row = $state_qry->row();

                $cities_qry = $this->db->query("select * from cities where id='".$delivery_ad_row->city."'");
                $cities_qry_row = $cities_qry->row();

                $pincode_qry = $this->db->query("select * from pincodes where id='".$delivery_ad_row->pincode."'");
                $pincode_qry_row = $pincode_qry->row();*/
                

                if($delivery_ad_row->address_type==1)
                {
                    $add_type ="Home";
                }
                else if($delivery_ad_row->address_type==1)
                {
                    $add_type ="Office";
                }
               // $user_address = $add_type.": ".$delivery_ad_row->name.", ".$delivery_ad_row->state.", ".$delivery_ad_row->city.", ".$delivery_ad_row->pincode.", ".$delivery_ad_row->address.", ".$delivery_ad_row->landmark;
                 $user_address = $delivery_ad_row->address.", ".$delivery_ad_row->landmark.", ".$delivery_ad_row->city.", ".$delivery_ad_row->state.$delivery_ad_row->pincode;

                    
            $vendor_ar = array('session_id'=>$session_id,'vendor_id'=>$vendor_ids,'status'=>0,'sub_total'=>$unitprice,'coupon_code'=>$coupon_code,'coupon_id'=>$coupon_id,'coupon_disount'=>$coupon_disount,'gst'=>$gst);
            $this->db->insert("vendor_orders_values",$vendor_ar);
            //echo $this->db->last_query(); die;
            $sub_total=$sub_total+$unitprice;
    }

    $ar = array('session_id'=>$session_id,'user_id'=>$user_id,'vendor_id'=>$vendor_ids,'deliveryaddress_id'=>$deliveryaddress_id,'user_address'=>$user_address,'payment_option'=>$payment_option,'order_status'=>$order_status,'order_status'=>$order_status,'deliveryboy_commission'=>$delivery_amount,'created_at'=>$created_at,'sub_total'=>$sub_total,'total_price'=>$grand_total,'admin_commission'=>$admin_total1,'vendor_commission'=>$vendor1,'coupon_code'=>$coupon_code,'coupon_id'=>$coupon_id,'coupon_disount'=>$coupon_disount,'gst'=>$gst);
    $ins = $this->db->insert("orders",$ar);
       
    if($ins)
    {

        $last_id = $this->db->insert_id();
        $title = "New Order From Sector6";
                        $message = "You Have new Order";
        $this->onesignalnotification($vendor_id,$title,$message);
                        $st_email = $wallet_row->email;
                        $to_mail = $st_email;
                        $from_email = 'satish@colourmoon.com';
                        $site_name = 'Sector6';
                        $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;">
        <tr><td align="center" valign="top"><img src="'.base_url().'admin_assets/assets/images/logo.png" alt="" height="50"></td></tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td valign="top">
                <h1 style="margin:0px; padding:10px 0px; background-color: #000; text-align: center; font-weight: 300; color:#fff; font-size: 22px; text-align: center;">Your Order Details</h1>
                <div style="padding:15px;">
                <h4 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Hello '.$wallet_row->first_name.',</h4>
                <p style="margin:0px; padding:0px; font-size: 14px; text-align: justify; line-height: 20px; padding-bottom: 10px;">Thank you for shopping with us. We willl send a confirmation once your item has shipped. Your order details are indicated below. The payment details of your transaction can be found on the <a href="#" style="color:#f47a20; text-decoration: none;">order invoice</a>. If you would like to view the status of your order or make any changes to it, please visit Your Orders on Absolutemens</p>
                </div>
            </td>
        </tr>';

         $adrs = $this->db->query("select * from user_address where id='".$deliveryaddress_id."'");
         $address = $adrs->row();
                $full_address = $address->address.", ".$address->locality.", ".$address->city.", ".$address->state.", ".$address->pincode;

$email_message .='<tr>
            <td bgcolor="#f4f4f4" valign="top">
                <div style="padding:15px">
                    <table width="100%">
                        <tr>
                            <td valign="top">
                                <p style="margin:0px; padding:0px 0px 10px 0px; line-height: 22px; font-size: 14px;">Your order will be sent to: <br>
                                <strong>'.$user_address.'</strong></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>';
    
    $email_message .='<tr>
            <td valign="top">
                <div style="padding:15px">
                    <h3 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Order Details :</h3>
                    <p style="margin:0px; padding:0px;"><strong>Order # '.$last_id.'</strong></p>
                </div>
            </td>
        </tr>

        <tr>
            <td valign="top">
                <div style="padding:15px;">
                    <table width="100%" border="1" cellpadding="5" style="border-collapse: collapse; border-color: #666;">';





                            $qry1 = $this->db->query("select * from cart where session_id='".$session_id."'");
                            $result1 = $qry1->result();
                            $ar1=[];
                                $unitprice1=0;
                                $admin_total1=0;
                                $totalgst=0;
                                foreach ($result1 as $value) 
                                {

                                    $link1 = $this->db->query("select * from  link_variant where id='".$value->variant_id."'");
                                    $link_variants1 = $link1->row();

                                    $pro1 = $this->db->query("select * from  products where id='".$link_variants->product_id."'");
                                    $product1 = $pro1->row();

                                     $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."' and shop_id='".$value->vendor_id."'");
                                     if( $adm_qry->num_rows()>0)
                                     {
                                        $adm_comm = $adm_qry->row();
                                        $p_gst = $adm_comm->gst;

                                     }
                                     else
                                     {
                                        $p_gst = '0';
                                     }

                                     $class_percentage = ($value->unit_price/100)*$p_gst;


                                    $subcat = $this->db->query("select * from  sub_categories where id='".$product1->sub_cat_id."'");
                                    $subcategory = $subcat->row();

                                    
                                    $adm1 = $this->db->query("select * from  admin_comissions where cat_id='".$product->cat_id."'");
                                    $admin1 = $adm1->row();
                                    
                                    $admin_price1 = ($admin1->admin_comission /100)*$value->price;
                                    

                                     $im = $this->db->query("select * from product_images where product_id='".$link_variants->product_id."' and variant_id='".$value->variant_id."'");
                                         $images = $im->row();
                                        if($images->image!='')
                                        {
                                            $img = base_url()."uploads/products/".$images->image;
                                        }
                                        else
                                        {
                                            $img = base_url()."uploads/noproduct.png";
                                        }
                                 

                                   $ar1[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img);
                                   $unitprice1 = $value->unit_price+$unitprice1;
                                   $totalgst = $class_percentage+$totalgst;

                                   $admin_total1 = $admin_price1+$admin_total1;
                               


                $email_message .='<tr>
                        <td valign="top" align="center">
                        <img src="'.$img.'" alt="" height="80"></td>
                        
                        <td valign="top">
                            <p style="margin:0px; padding: 0px;"><strong>'.$product1->name.'</strong> <br>'.$subcategory->sub_category_name.'</p>
                        </td>
                        <td valign="top">
                            <p style="margin:0px; padding: 0px;">'.$value->price.' * '.$value->quantity.'</p>
                        </td>
                        <td valign="top" align="right">Rs. '.$value->unit_price.'</td>
                    </tr>';
                     }
                    

            $email_message .='<tr>
                        <td valign="top" colspan="4">
                            <table width="100%" cellpadding="5">
                                <tr>
                                    <td align="right" colspan="2">Item Sub Total :</td>
                                    <td align="right" width="25%">Rs. '.$unitprice1.'</td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="2">Delivery Amount :</td>
                                    <td align="right" width="25%">Rs. '.$delivery_amount.'</td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="2">GST :</td>
                                    <td align="right" width="25%">Rs. '.$totalgst.'</td>
                                </tr>

                                
                               
                                <tr>
                                    <td align="right" colspan="2"><strong>Order Total :</strong></td>
                                    <td align="right" width="25%"><strong>Rs.'.$grand_total.'</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>';

$email_message .='</table>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="padding:15px">
                    <p style="margin:0px; padding:0px;">Thank you for shopping with us.</p>
                <h3 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Sector6</h3>
                </div>
            </td>
        </tr>
        <tr>
            <td height="30"></td>
        </tr>
        <tr>
            <td bgcolor="#000" style="padding:30px 10px; text-align: center;">
                <a href="#" style="margin-right: 5px"><img src="http://htmldemo.in/2020/fashionmaa_emails/fb.png" alt="" height="40"></a>
                <a href="#" style="margin-right: 5px"><img src="http://htmldemo.in/2020/fashionmaa_emails/twitter.png" alt="" height="40"></a>
                <a href="#" style="margin-right: 5px"><img src="http://htmldemo.in/2020/fashionmaa_emails/youtube.png" alt="" height="40"></a>
                <a href="#"><img src="http://htmldemo.in/2020/fashionmaa_emails/instagram.png" alt="" height="40"></a>
                <p style="font-weight: 300; color:#fff; font-size: 11px;">&copy; Copyright 2020 Sector6., All Rights Reserved</p>
            </td>
        </tr>
    </table>';

                $this->load->library('email');
                require_once (APPPATH . 'libraries/vendor/autoload.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/PHPMailer.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/SMTP.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/Exception.php');

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->From = $from_email;
                $mail->FromName = $site_name;
                $mail->addAddress($to_mail); 
                $mail->addReplyTo($from_email, "Reply");
                $mail->isHTML(true);
                $mail->Sender = $from_email;
                $mail->Subject = "Your Order";
                $mail->Body = $email_message;
                $sucess = $mail->send();
                if($sucess)
                {
                    $data='mail sent successfully';
                    
                }
                else
                {
                    $data='mail not sent,Please try again';
                }

        $msg = "New Order Created ";
        $ins = $this->db->insert("wallet_transactions",array('user_id'=>$user_id,'price'=>$wallet_used_amount,'message'=>$msg,'status'=>'minus','created_at'=>time(),'order_id'=>$last_id));

        $vendor_shop_qry = $this->db->query("select * from vendor_shop where id='".$vendor_id."'");
        $vendor_shop_row = $vendor_shop_qry->row();
        $vendor_phone =$vendor_shop_row->mobile;


        $order_message = "Dear vendor new order no.".$last_id." is in your dashboard. Please accept it for confirmation. Regards Sector 6";
       
        $vendortemplat_id='1407163164501113887';

        if($this->send_message($order_message,$vendor_phone,$vendortemplat_id))
        {
           $this->db->insert("sms_notifications",array('order_id'=>$last_id,'receiver_id'=>$vendor_id,'sender_id'=>$user_id,'created_at'=>time(),'message'=>$order_message)); 
        }

       


        $user_sms_qry = $this->db->query("select * from users where id='".$user_id."'");
        $user_sms_row = $user_sms_qry->row();
        $user_phone = $user_sms_row->phone;
        $user_name = $user_sms_row->first_name." ".$user_sms_row->last_name;

        $templat_id_user='1407163164491308239';
        $user_order_message = "Dear ".$user_name." your order no.".$last_id." is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6";

        if($this->send_message($user_order_message,$user_phone,$templat_id_user))
        {
           $this->db->insert("sms_notifications",array('order_id'=>$last_id,'receiver_id'=>$user_id,'sender_id'=>$vendor_id,'created_at'=>time(),'message'=>$user_order_message)); 
        }
        return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$last_id);
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Something went wrong, Please try again",'order_id' =>$last_id);
    }
}







    function onesignalnotification($vendor_id,$title,$message)
    {
        $qr = $this->db->query("select * from vendor_shop where id='".$vendor_id."'");
        $res = $qr->row();
            if($res->token!='')
            {
                       
                        $user_id = $res->token;
                        
                        $fields = array(
        'app_id' => '4b59783f-818b-45fd-8d62-0f23bc163a71',
        'include_player_ids' => [$user_id],
        'contents' => array("en" =>$message),
        'headings' => array("en"=>$title),
        'android_channel_id' => 'b8be1c48-6ba0-44cd-ac04-447b526e5ee7'
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



function doBidorder($bid,$session_id,$total_price,$user_id,$address_id,$payment_option,$order_status,$created_at,$vendor_id)
{
    $date = date("Y-m-d H:i:s");

    $delivery_boy=0;
    $admin_commission=0;
    $vendor_commission=0;
    $deliveryboy_commission = 0;
    $gst =0;
    $sub_total = 0;

    $array = array('bid_id'=>$bid,'session_id'=>$session_id,'user_id'=>$user_id,'vendor_id'=>$vendor_id,'deliveryaddress_id'=>$address_id,'payment_option'=>$payment_option,'payment_status'=>0,'order_status'=>$order_status,'created_at'=>$created_at,'created_date'=>$date,'total_price'=>$total_price,'delivery_boy'=>$delivery_boy,'admin_commission'=>$admin_commission,'vendor_commission'=>$vendor_commission,'deliveryboy_commission'=>$deliveryboy_commission,'gst'=>$gst,'sub_total'=>$sub_total);
    $ins = $this->db->insert('orders',$array);

    if($ins)
    {
         $last_id = $this->db->insert_id();
         $this->db->update("bid_quotations",array('accept'=>'yes'),array('user_id'=>$user_id,'vendor_id'=>$vendor_id,'bid_id'=>$bid));
         $this->db->update("user_bids",array('bid_status'=>2),array('id'=>$bid));
         return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$last_id);
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Something went wrong, Please try again");
    }

}

function orderList($user_id,$order_status)
{
        if($order_status=='all_orders')
        {
            $qry = $this->db->query("select * from orders where user_id='".$user_id."' and  order_status!=0 order by id desc");
        }
        else if($order_status=='ongoing')
        {
            $qry = $this->db->query("select * from orders where user_id='".$user_id."' and  order_status in (1,2,3,4) order by id desc");
        }
        else if($order_status=='delivered')
        {
            $qry = $this->db->query("select * from orders where user_id='".$user_id."' and  order_status=5 order by id desc");
        }
        else if($order_status=='cancel')
        {
            $qry = $this->db->query("select * from orders where user_id='".$user_id."' and  order_status=6 order by id desc");
        }
        
        if($qry->num_rows()>0)
        {
            $result = $qry->result();
            $ar=[];
            foreach ($result as $value) 
            {   
                $qry = $this->db->query("select * from users where id='".$value->user_id."'");
                $users = $qry->row();
                $name = $users->first_name." ".$users->last_name;

                $ven = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                $vendor = $ven->row();
                
                $adrs = $this->db->query("select * from user_address where id='".$value->deliveryaddress_id."'");
                $address = $adrs->row();
                $full_address = $address->address.",".$address->locality.",".$address->city.",".$address->state;
                if($value->payment_status==0)
                {
                    $payment_status="UnPaid";
                }
                else
                {
                    $payment_status="Paid";
                }

                if($value->order_status==1)
                {
                    $order_status = "Pending";
                }
                else if($value->order_status==2)
                {
                     $order_status = "Proccessing";
                }
                else if($value->order_status==3)
                {
                     $order_status = "Assigned to delivery to pick up";
                }
                else if($value->order_status==4)
                {
                    $order_status = "Delivery Boy On the way";
                }
                else if($value->order_status==5)
                {
                    $order_status = "Delivered";
                }
                else if($value->order_status==6)
                {
                    $order_status = "Cancelled";
                }
                else if($value->order_status==7)
                {
                    $order_status = "Refund Completed";
                }


                

                $ven1 = $this->db->query("select * from user_reviews where user_id='".$user_id."' and order_id='".$value->id."'");
               
                if($ven1->num_rows()>0)
                {
                    $review_status='true';
                }
                else
                {
                    $review_status='false';
                }
                
               $ar[]=array('id'=>$value->id,'session_id'=>$value->session_id,'customer_name'=>$name,'vendor_name'=>$vendor->shop_name,'address'=>$full_address,'payment_status'=>$payment_status,'payment_type'=>$value->payment_option,'service_status'=>$order_status,'amount'=>$value->total_price,'created_date'=>date('d-m-Y',$value->created_at),'order'=>$value->order_status,'review_status'=>$review_status,'vendor_id'=>$value->vendor_id,'user_id'=>$value->user_id,'payment_status'=>$value->payment_status);
            }
            return array('status' =>TRUE, 'orders'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Orders");
        }
    
    
}




function completedOrders($user_id)
{
        $qry = $this->db->query("select * from orders where user_id='".$user_id."' and  order_status in (5,6) order by id desc");
        if($qry->num_rows()>0)
        {
            $result = $qry->result();
            $ar=[];
            foreach ($result as $value) 
            {   
                $qry = $this->db->query("select * from users where id='".$value->user_id."'");
                $users = $qry->row();
                $name = $users->first_name." ".$users->last_name;

                $ven = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                $vendor = $ven->row();
                
                $adrs = $this->db->query("select * from user_address where id='".$value->deliveryaddress_id."'");
                $address = $adrs->row();
                $full_address = $address->address.",".$address->locality.",".$address->city.",".$address->state;
                if($value->payment_status==0)
                {
                    $payment_status="UnPaid";
                }
                else
                {
                    $payment_status="Paid";
                }

                if($value->order_status==1)
                {
                    $order_status = "Pending";
                }
                else if($value->order_status==2)
                {
                     $order_status = "Proccessing";
                }
                else if($value->order_status==3)
                {
                     $order_status = "Assigned to delivery to pick up";
                }
                else if($value->order_status==4)
                {
                    $order_status = "Delivery Boy On the way";
                }
                else if($value->order_status==5)
                {
                    $order_status = "Delivered";
                }
                else if($value->order_status==6)
                {
                    $order_status = "Cancelled";
                }
                else if($value->order_status==7)
                {
                    $order_status = "Refund Completed";
                }
                
                if($value->order_status==5)
                {
                   $review = $this->db->query("select * from user_reviews where user_id='".$user_id."' and order_id='".$value->id."'");
                     if($review->num_rows()>0)
                     {
                        $review_status = false;
                     }
                     else
                     {
                        $review_status = true;
                     } 
                     $refund_status=true;
                }
                else
                {
                    $review_status = false;
                    $refund_status=false;
                }
                 


               $ar[]=array('id'=>$value->id,'session_id'=>$value->session_id,'customer_name'=>$name,'vendor_name'=>$vendor->shop_name,'address'=>$full_address,'payment_status'=>$payment_status,'payment_type'=>$value->payment_option,'service_status'=>$order_status,'amount'=>$value->total_price,'vendor_id'=>$value->vendor_id,'user_id'=>$value->user_id,'created_date'=>date('d-m-Y',$value->created_at),'review_status'=>$review_status,'refund_status'=>$refund_status);
            }
            return array('status' =>TRUE, 'orders'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Orders");
        } 
}

function orderDetails($oid)
{

        $qry = $this->db->query("select * from orders where id='".$oid."'");
        if($qry->num_rows()>0)
        {
            $value = $qry->row();
                            $cart = $this->db->query("select * from cart where session_id='".$value->session_id."'");
                            $cartdetails = $cart->result();
                            $cartdata=[];
                            foreach ($cartdetails as $c) 
                            {
                                    $var = $this->db->query("select * from link_variant where id='".$c->variant_id."'");
                                    $variants = $var->row();
                                    $pro = $this->db->query("select * from products where id='".$variants->product_id."'");
                                    $products = $pro->row();
                                    if($products->return_status=='yes')
                                    {
                                        $return_noof_days = $products->return_noof_days;
                                    }

                                $cartdata[]=array('cartid'=>$c->id,'productname'=>$products->name,'price'=>$c->price,'product_id'=>$products->id,'quantity'=>$c->quantity,'unit_price'=>$c->unit_price,'return_noof_days'=>$return_noof_days,'return_status'=>$products->return_status);
                            }

                 $add = $this->db->query("select * from user_address where id='".$value->deliveryaddress_id."'");
                 $address = $add->row();

                 $user_full_address = $address->address."".$address->locality."".$address->state."".$address->city."".$address->pincode;

                $qry = $this->db->query("select * from users where id='".$value->user_id."'");
                $users = $qry->row();
                $name = $users->first_name." ".$users->last_name;

                $ven = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                $vendor = $ven->row();
                
                $adrs = $this->db->query("select * from user_address where id='".$value->deliveryaddress_id."'");
                $address = $adrs->row();
                $full_address = $address->address.", ".$address->locality.", ".$address->city.", ".$address->state.", ".$address->pincode;
                if($value->payment_status==0)
                {
                    $payment_status="UnPaid";
                }
                else
                {
                    $payment_status="Paid";
                }

                if($value->order_status==1)
                {
                    $order_status = "Pending";
                }
                else if($value->order_status==2)
                {
                     $order_status = "Proccessing";
                }
                else if($value->order_status==3)
                {
                     $order_status = "Assigned to delivery to pick up";
                }
                else if($value->order_status==4)
                {
                    $order_status = "Delivery Boy On the way";
                }
                else if($value->order_status==5)
                {
                    $order_status = "Delivered";
                }
                else if($value->order_status==6)
                {
                    $order_status = "Cancelled";
                }
                else if($value->order_status==7)
                {
                    $order_status = "Refund Completed";
                }
                
                if($value->coupon_disount!='')
                {
                        $coupon_disount=$value->coupon_disount;
                }
                else
                {
                    $coupon_disount="0";
                }

                $deliv = $this->db->query("select * from deliveryboy where id='".$value->delivery_boy."'");
                if($deliv->num_rows()>0)
                {
                    $delivery_boy = $deliv->row();
                    $dl_name = $delivery_boy->name;
                    $dl_phone = $delivery_boy->phone;
                    $alternative_mobiles = $delivery_boy->alternative_mobiles;
                }
                else
                {
                    $dl_name = "";
                    $dl_phone = "";
                    $alternative_mobiles = "";
                }

                if($value->order_status==3 || $value->order_status==4 || $value->order_status==5)
                {
                    $show =  'show';
                }
                else
                {
                    $show =  'hide';
                }
                
               $ar=array('id'=>$value->id,'session_id'=>$value->session_id,'delivery_date'=>$value->delivery_timeslots,'order_status'=>$order_status,'vendor_name'=>$vendor->shop_name,'address'=>$full_address,'payment_status'=>$payment_status,'payment_type'=>$value->payment_option,'amount'=>$value->total_price,'sub_total'=>$value->sub_total,'placed_on'=>date('d-m-Y',$value->created_at),'cartdetails'=>$cartdata,'customer_name'=>$name,'mobile'=>$address->mobile,'address'=>$full_address,'coupon_disount'=>$coupon_disount,'deliveryboy_commission'=>$value->deliveryboy_commission,'vendor_id'=>$value->vendor_id,'user_id'=>$value->user_id,'deliveryboy_commission'=>$value->deliveryboy_commission,'delivery_name'=>$dl_name,'delivery_phone'=>$dl_phone,'alternative_mobiles'=>$alternative_mobiles,'order_status'=>$show,'order_condition'=>$value->order_status);
            
            return array('status' =>TRUE, 'ordersdetails'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Order ID Wrong");
        }
    
       
}

function add_removewhishList($product_id,$user_id)
{
    $qry = $this->db->query("select * from whish_list where product_id='".$product_id."' and user_id='".$user_id."'");
    if($qry->num_rows()>0)
    {
        $upd = $this->db->delete("whish_list",array('product_id'=>$product_id,'user_id'=>$user_id));
        if($upd)
        {
            return array('status' =>TRUE, 'message'=>"Removed from the Favourites");
        }
    }
    else
    {
        $ins = $this->db->insert("whish_list",array('product_id'=>$product_id,'user_id'=>$user_id));
        if($ins)
        {
            return array('status' =>TRUE, 'message'=>"Added to Favourites");
        }
    }
}


function whishList($user_id)
{
        $qry = $this->db->query("select * from whish_list where user_id='".$user_id."'");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $wl) 
                {
                    
                     $prod = $this->db->query("SELECT vendor_shop.shop_name,link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and  products.id='".$wl->product_id."' and products.status=1  and vendor_shop.status=1 group by link_variant.product_id order by products.id ASC");
                     $value = $prod->row();

                    /*$qry1 = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 and product_id='".$value->id."'");
                    $value12 = $qry1->row();*/

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    $brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");
                    $brand = $brnd->row();

                    $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();



                    $wish = $this->db->query("select * from whish_list where product_id='".$value->id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }

                    if($value->saleprice!='')
                    {
                       $slaeprice =  $value->saleprice;
                    }
                    else
                    {
                        $slaeprice=0;
                    }

                    if($value->price!='')
                    {
                       $price = $value->price;
                    }
                    else
                    {
                        $price =0;
                    }
                        
                         $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$brand->brand_name,'shop'=>$value->shop_name,'price'=>$price,'saleprice'=>$slaeprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat);
                        
                    

                  
                }
            return array('status' =>TRUE,'product_list'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Whishlist Products");
        }
}


function profileDetails($user_id)
{
    $qry = $this->db->query("select * from users where id='".$user_id."'");
    if($qry->num_rows()>0)
    {
        $row = $qry->row();
        if($row->image!='')
        {
             $image = base_url()."uploads/users/".$row->image;
        }
        else
        {
             $image = base_url()."uploads/profile-icon-3.png";
        }
       
        $ar = array('id'=>$row->id,'first_name'=>$row->first_name,'last_name'=>$row->last_name,'email'=>$row->email,'phone'=>$row->phone,'image'=>$image);
         return array('status' =>TRUE,'profile_details'=>$ar);
    }
    else
    {
         return array('status' =>FALSE, 'message'=>"Invalid User Id");
    }
}

function browse_file($user_id)
    {
        $image = $this->upload_file('image'); 
        $ar = array('image'=>$image);
        $wr = array('id'=>$user_id);
        $upd = $this->db->update("users",$ar,$wr);
        if($upd)
        {
             return array('status' =>TRUE,'message'=>"Profile Updated successfully");
        }
        else
        {
            return array('status' =>FALSE,'message'=>"Something went wrong,Please try again");
        }
          
    }


    private function upload_file($file_name) {
        /*if($_FILES[$file_name]["size"]<'5114374')
        {*/
            //echo $_FILES[$file_name]["image"]; die;
            $upload_path1 = "./uploads/users/";
            $config1['upload_path'] = $upload_path1;
            $config1['allowed_types'] = "*";
            // $config1['allowed_types'] = "*";
            $config1['max_size'] = "204800000";
            $img_name1 = strtolower($_FILES[$file_name]['name']);
            $img_name1 = preg_replace('/[^a-zA-Z0-9\.]/', "_", $img_name1);
            $config1['file_name'] = date("YmdHis") . rand(0, 9999999) . "_" . $img_name1;
            $this->load->library('upload', $config1);
            $this->upload->initialize($config1);
            $this->upload->do_upload($file_name);
            $fileDetailArray1 = $this->upload->data();
            // echo $this->upload->display_errors();
            // die;

            return $fileDetailArray1['file_name'];
       /* }
        else
        {
            return 'false';
        }*/
        
    }


function updateProfile($user_id,$first_name,$last_name)
{
    $upd = $this->db->update("users",array('first_name'=>$first_name,'last_name'=>$last_name),array('id'=>$user_id));    
    if($upd)
    {
         return array('status' =>TRUE,'message'=>"Profile Updated successfully");
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Something went Wrong , Please try again");
    }
}

function attributesWithCategory($cat_id)
{
        $qry = $this->db->query("select * from manage_attributes where categories='".$cat_id."'");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $value) 
                {
                    $att = $this->db->query("select * from attributes_title where id='".$value->attribute_titleid."'");
                    $attribute = $att->row();

                     $typ = $this->db->query("select * from attributes_values where attribute_titleid='".$attribute->id."'");
                     $datails = $typ->result();
                      $ar_val=[];
                        foreach ($datails as $valuesdata) 
                        {                    
                           $ar_val[]=array('id'=>$valuesdata->id,'title'=>$valuesdata->value);
                        }

                   $ar[]=array('id'=>$attribute->id,'title'=>$attribute->title,'attributes_values'=>$ar_val);
                }
                return array('status' =>TRUE,'attributes'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Attributes");
        }
}

function fetchattributeValues($attribute_id)
{
    $qry = $this->db->query("select * from attributes_values where attribute_titleid='".$attribute_id."'");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {
                $ar=[];
                foreach ($dat as $values) 
                {                    
                   $ar[]=array('id'=>$values->id,'title'=>$values->value);
                }
                return array('status' =>TRUE,'attributes_values'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Attributes");
        }
}

function userReviews($user_id,$order_id,$vendor_id,$review,$rating,$createdat)
{
    $ins = $this->db->insert("user_reviews",array('user_id'=>$user_id,'order_id'=>$order_id,'vendor_id'=>$vendor_id,'review'=>$review,'rating'=>$rating,'createdat'=>$createdat));
    if($ins)
    {
        return array('status' =>TRUE, 'message'=>"Thank you for the review");
    }
    else
    {
        return array('status' =>FALSE, 'message'=>"Something went wrong, Please try again");
    }
}

function getNearByShops($lat,$lng)
{


             $row = $this->db->query("select * from vendor_shop where status=1");
             $dat = $row->result();
                $ar=[];
                foreach ($dat as $value) 
                {
                   
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";
                        }

                        $lat1 = $lat; 
                        $lon1 = $lng;

                        $lat2 = $value->lat;
                       $lon2 = $value->lng;

                          if (($lat1 == $lat2) && ($lon1 == $lon2)) 
                          {
                            return 0;
                          }
                          else {
                            $theta = $lon1 - $lon2;
                            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                            $dist = acos($dist);
                            $dist = rad2deg($dist);
                            $miles = $dist * 60 * 1.1515;
                            $unit = strtoupper($unit);

                            $km = ($miles * 1.609344);
                          }
                          $admin = $this->db->query("select * from admin where id=1");
                          $admin_row = $admin->row();
                          if(round($km)<=$admin_row->distance)
                          {
                             $pro = $this->db->query("select * from products where shop_id='".$value->id."'");
                             if($pro->num_rows()>0)
                             {
                                if(strlen($value->shop_name)>=10)
                                {
                                    $shopname = substr($value->shop_name,0,10)."...";
                                }
                                else
                                {
                                    $shopname = $value->shop_name;
                                }

                                if($value->status==1)
                                {
                                    $stat = "Open";
                                }
                                else
                                {
                                     $stat = "Closed";
                                }

                                $ar[]=array('id'=>$value->id,'shop_name'=>$shopname,'description'=>$value->description,'image'=>$img,'distance'=>number_format($km,2),'status'=>$stat);
                             }
                         }
                }
            return array('status' =>TRUE,'shop_list'=>$ar,'shops_count'=>count($ar));

}

function getVenodorShopswithCatId($cat_id)
{
        $qry = $this->db->query("select * from admin_comissions where cat_id='".$cat_id."' group by shop_id");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value1) 
                {
                    $row = $this->db->query("select * from vendor_shop where id='".$value1->shop_id."' and status=1");
                    $value = $row->row();
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";;
                        }


                        
                        $shop_qry = $this->db->query("select * from shop_favorites where shop_id='".$value->id."' and user_id='".$user_id."'");
                        if($shop_qry->num_rows()>0)
                        {
                            $shop_not = true;
                        }
                        else
                        {
                            $shop_not = false;
                        }


                         

                         


                     $pro = $this->db->query("select * from products where shop_id='".$value->id."'");
                     $total_products = $pro->num_rows();
                     
                        if($value->status==1)
                        {
                            $stat = "Open";
                        }
                        else
                        {
                             $stat = "Closed";
                        }

                       $ar[]=array('id'=>$value->id,'shop_name'=>$value->shop_name,'description'=>$value->description,'image'=>$img,'status'=>$stat,'shop_not'=>$shop_not,'total_products'=>$total_products);
                     
                }
            return array('status' =>TRUE,'shop_list'=>$ar,'shops_count'=>count($ar));
        }
        else{
            return array('status' =>FALSE,'message'=>"No Shops",'shops_count'=>count($ar));
        }
    }


function searchByNearByShops($title,$lat,$lng)
{

        $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;


        $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and  products.name LIKE '%".$title."%' and vendor_shop.status=1 and products.status=1 group by link_variant.product_id order by products.id ASC");
        //having distance<".$search_distance."
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar1=[];
                foreach ($dat as $value) 
                {

                    /*$qry11 = $this->db->query("select * from products where id='".$value12->product_id."' and ( name LIKE '%".$title."%' or meta_tag_description LIKE '%".$title."%' or meta_tag_title LIKE '%".$title."%' or meta_tag_keywords LIKE '%".$title."%' or product_tags LIKE '%".$title."%' ) ");
                    $value = $qry11->row();*/

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    
                        $ar1[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'title'=>$value->name,'image'=>$img,'cat_id'=>$value->cat_id);
                    
                }

        }
        else
        {
            $ar1=array();
        }


             
                $ar['products'] =$ar1;

            return array('status' =>TRUE,'data'=>$ar,'shops_count'=>count($ar2));


}


function shopsLogo($lat,$lng)
{
             $row = $this->db->query("select * from vendor_shop");
             $dat = $row->result();
                $ar=[];
                foreach ($dat as $value) 
                {
                   
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = "";
                        }

                        $lat1 = $lat; 
                        $lon1 = $lng;

                        $lat2 = $value->lat;
                       $lon2 = $value->lng;

                        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                            $km = 0;
                          }
                          else {
                            $theta = $lon1 - $lon2;
                            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                            $dist = acos($dist);
                            $dist = rad2deg($dist);
                            $miles = $dist * 60 * 1.1515;
                            $unit = strtoupper($unit);

                            $km = ($miles * 1.609344);
                          }

                          $admin = $this->db->query("select * from admin where id=1");
                          $admin_row = $admin->row();
                          if(round($km)<=$admin_row->distance)
                          {
                             $pro = $this->db->query("select * from products where shop_id='".$value->id."'");
                             if($pro->num_rows()>0)
                             {
                                $ar[]=array('id'=>$value->id,'shop_name'=>$value->shop_name,'shop_logo'=>$img);
                             }
                         }
                }
            return array('status' =>TRUE,'shop_logos'=>$ar);



}

function getVendorProfile($vendor_id)
{
        $qry = $this->db->query("select * from vendor_shop where id='".$vendor_id."'");
        $row = $qry->row();
        if($row->shop_logo!='')
        {
            $shopimg = base_url()."uploads/shops/".$row->shop_logo;
        }
        else
        {
            $shopimg = base_url()."uploads/noproduct.png";
        }
        
        if($row->logo!='')
        {
            $shoplogo = base_url()."uploads/shops/".$row->logo;
        }
        else
        {
            $shoplogo = base_url()."uploads/noproduct.png";
        }

        
        $qry1 = $this->db->query("select * from user_reviews where vendor_id='".$vendor_id."'");
        $result1 = $qry1->result();
        $review_list=[];
            foreach ($result1 as $value1) 
            {
                $user = $this->db->query("select * from users where id='".$value1->user_id."'");
                $users = $user->row();
                $name = $users->first_name." ".$users->last_name;

                if($users->image!='')
                {
                    $img = base_url()."uploads/users/".$users->image;
                }
                else
                {
                    $img = base_url()."uploads/noproduct.png";
                }
               $review_list[] = array('id'=>$value1->id,'review'=>$value1->review,'rating'=>$value1->rating,'name'=>$name,'user_image'=>$img,'createdat'=>date("d-M,Y",$value1->createdat));


            }
            
            if($row->status==0)
            {
                $shopstatus ='closed';
            }
            else
            {
                $shopstatus ='open';
            }
        $ar = array('id'=>$row->id,'shop_name'=>$row->shop_name,'owner_name'=>$row->owner_name,'email'=>$row->email,'description'=>$row->description,'mobile'=>$row->mobile,'address'=>$row->address,'city'=>$row->city,'pincode'=>$row->pincode,'shop_image'=>$shopimg,'min_order_amount'=>$row->min_order_amount,'delivery_time'=>$row->delivery_time,'shop_status'=>$shopstatus,'shop_logo'=>$shoplogo,'reviews'=>$review_list);
        
        return array('status' =>TRUE, 'vendor_details'=>$ar);
    

}


function add_removeFavorites($shop_id,$user_id)
{
    $qry = $this->db->query("select * from shop_favorites where shop_id='".$shop_id."' and user_id='".$user_id."'");
    if($qry->num_rows()>0)
    {
        $upd = $this->db->delete("shop_favorites",array('shop_id'=>$shop_id,'user_id'=>$user_id));
        if($upd)
        {
            return array('status' =>TRUE, 'message'=>"Removed from the Favorite");
        }
    }
    else
    {
        $ins = $this->db->insert("shop_favorites",array('shop_id'=>$shop_id,'user_id'=>$user_id));
        if($ins)
        {
            return array('status' =>TRUE, 'message'=>"Added to Favorite");
        }
    }
}

function getOrdersDetails($oid)
{
        $qry = $this->db->query("select * from orders where id='".$oid."'");
        if($qry->num_rows()>0)
        {
                $value = $qry->row();
                            $cart = $this->db->query("select * from cart where session_id='".$value->session_id."'");
                            $cartdetails = $cart->result();
                            $cartdata=[];
                            foreach ($cartdetails as $c) 
                            {
                                    $var = $this->db->query("select * from link_variant where id='".$c->variant_id."'");
                                    $variants = $var->row();

                                    if($c->status==1)
                                    {
                                        $refundmsg = "Refund Request sent";
                                    }
                                    else if($c->status==2)
                                    {
                                        $refundmsg = "Refund Completed";
                                    }
                                    else
                                    {
                                        $refundmsg = "";
                                    }

                                    $im = $this->db->query("select * from product_images where product_id='".$variants->product_id."' and variant_id='".$variants->id."'");
                                     $images = $im->row();


                                    if($images->image!='')
                                    {
                                        $img = base_url()."uploads/products/".$images->image;
                                    }
                                    else
                                    {
                                        $img = base_url()."uploads/noproduct.png";
                                    }

                                    
                                    $or = $this->db->query("select * from orders where session_id='".$c->session_id."'");
                                    $ord_s = $or->row();
                                    
                                    if($ord_s->order_status==5 || $ord_s->order_status==7)
                                    {
                                            $pro = $this->db->query("select * from products where id='".$variants->product_id."' and delete_status=0");
                                            $products = $pro->row();

                                            $cancel_status = $products->cancel_status;
                                            $return_status = $products->return_status;
                                        if($cancel_status=='yes' || $return_status=='yes')
                                        {
                                            $orderDate = $ord_s->created_date;
                                            $days = $products->return_noof_days;

                                           $ldate = strtotime(date("Y-m-d", strtotime($orderDate)) . " +".$days."days"); 
                                           $odr_start_date = time();
                                           if($ldate<$odr_start_date)
                                           {
                                                 $refund_status=false;
                                           }
                                           else
                                           {
                                                $refund_status=true;
                                           }
                                        }
                                        else
                                        {
                                            $refund_status=false;
                                        }


                                    }
                                    else
                                    {
                                        $refund_status=false;
                                    }


                                    

                                    


                                    $jsondata = json_decode($variants->jsondata);
                                    $attributes=[];
                                    foreach ($jsondata as $val) 
                                    {
                                        $attribute_type=$val->attribute_type;
                                        $attribute_value=$val->attribute_value;

                                        $type = $this->db->query("select * from attributes_title where id='".$attribute_type."'");
                                        $types = $type->row();

                                        $val12 = $this->db->query("select * from attributes_values where id='".$attribute_value."'");
                                        $value12 = $val12->row();

                                            

                                        $attributes[]=array('attribute_type'=>$types->title,'attribute_values'=>$value12->value);
                                    }
                                    $pro = $this->db->query("select * from products where id='".$variants->product_id."' and delete_status=0");
                                    $products = $pro->row();

                                    $ven_q = $this->db->query("select * from vendor_shop where id='".$c->vendor_id."'");
                                    $ven_row = $ven_q->row();

                                $cartdata[]=array('cartid'=>$c->id,'productname'=>$products->name,'price'=>$c->price,'quantity'=>$c->quantity,'total_price'=>$c->unit_price,'image'=>$img,'attributes'=>$attributes,'refund_status'=>$refund_status,'product_id'=>$variants->product_id,'refundmsg'=>$refundmsg,'status'=>$c->status,'shop_name'=>$ven_row->shop_name);
                            }



                 $add = $this->db->query("select * from user_address where id='".$value->deliveryaddress_id."'");
                 $address = $add->row();

                 $user_full_address = $address->address."".$address->locality."".$address->state."".$address->city."".$address->pincode;

                $qry = $this->db->query("select * from users where id='".$value->user_id."'");
                $users = $qry->row();
                $name = $users->first_name." ".$users->last_name;
                $ven = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                $vendor = $ven->row();
                
                $adrs = $this->db->query("select * from user_address where id='".$value->deliveryaddress_id."'");
                $address = $adrs->row();



                 $city_qry = $this->db->query("select * from cities where id='".$address->city."'");
            $city_row = $city_qry->row();

            $state_qry = $this->db->query("select * from states where id='".$address->state."'");
            $state_row = $state_qry->row();

            $area_qry = $this->db->query("select * from areas where id='".$address->area."'");
            $area_row = $area_qry->row();
            


                $full_address = $address->address.", ".$address->area."".$city_row->city_name.", ".$state_row->state_name.", ".$value->pincode;
                if($value->payment_status==0)
                {
                    $payment_status="UnPaid";
                }
                else
                {
                    $payment_status="Paid";
                }

                if($value->order_status==1)
                {
                    $order_status = "Pending";
                }
                else if($value->order_status==2)
                {
                     $order_status = "Proccessing";
                }
                else if($value->order_status==3)
                {
                     $order_status = "Assigned to delivery to pick up";
                }
                else if($value->order_status==4)
                {
                    $order_status = "Delivery Boy On the way";
                }
                else if($value->order_status==5)
                {
                    $order_status = "Delivered";
                }
                else if($value->order_status==6)
                {
                    $order_status = "Cancelled";
                }
                else if($value->order_status==7)
                {
                    $order_status = "Refund Completed";
                }
                
                if($value->coupon_id==0)
                {
                    $coupon_disount="0";
                    $sub_t = $value->sub_total;
                    $amount=$sub_t+$value->gst+$value->deliveryboy_commission;
                }
                else
                {
                    $coupon_disount=$value->coupon_disount;

                    $sub_t = $value->sub_total-$coupon_disount;
                    $amount=$sub_t+$value->gst+$value->deliveryboy_commission;
                }

                $deliv = $this->db->query("select * from deliveryboy where id='".$value->delivery_boy."'");
                if($deliv->num_rows()>0)
                {
                    $delivery_boy = $deliv->row();
                    $dl_name = $delivery_boy->name;
                    $dl_phone = $delivery_boy->phone;
                    $alternative_mobiles = $delivery_boy->alternative_mobiles;
                }
                else
                {
                    $dl_name = "";
                    $dl_phone = "";
                    $alternative_mobiles = "";
                }

                if($value->order_status==3 || $value->order_status==4 || $value->order_status==5)
                {
                    $show =  'show';
                }
                else
                {
                    $show =  'hide';
                }


                    if($value->bid_id==0)
                    {
                        $bid_status = 'no';
                    }
                    else
                    {   
                        $bid_status = 'yes';
                    }


                
               $ar=array('id'=>$value->id,'bid_status'=>$bid_status,'session_id'=>$value->session_id,'delivery_date'=>$value->delivery_timeslots,'order_status'=>$order_status,'vendor_name'=>$vendor->shop_name,'useraddress'=>$value->user_address,'payment_status'=>$payment_status,'payment_type'=>$value->payment_option,'amount'=>$amount,'sub_total'=>$value->sub_total,'placed_on'=>date('d-m-Y',$value->created_at),'cartdetails'=>$cartdata,'customer_name'=>$name,'mobile'=>$address->mobile,'coupon_disount'=>$coupon_disount,'deliveryboy_commission'=>$value->deliveryboy_commission,'gst'=>$value->gst,'delivery_name'=>$dl_name,'delivery_phone'=>$dl_phone,'alternative_mobiles'=>$alternative_mobiles,'order_status1'=>$show,'vendor_id'=>$value->vendor_id,'user_id'=>$value->user_id,'owner_name'=>$vendor->owner_name,'vendor_mobile'=>$vendor->mobile,'address'=>$vendor->address,'city'=>$vendor->city,'order_condition'=>$value->order_status,'accept_status'=>$value->accept_status);
            
            return array('status' =>TRUE, 'ordersdetails'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Order ID Wrong");
        }
    
    

}


function docancelOrder($user_id,$orderid)
    {
            $ar = array('order_status'=>'6');
            $wr = array('id'=>$orderid);
            $upd = $this->db->update("orders",$ar,$wr);
            if($upd)
            {
                $msg = "Order Cancelled by ";
                $aar = array('user_id'=>$user_id,'order_id'=>$orderid,'message'=>$msg);
                $this->db->insert("admin_notifications",$aar);

$qry = $this->db->query("select * from orders where id='".$orderid."'");
                $row = $qry->row();
                $usr_qry = $this->db->query("select * from vendor_shop where id='".$row->vendor_id."'");
                    $usr_row = $usr_qry->row();
                            
                            $phone =$usr_row->mobile;
                    
                    $msg="Dear{#var#} your order no. ".$orderid." is requested for cancellation, please wait for confirmation. Regards Sector 6";
                    $template_id = "1407163164518187934";
                    $this->send_message($msg,$phone,$template_id);
                    
                    $title = "Order Cancelled";
                    $this->onesignalnotification($row->vendor_id,$title,$msg);
                 return array('status' =>TRUE,'message'=>"Order Cancelled Successfully");
            }
            else
            {
                return array('status' =>FALSE,'message'=>"Something went wrong, Please try again");
            }
    }

function favoriteList($user_id)
{
             $row = $this->db->query("select * from shop_favorites where user_id='".$user_id."'");
             $dat = $row->result();
                $ar=[];
                foreach ($dat as $value_details) 
                {
                        $row = $this->db->query("select * from vendor_shop where id='".$value_details->shop_id."'");
                        $value = $row->row();
                   
                        if($value->shop_logo!='')
                        {
                            $img = base_url()."uploads/shops/".$value->shop_logo;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";
                        }
                        $ar[]=array('id'=>$value->id,'shop_name'=>$value->shop_name,'description'=>$value->description,'image'=>$img);
                }
            return array('status' =>TRUE,'shop_list'=>$ar);
}

function deleteCartData($session_id,$user_id)
{
    $del = $this->db->delete("cart",array('session_id'=>$session_id,'user_id'=>$user_id));
    if($del)
    {
            return array('status' =>TRUE,'message'=>"Cart Empty");
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Something went wrong, Please try again");
    }
}

function exchangeRefund($session_id,$product_id,$user_id,$vendor_id,$cartid,$delivery_type,$reson)
{
    $chk = $this->db->query("select * from refund_exchange where session_id='".$session_id."' and product_id='".$product_id."' and user_id='".$user_id."' and cartid='".$cartid."'");
    if($chk->num_rows()>0)
    {
          return array('status' =>FALSE,'message'=>"your request already sent Successfully");
    }   
    else
    {
            $user = $this->db->query("select * from users where id='".$user_id."'");
            $users = $user->row();

            $phone = $users->phone;
            $pro = $this->db->query("select * from products where id='".$product_id."'");
            $product = $pro->row();
             $otp_message = "Dear vendor order no:".$session_id." is requested for return by the customer. please review and and confirm. Contact customer care for more details.";
            
             $template_id="1407161684049275169";
        if($this->send_message($otp_message,$phone,$template_id))
        {

            $ar = array('session_id'=>$session_id,'user_id'=>$user_id,'product_id'=>$product_id,'vendor_id'=>$vendor_id,'cartid'=>$cartid,'delivery_type'=>$delivery_type,'message'=>$reson,'status'=>0);
            $ins = $this->db->insert("refund_exchange",$ar);
            if($ins)
            {
                /*$ven = $this->db->query("select * from vendor_shop where id='".$vendor_id."'");
                $vendor = $ven->row();
                $vendorphone = $vendor->mobile;
                $vendor_message = $otp_message = "You have recieved the Return or Exchange Request Product: ".$product->name." from Absolutemens,  order ID ".$session_id;
                $this->send_message($vendor_message,$vendorphone);*/

                $cart_ar = array('status'=>$delivery_type);
                $upd_ar = array('id'=>$cartid);
                $this->db->update("cart",$cart_ar,$upd_ar);
                if($delivery_type==1)
                {
                     return array('status' =>TRUE,'message'=>"Your Exchange Request sent Successfully");
                }
                else if($delivery_type==2)
                {
                    return array('status' =>TRUE,'message'=>"Your Refund Request sent Successfully");
                }
               
            }
            else
            {
                return array('status' =>FALSE,'message'=>"Something went wrong");
            }
        }
    }
}


function delivery_slots($shop_id,$date)
{
    /*$ss = '13';
     echo $covnver = date('h A',strtotime($ss));  die;*/
   $cdate = date("Y-m-d"); 
   $st1 = strtotime($date); 
   $st2 = strtotime($cdate);
    
    if($st1==$st2)
    {
           $chour = date('H')+2;

            $dayofweek = date('w', strtotime($date));  
           if($dayofweek==0)
           {
             $weekday = 'sunday';
           }
           else if($dayofweek==1)
           {
            $weekday = 'monday';
           }
           else if($dayofweek==2)
           {
            $weekday = 'tuesday';
           }
           else if($dayofweek==3)
           {
            $weekday = 'wednesday';
           }
           else if($dayofweek==4)
           {
            $weekday = 'thursday';
           }
           else if($dayofweek==5)
           {
            $weekday = 'friday';
           }
           else if($dayofweek==6)
           {
            $weekday = 'saturday';
           }
 
           $qry=$this->db->query("select * from working_hours where vendor_id='".$shop_id."' and weekname='".$weekday."' and working='yes'");
            if($qry->num_rows()>0)
            {
                $result = $qry->row();
                 $start_time = date('H', strtotime($result->open_time));
                 $end_time = date('H', strtotime($result->closed_time)); 
                  $ar=[];
                for ($i=$chour; $i <=$end_time; $i++) 
                { 
                    if($i=="1" || $i=="2" || $i=="3" || $i=="4" || $i=="5" || $i=="6" || $i=="7" || $i=="8" || $i=="9" || $i=="10" || $i=="11" || $i=="08" || $i=="09" || $i=="01" || $i=="02" || $i=="03" || $i=="04" || $i=="05" || $i=="06" || $i=="07")
                    {
                        $start_t = $i.":00 AM";
                    }
                    else
                    {
                        

                        $start_t = $i.":00 PM";
                    }


                        $chek = $i+1;
                        if($chek=='1' || $chek=='2' || $chek=='3' || $chek=='4' || $chek=='5' || $chek=='6' || $chek=='7' || $chek=='8' || $chek=='9' || $chek=='10' || $chek=='11' || $chek=='01' || $chek=='02' || $chek=='03' || $chek=='04' || $chek=='05' || $chek=='06' || $chek=='07' || $chek=='08')
                        {
                           $slotent = ($i+1).":00 AM";
                        }
                        else
                        {
                            $slotent = ($i+1).":00 PM";
                        }

                    $ar[]=array('start_time'=>$start_t,'end_time'=>$slotent);
                }
             
                return array('status' =>TRUE,'time_slots'=>$ar);
            }
            else
            {
                return array('status' =>FALSE,'message'=>"No Time Slots");
            }
    
    }
    else
    {
         $dayofweek = date('w', strtotime($date));    
           if($dayofweek==0)
           {
             $weekday = 'sunday';
           }
           else if($dayofweek==1)
           {
            $weekday = 'monday';
           }
           else if($dayofweek==2)
           {
            $weekday = 'tuesday';
           }
           else if($dayofweek==3)
           {
            $weekday = 'wednesday';
           }
           else if($dayofweek==4)
           {
            $weekday = 'thursday';
           }
           else if($dayofweek==5)
           {
            $weekday = 'friday';
           }
           else if($dayofweek==6)
           {
            $weekday = 'saturday';
           }
           $qry=$this->db->query("select * from working_hours where vendor_id='".$shop_id."' and weekname='".$weekday."' and working='yes'");
            if($qry->num_rows()>0)
            {
                $result = $qry->row();
                 $start_time = date('H', strtotime($result->open_time));
                 $end_time = date('H', strtotime($result->closed_time)); 
                  $ar=[];
                for ($i=$start_time; $i <=$end_time; $i++) 
                { 
                    if($i=="1" || $i=="2" || $i=="3" || $i=="4" || $i=="5" || $i=="6" || $i=="7" || $i=="8" || $i=="9" || $i=="10" || $i=="11" || $i=="08" || $i=="09" || $i=="01" || $i=="02" || $i=="03" || $i=="04" || $i=="05" || $i=="06" || $i=="07")
                    {
                        $start_t = $i.":00 AM";
                    }
                    else
                    {
                        /*if($i>="13" && $<="23")
                        {
                           $covnver = date('h A',strtotime($i));
                          $start_t = $covnver;
                        }
                        else
                        {*/
                            $start_t = $i.":00 PM";
                        /*}*/

                       
                    }


                        $chek = $i+1;
                        if($chek=='1' || $chek=='2' || $chek=='3' || $chek=='4' || $chek=='5' || $chek=='6' || $chek=='7' || $chek=='8' || $chek=='9' || $chek=='10' || $chek=='11' || $chek=='01' || $chek=='02' || $chek=='03' || $chek=='04' || $chek=='05' || $chek=='06' || $chek=='07' || $chek=='08')
                        {
                           $slotent = ($i+1).":00 AM";
                        }
                        else
                        {
                            $slotent = ($i+1).":00 PM";
                        }

                    $ar[]=array('start_time'=>$start_t,'end_time'=>$slotent);
                }
             
                return array('status' =>TRUE,'time_slots'=>$ar);
            }
            else
            {
                return array('status' =>FALSE,'message'=>"No Time Slots");
            }
    }

   
 }





 function dorazerpayOrder($session_id,$user_id,$vendor_id,$deliveryaddress_id,$created_at,$order_status,$sub_total,$delivery_amount,$grand_total,$coupon_id,$coupon_code,$coupon_disount,$order_id,$gst)
{
        $qry = $this->db->query("select * from cart where session_id='".$session_id."'");
        $result = $qry->result();
        $ar=[];
            $unitprice=0;
            $admin_total=0;
            foreach ($result as $value) 
            {
                $link = $this->db->query("select * from  link_variant where id='".$value->variant_id."'");
                $link_variants = $link->row();

                $pro = $this->db->query("select * from  products where id='".$link_variants->product_id."'");
                $product = $pro->row();

                

                $adm = $this->db->query("select * from  admin_comissions where shop_id='".$vendor_id."' and cat_id='".$product->cat_id."' and find_in_set('".$product->sub_cat_id."',subcategory_ids)");
                $admin = $adm->row();
                
                $admin_price = ($admin->admin_comission /100)*$value->price;
                
               $ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img);
               $unitprice = $value->unit_price+$unitprice;

               $admin_total = $admin_price+$admin_total;
            }



           

             $vendor =$unitprice-$admin_total; 
                $coupon_qry = $this->db->query("select * from coupon_codes where id='".$coupon_id."'");
                    $coupon_row = $coupon_qry->row();
                    if($coupon_qry->num_rows()>0)
                    {
                        if($coupon_row->shop_id==0)
                        {
                            $admin_total1=$admin_total-$coupon_disount;
                            $vendor1=$vendor;
                        }
                        else
                        {
                            $vendor1=$vendor-$coupon_disount;
                            $admin_total1=$admin_total;
                        }

                    }
                    else
                    {
                        $admin_total1=$admin_total;
                        $vendor1=$vendor;
                    }

    $ar = array('session_id'=>$session_id,'user_id'=>$user_id,'vendor_id'=>$vendor_id,'deliveryaddress_id'=>$deliveryaddress_id,'payment_status'=>1,'order_status'=>$order_status,'order_status'=>$order_status,'deliveryboy_commission'=>$delivery_amount,'created_at'=>$created_at,'sub_total'=>$unitprice,'total_price'=>$grand_total,'admin_commission'=>$admin_total1,'vendor_commission'=>$vendor1,'coupon_code'=>$coupon_code,'coupon_id'=>$coupon_id,'coupon_disount'=>$coupon_disount,'razerpay_orderId'=>$order_id,'gst'=>$gst,'payment_option'=>'ONLINE');
    $ins = $this->db->insert("online_orders",$ar);
    if($ins)
    {
        $last_id = $this->db->insert_id();
        return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$last_id,'razerpay_orderid' =>$order_id,'razerpay_key' =>'rzp_live_G0qYK68h4rJwFt');
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Something went wrong, Please try again",'razerpay_orderid' =>$order_id);
    }
}

function dorazerpaysuccessOrder($order_id,$razerpay_orderid,$razerpay_txnid,$payment_option)
{
    $qry = $this->db->query("select * from online_orders where id='".$order_id."'");
    if($qry->num_rows()>0)
    {
        $row = $qry->row();

                $admin_qry = $this->db->query("select * from  admin where id=1");
                $admin_row = $admin_qry->row();
            
            $admin_order_amount = $admin_row->order_amount;
            $coins = $admin_row->coins;

            $bonus = $grand_total/$row->total_price;
            $total_bonus = $bonus*$coins;


             $delivery_ad_qry = $this->db->query("select * from user_address where id='".$row->deliveryaddress_id."'");
                $delivery_ad_row = $delivery_ad_qry->row();

                /*$state_qry = $this->db->query("select * from states where id='".$delivery_ad_row->state."'");
                $state_qry_row = $state_qry->row();

                $cities_qry = $this->db->query("select * from cities where id='".$delivery_ad_row->city."'");
                $cities_qry_row = $cities_qry->row();

                $pincode_qry = $this->db->query("select * from pincodes where id='".$delivery_ad_row->pincode."'");
                $pincode_qry_row = $pincode_qry->row();*/
                

                if($delivery_ad_row->address_type==1)
                {
                    $add_type ="Home";
                }
                else if($delivery_ad_row->address_type==1)
                {
                    $add_type ="Office";
                }
                //$user_address = $add_type.": ".$delivery_ad_row->name.", ".$state_qry_row->state_name.", ".$cities_qry_row->city_name.", ".$pincode_qry_row->pincode.", ".$delivery_ad_row->address.", ".$delivery_ad_row->landmark;
                $user_address = $add_type.": ".$delivery_ad_row->name.", ".$delivery_ad_row->state.", ".$delivery_ad_row->city.", ".$delivery_ad_row->pincode.", ".$delivery_ad_row->address.", ".$delivery_ad_row->landmark;



        $ar = array('session_id'=>$row->session_id,'user_id'=>$row->user_id,'vendor_id'=>$row->vendor_id,'deliveryaddress_id'=>$row->deliveryaddress_id,'payment_option'=>$row->payment_option,'payment_status'=>$row->payment_status,'order_status'=>$row->order_status,'delivery_boy'=>$row->delivery_boy,'created_at'=>$row->created_at,'created_date'=>$row->created_date,'admin_commission'=>$row->admin_commission,'vendor_commission'=>$row->vendor_commission,'deliveryboy_commission'=>$row->deliveryboy_commission,'total_price'=>$row->total_price,'gst'=>$row->gst,'sub_total'=>$row->sub_total,'coupon_id'=>$row->coupon_id,'coupon_code'=>$row->coupon_code,'coupon_disount'=>$row->coupon_disount,'pay_orderid'=>$order_id,'pay_razerpay_id'=>$razerpay_orderid,'pay_transaction_id'=>$razerpay_txnid,'gst'=>$row->gst,'user_address'=>$user_address);
        $ins = $this->db->insert("orders",$ar);
        if($ins)
        {
    $vendor_qry = $this->db->query("select * from cart where session_id='".$session_id."' group by vendor_id");
    $vendor_result = $vendor_qry->result();
    $vendor_ar=[];
    foreach ($vendor_result as $vendor_value) 
    {
        $vendor_ar[]=$vendor_value->vendor_id;
    }

    $sub_total=0;
    foreach ($vendor_ar as $vendor_ids) 
    {
        
        $qry = $this->db->query("select * from cart where session_id='".$session_id."' and vendor_id='".$vendor_ids."'");
        $result = $qry->result();
            $ar=[];
            $unitprice=0;
            $admin_total=0;
            foreach ($result as $value) 
            {
                $link = $this->db->query("select * from  link_variant where id='".$value->variant_id."'");
                $link_variants = $link->row();

                $pro = $this->db->query("select * from  products where id='".$link_variants->product_id."'");
                $product = $pro->row();

                $adm = $this->db->query("select * from  admin_comissions where shop_id='".$vendor_id."' and cat_id='".$product->cat_id."' and find_in_set('".$product->sub_cat_id."',subcategory_ids)");
                $admin = $adm->row();
                
                $admin_price = ($admin->admin_comission /100)*$value->price;
                

                

               $ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img);
               $unitprice = $value->unit_price+$unitprice;

               $admin_total = $admin_price+$admin_total;

               $total=$link_variants->stock-$value->quantity;



                $ar = array('varient_id'=>$value->variant_id,'product_id'=>$link_variants->product_id,'quantity'=>$value->quantity,'paid_status'=>'Debit','message'=>'New Order','total_stock'=>$total,'created_at'=>time());
                $ins11 = $this->db->insert("stock_management",$ar);

                if($ins11)
                {
                    $qty = $link_variants->stock-$value->quantity;
                    $this->db->update("link_variant",array('stock'=>$qty),array('id'=>$value->variant_id));
                } 
            }


            $admin_qry = $this->db->query("select * from  admin where id=1");
                $admin_row = $admin_qry->row();
                $admin_order_amount = $admin_row->order_amount;
                $coins = $admin_row->coins;

                $bonus = $grand_total/$admin_order_amount;
                $total_bonus = $bonus*$coins;
                $u_w = $this->db->query("select * from users where id='".$user_id."'");
                $wallet_row = $u_w->row();


                    $vendor =$unitprice-$admin_total; 

                    $coupon_qry = $this->db->query("select * from coupon_codes where id='".$coupon_id."'");
                    $coupon_row = $coupon_qry->row();
                    if($coupon_qry->num_rows()>0)
                    {
                        if($coupon_row->shop_id==0)
                        {
                            $admin_total1=$admin_total-$coupon_disount;
                            $vendor1=$vendor;
                        }
                        else
                        {
                            $vendor1=$vendor-$coupon_disount;
                            $admin_total1=$admin_total;
                        }

                    }
                    else
                    {
                        $admin_total1=$admin_total;
                        $vendor1=$vendor;
                    }


                $delivery_ad_qry = $this->db->query("select * from user_address where id='".$deliveryaddress_id."'");
                $delivery_ad_row = $delivery_ad_qry->row();

                $state_qry = $this->db->query("select * from states where id='".$delivery_ad_row->state."'");
                $state_qry_row = $state_qry->row();

                $cities_qry = $this->db->query("select * from cities where id='".$delivery_ad_row->city."'");
                $cities_qry_row = $cities_qry->row();

                $pincode_qry = $this->db->query("select * from pincodes where id='".$delivery_ad_row->pincode."'");
                $pincode_qry_row = $pincode_qry->row();
                

                if($delivery_ad_row->address_type==1)
                {
                    $add_type ="Home";
                }
                else if($delivery_ad_row->address_type==1)
                {
                    $add_type ="Office";
                }
                $user_address = $add_type.": ".$delivery_ad_row->name.", ".$state_qry_row->state_name.", ".$cities_qry_row->city_name.", ".$pincode_qry_row->pincode.", ".$delivery_ad_row->address.", ".$delivery_ad_row->landmark;

                    
            $vendor_ar = array('session_id'=>$session_id,'vendor_id'=>$vendor_ids,'status'=>0,'sub_total'=>$unitprice,'coupon_code'=>$coupon_code,'coupon_id'=>$coupon_id,'coupon_disount'=>$coupon_disount,'gst'=>$gst);
            $this->db->insert("vendor_orders_values",$vendor_ar);
            //echo $this->db->last_query(); die;
            $sub_total=$sub_total+$unitprice;
    }


               
                $this->db->insert("vendor_orders_values",$vendor_ar);


            $last_id = $this->db->insert_id();


                        $u_w = $this->db->query("select * from users where id='".$row->user_id."'");
                        $wallet_row = $u_w->row();

                        $st_email = $wallet_row->email;
                        $to_mail = $st_email;
                        $from_email = 'satish@colourmoon.com';
                        $site_name = 'Sector6';
                        $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;">
        <tr><td align="center" valign="top"><img src="'.base_url().'admin_assets/assets/images/logo.png" alt="" height="50"></td></tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td valign="top">
                <h1 style="margin:0px; padding:10px 0px; background-color: #000; text-align: center; font-weight: 300; color:#fff; font-size: 22px; text-align: center;">Your Order Details</h1>
                <div style="padding:15px;">
                <h4 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Hello '.$wallet_row->first_name.',</h4>
                <p style="margin:0px; padding:0px; font-size: 14px; text-align: justify; line-height: 20px; padding-bottom: 10px;">Thank you for shopping with us. We willl send a confirmation once your item has shipped. Your order details are indicated below. The payment details of your transaction can be found on the <a href="#" style="color:#f47a20; text-decoration: none;">order invoice</a>. If you would like to view the status of your order or make any changes to it, please visit Your Orders on Sector6</p>
                </div>
            </td>
        </tr>';

         $adrs = $this->db->query("select * from user_address where id='".$row->deliveryaddress_id."'");
         $address = $adrs->row();
                

$email_message .='<tr>
            <td bgcolor="#f4f4f4" valign="top">
                <div style="padding:15px">
                    <table width="100%">
                        <tr>
                            <td valign="top">
                                <p style="margin:0px; padding:0px 0px 10px 0px; line-height: 22px; font-size: 14px;">Your order will be sent to: <br>
                                <strong>'.$user_address.'</strong></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>';
    
    $email_message .='<tr>
            <td valign="top">
                <div style="padding:15px">
                    <h3 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Order Details :</h3>
                    <p style="margin:0px; padding:0px;"><strong>Order # '.$last_id.'</strong></p>
                </div>
            </td>
        </tr>

        <tr>
            <td valign="top">
                <div style="padding:15px;">
                    <table width="100%" border="1" cellpadding="5" style="border-collapse: collapse; border-color: #666;">';





                            $qry1 = $this->db->query("select * from cart where session_id='".$row->session_id."'");
                            $result1 = $qry1->result();
                            $ar1=[];
                                $unitprice1=0;
                                $admin_total1=0;
                                $gst_total=0;
                                foreach ($result1 as $value) 
                                {

                                    $link1 = $this->db->query("select * from  link_variant where id='".$value->variant_id."'");
                                    $link_variants1 = $link1->row();

                                    $pro1 = $this->db->query("select * from  products where id='".$link_variants1->product_id."'");
                                    $product1 = $pro1->row();

                                    $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."' and shop_id='".$value->vendor_id."'");
                                     if( $adm_qry->num_rows()>0)
                                     {
                                        $adm_comm = $adm_qry->row();
                                        $p_gst = $adm_comm->gst;

                                     }
                                     else
                                     {
                                        $p_gst = '0';
                                     }

                                     $class_percentage = ($value->unit_price/100)*$p_gst;

                                    $subcat = $this->db->query("select * from  sub_categories where id='".$product1->sub_cat_id."'");
                                    $subcategory = $subcat->row();

                                    
                                    $adm1 = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."'");
                                    $admin1 = $adm1->row();
                                    

                                    $admin_price1 = ($admin1->admin_comission /100)*$value->price;
                                    

                                     $im = $this->db->query("select * from product_images where product_id='".$link_variants1->product_id."' and variant_id='".$value->variant_id."'");
                                         $images = $im->row();
                                        if($images->image!='')
                                        {
                                            $img = base_url()."uploads/products/".$images->image;
                                        }
                                        else
                                        {
                                            $img = base_url()."uploads/noproduct.png";
                                        }
                                 

                                   $ar1[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img);
                                   $unitprice1 = $value->unit_price+$unitprice1;
                                   $gst_total = $p_gst+$gst_total;

                                   $admin_total1 = $admin_price1+$admin_total1;
                               



                $email_message .='<tr>
                        <td valign="top" align="center">
                        <img src="'.$img.'" alt="" height="80"></td>
                        
                        <td valign="top">
                            <p style="margin:0px; padding: 0px;"><strong>'.$product1->name.'</strong> <br>'.$subcategory->sub_category_name.'</p>
                        </td>
                        <td valign="top">
                            <p style="margin:0px; padding: 0px;">'.$value->price.' * '.$value->quantity.'</p>
                        </td>
                        <td valign="top" align="right">Rs. '.$value->unit_price.'</td>
                    </tr>';
                     }
                    

            $email_message .='<tr>
                        <td valign="top" colspan="4">
                            <table width="100%" cellpadding="5">
                                <tr>
                                    <td align="right" colspan="2">Item Sub Total :</td>
                                    <td align="right" width="25%">Rs. '.$unitprice1.'</td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="2">Delivery Amount :</td>
                                    <td align="right" width="25%">Rs. '.$row->deliveryboy_commission.'</td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="2">GST :</td>
                                    <td align="right" width="25%">Rs. '.$gst_total.'</td>
                                </tr>
                               
                                <tr>
                                    <td align="right" colspan="2"><strong>Order Total :</strong></td>
                                    <td align="right" width="25%"><strong>Rs.'.$row->total_price.'</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>';

$email_message .='</table>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="padding:15px">
                    <p style="margin:0px; padding:0px;">Thank you for shopping with us.</p>
                <h3 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Sector6</h3>
                </div>
            </td>
        </tr>
        <tr>
            <td height="30"></td>
        </tr>
        <tr>
            <td bgcolor="#000" style="padding:30px 10px; text-align: center;">
                <a style="margin-right: 5px"><img src="http://htmldemo.in/2020/fashionmaa_emails/fb.png" alt="" height="40"></a>
                <a style="margin-right: 5px"><img src="http://htmldemo.in/2020/fashionmaa_emails/twitter.png" alt="" height="40"></a>
                <a style="margin-right: 5px"><img src="http://htmldemo.in/2020/fashionmaa_emails/youtube.png" alt="" height="40"></a>
                <a ><img src="http://htmldemo.in/2020/fashionmaa_emails/instagram.png" alt="" height="40"></a>
                <p style="font-weight: 300; color:#fff; font-size: 11px;">&copy; Copyright 2020 Sector6, All Rights Reserved</p>
            </td>
        </tr>
    </table>';

                $this->load->library('email');
                require_once (APPPATH . 'libraries/vendor/autoload.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/PHPMailer.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/SMTP.php');
                require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/Exception.php');

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->From = $from_email;
                $mail->FromName = $site_name;
                $mail->addAddress($to_mail); 
                $mail->addReplyTo($from_email, "Reply");
                $mail->isHTML(true);
                $mail->Sender = $from_email;
                $mail->Subject = "Your Order";
                $mail->Body = $email_message;
                $sucess = $mail->send();
                if($sucess)
                {
                    $data='mail sent successfully';
                    
                }
                else
                {
                    $data='mail not sent,Please try again';
                }

        $msg = "New Order Created ";
        $ins = $this->db->insert("wallet_transactions",array('user_id'=>$row->user_id,'price'=>$row->wallet_amount,'message'=>$msg,'status'=>'minus','created_at'=>time(),'order_id'=>$last_id));
        
        

        $vendor_shop_qry = $this->db->query("select * from vendor_shop where id='".$row->vendor_id."'");
        $vendor_shop_row = $vendor_shop_qry->row();
        $vendor_phone =$vendor_shop_row->mobile;
$template_id = "1407163164501113887";

$order_message="Dear vendor new order no.".$last_id." is in your dashboard. Please accept it for confirmation. Regards Sector 6";
if($this->send_message($order_message,$vendor_phone,$template_id))
        {
           $this->db->insert("sms_notifications",array('order_id'=>$last_id,'receiver_id'=>$row->vendor_id,'sender_id'=>$row->user_id,'created_at'=>time(),'message'=>$order_message)); 
        }

/*
        $vm_qry = $this->db->query("select * from visual_merchant where id='".$vendor_shop_row->vm_id."'");
        $vm_row = $vm_qry->row();
        $vm_phone =$vm_row->mobile;


        $order_message = "New Order: order ID :".$last_id." amounting to Rs.".$row->total_price.". from Absolutemens"; 
        
        if($this->send_message($order_message,$vm_phone))
        {
           $this->db->insert("sms_notifications",array('order_id'=>$last_id,'receiver_id'=>$vendor_shop_row->vm_id,'sender_id'=>$row->user_id,'created_at'=>time(),'message'=>$order_message)); 
        }
*/

        $user_sms_qry = $this->db->query("select * from users where id='".$row->user_id."'");
        $user_sms_row = $user_sms_qry->row();
        $user_phone = $user_sms_qry->phone;


$template_id = "1407163164491308239";
$user_order_message="Dear ".$user_sms_row->first_name." your order no.".$last_id." is successfully placed, awaiting for vendors confirmation. Thank you for shopping with us. Regards Sector 6";
        if($this->send_message($user_order_message,$user_phone,$template_id))
        {
           $this->db->insert("sms_notifications",array('order_id'=>$last_id,'receiver_id'=>$row->user_id,'sender_id'=>$row->vendor_id,'created_at'=>time(),'message'=>$user_order_message)); 
        }

            $del = $this->db->delete("online_orders",array('id'=>$order_id));
            if($del)
            {
                $title = "New Order From Sector6";
                        $message = "You Have new Order";
                $this->onesignalnotification($row->vendor_id,$title,$message);
                return array('status' =>TRUE,'message'=>"Order Created successfully",'order_id' =>$last_id);  
            }
            
        }
        else
        {
            return array('status' =>FALSE,'message'=>"Something went wrong, Please try again");
        }
    }
    else
    {
         return array('status' =>FALSE,'message'=>"Invalid Order ID");
    }
    

}

function viewAlltopDeals($user_id,$start_from,$perpage,$lat,$lng)
{
   /* $total_cpunt = $this->db->query("SELECT link_variant.id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and products.top_deal='yes' and vendor_shop.status=1 group by link_variant.product_id order by products.id ASC");*/


$admin = $this->db->query("select * from admin where id=1");
$search_distance = $admin->row()->distance;
   
     $total_cpunt = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance,vendor_shop.shop_name FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and products.top_deal='yes' group by link_variant.product_id  order by products.id ASC");
     //having distance<".$search_distance."



    $deal_qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance,vendor_shop.shop_name FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and products.top_deal='yes' group by link_variant.product_id order by products.id ASC LIMIT ".$start_from.",".$perpage);
    //having distance<".$search_distance."
        $dat = $deal_qry->result();
        if($deal_qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {
                    /*$qry11 = $this->db->query("select * from products where id='".$value12->product_id."' and top_deal='yes'");
                    $value = $qry11->row();*/

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    

                     /*$admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;*/


                   /* $vendo = $this->db->query("select *, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance from vendor_shop where id='".$value->shop_id."' and status=1 having distance<'".$search_distance."' ");
                    $vendor = $vendo->row();*/


                    $wish = $this->db->query("select * from whish_list where product_id='".$value->product_id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }
                   /* if($vendo->num_rows()>0)
                    {*/
                        /*if($qry11->num_rows()>0)
                        {*/
                            $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$value->shop_name,'price'=>$value->price,'saleprice'=>$value->saleprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat,'distance'=>$value->distance);
                        /*}*/
                   /* }*/
                }

            return array('status' =>TRUE,'product_list'=>$ar,'total'=>$total_cpunt->num_rows());
        }
        else
        {
           
            return array('status' =>FALSE, 'message'=>"No Products",'total'=>$total_cpunt->num_rows());
        }

                        
    

 
 

}



function getmostViewedProducts($user_id,$lat,$lng)
 {
        $qry = $this->db->query("SELECT count(id) as cnt,product_id FROM `most_viewed_products` group by product_id order by id DESC LIMIT 13");
        $dat = $qry->result();
    
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $mv) 
                {
                    if($mv->cnt>=2)
                    {
                        $pr = $this->db->query("select * from products where id='".$mv->product_id."' and status=1");
                        $value = $pr->row();

                        $qry1 = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 and product_id='".$value->id."'");
                        $value12 = $qry1->row();

                         $im = $this->db->query("select * from product_images where product_id='".$value->id."'");
                         $images = $im->row();
                        if($images->image!='')
                        {
                            $img = base_url()."uploads/products/".$images->image;
                        }
                        else
                        {
                            $img = base_url()."uploads/noproduct.png";
                        }

                        
                        $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                        $category = $cat->row();
                        $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                        $subcategory = $subcat->row();
                        


                             $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
                    $row = $qry->row();
                    $state_id = $row->state_id;
                    $city_id = $row->address_id;
                    $pincode_id = $row->pincode_id;


                   $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;
                    
                    $vendo = $this->db->query("select *, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance from vendor_shop where id='".$value->shop_id."' and status=1");
                    //having distance<'".$search_distance."' 
                        $vendor = $vendo->row();


                                if($vendor->status==1)
                                {
                                    $shopstat = "Open";
                                }
                                else
                                {
                                     $shopstat = "Closed";
                                }


                        $wish = $this->db->query("select * from whish_list where product_id='".$value->id."' and user_id='".$user_id."'");
                        if($wish->num_rows()>0)
                        {
                            $stat = true;
                        }
                        else
                        {
                            $stat = false;
                        }
                        if($value12->saleprice!='')
                        {
                           $slaeprice =  $value12->saleprice;
                        }
                        else
                        {
                            $slaeprice=0;
                        }

                        if($value12->price!='')
                        {
                           $price = $value12->price;
                        }
                        else
                        {
                            $price =0;
                        }
                        
                            $name = $value->name;
                        
                            if($vendo->num_rows()>0)
                            {
                             $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$vendor->shop_name,'price'=>$price,'saleprice'=>$slaeprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat,'shop_status'=>$shopstat,'distance'=>round($vendor->distance));
                            }
                    }
                    
                    

                  
                }
            return array('status' =>TRUE,'product_list'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Products");
        }

    

 
 }



function getproductsFilters($json_data,$cat_id)
{
    $str = json_decode($json_data);
    $sp=[];
    foreach ($str as $value) 
    {
         $str = json_encode($value); 
         $filt_qry = "and link_variant.jsondata LIKE '%".$str."%'";

         $admin = $this->db->query("select * from admin where id=1");
         $search_distance = $admin->row()->distance;

            $qry = $this->db->query("SELECT vendor_shop.id as shop_id,vendor_shop.shop_name,link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and  products.cat_id='".$cat_id."' and products.status=1  and vendor_shop.status=1 ".$filt_qry." group by link_variant.product_id order by link_variant.id desc ");
            //having distance<".$search_distance." 

         $dat = $qry->result();
         if($qry->num_rows()>0)
         {
                $ar=[];
                foreach ($dat as $value) 
                { 
                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();

                    /*$vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();*/

                    $wish = $this->db->query("select * from whish_list where product_id='".$value->id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }
                 
                 $ar[]=array('id'=>$value->id,'variant_id'=>$value->variant_id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$value->shop_name,'price'=>$value->price,'saleprice'=>$value->saleprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat);
                }
             return array('status' =>TRUE,'product_list'=>$ar);
        
         }
         else
         {
            return array('status' =>FALSE,'message'=>"No Products");
         }
     }

   
   
}


 function socialShare()
    {
        $qry = $this->db->query("select * from admin where id=1");
        $row = $qry->row();
        return array('status' =>TRUE, 'id'=>$row->id,'share_title'=>$row->share_title,'playstore_vendorlink'=>$row->playstore_vendorlink);
    }

function getDistance($clat,$clng,$userlat,$userlng)
{
                        $lat1 = $clat; 
                        $lon1 = $clng;
                        $lat2 = $userlat;
                        $lon2 = $userlng;
                          if (($lat1 == $lat2) && ($lon1 == $lon2)) 
                          {
                            $km = 0;
                          }
                          else {
                            $theta = $lon1 - $lon2;
                            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                            $dist = acos($dist);
                            $dist = rad2deg($dist);
                            $miles = $dist * 60 * 1.1515;
                            $unit = strtoupper($unit);

                            $km = ($miles * 1.609344);
                          }
                          $qry = $this->db->query("select * from admin where id=1");
                          $admin_row = $qry->row();
                          $distance = $admin_row->distance;
                          if(round($km)>$distance)
                          {
                            $stat = false;
                          }
                          else
                          {
                            $stat = true;
                          }

    return array('status' =>$stat,'distance'=>round($km));
}

function getTransactions($user_id)
{
    $user = $this->db->query("select * from users where id='".$user_id."'");
    $users = $user->row();
    $wallet_amount = $users->wallet_amount;
    $qry = $this->db->query("select * from wallet_transactions where user_id='".$user_id."'");
    $dat = $qry->result();
    if($qry->num_rows()>0)
    {
        $ar=[];
        foreach ($dat as $value) 
        {
            $date = date('d-m,Y h:i A',$value->created_at);
           $ar[]=array('id'=>$value->id,'message'=>$value->message,'price'=>$value->price,'status'=>$value->status,'created_at'=>$date);
        }
        return array('status' =>TRUE,'transactions'=>$ar,'wallet_amount'=>$wallet_amount);
    }
    else
    {
       return array('status' =>FALSE,'message'=>"No Transactions",'wallet_amount'=>$wallet_amount); 
    }
    
}

function getUserWallet($user_id)
{
    $user = $this->db->query("select * from users where id='".$user_id."'");
    $users = $user->row();
    $wallet_amount = $users->wallet_amount;
    return array('status' =>TRUE,'wallet_amount'=>$wallet_amount);
}


function getWalletRazerpayOrderId($user_id,$total_amount,$order_id)
{
    $ar = array('user_id'=>$user_id,'amount'=>$total_amount,'order_id'=>$order_id);
    $ins = $this->db->insert("wallet_orderid",$ar);
    if($ins)
    {
        $order_razerpay_id = $this->db->insert_id();
        return array('status' =>TRUE,'order_id' =>$order_razerpay_id,'razerpay_order_id' =>$order_id);
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Somethingwent wrong, Please try again"); 
    }
}

function addAmountToWallet($user_id,$payment_id,$razerpay_orderid,$order_id)
{
    $qry = $this->db->query("select * from users where id='".$user_id."'");
    $user_row = $qry->row();
    $user_wallet = $user_row->wallet_amount;

    $qry1 = $this->db->query("select * from wallet_orderid where id='".$order_id."'");
    $wallet_row = $qry1->row();

    $amount = $wallet_row->amount;
    $msg = "Added to your wallet";
    $ins = $this->db->insert("wallet_transactions",array('user_id'=>$user_id,'price'=>$amount,'message'=>$msg,'status'=>'plus','created_at'=>time(),'razerpay_orderid'=>$razerpay_orderid,'order_id'=>$order_id));
    if($ins)
    {
            $finalwallet_amount = $amount+$user_wallet;
            $this->db->update('users',array('wallet_amount'=>$finalwallet_amount),array('id'=>$user_id));
        return array('status' =>TRUE,'message'=>'Amount added to your wallet','wallet_amount'=>$finalwallet_amount);
    }
    else
    {
        return array('status' =>FALSE,'message'=>'Somethingwent wrong,Please try again');
    }



}



function getUserBonuPoints($user_id)
{
    $qry = $this->db->query("select * from users where id='".$user_id."'");
    if($qry->num_rows()>0)
    {
        $row = $qry->row();

        $adm_qry = $this->db->query("select * from admin where id=1");
        $admin_row = $adm_qry->row();

         $bonus_points = $admin_row->coinperamount; 
         $user_bonus = $row->bonus_points; 
        $total_amount = $user_bonus*$bonus_points;
        return array('status' =>TRUE,'bonus_points'=>$row->bonus_points,'percoins'=>$bonus_points,'redeem_amount'=>$total_amount);
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Invalid User ID");
    }
    
}

function doRedeemAmount($user_id,$redeem_amount)
{
    $qry = $this->db->query("select * from users where id='".$user_id."'");
    if($qry->num_rows()>0)
    {
        $row = $qry->row();

        $userwallet = $row->wallet_amount;

        $final = $userwallet+$redeem_amount;
        $this->db->update("users",array('wallet_amount'=>$final,'bonus_points'=>0),array('id'=>$user_id));

        return array('status' =>TRUE,'message'=>"Amount Added to your wallet",'wallet_amount'=>$final);
    }
    else
    {
        return array('status' =>FALSE,'message'=>"Invalid User ID");
    }
}


function getCities()
{
    $qry = $this->db->query("select id,city_name from cities");
    $result = $qry->result();
    return array('status' =>TRUE,'cities'=>$result);
}

function fetchOrderCoins($user_id)
{
    $qry = $this->db->query("select coinperamount from admin");
    $result = $qry->row();

     $user = $this->db->query("select * from users where id='".$user_id."'");
     $users = $user->row();

    return array('status' =>TRUE,'coins'=>$result->coinperamount,'referral_code'=>$users->referral_code,'playstore_userlink'=>$result->playstore_userlink);
}


function createUserBid($ar)
{
    $ins = $this->db->insert('user_bids',$ar);
    if($ins)
    {
        $order_message = "Bid Placed : order ID :".$ar['session_id']." amounting to Rs.".$ar['grand_total'].". from Sector6"; 

        $user_sms_qry = $this->db->query("select * from users where id='".$ar['user_id']."'");
        $user_sms_row = $user_sms_qry->row();
        $user_phone = $user_sms_qry->mobile;

        if($this->send_message($order_message,$user_phone))
        {
           $this->db->insert("sms_notifications",array('order_id'=>$ar['session_id'],'receiver_id'=>$ar['vendor_id'],'sender_id'=>$ar['user_id'],'created_at'=>time(),'message'=>$order_message)); 
        }

       return array('status' =>TRUE,'message'=>"Bid Created Successfully"); 
    }
}



function mybids($user_id,$order_status)
{
        if($order_status=='ongoing')
        {
            $qry = $this->db->query("select * from user_bids where user_id='".$user_id."' and  bid_status in (0,1) order by id desc");
        }
        else if($order_status=='delivered')
        {
            $qry = $this->db->query("select * from user_bids where user_id='".$user_id."' and  bid_status=2 order by id desc");
        }
        else if($order_status=='cancelled')
        {
            $qry = $this->db->query("select * from user_bids where user_id='".$user_id."' and  bid_status=3 order by id desc");
        }
        
        if($qry->num_rows()>0)
        {
            $result = $qry->result();
            $ar=[];
            foreach ($result as $bidds) 
            {   
                $cart = $this->db->query("select * from cart where session_id='".$bidds->session_id."'");
                $total_products = $cart->num_rows();

                if($bidds->bid_status==0)
                {
                    $bid_status = "Waiting for Bid";  
                }
                else if($bidds->bid_status==1)
                {
                    $bid_status = "Bid accepted";
                }
                else if($bidds->bid_status==2)
                {
                    $bid_status = "Bid Completed";
                }
                else if($bidds->bid_status==3)
                {
                    $bid_status = "Bid Cancelled";
                }

                
                $quote = $this->db->query("select * from bid_quotations where bid_id='".$bidds->id."'");
                $total_quotes = $quote->num_rows();
                $min_quote = $this->db->query("select MIN(total_price) as minbid from bid_quotations where bid_id='".$bidds->id."'");
                $min_quote_row = $min_quote->row();
                if($min_quote_row->minbid!='')
                {
                    $low_bid = $min_quote_row->minbid;
                }
                else
                {
                    $low_bid = 'N/A';
                }


                $cart_qry = $this->db->query("select * from cart where session_id='".$bidds->session_id."'");
                $cart_result = $cart_qry->result();
                $products_ar=[];
                foreach ($cart_result as $value) 
                {   
                    $pro = $this->db->query("select * from  product_images where variant_id='".$value->variant_id."'");
                    $product = $pro->row();

                    if($product->image!='')
                    {
                        $img = base_url()."uploads/products/".$product->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }
                    //$value->variant_id
                        $var1 = $this->db->query("select * from link_variant where id='".$value->variant_id."'");
                        $link = $var1->row();
                         $pro1 = $this->db->query("select * from  products where id='".$link->product_id."'");
                         $product1 = $pro1->row();

                         $adm_qry = $this->db->query("select * from  admin_comissions where cat_id='".$product1->cat_id."' and shop_id='".$value->vendor_id."'");
                         if( $adm_qry->num_rows()>0)
                         {
                            $adm_comm = $adm_qry->row();
                            $p_gst = $adm_comm->gst;

                         }
                         else
                         {
                            $p_gst = '0';
                         }

                         $class_percentage = ($value->unit_price/100)*$p_gst;

                         

                            $variants1 = $var1->result();
                            $att1=[];
                            foreach ($variants1 as $value1) 
                            {

                                

                                $jsondata = $value1->jsondata;

                                $values_ar=[];

                                $json =json_decode($jsondata);
                                foreach ($json as $value123) 
                                {
                                    $type = $this->db->query("select * from attributes_title where id='".$value123->attribute_type."'");
                                    $types = $type->row();
                                
                                    $val = $this->db->query("select * from attributes_values where id='".$value123->attribute_value."'");
                                    $value1 = $val->row();
                                    $values_ar[]=array('id'=>$value1->id,'title'=>$types->title,'value'=>$value1->value);
                                }

                                

                            }

                            $shop = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                            $shopdat = $shop->row();

                    $products_ar[]=array('id'=>$value->id,'price'=>$value->price,'quantity'=>$value->quantity,'unit_price'=>$value->unit_price,'image'=>$img,'attributes'=>$values_ar,'product_name'=>$product1->name,'shop_name'=>$shopdat->shop_name,'shop_id'=>$value->vendor_id,'gst'=>$class_percentage);
                }


                $quote_qry = $this->db->query("select * from bid_quotations where bid_id='".$bidds->id."'");
                $quote_result = $quote_qry->result();
                $quote_list=[];
                foreach ($quote_result as $val) 
                {
                    $shop_q = $this->db->query("select * from vendor_shop where id='".$val->vendor_id."'");
                    $shop_row = $shop_q->row();

                    $qry = $this->db->query("select id,city_name from cities where id='".$shop_row->city_id."'");
                    $city = $qry->row();
                    $addrs = $shop_row->address.", ".$city->city_name;

                    $date = date("d-m-Y h:i A",$val->created_at);

                    if($val->accept=='yes')
                    {
                        $accept_status =1;
                    }
                    else
                    {
                         $accept_status =0;
                    }

                    if($val->accept=='yes')
                    {
                        $finalstatus =1;
                    }
                    
                   $quote_list[]=array('id'=>$val->id,'bid_value'=>$val->total_price,'vendor_id'=>$val->vendor_id,'shop_name'=>$shop_row->shop_name,'shop_name'=>$shop_row->shop_name,'address'=>$addrs,'date'=>$date,'accept_status'=>$accept_status);
                }



               $ar[]=array('id'=>$bidds->id,'session_id'=>$bidds->session_id,'total_products'=>$total_products,'bid_status'=>$bid_status,'recived_quotes'=>$total_quotes,'lowest_bid'=>$low_bid,'total_price'=>$bidds->grand_total,'products'=>$products_ar,'bidders_list'=>$quote_list,'finalstatus'=>$bidds->bid_status);
            }
            return array('status' =>TRUE, 'bids'=>$ar);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"No Bids");
        }

}



function cancelBid($bid)
{
    $ar=array('bid_status'=>3);
    $wr =array('id'=>$bid);
    $upd = $this->db->update("user_bids",$ar,$wr);
    if($upd)
    {
        return array('status' =>TRUE, 'message'=>"Bid Cancelled Successfully");
    }
    else
    {
        return array('status' =>FALSE, 'message'=>"Something Went wrong");
    }
}


function selectUseraddress($user_id,$address_id)
{
    $qry = $this->db->query("select * from user_address where id='".$address_id."'");
    $address = $qry->row();

    $state = $address->state;
    $city = $address->city;
    $pincode = $address->pincode;

    $chk = $this->db->query("SELECT * FROM `vendor_shop` where state_id='".$state."' and city_id='".$city."' and find_in_set('".$pincode."',vendor_pincodes)");
    if($chk->num_rows()>0)
    {


    $ar = array('address_id'=>$city,'address_id'=>$city,'state_id'=>$state,'pincode_id'=>$pincode);
    $wr = array('id'=>$user_id);
     $upd = $this->db->update("users",$ar,$wr);
     if($upd)
     {
         $ar = array('isdefault'=>'no');
         $wr = array('user_id'=>$user_id);
         $this->db->update("user_address",$ar,$wr);
         
         $ar = array('isdefault'=>'yes');
         $wr = array('id'=>$address_id);
         $this->db->update("user_address",$ar,$wr);
       return array('status' =>TRUE, 'message'=>"Address Updated Successfully");
     }
     else
     {
        return array('status' =>FALSE, 'message'=>"Something Went wrong");
     }
 }
 else
 {
    return array('status' =>FALSE, 'message'=>'There is no Shop, Please add/change your location');
 }
}


function getcontent($cid)
{
    $qry = $this->db->query("select id,title,description from content where id='".$cid."'");
    $content = $qry->row();
    $ar = array('id'=>$content->id,'title'=>$content->title,'description'=>$content->description);
    return array('status' =>TRUE, 'content'=>$ar);
}

function deleteAddress($user_id,$aid)
{
    $del = $this->db->delete("user_address",array('id'=>$aid));
    if($del)
     {
       return array('status' =>TRUE, 'message'=>"Address Deleted Successfully");
     }
     else
     {
        return array('status' =>FALSE, 'message'=>"Something Went wrong");
     }
}

function userNotifications($user_id)
{
    $qry12 = $this->db->query("select * from sms_notifications where receiver_id='".$user_id."' and view_status=0 order by id desc");
    $cont = $qry12->num_rows();

    $qry = $this->db->query("select * from sms_notifications where receiver_id='".$user_id."'");
    $result = $qry->result();
    if($qry->num_rows()>0)
    {
        $ar=[];
        foreach ($result as $value) 
        {
            $qry1 = $this->db->query("select * from users where id='".$user_id."'");
            $users = $qry1->row();
            $name = $users->first_name." ".$users->last_name;
            if($users->image!='')
            {
                 $image = base_url()."uploads/users/".$users->image;
            }
            else
            {
                 $image = base_url()."uploads/profile-icon-3.png";
            }


            $ar[]=array('id'=>$value->id,'message'=>$value->message,'created_at'=>date("d M,Y",$value->created_at),'order_id'=>$value->order_id,'sender_id'=>$value->sender_id,'image'=>$image,'name'=>$name);
        }
        return array('status' =>TRUE, 'notifications'=>$ar,'notcount'=>$cont);
    }
    else
    {
         return array('status' =>FALSE, 'message'=>"No Notifications",'notcount'=>$cont);
    }
}

function updateNotifications($user_id)
{
    $upd = $this->db->update('sms_notifications',array('view_status'=>1),array('receiver_id'=>$user_id));
    if($upd)
    {
        return array('status' =>TRUE, 'message'=>"success");
    }
}


function sendPushnotification($user_id)
{
                    $user_qry = $this->db->query("select * from users where id='".$user_id."'");
                    $user_row = $user_qry->row();

                    $device_id = $user_row->token;
                    $message = 'This is for testing';
                    $title  = 'Sample push Notification';
                    $this->push_notification_android($device_id,$message,$title);
}


function push_notification_android($device_id,$message,$title){
    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';

    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    
    $api_key = 'AAAA0DoBBlM:APA91bGLNDRu2vokZwVYAiSGMgqlnGebnddPwEpqd1GhOyjERKN65vTuy74UiZqi60WG4OlHDzl1DlUh7KjsWuEiLc4J30QxeDM1TYb1JBgzl6_BKT76I8J8o2vnCDmEcMRyc-HhKQXO';
                
    $fields = array (
        'registration_ids' => array (
                $device_id
        ),
        'data' => array (
                "title" => $title,
                "body" => $message
        )
    );

    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
                
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
} 


function getstates()
{
    $qry =$this->db->query("select * from states");
    if($qry->num_rows()>0)
    {
        $state = $qry->result();
        return array('status' =>TRUE, 'states'=>$state);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No States');
    }
}

function getCities1($state_id,$shopId)
{
    
        $qry =$this->db->query("select * from cities where state_id='".$state_id."'");
        if($qry->num_rows()>0)
        {
            $cities = $qry->result();
            return array('status' =>TRUE, 'cities'=>$cities);
        }
        else
        {
            return array('status' =>TRUE, 'message'=>'No Cities');
        }
   

    
}

function getEditCities1($state_id)
{
    $qry =$this->db->query("select * from cities where state_id='".$state_id."'");
    if($qry->num_rows()>0)
    {
        $cities = $qry->result();
        return array('status' =>TRUE, 'cities'=>$cities);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No Cities');
    }
}


function getHomeCities()
{
    $qry =$this->db->query("select * from cities");
    if($qry->num_rows()>0)
    {
        $cities = $qry->result();
        return array('status' =>TRUE, 'cities'=>$cities);
    }
    else
    {
        return array('status' =>FALSE, 'message'=>'No Cities');
    }
}




function getSelectedCities($state)
{
    $qry =$this->db->query("select * from cities where state_id='".$state."'");
    if($qry->num_rows()>0)
    {
        $cities = $qry->result();
        return array('status' =>TRUE, 'cities'=>$cities);
    }
    else
    {
        return array('status' =>FALSE, 'message'=>'No Cities');
    }
}

function saveUserHomeLocation($user_id,$city_id,$state,$pincode)
{
    $chk = $this->db->query("SELECT * FROM `vendor_shop` where state_id='".$state."' and city_id='".$city_id."' and find_in_set('".$pincode."',vendor_pincodes)");
    if($chk->num_rows()>0)
    {
        $upd = $this->db->update("users",array('address_id'=>$city_id,'pincode_id'=>$pincode,'state_id'=>$state),array('id'=>$user_id));
        if($upd)
        {
             return array('status' =>TRUE, 'message'=>"Location Updated Successfully");
        }
        else
        {
             return array('status' =>FALSE, 'message'=>'Something went wrong');
        }
    }
    else
    {
        return array('status' =>FALSE, 'message'=>'There is no Shop,Please change your location');
    }

    
}


function checkLocationCondition($user_id)
{
     $chk = $this->db->query("SELECT * FROM `users` where id='".$user_id."' and state_id=0 and address_id=0 and pincode_id=0");
     if($chk->num_rows()>0)
     {
        return array('status' =>FALSE, 'message'=>'Please Update your Location');
     }
     else
     {
        $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
        $row = $qry->row();
        $state_id = $row->state_id;
        $city_id = $row->address_id;
        $pincode_id = $row->pincode_id;
        $chk = $this->db->query("SELECT * FROM `vendor_shop` where state_id='".$state_id."' and city_id='".$city_id."' and find_in_set('".$pincode_id."',vendor_pincodes)");
        if($chk->num_rows()>0)
        {
            return array('status' =>TRUE, 'message'=>"Location Updated");
        }
        else
        {
             return array('status' =>FALSE, 'message'=>'Please Update your Location');
        }

     }
}

function getselectedPincodes($city_id)
{
    
    $qry =$this->db->query("select * from pincodes where city_id='".$city_id."' and status=1");
    if($qry->num_rows()>0)
    {
        $cities = $qry->result();
        return array('status' =>TRUE, 'pincodes'=>$cities);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No Pincodes');
    }
}


function getPincodes($state_id,$city_id,$vendor_id)
{
         $vendor_qry = $this->db->query("SELECT * FROM `vendor_shop` WHERE state_id='".$state_id."' and city_id='".$city_id."' and id='".$vendor_id."'");
         $vendor_row = $vendor_qry->row();
         if($vendor_qry->num_rows()>0)
         {
                 $pincode_list = explode(",", $vendor_row->vendor_pincodes);
                 $pincode_ar=[];
                 foreach ($pincode_list as $value) 
                 {
                    $chk_qry = $this->db->query("select * from pincodes where id='".$value."'");
                    $chk_pincode = $chk_qry->row();
                    if($chk_qry->num_rows()>0)
                    {
                        $pincode_ar[]=$chk_pincode;
                    }
                    
                 }
                 if(count($pincode_ar)>0)
                 {
                    return array('status' =>TRUE, 'pincodes'=>$pincode_ar);
                 }
                 else
                 {
                    return array('status' =>TRUE, 'message'=>"There is no vendor for this location");
                 }
                
         }
         else
         {
            return array('status' =>TRUE, 'message'=>"There is no vendor for this location");
         }

    /*$qry =$this->db->query("select * from pincodes where state_id='".$state_id."' and city_id='".$city_id."' and status=1 order by pincode asc");
    if($qry->num_rows()>0)
    {
        $cities = $qry->result();
        return array('status' =>TRUE, 'pincodes'=>$cities);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No Pincodes');
    }*/
}


function addCartAddress($user_id,$name,$mobile,$address,$city,$state,$pincode,$address_type,$landmark,$vendor_id){
        /*$chk = $this->db->query("SELECT * FROM `vendor_shop` where id = '".$vendor_id."' and state_id='".$state."' and city_id='".$city."' and find_in_set('".$pincode."',vendor_pincodes)");
        if($chk->num_rows()>0)
        {*/

        $data=array('user_id'=>$user_id,'name'=>$name,'mobile'=>$mobile,'address'=>$address,'city'=>$city,'state'=>$state,'pincode'=>$pincode,'landmark'=>$landmark,'address_type'=>$address_type);
        $ins = $this->db->insert("user_address",$data);
        if($ins)
        {
            return array('status' =>TRUE, 'message'=>"Address added successfully");
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Something went wrong");
        }
    /*}
    else
    {
         return array('status' =>FALSE, 'message'=>'No shops in this location,Please change your location');
    }*/

    }
/*function getPincodes($state_id,$city_id,$vendor_id)
{
    $qry =$this->db->query("select * from pincodes where state_id='".$state_id."' and city_id='".$city_id."' and status=1");
    if($qry->num_rows()>0)
    {
        $cities = $qry->result();
        return array('status' =>TRUE, 'pincodes'=>$cities);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No Pincodes');
    }
}*/
function shopWiseProductSearch($cat_id,$user_id,$start_from,$perpage,$lat,$lng,$keyword)
    {
          $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;

                          $qry1 = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.status=1 and products.delete_status=0 and products.cat_id='".$cat_id."' and products.status=1 and products.availabile_stock_status='available' and  products.name LIKE '%".$keyword."%' group by link_variant.product_id order by products.id ASC");
        
                        $qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.* FROM link_variant INNER JOIN products ON link_variant.product_id=products.id where link_variant.saleprice!=0 and link_variant.status=1 and products.delete_status=0 and products.cat_id='".$cat_id."' and products.status=1 and products.availabile_stock_status='available' and  products.name LIKE '%".$keyword."%' group by link_variant.product_id order by products.id ASC LIMIT ".$start_from.",".$perpage);

        //$qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 group by product_id");
        $dat = $qry->result();
        if($qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {

                    /*$qry11 = $this->db->query("select * from products where cat_id='".$cat_id."' and sub_cat_id='".$subcat_id."'  and shop_id='".$shop_id."' and id='".$value12->product_id."' and status=1");
                    $value = $qry11->row();*/

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }


                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                    /*$brnd = $this->db->query("select * from attr_brands where id='".$value->brand."'");
                    $brand = $brnd->row();*/

                    $vendo = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                    $vendor = $vendo->row();


                    // print_r($value); 
                    $wish = $this->db->query("select * from whish_list where product_id='".$value->id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }

                        $ar[]=array('id'=>$value->id,'shop_id'=>$vendor->id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$vendor->shop_name,'price'=>$value->price,'saleprice'=>$value->saleprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat);
                    
                }


            return array('status' =>TRUE,'product_list'=>$ar,'total'=>$qry1->num_rows());
        }
        else
        {
           
            return array('status' =>FALSE, 'message'=>"No Products",'total'=>$qry1->num_rows());
        }


    }

function getuserPincodes($state_id,$city_id)
{
    $qry =$this->db->query("select * from pincodes where state_id='".$state_id."' and city_id='".$city_id."' and status=1");
    if($qry->num_rows()>0)
    {
        $cities = $qry->result();
        return array('status' =>TRUE, 'pincodes'=>$cities);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No Pincodes');
    }
}

function getAreas($state_id,$city_id,$vendor_id,$pincode)
{
    $qry =$this->db->query("select * from areas where pincode='".$pincode."' and status=1");
    if($qry->num_rows()>0)
    {
        $areas = $qry->result();
        return array('status' =>TRUE, 'areas'=>$areas);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No Areas');
    }
}

function getuserAreas($state_id,$city_id,$pincode)
{
    $qry =$this->db->query("select * from areas where state_id='".$state_id."' and city_id='".$city_id."' and pincode='".$pincode."' and status=1");
    if($qry->num_rows()>0)
    {
        $areas = $qry->result();
        return array('status' =>TRUE, 'areas'=>$areas);
    }
    else
    {
        return array('status' =>TRUE, 'message'=>'No Areas');
    }
}


function applyManualCoupon($coupon_code,$session_id,$coupon_status,$grand_total)
{
            $qry = $this->db->query("select * from coupon_codes where coupon_code='".$coupon_code."'");
        if($qry->num_rows()>0)
        {
            $row = $qry->row();


            $cprice = $row->maximum_amount;

            $percentage = $row->percentage;

            $dis_percentage = ($grand_total/100)*$percentage; 

            if($cprice<round($dis_percentage))
            {
                $final_amount = $grand_total-$cprice;
                $discount = number_format($cprice,2);
            }
            else
            {
                    if($grand_total<round($dis_percentage))
                    {
                        $final_amount =0;
                        $discount = number_format($cprice,2);
                    }
                    else
                    {
                        $final_amount = $grand_total-$dis_percentage;
                        $discount = number_format($dis_percentage,2);
                    }
                
            }



            return array('status' =>TRUE,'message'=>"Coupon Applied successfully",'grand_total' =>$final_amount,'discount' =>$discount,'coupon_id'=>$row->id,'coupon_code'=>$coupon_code);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid Coupon");
        }
   
    
}


function checkLocation($area_id,$city_id,$vendor_id,$pincode)
{
    $chk_qry = $this->db->query("select * from pincodes where pincode='".$pincode."'");
    if($chk_qry->num_rows()>0)
    {
            $chk_pincode = $chk_qry->row();
         $pincode_qry = $this->db->query("SELECT * FROM `vendor_shop` where id='".$vendor_id."' and city_id='".$city_id."' and find_in_set('".$chk_pincode->id."',vendor_pincodes)");
         if($pincode_qry->num_rows()>0)
         {
             return array('status' =>TRUE);
         }
         else
         {
            return array('status' =>TRUE, 'message'=>"There is no vendor for this location");
         }
    }
    else
    {
         return array('status' =>TRUE, 'message'=>"There is no vendor for this location");
    }
}


function updateUserToken1($user_id,$tokenId)
{
    $upd = $this->db->update("users",array('token'=>$tokenId),array('id'=>$user_id));
    if($upd)
    {
        return array('status' =>TRUE,'message'=>"Token Updated Successfully");
    }
}

function updateCustomerAddress($user_id,$lat,$lng,$address)
{

                    /*$admin = $this->db->query("select * from admin where id=1");
                    $search_distance = $admin->row()->distance;
     $shop_qry = $this->db->query("SELECT id,( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance FROM vendor_shop having distance<'".$search_distance."'");
        if($shop_qry->num_rows()>0)
        {*/
            $upd = $this->db->update("users",array('lat'=>$lat,'lng'=>$lng,'home_location'=>$address),array('id'=>$user_id));
            if($upd)
            {
                return array('status' =>TRUE,'message'=>"Location Updated Successfully");
            }
        /*}
        else
        {
            return array('status' =>TRUE,'message'=>"Location Updated Successfully");
            //return array('status' =>FALSE,'message'=>"There is no shop your selected location, please change location");
        }*/
}


function distanceInKm()
{
    $admin = $this->db->query("select * from admin where id=1");
    $search_distance = $admin->row()->distance;
    return array('status' =>TRUE,'distance'=>$search_distance);
}


function versionControl()
    {
        $qry = $this->db->query("select * from version_control where id=1");
        if($qry->num_rows()>0)
        {
            $verion = $qry->row();
            return array('status'=>TRUE,'veersion_no'=>$verion->version);
        }
        else
        {
             return array('status'=>FALSE);
        }
    }



    function getTopDeals($user_id,$lat,$lng)
{

    
 $admin = $this->db->query("select * from admin where id=1");
                          $search_distance = $admin->row()->distance;
   
     $deal_qry = $this->db->query("SELECT link_variant.id as variant_id,link_variant.price,link_variant.saleprice,link_variant.stock,link_variant.jsondata, products.*, products.*, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance,vendor_shop.shop_name FROM link_variant INNER JOIN products ON link_variant.product_id=products.id INNER JOIN vendor_shop ON vendor_shop.id=products.shop_id where link_variant.saleprice!=0 and link_variant.status=1 and products.top_deal='yes' group by link_variant.product_id order by products.id ASC");
     //having distance<".$search_distance."
    //$deal_qry = $this->db->query("SELECT * FROM `link_variant` where saleprice!=0 and status=1 group by product_id");
        $dat = $deal_qry->result();
        if($deal_qry->num_rows()>0)
        {   
                $ar=[];
                foreach ($dat as $value) 
                {
                   /* $qry11 = $this->db->query("select * from products where id='".$value12->product_id."' and top_deal='yes' and priority!=0");
                    $value = $qry11->row();*/

                     $im = $this->db->query("select * from product_images where product_id='".$value->id."' and variant_id='".$value->variant_id."'");
                     $images = $im->row();
                    if($images->image!='')
                    {
                        $img = base_url()."uploads/products/".$images->image;
                    }
                    else
                    {
                        $img = base_url()."uploads/noproduct.png";
                    }

                    
                    $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                    $category = $cat->row();
                    $subcat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                    $subcategory = $subcat->row();
                   


                    $qry = $this->db->query("SELECT * FROM `users` where id='".$user_id."'");
                    $row = $qry->row();


                   


                    /*$vendo = $this->db->query("select *, ( 3959 * acos ( cos ( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin ( radians('".$lat."') ) * sin( radians( lat ) ) ) ) * 1.60934 AS distance from vendor_shop where id='".$value->shop_id."' and status=1 having distance<'".$search_distance."' ");

                    $vendor = $vendo->row();*/


                    $wish = $this->db->query("select * from whish_list where product_id='".$value->id."' and user_id='".$user_id."'");
                    if($wish->num_rows()>0)
                    {
                        $stat = true;
                    }
                    else
                    {
                        $stat = false;
                    }
                   
                        
                            $ar[]=array('id'=>$value->id,'shop_id'=>$value->shop_id,'variant_product'=>$value->variant_product,'name'=>$value->name,'category_name'=>$category->category_name,'subcategory_name'=>$subcategory->sub_category_name,'brand'=>$value->brand,'shop'=>$value->shop_name,'price'=>$value->price,'saleprice'=>$value->saleprice,'image'=>$img,'availabile_stock_status'=>$value->availabile_stock_status,'whishlist_status'=>$stat,'distance'=>$value->distance);
                        
                    
                    
                }

            return array('status' =>TRUE,'product_list'=>$ar);
        }
        else
        {
           
            return array('status' =>FALSE, 'message'=>"No Products");
        }
}


function promotionalNotifications($user_id)
{
        $qry = $this->db->query("select id,title,description as message from promotion_notifications where ( user_id='".$user_id."' or select_user_type='all' ) ");
        if($qry->num_rows()>0)
        {
            $promotions = $qry->result();

            return array('status'=>TRUE,'promo_notifications'=>$promotions,'type'=>'promotions');
        }
        else
        {
             return array('status'=>FALSE,'message'=>"No data found");
        }
}


function applyUserCoupon($coupon_code,$session_id,$coupon_status,$grand_total,$user_id)
{

    $date = date("Y-m-d");
   
        

    $chk_qry = $this->db->query("select * from cash_coupons where user_id='".$user_id."' and coupon_code='".$coupon_code."'  and ( start_date<='".$date."' and expiry_date>='".$date."' )");
    if($chk_qry->num_rows()>0)
    {
        $chk_cash_coupon_row = $chk_qry->row();
        $discount=$chk_cash_coupon_row->amount;
        if($grand_total>$discount)
        {
            $final_amount=$grand_total-$discount;
        }
        else
        {
            $final_amount=0;
        }
        
          return array('status' =>TRUE,'message'=>"Coupon Applied successfully",'grand_total' =>$final_amount,'discount' =>$discount,'coupon_id'=>$chk_cash_coupon_row->id,'coupon_code'=>$coupon_code);
    }
    else
    {
        $qry = $this->db->query("select * from coupon_codes where coupon_code='".$coupon_code."' and ( start_date<='".$date."' and expiry_date>='".$date."' )");
        if($qry->num_rows()>0)
        {
            $row = $qry->row();


            $cprice = $row->maximum_amount;

            $percentage = $row->percentage;

            $dis_percentage = ($grand_total/100)*$percentage; 

            if($cprice<round($dis_percentage))
            {
                $final_amount = $grand_total-$cprice;
                $discount = number_format($cprice,2);
            }
            else
            {
                    if($grand_total<round($dis_percentage))
                    {
                        $final_amount =0;
                        $discount = number_format($cprice,2);
                    }
                    else
                    {
                        $final_amount = $grand_total-$dis_percentage;
                        $discount = number_format($dis_percentage,2);
                    }
                
            }



            return array('status' =>TRUE,'message'=>"Coupon Applied successfully",'grand_total' =>$final_amount,'discount' =>$discount,'coupon_id'=>$row->id,'coupon_code'=>$coupon_code);
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid Coupon");
        }
    }
}


function changeSeoUrl($val)
{
    if($val=='1')
    {
        $qry = $this->db->query("select * from products");
    $results = $qry->result();
    foreach ($results as $value) 
    {
        $title = $value->id."_".$value->name;
        $shop_name = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($title))));

       $this->db->update("products",array('seo_url'=>$shop_name),array('id'=>$value->id));
    }
    }
    else if($val=='2')
    {
         $qry = $this->db->query("select * from vendor_shop");
            $results = $qry->result();
            foreach ($results as $value) 
            {
                $title = $value->id."_".$value->shop_name;
                $shop_name = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($title))));
        
               $this->db->update("vendor_shop",array('seo_url'=>$shop_name),array('id'=>$value->id));
            }
    }
    else if($val=='3')
    {
         $qry = $this->db->query("select * from categories");
            $results = $qry->result();
            foreach ($results as $value) 
            {
                $title = $value->id."_".$value->category_name;
                $shop_name = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($title))));
        
               $this->db->update("categories",array('seo_url'=>$shop_name),array('id'=>$value->id));
            }
    }
    else if($val=='4')
    {
         $qry = $this->db->query("select * from sub_categories");
            $results = $qry->result();
            foreach ($results as $value) 
            {
                $title = $value->id."_".$value->sub_category_name;
                $shop_name = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($title))));
        
               $this->db->update("sub_categories",array('seo_url'=>$shop_name),array('id'=>$value->id));
            }
    }
    
    
    
}



function getStateCity($pincode)
{
    $pincode_qry = $this->db->query("select * from pincodes where pincode='".$pincode."'");
    $pincode_row = $pincode_qry->row();
    $stat_id = $pincode_row->state_id;
    $city_id = $pincode_row->city_id; 
    
    $states_qry = $this->db->query("select * from states where id='".$stat_id."'");
    $state_row = $states_qry->row();
    $state_name = $state_row->state_name;
    
    $cities_qry = $this->db->query("select * from cities where id='".$city_id."'");
    $cities_row = $cities_qry->row();
    $city_name = $cities_row->city_name;
    if($pincode_qry->num_rows()>0)
    {
        return array('status'=>TRUE,'state_name'=>$state_name,'city_name'=>$city_name);
    }
    else
    {
        return array('status'=>FALSE);
    }
    
    
    
}




}