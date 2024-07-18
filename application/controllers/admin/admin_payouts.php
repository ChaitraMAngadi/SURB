<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_payouts extends MY_Controller {

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
        $this->data['page_name'] = 'Admin_payouts';
        $this->data['title'] = 'Admin_payouts';
        
        $qry = $this->db->query("select * from orders where order_status=5");
        $result = $qry->result();
        $this->data['orders']=$qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/admin_payouts', $this->data);
        $this->load->view('admin/includes/footer');
    }

   

    function changeStatus() {
        $id = $this->input->post('id');//vendor id
        $reference_id =$this->input->get_post('reference_id');//order id
        // print_r($reference_id);
        // exit;
        $requested_amount = $this->input->post('requested_amount');
        $mode_payment = $this->input->post('mode_payment');
        $sender_name = $this->input->post('sender_name');
        $receiver_name = $this->input->post('receiver_name');
        $description = $this->input->post('description');
        $status=$this->input->post('status');


    
        $orders_qry = $this->db->query("SELECT * FROM orders WHERE vendor_id='" . $id. "' AND order_status=5");
        $orders_qry_res = $orders_qry->result();
        foreach($orders_qry_res as $v) {
            $cart_qry = $this->db->query("SELECT * FROM cart WHERE session_id='" . $v->session_id . "' AND vendor_id='" . $v->vendor_id . "'");
            $cart_result = $cart_qry->result();
            $unit_price = 0;
    
            foreach ($cart_result as $cart_value) {
                $link_qry = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value->variant_id . "'");
                $link_row = $link_qry->row();
    
                $prod_qry = $this->db->query("SELECT * FROM products WHERE id='" . $link_row->product_id . "'");
                $prod_row = $prod_qry->row();
    
                $cat_id = $prod_row->cat_id;
                $sub_cat_id = $prod_row->sub_cat_id;
    
                $cat_qry = $this->db->query("SELECT * FROM categories WHERE id='" . $cat_id . "'");
                $cat_row = $cat_qry->row();
    
                $scat_qry = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $sub_cat_id . "'");
                $scat_row = $scat_qry->row();
    
                $cart_vendor_id = $cart_value->vendor_id;
                if ($sub_cat_id) {
                    $find_in_set = "AND find_in_set('" . $sub_cat_id . "',subcategory_ids)";
                } else {
                    $find_in_set = "";
                }
                $adminc_qry = $this->db->query("SELECT * FROM admin_comissions WHERE shop_id='" . $cart_vendor_id . "' AND cat_id='" . $cat_id . "' " . $find_in_set . " ");
                $adminc_row = $adminc_qry->row();
                if ($adminc_row->admin_comission != '') {
                    $admin_comission = $adminc_row->admin_comission;
                } else {
                    $admin_comission = 0;
                }
                $commision = floatval($cart_value->unit_price * $admin_comission) / 100;
                $gst = ($adminc_row->gst * $commision) / 100;
                $unit_price += $cart_value->unit_price;
            }
            $vendorAmount = floatval($unit_price - ($gst + $commision))+ $vendorAmount;
        }
    //  $array = array('total_payment' => $vendorAmount, 'requested_amount' => $requested_amount,'status'=>1);
    //  $where = array('vendor_id' => $id);
    //  $this->db->update("vendor_payements", $array, $where);
     $last_request_payment_qry = $this->db->query("SELECT * FROM request_payment WHERE vendor_id = '" . $id . "' and reference_id='".$reference_id."' ORDER BY id DESC LIMIT 1");
    $last_request_payment_row = $last_request_payment_qry->row();
    $vendor_amount = ($last_request_payment_qry->num_rows() > 0) ? (floatval($last_request_payment_row->vendor_amount) - floatval($last_request_payment_row->request_amount)) : $vendorAmount;

    if($status=='completed'){
       
    
    
    // Calculate the new vendor_amount
    // $vendor_amount = $previous_vendor_amount - $requested_amount;

    // Prepare data for insertion or update
    $com_qry=$this->db->query("select * from request_payment where vendor_id='".$id."' and reference_id='".$reference_id."'");
    $com_qry_res=$com_qry->result();
    $com_qry_count=$com_qry->num_rows();
    if($com_qry_count==0){
    $data = array(
        'transaction_id' => '',
        'sender_name' => $sender_name,
        'receiver_name' => $receiver_name,
        'mode_payment' => $mode_payment,
        'vendor_id' => $id,
        'reference_id' => $reference_id,
        'vendor_amount' => $vendor_amount,
        'request_amount' => $requested_amount,
        'admin_description' => $description,
        'image' => '',
        'status' => 1,
        'created_at' => time(),
        'updated_at' => time(),
        'payment_status'=>$status
    );

    // Insert or update request_payment table
    $insert_query= $this->db->insert('request_payment', $data);
    }else{
        $data_com = array(
            'transaction_id' => '',
            'sender_name' => $sender_name,
            'receiver_name' => $receiver_name,
            'mode_payment' => $mode_payment,
            'vendor_id' => $id,
            'reference_id' => $reference_id,
            'vendor_amount' => $vendor_amount,
            'request_amount' => $requested_amount,
            'admin_description' => $description,
            'image' => '',
            'status' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            'payment_status'=>$status
        );
    
        // Insert or update request_payment table
        $this->db->where('vendor_id',$id);
        $this->db->where('reference_id',$reference_id);
        $update_qry= $this->db->update('request_payment', $data_com);
    }

       
    }
    else if($status == 'pending'){

       $pe_qry=$this->db->query("select * from request_payment where vendor_id='".$id."' and reference_id='".$reference_id."'");
       $pe_qry_res=$pe_qry->result();
       $pe_qry_count=$pe_qry->num_rows();
       if($pe_qry_count==0){
        $data_p = array(
           
            'vendor_id' => $id,
            'reference_id' => $reference_id,
            'vendor_amount'=>$vendor_amount,
            'created_at' => time(),
            'updated_at' => time(),
            'payment_status'=>$status
        );
    
        // Insert or update request_payment table
        $insert_query_pending= $this->db->insert('request_payment', $data_p);
       }     
       else{
        $data_p2 = array(
           
            'vendor_id' => $id,
            'reference_id' => $reference_id,
            'vendor_amount'=>$vendor_amount,
            'created_at' => time(),
            'updated_at' => time(),
            'payment_status'=>$status
        );
    
        // Insert or update request_payment table
        $this->db->where('vendor_id',$id);
        $this->db->where('reference_id',$reference_id);
        $this->db->update('request_payment', $data_p2);
       }
      
        $this->session->set_tempdata('error_message', 'payment is pending',3);

        
    }
    else if($status == 'deferred'){
        // $deffered_qry=$this->db->query("select * from orders where vendor_id='".$id."' and order_status=5 and id='".$reference_id."'");
        // $deffered_qry_res=$deffered_qry->row();
        // $deffered_array= array(
        //     'order_status'=>6,
        //     'vendor_id'=>$id
        // );
        // $this->db->where('id',$reference_id);
        // $this->db->update('orders',$deffered_array);
        // // $this->load->controller('Orders');
        // // $this->orderCancel($deffered_qry_res->session_id);
        $de_qry=$this->db->query("select * from request_payment where vendor_id='".$id."' and reference_id='".$reference_id."'");
       $de_qry_res=$de_qry->result();
       $de_qry_count=$de_qry->num_rows();
       if($de_qry_count==0){
        $data_d = array(
           
            'vendor_id' => $id,
            'reference_id' => $reference_id,
            'vendor_amount'=>$vendor_amount,
            'created_at' => time(),
            'updated_at' => time(),
            'payment_status'=>$status
        );
    
        // Insert or update request_payment table
        $insert_query_deffered= $this->db->insert('request_payment', $data_d);
    }else{
        $data_d2 = array(
           
            'vendor_id' => $id,
            'reference_id' => $reference_id,
            'vendor_amount'=>$vendor_amount,
            'created_at' => time(),
            'updated_at' => time(),
            'payment_status'=>$status
        );
    
        // Insert or update request_payment table
        $this->db->where('vendor_id',$id);
        $this->db->where('reference_id',$reference_id);
        $this->db->update('request_payment', $data_d2);
    }

        $this->session->set_tempdata('error_message', 'Payment is in deferred state',3);
        

    }
    // $this->session->set_userdata('status',$status);
        if ($insert_query ||  $update_qry) {
            $vv = $this->db->query("SELECT * FROM request_payment WHERE vendor_id='" . $id . "' and reference_id= '".$reference_id."'");
            $vendr = $vv->row();
    
            
    
            $qrr = $this->db->query("SELECT * FROM vendor_shop WHERE id='" . $vendr->vendor_id . "'");
            $vend_row = $qrr->row();
    
            $msg = "Payment Request: Admin Settled the amount of Rs. " . $requested_amount . " to " . $vend_row->shop_name;
            $trans_ar = array('sender_name' => 'Admin', 'receiver_name' => $vend_row->shop_name, 'amount' => $requested_amount, 'message' => $msg, 'created_at' => time());
            $this->db->insert('transactions', $trans_ar);
    
            // Notification to admin
            $array = array('vendor_id' => $vend_row->id, 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);

            $order_arr=array(
                'admin_payment_date'=>date('Y-m-d')
            );
            $this->db->where('id',$reference_id);
            $this->db->update('orders',$order_arr);
    
            $this->session->set_tempdata('success_message', 'admin settled amount', 3);
            redirect('admin/admin_payouts');
            die();
        } else {
            redirect('admin/admin_payouts');
            die();
        }
    }
    

    private function upload_file($file_name) {
// echo $file_ext = pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);
// die;
        if ($_FILES[$file_name]['name'] != '') {

            if ($_FILES[$file_name]["size"] < '5114374') {
                $upload_path1 = "./uploads/payments/";
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
            } else {
                return 'false';
            }
        } else {
            return '';
        }
    }

   
    public function datewiseReport(){
        $start_date = $this->input->get_post('start_date');
        $end_date1 = $this->input->get_post('end_date');
        
        // Increment the end date by one day to include records up to the end date
        $end_date = date('Y-m-d', strtotime($end_date1. ' + 1 days'));
        
        // Prepare the query using normal date strings for start and end dates
        $payment_qry = $this->db->query("SELECT * FROM orders WHERE admin_payment_date BETWEEN ? AND ?", array($start_date, $end_date));
        $payment_qry_res = $payment_qry->result();
        
        // Assign dates to data array
        $this->$data['start_date'] = $start_date;
        $this->$data['end_date'] = $end_date1;
        $this->data['orders'] = $payment_qry_res;
        
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/admin_payouts', $this->data);
        $this->load->view('admin/includes/footer');
        
        

    }

    function orderDetails($session_id){
        $this->data['page_name'] = 'Admin_payouts';

        $qry = $this->db->query("select * from orders where session_id='" . $session_id . "'");

        $orders = $qry->result();

        foreach ($orders as $order) {
            $order->vendor_details = $this->db->where(['id' => $order->vendor_id])->get('vendor_shop')->row();
            $qry_cart = $this->db->query("select * from cart where vendor_id='" . $order->vendor_id . "' and session_id='" . $order->session_id . "'");
            $order->cart_data = $qry_cart->result();

            foreach ($order->cart_data as $ord) {
                $var = $this->db->query("select * from link_variant where id='" . $ord->variant_id . "'");

                $ord->variant = $var->row();

                $pro = $this->db->query("select * from products where id='" . $ord->variant->product_id . "'");

                $ord->prod = $pro->row();

                $jsondata = json_decode($ord->variant->jsondata);

                //print_r($jsondata); die;

                $ord->attributes = [];

                foreach ($jsondata as $row) {

                    $att_title = $this->db->query("select * from attributes_title where id='" . $row->attribute_type . "'");

                    $att_title_row = $att_title->row();

                    $att_value = $this->db->query("select * from attributes_values where id='" . $row->attribute_value . "'");

                    $att_value_row = $att_value->row();

                    $ord->attributes[] = array('type' => $att_title_row->title, 'value' => $att_value_row->value);
                }
            }
        }
        //pr($orders);
        $this->data['orders'] = $orders;
        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/payout_details', $this->data);

        $this->load->view('admin/includes/footer');

    }


    function getBackAmount($vendor_id,$order_id){
        $orders_qry = $this->db->query("SELECT * FROM orders WHERE vendor_id='" . $vendor_id. "' AND order_status=5");
        $orders_qry_res = $orders_qry->result();

        foreach($orders_qry_res as $v) {
            $cart_qry = $this->db->query("SELECT * FROM cart WHERE session_id='" . $v->session_id . "' AND vendor_id='" . $v->vendor_id . "'");
            $cart_result = $cart_qry->result();
            $unit_price = 0;
    
            foreach ($cart_result as $cart_value) {
                $link_qry = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value->variant_id . "'");
                $link_row = $link_qry->row();
    
                $prod_qry = $this->db->query("SELECT * FROM products WHERE id='" . $link_row->product_id . "'");
                $prod_row = $prod_qry->row();
    
                $cat_id = $prod_row->cat_id;
                $sub_cat_id = $prod_row->sub_cat_id;
    
                $cat_qry = $this->db->query("SELECT * FROM categories WHERE id='" . $cat_id . "'");
                $cat_row = $cat_qry->row();
    
                $scat_qry = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $sub_cat_id . "'");
                $scat_row = $scat_qry->row();
    
                $cart_vendor_id = $cart_value->vendor_id;
                if ($sub_cat_id) {
                    $find_in_set = "AND find_in_set('" . $sub_cat_id . "',subcategory_ids)";
                } else {
                    $find_in_set = "";
                }
                $adminc_qry = $this->db->query("SELECT * FROM admin_comissions WHERE shop_id='" . $cart_vendor_id . "' AND cat_id='" . $cat_id . "' " . $find_in_set . " ");
                $adminc_row = $adminc_qry->row();
                if ($adminc_row->admin_comission != '') {
                    $admin_comission = $adminc_row->admin_comission;
                } else {
                    $admin_comission = 0;
                }
                $commision = floatval($cart_value->unit_price * $admin_comission) / 100;
                $gst = ($adminc_row->gst * $commision) / 100;
                $unit_price += $cart_value->unit_price;
            }
            $vendorAmount = floatval($unit_price - ($gst + $commision))+ $vendorAmount;
        }
    //  $array = array('total_payment' => $vendorAmount, 'requested_amount' => $requested_amount,'status'=>1);
    //  $where = array('vendor_id' => $id);
    //  $this->db->update("vendor_payements", $array, $where);
     $last_request_payment_qry = $this->db->query("SELECT * FROM request_payment WHERE vendor_id = '" . $id . "' ORDER BY id DESC LIMIT 1");
    $last_request_payment_row = $last_request_payment_qry->row();
    $vendor_amount = ($last_request_payment_qry->num_rows() > 0) ? ($last_request_payment_row->vendor_amount-$last_request_payment_row->request_amount) : $vendorAmount;

        $data = array(
            'transaction_id' => '',
            'sender_name' => '',
            'receiver_name' => '',
            'mode_payment' => '',
            'vendor_id' => '',
            'reference_id' => '',
            'admin_description' => 'get back amount',
            'image' => '',
            'status' => 0,
            'created_at' => time(),
            'updated_at' => time(),
            'payment_status'=>'get_back'
        );
    
        // Insert or update request_payment table
        $this->db->where('reference_id',$order_id);
        $this->db->where('vendor_id',$vendor_id);
        $insert_query= $this->db->update('request_payment', $data);

        $array = array('vendor_id' => $vendor_id, 'total_payment' => $vendorAmount,'requested_amount'=>'');
        $where = array('vendor_id' => $vendor_id);
        $this->db->update("vendor_payements", $array, $where);

        $order_arr=array(
            'admin_payment_date'=>''
        );
        $this->db->where('id',$order_id);
        $this->db->update('orders',$order_arr);

        if($insert_query){
            redirect('admin/admin_payouts');
            die();
        }else{
            redirect('admin/admin_payouts');
            die();
        }

    }
   
}
