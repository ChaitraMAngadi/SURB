<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Orders extends MY_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');

        }

        $this->load->model("admin_model");

    }



    function index() {

        $data['page_name'] = 'orders';

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $qry = $this->db->query("select * from orders where order_status=1 order by id desc");
        

        $data['orders'] = $qry->result();



        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/orders', $this->data);

        $this->load->view('admin/includes/footer');

    }
    
    
    



    function pending($value)

    {

       // echo $this->uri->segment(3);;

        $data['page_name'] = 'orders';

        $shop_id = $_SESSION['vendors']['vendor_id'];



        if($value=='pending')

        {

            $qry = $this->db->query("select * from orders where order_status=1 order by id desc");

        }

        else if($value=='accepted_retos')

        {

            $qry = $this->db->query("select * from orders where order_status=2 and accept_status=0 order by id desc");

        }

        else if($value=='accepted_vendor')

        {

            $qry = $this->db->query("select * from orders where order_status=2 order by id desc");

        }

        else if($value=='pickuorders')

        {

            $qry = $this->db->query("select * from orders where order_status=3 order by id desc");

        }

        else if($value=='ondelivery')

        {

            $qry = $this->db->query("select * from orders where order_status=4 order by id desc");

        }

        else if($value=='completed')

        {

            $qry = $this->db->query("select * from orders where order_status=5 order by id desc");

        }

        else if($value=='cancelled')

        {

            $qry = $this->db->query("select * from orders where order_status=6 order by id desc");

        }

        else if($value=='return')

        {

            $qry = $this->db->query("select * from orders where order_status=7 order by id desc");

        }

        else if($value=='allorders')

        {

            $qry = $this->db->query("select * from orders order by id desc");

        }

        

        $data['orders'] = $qry->result();

        

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/orders', $this->data);

        $this->load->view('admin/includes/footer'); 

    }







    



    function orderCancel($orderid,$user_id)

    {

        $upd = $this->db->update("orders",array('order_status'=>6),array('id'=>$orderid));

        if($upd)

        {

            $msg = "Admin Cancel the order";

            $this->db->insert("sms_notifications",array('order_id'=>$orderid,'sender_id'=>0,'receiver_id'=>$user_id,'message'=>$msg,'created_at'=>time()));

            $this->session->set_tempdata('success_message', 'Order Cancelled Successfully',3);

            redirect('admin/orders');



        }

    }

    

    function orderDetails($session_id)

    {

        $this->data['page_name'] = 'orders';

        $qry = $this->db->query("select * from orders  where session_id='".$session_id."'");

        $data['orders'] = $qry->row();

        

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $qry = $this->db->query("select * from cart where session_id='".$session_id."'");

        $orders = $qry->result();

        $ar=[];

        foreach($orders as $ord)

        {

               $var = $this->db->query("select * from link_variant where id='".$ord->variant_id."'");

               $variant = $var->row(); 

               

               $pro = $this->db->query("select * from products where id='".$variant->product_id."'");

               $prod = $pro->row(); 

               

               $jsondata = json_decode($variant->jsondata);

               //print_r($jsondata); die;

               $attributes=[];

               foreach($jsondata as $row)

               {

                    $att_title = $this->db->query("select * from attributes_title where id='".$row->attribute_type."'");

                    $att_title_row = $att_title->row();

                    

                    $att_value = $this->db->query("select * from attributes_values where id='".$row->attribute_value."'");

                    $att_value_row = $att_value->row();

                    $attributes[]=array('type'=>$att_title_row->title,'value'=>$att_value_row->value);

               }

               

            $ar[]=array('id'=>$ord->id,'product_name'=>$prod->name,'price'=>$ord->price,'quantity'=>$ord->quantity,'unit_price'=>$ord->unit_price,'attributes'=>$attributes,'variant_id'=>$ord->variant_id,'cat_id'=>$prod->cat_id,'vendor_id'=>$ord->vendor_id);

        }

        $data['order_cart']=$ar;

        

        $or = $this->db->query("select * from orders where session_id='".$session_id."'");

        $ord = $or->row();

        

        $data['orderdetails']=$ord;

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/order_details', $this->data);

        $this->load->view('admin/includes/footer');

    }

  

     function delivery($session_id)

    {

        $data['order_id']=$session_id;

        $del = $this->db->query("select id,name,phone from deliveryboy");

        $data['deliverypersons']=$del->result();

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/deliverypage', $data);

        $this->load->view('admin/includes/footer');

    }



    function assignDeliveryBoy()

    {

        $ar = array('delivery_boy'=>$this->input->get_post('db_id'),'order_status'=>'3');

        $wr = array('id'=>$this->input->get_post('order_id'));

        $upd = $this->db->update("orders",$ar,$wr);



        if($upd)

        { 

            $ad_ar = array('status'=>1);

            $ad_wr = array('order_id'=>$this->input->get_post('order_id'));

            $this->db->update("admin_notifications",$ad_ar,$ad_wr);



            $chk = $this->db->query("select * from deliveryboy where id='".$this->input->get_post('db_id')."'");

            $delivery = $chk->row();

           

            $device_id = $delivery->token;

            $title = "New Order";

            $message = "New Order Assigned From Sector6";

			

			



            //$this->send_push_notification($device_id,$message,$title);

            

			

            $this->push_notification_android($device_id,$message,$title);

            $data['page_name'] = 'orders';

            $shop_id = $_SESSION['vendors']['vendor_id'];

            $qry = $this->db->query("select * from orders where vendor_id='".$shop_id."' order by id desc");

            $data['orders'] = $qry->result();

             //$this->mailsenttoCustomer($this->input->get_post('db_id'),$this->input->get_post('order_id'));



        $qry = $this->db->query("select * from orders where id='".$this->input->get_post('order_id')."'");

        $order_row = $qry->row();



        $user_qry = $this->db->query("select * from users where id='".$order_row->user_id."'");

        $user_row = $user_qry->row();



        $del_qry = $this->db->query("select * from deliveryboy where id='".$this->input->get_post('db_id')."'");

        $delivery_row = $del_qry->row();





$otp_message = "Dear ".$delivery_row->name." you have been assigned to pick up order no ".$order_row->id." from vendor ".$vendor_name." and deliver to ".$user_row->first_name.". Pls acknowledge notification in app.";

            

                    $template_id = "1407161684122274071";

                    $this->send_message($otp_message,$delivery_row->phone,$template_id);



                    $otp_message = "Dear ".$user_row->first_name." ur order no ".$this->input->get_post('order_id')." is assigned to ".$delivery_row->name." and he/she will deliver to you shortly. Thank u for shopping with us.";

            

                    $template_id = "1407161683247844364";

                    if($this->send_message($otp_message,$user_row->phone,$template_id))

                    {



$user_id = $order_row->user_id;

            $user_title = "Delivery Boy Assigned";

            $user_message = $otp_message;

			$this->onesignalnotification($user_id,$user_message,$user_title);





        $to_mail = $user_row->email;

        $from_email = 'absolutemens@gmail.com';

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

                Assigned Delivery Boy: Your order ID :'.$orderid.' amounting to Rs.'.$order_row->total_price.'. You can expect delivery by '.$order_row->delivery_timeslots.' We will send you an update when your order is packed/shipped.<br><br>

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

                <a href="#" style="margin-right: 5px"><img src="'.base_url().'uploads/fb.png" alt="" height="40"></a>

                <a href="#" style="margin-right: 5px"><img src="'.base_url().'uploads/twitter.png" alt="" height="40"></a>

                <a href="#" style="margin-right: 5px"><img src="'.base_url().'uploads/youtube.png" alt="" height="40"></a>

                <a href="#"><img src="'.base_url().'uploads/instagram.png" alt="" height="40"></a>

                <p style="font-weight: 300; color:#fff; font-size: 11px;">&copy; Copyright 2021 Sector6., All Rights Reserved</p>

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

                                        $mail->Subject = "Assigned Delivery Person";

                                        $mail->Body = $email_message;

                                        $sucess = $mail->send();

                                        /*if($sucess)

                                        {

                                            $data='mail sent successfully';

                                            

                                        }

                                        else

                                        {

                                            $data='mail not sent,Please try again';

                                        }*/





            /*$this->load->view('admin/includes/header', $data);

            $this->load->view('admin/orders', $this->data);

            $this->load->view('admin/includes/footer'); */

        }

            redirect('admin/orders');

        }

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

	

function send_push_notification($userid,$message,$title){



$data = array("to" => $userid, "priority" => 'high', "data" => array("title" => $title,"body" => $message, 'sound'=>'vendor_delivery_notification','msg_type'=>'Notificaton'));





	  $data_string = json_encode($data);

		//print_r($data_string);die;

      $headers = array

      (

       'Authorization: key=AAAA0bshvm4:APA91bESYbazUcHNIp9RpvqX2tjzYfajYyCtH_C1rXsLhTIyjYRnPg_hI6igO-luMj65UqGvILKtUFld0BMlncfa31JV6pNt6B_lXVszpST_iI3mDdC0_cXeuJ9VTDxoTkJM1qhAcaLJ',

       'Content-Type: application/json'

      );



      $ch = curl_init();



      curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

      curl_setopt( $ch,CURLOPT_POST, true );

      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );

      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

      curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);



      $result = curl_exec($ch);



      curl_close ($ch);



      $arr = array('status' => "valid",'data' => strip_tags($result));



      return $arr;



    }



function send_message($message = "", $mobile_number,$template_id) {





         $message = urlencode($message);



         $URL = "http://login.smsmoon.com/API/sms.php"; // connecting url 



         $post_fields = ['username' => 'absolutemens', 'password' => 'vizag@123', 'from' => 'Absolutemens', 'to' => $mobile_number, 'msg' => $message, 'type' => 1, 'dnd_check' => 0,'template_id'=>$template_id];



         //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");

         $ch = curl_init();

         curl_setopt($ch, CURLOPT_URL, $URL);

         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

         curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

         curl_exec($ch);

         return true;

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

    //print_r($result); die;

    return $result;

} 



function assignCourier($session_id)
{


        $data['page_name'] = 'orders';

        $shop_id = $_SESSION['vendors']['vendor_id'];

        $qry = $this->db->query("select * from cart where session_id='".$session_id."' group by vendor_id");

        $data['orders'] = $qry->result();
        foreach($data['orders'] as $ord){
            // print_r($ord->vendor_id); die;
            $this->getOrderTrack($ord->vendor_id);
        }


        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/courier', $this->data);

        $this->load->view('admin/includes/footer');
}

function getOrderTrack($vendorid, $order_id = "musqd2lkp9983hp96ney1630911702"){
    print_r($order_id); die;
        $timestamp    = time();
        $appID        = 7071;
        $key          = 'qqguv845+z4=';
        $secret       = 'iXlfZZiW3/nZvKPos/tXYioWsCyi0GttMCo7MDVwH4LHilE8ZsTL3xSw1+bUxNASYv1Mtln2ets17KzPoRhgPw==';
        $sign = "key:".$key."id:".$appID.":timestamp:".$timestamp;
        $authtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));  
        $ch = curl_init();
    
        $header = array(
            "x-appid: $appID",
            "x-timestamp: $timestamp",
            "x-sellerid:$vendorid",
            "x-version:3", // for auth version 3.0 only
            "Authorization: $authtoken"
        );
    
        curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/track/'.$order_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        var_dump($server_output);
        exit;
        curl_close($ch);
        
        die;
    }
    
    

function sendCourier($session_id,$vendor_id)
{
    //echo $session_id;

    //echo $vendor_id; die;


                $timestamp    = time();
                $appID        = 7071;
                $key          = 'qqguv845+z4=';
                $secret       = 'iXlfZZiW3/nZvKPos/tXYioWsCyi0GttMCo7MDVwH4LHilE8ZsTL3xSw1+bUxNASYv1Mtln2ets17KzPoRhgPw==';

                $sign = "key:".$key."id:".$appID.":timestamp:".$timestamp;
                $authtoken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));  
                // echo $authtoken; die;
                //echo $timestamp;

                $vendorid=117531;
                $ch = curl_init();

                $ord = $this->db->query("select * from orders where session_id='".$session_id."'");
                $ord_row = $ord->row();
                // print_r($ord_row->user_id); die;
                $deliveryaddress_id = $ord_row->deliveryaddress_id;

                $user_ad = $this->db->query("select * from user_address where id='".$deliveryaddress_id."'");
                $user_row = $user_ad->row();
                // print_r($user_row); die;
                $city_qry = $this->db->query("select * from cities where id='".$user_row->city."'");
                $city_row = $city_qry->row();

                $pincode_qry = $this->db->query("select * from pincodes where id='".$user_row->pincode."'");
                $pincode_row = $pincode_qry->row();

                


                $user = $this->db->query("select * from users where id='".$ord_row->user_id."'");
                
                $user_row = $user->row();
    
                // print_r($this->db->last_query()); die;
                
                        $order_id = $session_id."".time();


                            $cart_qry = $this->db->query("select * from cart where session_id='".$session_id."' and vendor_id='".$vendor_id."'");
                            $cart_result = $cart_qry->result();
                            $skuList=[];
                            $total_price=0;
                            foreach ($cart_result as $value) 
                            {
                                $price = $value->price;
                                $quantity = $value->quantity;
                                $unit_price = $value->unit_price;
                                $price = $value->price;

                                                $lv_qry = $this->db->query("select * from link_variant where id='".$value->variant_id."'");
                                                $lv_report = $lv_qry->row();

                                                $pro_qry = $this->db->query("select * from products where id='".$lv_report->product_id."'");
                                                $pro_report = $pro_qry->row();
                                      $total_price = $total_price+$unit_price;          
                               $skuList[]=array("sku" => $pro_report->name,"itemName" => $pro_report->name, "quantity" => $quantity,"price" => $price,"itemLength" =>$pro_report->package_length, "itemWidth" =>$pro_report->package_breadth,"itemHeight"=> $pro_report->package_height,"itemWeight" => $pro_report->package_weight);
                            }


                             


                        $package = array("itemLength" => 1.5,"itemWidth" => 1.5,"itemHeight"=> 1.5,"itemWeight" => 1.5);

                    $ord = array('orderId'=>$order_id,'customerName'=>$user_row->first_name,'customerAddress'=>$ord_row->user_address,'customerCity'=>$city_row->city_name,'customerPinCode'=>$pincode_row->pincode,'customerContact'=>$user_row->phone,'orderType'=>$ord_row->payment_option,'modeType'=>"Surface",'orderDate'=>date("Y-m-d"),'package'=>$package,'skuList'=>$skuList,'totalValue'=>$total_price,'sellerAddressId'=>56509);

                $data = array("orders"=>array($ord));
            //   print_r($data); die;
                /*$data = Array(
                    "orders" => Array(
                        "0" => Array(
                            "orderId" => "123456sss78901",
                            "customerName" => "Satish",
                            "customerAddress" => "dwaraka nagar, 5th lane, visakapatnam",
                            "customerCity" => "visakapatnam",
                            "customerPinCode" => "530016",
                            "customerContact" => "9542921119",
                            "orderType" => "COD",
                            "modeType" => "Surface",
                            "orderDate" => "2021-08-10",

                            "package" => Array( 
                                "itemLength" => 12,
                                "itemWidth" => 15,
                                "itemHeight"=> 20,
                                "itemWeight" => 1.5
                            ),
                            "skuList" => Array(
                                "0" => Array(
                                    "sku" => "Test",
                                    "itemName" => "Item1",
                                    "quantity" => 1,
                                    "price" => 45.00,
                                    "itemLength" => 10, //optional
                                    "itemWidth" => 3, //optional
                                    "itemHeight"=> 2, //optional
                                    "itemWeight" => 2 //optional
                                ),
                                "1" => Array(
                                    "sku" => "Test1",
                                    "itemName" => "Item2",
                                    "quantity" => 1,
                                    "price" => 45.00,
                                    "itemLength" => null, //optional
                                    "itemWidth" => null, //optional
                                    "itemHeight"=> null, //optional
                                    "itemWeight" => null //optional
                                )
                            ),
                            "totalValue" => 1320,
                            "sellerAddressId" => 56509,
                        )
                    )
                );*/

                $data_json = json_encode($data);
// echo "<pre>"; print_r($data_json); die;
                $header = array(
                    "x-appid: $appID",
                    "x-sellerid:$vendorid",
                    "x-timestamp: $timestamp",
                    "x-version:3", // for auth version 3.0 only
                    "Authorization: $authtoken",
                    "Content-Type: application/json",
                    "Content-Length: ".strlen($data_json)
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/order?method=sku');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response  = curl_exec($ch);
                $resp = json_decode($response);


                curl_close($ch);
                $shipment_id = "";
                // print_r($resp); die;
                
                
                if($resp[0]->success){
                    $final_data["order_resp_id"] = $resp[0]->success;
                    $final_data["order_response"] = $response;
                    $shipment_id = $resp[0]->success;
                }
                if($resp[0]->error){
                    $this->session->set_tempdata('error_message',"Order Creation Failed. Error: '".$resp[0]->error."' Occured.",3);
                    echo "<script> location.href='".$_SERVER['HTTP_REFERER']."';</script>"; die;
                }
                
                
                
                
                
                
                
            $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
            $encode64 = base64_encode(hash_hmac('sha256', $sign, $secret, true));
            $authtoken = rawurlencode($encode64);
            $ch = curl_init();
            $orderIds = [$shipment_id];
            $data = array(
                "orders"=> $orderIds
            );
        
            $data_json = json_encode($data);
            $header = array(
                "x-appid: $appID",
                "x-timestamp: $timestamp",
                "x-sellerid:$vendorid",
                "Authorization: $authtoken",
                "Content-Type: application/json",
                "x-version:3"
            );
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.shyplite.com/bulkslip');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            $final_data["shipment_response"] = $server_output;
            var_dump($server_output);
            curl_close($ch);
            
            
            
            
            
            
            
            
            
            
            $sign = "key:". $key ."id:". $appID. ":timestamp:". $timestamp;
            $encode64 = base64_encode(hash_hmac('sha256', $sign, $secret, true));
            $authtoken = rawurlencode($encode64);
            $ch = curl_init();
        
            $header = array(
                "x-appid: $appID",
                "x-timestamp: $timestamp",
                "x-sellerid:$vendorid",
                "Authorization: $authtoken",
                "Content-Type: application/json",
                "x-version:3"
            );
            $uri = 'https://api.shyplite.com/getManifestPDF/';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $uri);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            $final_data["manifest_response"] = $server_output;
            // var_dump($server_output);
            curl_close($ch);
            $final_data['session_id'] = $session_id;
            $final_data['vendor_id'] = $vendor_id;
            
            
            
            $res = $this->db->insert("courier_orders",$final_data);
            if(!$res){
                print_r($final_data); die;
            }
            // print_r($final_data); die;
            redirect($_SERVER['HTTP_REFERER']);
                

}





}

