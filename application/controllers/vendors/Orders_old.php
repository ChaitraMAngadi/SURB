<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        $data['page_name'] = 'orders';
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $qry = $this->db->query("select * from orders where vendor_id='".$shop_id."' order by id desc");
        $data['orders'] = $qry->result();
        
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/orders', $this->data);
        $this->load->view('vendors/includes/footer');
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
       
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/order_details', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function delivery($session_id)
    {
        $data['order_id']=$session_id;
        $del = $this->db->query("select id,name from deliveryboy");
        $data['deliverypersons']=$del->result();
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/deliverypage', $data);
        $this->load->view('vendors/includes/footer');
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

	        $data['page_name'] = 'orders';
	        $shop_id = $_SESSION['vendors']['vendor_id'];
	        $qry = $this->db->query("select * from orders where vendor_id='".$shop_id."' order by id desc");
	        $data['orders'] = $qry->result();
	        
	        $this->load->view('vendors/includes/header', $data);
	        $this->load->view('vendors/orders', $this->data);
	        $this->load->view('vendors/includes/footer'); 
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
function send_message($message = "", $mobile_number,$template_id) {


         $message = urlencode($message);

         $URL = "http://login.smsmoon.com/API/sms.php"; // connecting url 

         $post_fields = ['username' => 'absolutemens', 'password' => 'vizag@123', 'from' => 'absolutemens', 'to' => $mobile_number, 'msg' => $message, 'type' => 1, 'dnd_check' => 0,'template_id'=>$template_id];

         //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $URL);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_exec($ch);
         return true;
      }

    function changeStatus()
    {
        $shop_id = $_SESSION['vendors']['vendor_id'];
	  if($this->input->post('value'))
	  {
	  	$order_id=$this->input->post('order_id');

        $value=$this->input->post('value');
        if($value==2)
        {
            $ar=array('order_status'=>$this->input->post('value'),'accept_status'=>1);
        }
        else
        {
            $ar=array('order_status'=>$this->input->post('value'));
        }

	  	
	  	$wr=array('id'=>$order_id);
	   	$upd = $this->db->update("orders",$ar,$wr);
	   	if($upd)
	   	{  
		$qry = $this->db->query("select * from orders where id='".$order_id."'");
                $row = $qry->row();
				$usr_qry = $this->db->query("select * from users where id='".$row->user_id."'");
                    $usr_row = $usr_qry->row();
							
							$phone =$usr_row->phone;
                    $name =$usr_row->first_name;
                if($this->input->post('value')==2)
                {
                    $msg = "Order Accepted by ";
					$title = "Order Accepted";
                        $message = "Your Order : ".$row->id." Accepted by Admin";
                            $this->onesignalnotification($row->user_id,$message,$title);
							
							
                    $msg="Dear ".$name." your order is ".$order_id." is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.";
            
                    $template_id = "1407161683232344120";
                    $this->send_message($msg,$phone,$template_id);
					
                }
                else if($this->input->post('value')==3)
                {
                    $msg = "Order Accepted by ";
                    $title = "Order Accepted";
                        $message = "Your Order : ".$row->id." Accepted by Admin";
                            $this->onesignalnotification($row->user_id,$message,$title);
                            
                            
                    $msg="Dear ".$name." your order is ".$order_id." is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.";
            
                    $template_id = "1407161683232344120";
                    $this->send_message($msg,$phone,$template_id);
                    
                }
                else if($this->input->post('value')==6)
                {
                    $msg = "Order Cancelled by";
					$title = "Order Cancelled";
                        $message = "Your Order : ".$row->id." Cancelled by Admin";
                            $this->onesignalnotification($row->user_id,$message,$title);
                }
                
                $aar = array('vendor_id'=>$shop_id,'order_id'=>$order_id,'message'=>$msg);
                $this->db->insert("admin_notifications",$aar);

	   		echo "success"; exit;
	   	}
	  }

    }

}
