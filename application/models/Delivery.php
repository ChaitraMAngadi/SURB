<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Delivery extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        //load database library
        $this->load->database();
    }
 function send_message($message = "", $mobile_number,$template_id="") {


         $message = urlencode($message);
        $template_name = urlencode('Registration OTP Verification');
        $URL = "https://2factor.in/API/R1/"; // connecting url
        $mobile_number = urlencode($mobile_number); 
        $template_id = urlencode($template_id);

         //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");
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

        return true;
      }

   
    function checkLogin($mobile,$password,$token)
    {
        $chk = $this->db->query("select * from deliveryboy where phone='".$mobile."' and password='".$password."'");
        if($chk->num_rows()>0)
        {
             $row = $chk->row();
             $name = $row->name;
             $this->db->update("deliveryboy",array('token'=>$token),array('phone'=>$mobile));
             $res = array('status' =>"Valid",'db_id'=>$row->id,'name'=>$row->name,'message'=>"Logged In Successfully");
             return $res;
        }
        else
        {
            return array('status' =>"Invalid", 'message'=>"Invalid Login Details");
        }
    }

   

    function orderList($db_id)
    {
        $qry = $this->db->query("select * from orders where delivery_boy='".$db_id."' and order_status=3");
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

                    $city_qry = $this->db->query("select * from cities where id='".$address->city."'");
                    $city_row = $city_qry->row();

                    $state_qry = $this->db->query("select * from states where id='".$address->state."'");
                    $state_row = $state_qry->row();

                    $area_qry = $this->db->query("select * from areas where id='".$address->area."'");
                    $area_row = $area_qry->row();
            

                $full_address =$address->address.", ".$value->area."".$city_row->city_name.", ".$state_row->state_name.", ".$address->pincode;
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
                
               $ar[]=array('id'=>$value->id,'order_id'=>$value->session_id,'customer_name'=>$name,'mobile'=>$users->phone, 'address'=>$full_address,'date_time'=>date('d-m-Y, h:i A',$value->created_at),'payment_status'=>$payment_status,'payment_option'=>$value->payment_option,'service_status'=>$order_status,'amount'=>$value->total_price,'vendor_name'=>$vendor->shop_name,'created_date'=>date('d-m-Y, h:i A',$value->created_at));
            }
            return array('status' =>"Valid", 'orders'=>$ar);
        }
        else
        {
            return array('status' =>"Invalid", 'message'=>"No Orders");
        }
    }


     function pickupOrders($db_id)
    {
        $qry = $this->db->query("select * from orders where delivery_boy='".$db_id."' and order_status=4");
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

                    $city_qry = $this->db->query("select * from cities where id='".$address->city."'");
                    $city_row = $city_qry->row();

                    $state_qry = $this->db->query("select * from states where id='".$address->state."'");
                    $state_row = $state_qry->row();

                    $area_qry = $this->db->query("select * from areas where id='".$address->area."'");
                    $area_row = $area_qry->row();
            

                $full_address =$address->address.", ".$value->area."".$city_row->city_name.", ".$state_row->state_name.", ".$address->pincode;
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
                
               $ar[]=array('id'=>$value->id,'order_id'=>$value->session_id,'customer_name'=>$name,'mobile'=>$users->phone, 'address'=>$full_address,'date_time'=>date('d-m-Y, h:i A',$value->created_at),'payment_status'=>$payment_status,'payment_option'=>$value->payment_option,'service_status'=>$order_status,'amount'=>$value->total_price,'vendor_name'=>$vendor->shop_name,'created_date'=>date('d-m-Y, h:i A',$value->created_at));
            }
            return array('status' =>"Valid", 'orders'=>$ar);
        }
        else
        {
            return array('status' =>"Invalid", 'message'=>"No Orders");
        }
    }

    function completedOrders($db_id)
    {
        $qry = $this->db->query("select * from orders where delivery_boy='".$db_id."' and order_status=5");
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
                

                $city_qry = $this->db->query("select * from cities where id='".$address->city."'");
                    $city_row = $city_qry->row();

                    $state_qry = $this->db->query("select * from states where id='".$address->state."'");
                    $state_row = $state_qry->row();

                    $area_qry = $this->db->query("select * from areas where id='".$address->area."'");
                    $area_row = $area_qry->row();
            

                $full_address =$address->address.", ".$value->area."".$city_row->city_name.", ".$state_row->state_name.", ".$address->pincode;

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
                
               $ar[]=array('id'=>$value->id,'order_id'=>$value->session_id,'customer_name'=>$name,'mobile'=>$users->phone, 'address'=>$full_address,'date_time'=>date('d-m-Y, h:i A',$value->created_at),'payment_status'=>$payment_status,'payment_option'=>$value->payment_option,'service_status'=>$order_status,'amount'=>$value->total_price,'vendor_name'=>$vendor->shop_name,'created_date'=>date('d-m-Y, h:i A',$value->created_at));
            }
            return array('status' =>"Valid", 'completed_orders'=>$ar);
        }
        else
        {
            return array('status' =>"Invalid", 'message'=>"No Completed Orders");
        }
    }

    function orderDetails($order_id)
    {
        $qry = $this->db->query("select * from orders where session_id='".$order_id."'");
        if($qry->num_rows()>0)
        {
            $ord = $qry->row();
                $cartt_qry = $this->db->query("select * from cart where session_id='".$order_id."'");
                $result = $cartt_qry->result();
           
                 $ar=[];
                foreach ($result as $value) 
                {
                        $link = $this->db->query("select * from link_variant where id='".$value->variant_id."'");
                        $link_variant = $link->row();

                        $jsondata = json_decode($link_variant->jsondata);
                        $attribute=[];
                        foreach ($jsondata as $value1) 
                        {
                            $attribute_type=$value1->attribute_type;

                            $atr = $this->db->query("select * from attributes_title where id='".$attribute_type."'");
                            $atr_type = $atr->row();

                            $attribute_value=$value1->attribute_value;

                            $atr_v = $this->db->query("select * from attributes_values where id='".$attribute_value."'");
                            $atr_values = $atr_v->row();

                            $attribute[]=array('attribute_type'=>$atr_type->title,'attribute_value'=>$atr_values->value);
                        }


                        $prod = $this->db->query("select * from products where id='".$link_variant->product_id."'");
                        $product = $prod->row();

                        $prod_img = $this->db->query("select * from product_images where product_id='".$product->id."'");
                        $product_img = $prod_img->row();

                            if($product_img->image!='')
                            {
                                $im = base_url()."uploads/products/".$product_img->image;

                            }
                            else
                            {
                                $im ="";
                            }

                            $ven = $this->db->query("select * from vendor_shop where id='".$value->vendor_id."'");
                            $vendor = $ven->row();
                            $vendordet = array('shop_name'=>$vendor->shop_name,'contact_person_name'=>$vendor->owner_name,'mobile'=>$vendor->mobile,'address'=>$vendor->address);
                            
                    $ar[]=array('id'=>$value->id,'product'=>$product->name,'price'=>$value->price,'qty'=>$value->quantity,'sub_total'=>$value->unit_price,'image'=>$im,'attributes'=>$attribute,'vendor_details'=>$vendordet);
                }



               $q = $this->db->query("select SUM(unit_price) as total_price from cart where session_id='".$session_id."'");
                $cart = $q->row();

                $del = $this->db->query("select * from deliveryboy_amount");
                $delivery_charge = $del->row();
                
                $delivery_amount = $delivery_charge->amount;
                $grandtotal = $ord->total_price;



                $adrs = $this->db->query("select * from user_address where id='".$ord->deliveryaddress_id."'");
                $address = $adrs->row();
                
                $city_qry = $this->db->query("select * from cities where id='".$address->city."'");
                    $city_row = $city_qry->row();

                    $state_qry = $this->db->query("select * from states where id='".$address->state."'");
                    $state_row = $state_qry->row();

                    $area_qry = $this->db->query("select * from areas where id='".$address->area."'");
                    $area_row = $area_qry->row();
            

                $full_address =$address->address.", ".$value->area."".$city_row->city_name.", ".$state_row->state_name.", ".$address->pincode;




                $qry = $this->db->query("select * from users where id='".$ord->user_id."'");
                $users = $qry->row();
                $name = $users->first_name." ".$users->last_name;

                 if($ord->payment_status==0)
                {
                    $payment_status="UnPaid";
                }
                else
                {
                    $payment_status="Paid";
                }


                $address_ar = array('name'=>$address->name,'address'=>$address->address,'locality'=>$value->area,'city'=>$city_row->city_name,'state'=>$state_row->state_name,'pincode'=>$address->pincode,'mobile'=>$address->mobile);


                 return array('status' =>"Valid",'items'=>$ar,'address'=>$address_ar,'order_id'=>$order_id,'customer_name'=> $name,'mobile'=>$users->phone,'date_time'=>date('d-m-Y, h:i A',$ord->created_at),'payment_option'=>$ord->payment_option,'payment_status'=>$payment_status,'sub_total'=>$ord->sub_total,'shipping'=>$delivery_amount,'gst'=>$ord->gst,'coupon_disount'=>$ord->coupon_disount,'total'=>$grandtotal);
             


                /*$value = $qry->row();
            
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
                
               $ar=array('id'=>$value->id,'session_id'=>$value->session_id,'customer_name'=>$name,'vendor_name'=>$vendor->shop_name,'address'=>$full_address,'payment_status'=>$payment_status,'payment_type'=>$value->payment_option,'service_status'=>$order_status,'amount'=>$value->total_price,'created_date'=>date('d-m-Y, h:i A',$value->created_at));
            return array('status' =>TRUE, 'ordersdetails'=>$ar);*/
        }
        else
        {
            return array('status' =>"Invalid", 'message'=>"No Order details");
        }



    }


    function confirmPickup($order_id,$db_id)
    {
        $sel = $this->db->query("select * from orders where session_id='".$order_id."'");
        if($sel->num_rows()>0)
        {
                $ar = array('order_status'=>4,'delivery_boy'=>$db_id);
                $wr = array('session_id'=>$order_id);
                $upd = $this->db->update("orders",$ar,$wr);
                if($upd)
                {

                        $del_qry = $this->db->query("select * from deliveryboy where id='".$db_id."'");
                        $delivery_row = $del_qry->row();
                        $delivery_name=$delivery_row->name;
                    $order_row = $sel->row();
                    $userid = $order_row->user_id;
                    $vendor_id = $order_row->vendor_id;

                    $usr_qry = $this->db->query("select * from users where id='".$userid."'");
                    $usr_row = $usr_qry->row();

                     $vend_qry = $this->db->query("select * from vendor_shop where id='".$vendor_id."'");
                     $vend_row = $vend_qry->row();
                     $vendor_name = $vend_row->owner_name;

                    $title = "Order Picked";
                    $message ="Your Order ".$order_row->id." has been Picked by delivery boy,he is on the way";


                    $phone =$usr_row->phone;
                    $name =$usr_row->first_name;
                    $otp_message = "Dear ".$name." you have been assigned to pick up order no ".$order_row->id." from vendor ".$vendor_name." and deliver to ".$delivery_name.". Pls acknowledge notification in app.";
            
                    $template_id = "1407161684122274071";
                    $this->send_message($otp_message,$phone,$template_id);



                    $otp_message1 = "Dear ".$delivery_name." thank you pick up the order and safely deliver to customer following road safety and covid precautions.";
                    $delphone = $delivery_row->phone;
                    $template_id1 = "1407161684135171889";
                    $this->send_message($otp_message1,$delphone,$template_id1);

                    $otp_message_user = "Dear ".$usr_row->first_name.", Your order from Absolutemens.com your shipment will be delivered to you soon by our delivery partner. Thank you for shopping with us Team Absolutemens.com";

                    $this->send_message($otp_message_user,$usr_row->phone);



                     $this->onesignalnotification($userid,$message,$title);
					 //$this->push_notification_android($userid,$message,$title);
                        $user_qry = $this->db->query("select * from users where id='".$order_row->user_id."'");
                        $user_row = $user_qry->row();
                     $to_mail = $user_row->email;
                                    $from_email = 'absolutemens@gmail.com';
                                    $site_name = 'Absolutemens';
                                    $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;">
        <tr><td align="center" valign="top"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td></tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td valign="top">
                <h1 style="margin:0px; padding:10px 0px; background-color: #000; text-align: center; font-weight: 300; color:#fff; font-size: 22px; text-align: center;">Your Order Details</h1>
                <div style="padding:15px;">
                <h4 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Hello '.$user_row->first_name.',</h4>
                <p style="margin:0px; padding:0px; font-size: 14px; text-align: justify; line-height: 20px; padding-bottom: 10px;">
                Order Shipped :OrderID '.$order_row->id.' amounting to Rs.'.$order_row->total_price.'. You can expect delivery by '.$order_row->delivery_timeslots.' We will send you an update when your order is Delivered. <br><br>
                Delivery Person will Pickup the Order<br><br>
                <b>Delivery Boy Name:</b> '.$delivery_row->name.'<br> <b>Mobile Number :</b>'.$delivery_row->phone.'

                </p>
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
                <p style="font-weight: 300; color:#fff; font-size: 11px;">&copy; Copyright 2021 Absolutemens, All Rights Reserved</p>
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
                                        $mail->Subject = "Order Shipped";
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



                     return array('status' =>"Valid","message"=>"Pick Up Successful");
                }
        }
        else
        {
             return array('status' =>"Invalid","message"=>"Order Id  Wrong, Please try again");
        }
    }


function push_notification_android($device_id,$message,$title){

    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';

    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    
    $api_key = 'AAAAkpaJlU0:APA91bFtR5W87oDNlnaW4dgXbTXZAENAiPOx7D9to-h-GujBPC0Eo5bKsvVz2RkdNA5pTs8ffAZXgyOESL59o6IDwdci5dvmHJCd6B4ppbg5vPHxxw6tr3wnaEB9sbtsOcPIk9E8J9mf';
                
    $fields = array (
        'registration_ids' => array (
                $device_id
        ),
        'data' => array (
                "title" => $title,
                "body" => $message,
				 'sound'=>'vendor_delivery_notification'
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
} 
     function onesignalnotification($user_id,$message,$title)
    {
        $qr = $this->db->query("select * from users where id='".$user_id."'");
        $res = $qr->row();
            if($res->token!='')
            {                 
                       
                        $user_id = $res->token;
                        
                        $fields = array(
        'app_id' => 'e072cc7b-595d-4c4c-a451-b07832b073f9',
        'include_player_ids' => [$user_id],
        'contents' => array("en" =>$message),
        'headings' => array("en"=>$title),
		'android_channel_id' => 'ea6c19aa-e55f-4243-af28-605a32901234'
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

    function confirmDelivery($order_id,$db_id)
    {
        $sel = $this->db->query("select * from orders where session_id='".$order_id."' and delivery_boy='".$db_id."'");
        if($sel->num_rows()>0)
        {
                $ar = array('order_status'=>5,'payment_status'=>1);
                $wr = array('session_id'=>$order_id,'delivery_boy'=>$db_id);
                $upd = $this->db->update("orders",$ar,$wr);
                if($upd)
                {
                        $orderd = $sel->row();

                        $userid = $orderd->user_id;

                             $user_qry1 = $this->db->query("select * from users where id='".$userid."'");
                             $user_row1 = $user_qry1->row();
                             $phone=$user_row1->phone;
                             $first_name=$user_row1->first_name;
                        $message = "Your Order Delivered";
                        $title ="Delivered";

                        $otp_message = "Dear ".$first_name." u r order no. ".$orderd->id." is successfully delivered. Thank u for shopping with Sector6. in case of any queries pls contact customer care.";
            
                    $template_id = "1407161683259484619";
                    $this->send_message($otp_message,$phone,$template_id);


                     $this->onesignalnotification($userid,$otp_message,$message);
					 
					// $this->push_notification_android($userid,$message,$title);

                        $bonus = $orderd->bonus_points;

                        $user_qry = $this->db->query("select * from users where id='".$orderd->user_id."'");
                        $user_row = $user_qry->row();

                        $user_coins = $user_row->bonus_points;
                        $user_total_coins = $user_coins+$bonus;
                        $this->db->update("users",array('bonus_points'=>$user_total_coins),array('id'=>$orderd->user_id));





                         

                        $user_qry = $this->db->query("select * from users where id='".$orderd->user_id."'");
                        $user_row = $user_qry->row();


                        $del_qry = $this->db->query("select * from deliveryboy where id='".$db_id."'");
                        $delivery_row = $del_qry->row();

                                    $to_mail = $user_row->email;
                                    $from_email = 'Absolutemens@gmail.com';
                                    $site_name = 'Sector6';
                                    $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;">
        <tr><td align="center" valign="top"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td></tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td valign="top">
                <h1 style="margin:0px; padding:10px 0px; background-color: #000; text-align: center; font-weight: 300; color:#fff; font-size: 22px; text-align: center;">Your Order Details</h1>
                <div style="padding:15px;">
                <h4 style="margin:0px; padding:0px 0px 10px 0px; color:#f47a20">Hello '.$user_row->first_name.',</h4>
                <p style="margin:0px; padding:0px; font-size: 14px; text-align: justify; line-height: 20px; padding-bottom: 10px;">
                Order Delivered :OrderID '.$orderd->id.' amounting to Rs.'.$orderd->total_price.'. <br>
                </p>
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
                <p style="font-weight: 300; color:#fff; font-size: 11px;">&copy; Copyright 2021 Absolutemens., All Rights Reserved</p>
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
                                        $mail->Subject = "Order Delivered";
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

                     return array('status' =>"Valid","message"=>"Order Delivered Successfully");
                }
        }
        else
        {
             return array('status' =>"Invalid","message"=>"Something went  Wrong, Please try again");
        }
    }

    function ordersCount($db_id)
    {
        $ord = $this->db->query("select * from orders where delivery_boy='".$db_id."' and order_status=3");
        $new_orders = $ord->num_rows();

        $pick = $this->db->query("select * from orders where delivery_boy='".$db_id."' and order_status=4");
        $pickup = $pick->num_rows();

        $com = $this->db->query("select * from orders where delivery_boy='".$db_id."' and order_status=5");
        $completed = $com->num_rows();

        return array('status' =>"Valid","neworder"=>$new_orders,"pickup_order"=>$pickup,"completedorder"=>$completed);
    }


     function checkForgot($phone)
    {
        $chk = $this->db->query("select * from deliveryboy where ( phone='".$phone."' or email='".$phone."' )");
        if($chk->num_rows()>0)
        {
            $otp = rand(1000,10000);
            $ar=array('otp'=>$otp);
            $wr=array('phone'=>$phone);
            $otp_message = $otp." is OTP to reset your password. Pls do not share OTP to anyone for security reasons.";
            
            $template_id = "1407161683190033363";
            if($this->send_message($otp_message,$phone,$template_id))
            {
                $upd = $this->db->update('deliveryboy',$ar,$wr);
                if($upd)
                {
                    $stu_row = $chk->row();
                     $st_email = $stu_row->email;
                $to_mail = $st_email;
                $from_email = 'absolutemens@gmail.com';
                $site_name = 'Absolutemens';
                $email_message = '<table width="100%" style="max-width: 560px; margin:0px auto; background-color: #fff; padding:10px 0px 0px 0px;height: 100vh">
                        <tr>
                            <td align="center"><img src="'.base_url().'web_assets/img/logo-white.svg" alt="" height="50"></td>
                        </tr>   
                        <tr>
                            <td align="center">
                                <h1 style="margin:0px; padding:0px; text-align: center; font-weight: 300; color:#666"><span style="color:#f47a20">FORGOT PASSWORD FROM Sector6</span></h1>
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
                    $row = $chk->row();
                    $res = array('status' =>TRUE,'otp'=>$otp,'phone'=>$phone);
                    return $res;  
                }
            }
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Invalid Phone Number");
        }
    }

    function resetPassword($phone,$otp,$password)
    {
        $qry = $this->db->query("select * from deliveryboy where phone='".$phone."' and otp='".$otp."'");
        if($qry->num_rows()>0)
        {
              $ar = array('password'=>md5($password));
              $wr = array('phone'=>$phone);
              $upd = $this->db->update("deliveryboy",$ar,$wr);
             if($upd)
             {
                $row = $qry->row();
                $res = array('status' =>TRUE,'user_id'=>$row->id,'phone'=>$row->phone,'email'=>$row->email);
                return $res;
             }
        }
        else
        {
            return array('status' =>FALSE, 'message'=>"Something went wrong");
        }
    }


     function updatePassword($user_id,$current_password,$new_password)
    {
        
            $se =$this->db->query("select * from deliveryboy where id='".$user_id."'");
            if($se->num_rows()>0)
            {
                $vendor = $se->row();
                    $oldpa =$this->db->query("select * from deliveryboy where id='".$user_id."' and password='".md5($current_password)."'");
                    if($oldpa->num_rows()>0)
                    {
                            $ar = array('password'=>md5($new_password));
                            $wr = array('id'=>$user_id);
                            $upd = $this->db->update("deliveryboy",$ar,$wr);
                            if($upd)
                            {
                                 $report=array('status'=>TRUE,'message'=>"Password Changed Successfully");
                                 return $report;
                            }
                    }
                    else
                    {
                           $report=array('status'=>FALSE,'message'=>"Old Password Wrong");
                             return $report;
                    }
                
            }
            else
            {
               $report=array('status'=>FALSE,'message'=>"Invalid User");
                return $report;
            }
     
    }


    function profileDetails($user_id)
{
    $qry = $this->db->query("select * from deliveryboy where id='".$user_id."'");
    if($qry->num_rows()>0)
    {
        $row = $qry->row();
        if($row->image!='')
        {
             $image = base_url()."uploads/delivery_boy/".$row->photo;
        }
        else
        {
             $image = "";
        }

        if($row->driving_license_image!='')
        {
             $driving_license_image = base_url()."uploads/delivery_boy/".$row->driving_license_image;
        }
        else
        {
             $driving_license_image = "";
        }

        if($row->aadhar_card!='')
        {
             $aadhar_card = base_url()."uploads/delivery_boy/".$row->aadhar_card;
        }
        else
        {
             $aadhar_card = "";
        }
       
        $ar = array('id'=>$row->id,'name'=>$row->name,'email'=>$row->email,'phone'=>$row->phone,'alternative_mobiles'=>$row->alternative_mobiles,'vehicle_number'=>$row->vehicle_number,'vehicle_type'=>$row->vehicle_type,'driving_license_image'=>$driving_license_image,'image'=>$image,'driving_license_number'=>$row->driving_license_number,'aadhar_card'=>$aadhar_card,'aadhar_card_number'=>$row->aadhar_card_number,'address'=>$row->address,'pincode'=>$row->pincode);
         return array('status' =>TRUE,'profile_details'=>$ar);
    }
}


function browse_file()
    {
        $image = $this->upload_file('image'); 
        return $image;
          
    }


    function getearnings($user_id)
    {
        $qry = $this->db->query("select SUM(deliveryboy_commission) as tamount from orders where delivery_boy='".$user_id."' and order_status=5");
        $row = $qry->row();
        if($row->tamount=='' || $row->tamount==null)
        {
            $tamount = 0;
        }
        else
        {
            $tamount =$row->tamount;
        }
        return array('status'=>'Valid','total_earnings'=>$tamount); 
    }


    private function upload_file($file_name) {
        /*if($_FILES[$file_name]["size"]<'5114374')
        {*/
            //echo $_FILES[$file_name]["image"]; die;
            $upload_path1 = "./uploads/delivery_boy/";
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


    function versionControl()
    {
        $qry = $this->db->query("select * from version_control where id=1");
        if($qry->num_rows()>0)
        {
            $verion = $qry->row();
            return array('status'=>TRUE,'veersion_no'=>$verion->deliveryvoy_version);
        }
        else
        {
             return array('status'=>FALSE);
        }
    }
    

}
?>