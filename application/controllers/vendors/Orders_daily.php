<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_daily extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out');
            redirect('vendors/login');
        }
        $this->load->model('web_model');
        $this->load->model('vendor_model');
        $this->load->library('pagination');
        $this->data['vendor_id'] = $this->session->userdata('vendors')['vendor_id'];
        
    }

    function index() {

        $data['page_name'] = 'orders_daily';
        $data['shop_id'] = $_SESSION['vendors']['vendor_id'];

        $type = $this->input->get('type');
        $status = $this->input->get('status');
        $keyword = $this->input->get_post('keyword');
        $from_date = $this->input->get_post('from_date');
        $to_date = $this->input->get_post('to_date');
        $this->data['filter_keyword'] = $keyword;
        $this->data['filter_from_dt'] = $from_date;
        $this->data['filter_to_dt'] = $to_date;
        $start = ($this->input->get_post('per_page')) ? $this->input->get_post('per_page') : 0;
        if ($start == "") {
            $this->data['i'] = 1;
        } else {
            $this->data['i'] = $start + 1;
        }
        if ($type == "today_orders") {
            $data['count_data'] = sizeof($this->vendor_model->get_today_orders1($data['shop_id']));
            $config['base_url'] = base_url() . 'vendors/orders_daily';
            $config['total_rows'] = $data['count_data'];
            $config['per_page'] = 100;
            $config['page_query_string'] = true;
            $config['num_links'] = 5;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['reuse_query_string'] = true;
            $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
            $config['prev_tag_open'] = '<li class="button grey">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
            $config['next_tag_open'] = '<li class="button grey">';
            $config['next_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['page_start'] = $start - $config['per_page'] + 11;
            $this->db->limit($config['per_page'], $start);
            $this->db->order_by('id', 'desc');

            $all_orders = $this->vendor_model->get_today_orders1($data['shop_id']);

        } else {
            if (!empty($status)) {
                $this->db->where('order_status', $status);
            }
            if ($keyword != "") {
                $this->db->where('session_id', $keyword);
            }
            if ($from_date != "") {
                $this->db->where('order_date >=', $from_date);
            }
            if ($to_date != "") {
                $this->db->where('order_date <=', $to_date);
            }
            $current_date=date('Y-m-d');
            $all_order = $this->common_model->get_data_with_condition(['vendor_id' => $data['shop_id'],'payment_status' => 1,'order_date'=> $current_date] , 'orders');
            $data['count_data'] = sizeof($all_order);
              // print_r($this->db->last_query());die;     
            $config['base_url'] = base_url() . 'vendors/orders_daily';
            $config['total_rows'] = $data['count_data'];
            $config['per_page'] = 10;
            $config['page_query_string'] = true;
            $config['num_links'] = 5;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['reuse_query_string'] = true;
            $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
            $config['prev_tag_open'] = '<li class="button grey">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
            $config['next_tag_open'] = '<li class="button grey">';
            $config['next_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['page_start'] = $start - $config['per_page'] + 11;
            $this->db->limit($config['per_page'], $start);
            $this->db->order_by('id', 'desc');
            if (!empty($status)) {
                $this->db->where('order_status', $status);
            }
            if ($keyword != "") {
                $this->db->where('session_id', $keyword);
            }
            if ($from_date != "") {
                $this->db->where('order_date >=', $from_date);
            }
            if ($to_date != "") {
                $this->db->where('order_date <=', $to_date);
            }
            $all_orders = $this->common_model->get_data_with_condition(['vendor_id' => $data['shop_id'],'payment_status' => 1,'order_date'=>$current_date], 'orders');
            // print_r($this->db->last_query());die;
        }
        // echo "<pre>";
     

        // $orders=[];
   
        // foreach($all_order as $order){
  
  
        // if($order->waybill_generated!='' && $order->order_status == 4 ){
        // $orders[]=$order;
    
        // }
   
        // }
        $this->Tracking($all_orders);

       
        
   
        $this->data['orders'] = $all_orders;

        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/orders_daily', $this->data);
        $this->load->view('vendors/includes/footer');
    }


    function Tracking($allorders){
        foreach($allorders as $order){
            if($order->waybill_generated != '' && $order->order_status == 4){
                // Track order status
                $apiUrl = TRACKING_URL; 
                $api_key = TEST_KEY;
                
                $data = array('waybill' => $order->waybill_generated);
    
                $ch = curl_init($apiUrl . '?' . http_build_query($data));
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization: Token ' . $api_key
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    
                $response = curl_exec($ch);
    
                if (curl_errno($ch)) {
                    return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
                }
    
                curl_close($ch);
                $decoded_response = json_decode($response, true);
    
                if ($decoded_response === null) {
                    return json_encode(['status' => 'error', 'error' => 'Invalid JSON response']);
                }
    
                $trackdata = $decoded_response['ShipmentData'][0];
                $status_data = $trackdata['Shipment'];
                $status = $status_data['Status']['Status'];
                $statusType = $status_data['Status']['StatusType'];
    
                if($status == 'Delivered' && $statusType == 'DL'){
                    
                    // Update order status in the database
                    $orderstatus = array('order_status' => 5);
                    $this->db->where('id', $order->id);
                    $update = $this->db->update('orders', $orderstatus);
                    if ($update) {
                        $order_details = $this->web_model->orderDetails($order->id);
                        //sms send to customer
            
                        $phone = $order_details['ordersdetails']['mobile'];
                        $otp_message = "Dear " . str_replace(' ', '', $order_details['ordersdetails']['customer_name']) . ", Your order from Absolutemens.com your order has been successfully delivered . We look forward to serving you again Team Absolutemens.com";
                        $template_id = '1407167151718602797';
                        $this->web_model->send_message($otp_message, $phone, $template_id);
            
                        //notification to admin
                        $msg = "Order Delivered";
                        $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
                        $this->db->insert("admin_notifications", $array);
            
                        $coupon_disount = $order_details['ordersdetails']['coupon_disount'];
                        $subject = 'Order Delivered ('.$order_details['ordersdetails']['session_id'].')';
                        $title = 'Order Delivered';
                        $message = "Dear Customer, Your order with Order id ".$order_details['ordersdetails']['session_id']." has been successfully delivered, hope we have served you well. <br>We are looking forward to serving you again. <br>Thank you, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";
                        $footer = $this->data['order_delivered_invoice']->footer;
            
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
                        <h1>[ ' . $title . ' ]</h1>
                        <div id="company" class="clearfix">
                            <div>' . $order_details['ordersdetails']['customer_name'] . '</div>
                            <div><a href="mailto:' . $order_details['ordersdetails']['email'] . '">' . $order_details['ordersdetails']['email'] . '</a></div>
                            <div>' . $order_details['ordersdetails']['mobile'] . '</div>
                            <div>' . $order_details['ordersdetails']['useraddress'] . '</div>
                        </div>
                        <div id="project">
                            <div><span>Order ID</span> #' . $order_details['ordersdetails']['session_id'] . '</div>
                            <div><span>Placed On</span> ' . $order_details['ordersdetails']['created_date'] . '</div>
                            <div><span>Payment Status</span> ' . $order_details['ordersdetails']['payment_status'] . '</div>
                            <div><span>Payment Method</span> ' . $order_details['ordersdetails']['payment_type'] . '</div>
                            <div><span>Order status</span> ' . $order_details['ordersdetails']['order_status'] . '</div>
                        </div>
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
                                </tr>
                            </thead>
                            <tbody>';
            
                        $count = 1;
                        foreach ($order_details['ordersdetails']['cartdetails'] as $item) {
            
                            $message .= '<tr>
                                        <td class="service">' . $count . '</td>
                                        <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                                        <td class="desc">
                                            ' . $item['productname'] . '<br>[';
                                foreach ($item['attributes'] as $attr) {
                                    $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . '<br>';
                                }
                                $message .= ']</td>
                                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                                        <td class="desc">' . $item['quantity'] . '</td>
                                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>
            
                                    </tr>';
                        }
                        $message .= '<tr>
                                    <td colspan="5">Subtotal</td>
                                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['sub_total'] . '</td>
                                </tr>';
                        if (!empty($coupon_disount)) {
                            $message .= '<tr>
                                    <td colspan="5">Coupon Discount</td>
                                    <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                                </tr>';
                        }
            
                        if (!empty($order_details['ordersdetails']['deliveryboy_commission'])) {
                            $message .= '<tr>
                                    <td colspan="5">Delivery Charge</td>
                                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['deliveryboy_commission'] . '</td>
                                </tr>';
                        }
            
                        if (!empty($order_details['ordersdetails']['gst'])) {
                            $message .= '<tr>
                                    <td colspan="5">GST</td>
                                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['gst'] . '</td>
                                </tr>';
                        }
            
                        if ($order_details['ordersdetails']['gst'] == "") {
                            $gst = 0;
                        } else {
                            $gst = $order_details['ordersdetails']['gst'];
                        }
            
                        $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
                        $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
                        $final_total = $sub_coupon + $order_boy;
            
                        $message .= '<tr>
                                    <td colspan="5" class="grand total">GRAND TOTAL</td>
                                    <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $final_total . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </main>
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
                    } else {
                        return json_encode(['error' => 'Failed to update order status']);
                    }
                } 
            }
        }
    // print_r($decoded_response);
    // exit;
        // After processing all orders, redirect
        // redirect('vendors/orders_daily');
    }
    




    function orderDetails($oid) {


        $this->data['page_name'] = 'orders';
        $qry = $this->db->query("select * from orders where id='" . $oid . "'");
        $order = $qry->row();
        // print_r($order);die;
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

        $this->data['orders'] = $order;

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/order_details', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function delivery($session_id) {
        $data['order_id'] = $session_id;
        $del = $this->db->query("select id,name from deliveryboy");
        $data['deliverypersons'] = $del->result();
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/deliverypage', $data);
        $this->load->view('vendors/includes/footer');
    }

    function assignDeliveryBoy() {
        $ar = array('delivery_boy' => $this->input->get_post('db_id'), 'order_status' => '3');
        $wr = array('id' => $this->input->get_post('order_id'));
        $upd = $this->db->update("orders", $ar, $wr);
        if ($upd) {
            $ad_ar = array('status' => 1);
            $ad_wr = array('order_id' => $this->input->get_post('order_id'));
            $this->db->update("admin_notifications", $ad_ar, $ad_wr);

            $data['page_name'] = 'orders_daily';
            $shop_id = $_SESSION['vendors']['vendor_id'];
            $qry = $this->db->query("select * from orders where vendor_id='" . $shop_id . "' order by id desc");
            $data['orders'] = $qry->result();

            $this->load->view('vendors/includes/header', $data);
            $this->load->view('vendors/orders_daily', $this->data);
            $this->load->view('vendors/includes/footer');
        }
        redirect('vendors/orders_daily');
    }

    function onesignalnotification($user_id, $message, $title) {
        $qr = $this->db->query("select * from users where id='" . $user_id . "'");
        $res = $qr->row();
        if ($res->token != '') {

            $user_id = $res->token;

            $fields = array(
                'app_id' => 'e072cc7b-595d-4c4c-a451-b07832b073f9',
                'include_player_ids' => [$user_id],
                'contents' => array("en" => $message),
                'headings' => array("en" => $title),
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

    function send_message($message = "", $mobile_number, $template_id) {


        $message = urlencode($message);

        $URL = "http://login.smsmoon.com/API/sms.php"; // connecting url 

        $post_fields = ['username' => 'absolutemens', 'password' => 'vizag@123', 'from' => 'absolutemens', 'to' => $mobile_number, 'msg' => $message, 'type' => 1, 'dnd_check' => 0, 'template_id' => $template_id];

        //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        return true;
    }

    function changeStatus() {
        $shop_id = $_SESSION['vendors']['vendor_id'];
        if ($this->input->post('value')) {
            $order_id = $this->input->post('order_id');

            $value = $this->input->post('value');
            if ($value == 2) {
                $ar = array('order_status' => $this->input->post('value'), 'accept_status' => 1);
            } else {
                $ar = array('order_status' => $this->input->post('value'));
            }


            $wr = array('id' => $order_id);
            $upd = $this->db->update("orders", $ar, $wr);
            if ($upd) {
                $qry = $this->db->query("select * from orders where id='" . $order_id . "'");
                $row = $qry->row();
                $usr_qry = $this->db->query("select * from users where id='" . $row->user_id . "'");
                $usr_row = $usr_qry->row();

                $phone = $usr_row->phone;
                $name = $usr_row->first_name;
                if ($this->input->post('value') == 2) {
                    $msg = "Order Accepted by ";
                    $title = "Order Accepted";
                    $message = "Your Order : " . $row->id . " Accepted by Admin";
                    $this->onesignalnotification($row->user_id, $message, $title);

                    $msg = "Dear " . $name . " your order is " . $order_id . " is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.";

                    $template_id = "1407161683232344120";
                    $this->send_message($msg, $phone, $template_id);
                } else if ($this->input->post('value') == 3) {
                    $msg = "Order Accepted by ";
                    $title = "Order Accepted";
                    $message = "Your Order : " . $row->id . " Accepted by Admin";
                    $this->onesignalnotification($row->user_id, $message, $title);

                    $msg = "Dear " . $name . " your order is " . $order_id . " is accepted by the vendor and it will be delivered with in 2-24hrs of time. Thank u for shopping with Sector6.";

                    $template_id = "1407161683232344120";
                    $this->send_message($msg, $phone, $template_id);
                } else if ($this->input->post('value') == 6) {
                    $msg = "Order Cancelled by";
                    $title = "Order Cancelled";
                    $message = "Your Order : " . $row->id . " Cancelled by Admin";
                    $this->onesignalnotification($row->user_id, $message, $title);
                }

                $aar = array('vendor_id' => $shop_id, 'order_id' => $order_id, 'message' => $msg);
                $this->db->insert("admin_notifications", $aar);

                echo "success";
                exit;
            }
        }
    }

    function view_aceept_status($id) {
        $status = $this->vendor_model->get_accept_status($id);
        //print_r($id);die;
        if ($status) {
            $this->session->set_tempdata('status_changed', 'Status Changed .',3);
            redirect('vendors/orders_daily');
        } else {
            $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            redirect('vendors/orders_daily');
        }
    }

    function cancel_status($id) {
        $status = $this->vendor_model->get_cencel_status($id);
        //print_r($id);die;
        if ($status) {
            $this->session->set_tempdata('status_changed', 'Status Changed .',3);
            redirect('vendors/orders_daily');
        } else {
            $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            redirect('vendors/orders_daily');
        }
    }


    function ordercreate($order_id){
        $length=floatval($this->input->post('shipment_length'));
        $width=floatval($this->input->post('shipment_width'));
        $height=floatval($this->input->post('shipment_height'));
        $weight=floatval($this->input->post('weight'));
        $mode=$this->input->post('mode');
        $warehouse=$this->input->post('delivery_id');
       
        if ($length!='' && $width!='' && $height!='' && $weight!='' && $warehouse!='') {
           
        $order_details = $this->web_model->orderDetails($order_id);
        // echo "<pre>";
        // print_r($order_details['ordersdetails']['user_address']);
        // exit;
        $address=$order_details['ordersdetails']['user_address'];
        $pattern = '/\b\d{6}\b/';

        // Perform the regular expression match
        preg_match_all($pattern, $address, $matches);
        
        // Get the last pincode from the matches
        
            $add = $this->db->query("select * from user_address where id='" . $order_details['ordersdetails']['address_id'] . "'");
            // echo "<pre>";
            $customerdetails = $add->row();
            
           

            $state_qry = $this->db->query("select * from states where id='" .$customerdetails->state . "'");

            $state_row = $state_qry->row();
            
            

            // $area_qry = $this->db->query("select * from areas where id='" . $customerdetails->area . "'");

            // $area_row = $area_qry->row();
           
            $query = $this->db->select('*')
                  ->from('warehouses')
                  ->where('warehouse_name', $warehouse)
                  ->where('vendor_id', $order_details['ordersdetails']['vendor_id'])
                  ->get();

$result = $query->row();
// $product_names=[];
            // echo "<pre>";
            $product_names = array(); // Initialize the array

            foreach ($order_details['ordersdetails']['cartdetails'] as $index => $cart) {
                // Assuming $index starts from 0
                $product_names[] = ($index + 1) . ". " . $cart['productname'];
            }
            
            $product_names_string = implode(', ', $product_names); // Convert array to comma-separated string
            
            // echo $product_names_string;
            
            // exit;
            // $product_description=$order_details['ordersdetails']['cartdetails'][0]['productname'];
            $product_description=$product_names_string;

            $pickupaddress=$result->address;
            $pickup_city=$result->city;
            $pickup_state=$result->state;//it is two letter word
            $pickup_country=$result->country;
            $pickup_pin=$result->pincode;
            $pickup_contact=$result->warehouse_name;
            $pickup_phone=$result->mobile_number;
            $return_pin=$result->return_pincode;
            $return_city=$result->return_city;
            $return_state=$result->return_state;
            $return_add=$result->return_address;
            $return_country=$result->return_country;
            $delivery_name=$order_details['ordersdetails']['customer_name'];//delivery_name is there need to check this
            $delievery_address=$order_details['ordersdetails']['user_address'];
            $deliver_city=$customerdetails->city;
            $deliver_country='IN';
             $deliver_state=$state_row->state_name;
             $deliver_pin=$customerdetails->pincode;
            // echo "<pre>";
            // print_r($deliver_pin);
            // exit;
            //  $deliver_pin= end($matches[0]);
        
            $deliver_contact=$order_details['ordersdetails']['customer_name'];
            $delivery_phone=$order_details['ordersdetails']['mobile'];
            $cartdetails=$order_details['ordersdetails']['cartdetails'];
            // echo "<pre>";
            $count=0;
            foreach($cartdetails as $details){
                // print_r($details['quantity']);
                $count+=$details['quantity'];
            }
            // print_r($count);
            $pieces=$count;
            if($order_details['ordersdetails']['payment_status']=='Paid'){
                $package_type_key='Prepaid';
            }
            else if($order_details['ordersdetails']['payment_status']=='COD'){
                $package_type_key='COD';
            }
            else{
                $package_type_key='pickup';
            }
            
            $order_id=$order_details['ordersdetails']['id'];
            $fragile_shipment='false';
            $country='IN';
            $seller_gst_in='';// GST TIN number of the seller--Mandatory in the API
            $hsn_code='';
            $gst=0;
            if($order_details['ordersdetails']['payment_status']=='COD'){
            $cod_amount=$order_details['ordersdetails']['amount'];
            }
            else{
                $cod_amount=0;
            }
            $package_count=$pieces;
            $total_amount=$order_details['ordersdetails']['amount'];
            // echo "<pre>";
            
            // $client_name=USER_NAME;//warehouse location
            // $product_details=json_encode($order_details['cartdetails']);

            $details=$this->order_creation_api($delivery_name,$delievery_address,
            $deliver_pin, $deliver_city,$deliver_state,$deliver_country,$delivery_phone,$order_id,
            $package_type_key,$return_pin,$return_city,$return_add, $return_state,
           $return_country,
            $product_description,$hsn_code,$cod_amount, $total_amount,
            $pickupaddress,$pickup_city,$pickup_state,$pickup_pin,$pickup_contact, 
            $pickup_phone,$pickup_country,$package_count,$length,
            $width,$height,$weight,$mode, $fragile_shipment,$seller_gst_in,$gst);
            
            // print_r($waybill);
            $details_msg=json_decode($details,true);
            // var_dump($details);
            // exit;
            $ordercreation_msg=$details_msg['packages'][0]['status'];
            $waybill_generated=$details_msg['packages'][0]['waybill'];

            $apiUrl=SHIPPING_COST_URL;
            $api_key=TEST_KEY;
            $md=$mode;
            $cgm=$weight;
            $o_pin=$pickup_pin;
            $d_pin=$deliver_pin;
            $ss='Delivered';
            
              // Data to be sent in the request
              $data = ['md' => $md,'cgm'=>$cgm,'o_pin'=>$o_pin,'d_pin'=>$d_pin,'ss'=>$ss];
            
              // cURL setup
              $ch = curl_init($apiUrl . '?' . http_build_query($data));
              curl_setopt($ch, CURLOPT_HTTPGET, true);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                  'Content-Type: application/json',
                  'Authorization: Token ' .$api_key
              ));
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
              // Execute cURL request
              $response1 = curl_exec($ch);
            
              // Check for cURL errors
              if (curl_errno($ch)) {
                  return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
              }
            
              // Close cURL session
              curl_close($ch);
              $res1=json_decode($response1,true);
            //   if($res['error']){
            //       echo '@error';
            //       // $this->session->set_tempdata('error_message', 'please provide correct values',3);
              
                  
            //   }
            //   else{
                //   print($res1[0]['total_amount']);
                  // $this->session->set_tempdata('success_message', 'shipping cost calculated',3);
                  
            //   }
            // echo "<pre>";
            // print_r($details_msg);//6055910003544
            // exit;
            // $update_status = $this->common_model->update_record(['id' => $order_id], 'orders', ['order_status' => 3]);
            // echo "<pre>";
            // print_r($update_status);
            // print_r($details_msg);
            // exit;
            // $ar = array('order_status' => '3');
            // $wr = array('id' => $order_id);
            // $upd = $this->db->update("orders", $ar, $wr);
           
            if($ordercreation_msg=='Success'&& $res1[0]['total_amount']!=''){
               
                $phone = $order_details['ordersdetails']['mobile'];
                $otp_message = "Dear " . str_replace(' ', '', $order_details['ordersdetails']['customer_name']) . ", Your order no " . $order_details['ordersdetails']['session_id'] . " from Absolutemens.com will be delivered to you soon by our delivery partner. Thank you for shopping with us Team Absolutemens.com";
                $template_id = '1407167151735133556';
                $this->web_model->send_message($otp_message, $phone, $template_id);
                $id=$order_details['ordersdetails']['id'];
                $amount=$res1[0]['total_amount'];
                $data=array(
                    'order_id'=>$id,
                    'waybill'=>$waybill_generated,
                    'shipment_length'=>$length,
                    'shipment_width'=>$width,
                    'shipment_height'=>$height,
                    'weight'=>$weight,
                    'phone'=>$pickup_phone,
                    'payment_mode'=>$package_type_key,
                    'consignee_name'=>$delivery_name,
                    'address'=>$delievery_address, //consignee address(destination)
                    'product_details'=>$product_description,
                    'warehouse_name'=>$warehouse,
                    'ship_cost'=>$amount
    
                        );
                        $this->db->insert("order_details",$data);
    
                
                
               
                
                $array2 = array(
                 
              
                    'waybill_generated' => $waybill_generated,
                    'order_status' => 3
                );
                
               
                $this->db->where('id', $order_details['ordersdetails']['id']);
                
               
                $this->db->update("orders", $array2);

               
               
    
                // $this->db->where('order_array',$order_details['ordersdetails']['id']);
                // $this->db->update("pickup_table",$array2);
                $msg = "Order Assigned To Courier";
                $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
                $this->db->insert("admin_notifications", $array);
    
                $this->session->set_tempdata('success_message', 'Status changed successfully.',3);
                // redirect('vendors/orders_daily');
                $this->index();
            }
           
            else {
                    $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
                    // redirect('vendors/orders_daily');
                    $this->index();
            }

           
        } else {
            $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            // redirect('vendors/orders_daily');
            $this->index();
        }
        // redirect('vendors/orders_daily');
            
    }
    function assigned_deliveryBoy($order_id) {
        $update_status = $this->common_model->update_record(['id' => $order_id], 'orders', ['order_status' => 3]);
        if ($update_status) {
            //sms send to customer
            $order_details = $this->web_model->orderDetails($order_id);
            $phone = $order_details['ordersdetails']['mobile'];
            $otp_message = "Dear " . str_replace(' ', '', $order_details['ordersdetails']['customer_name']) . ", Your order no " . $order_details['ordersdetails']['session_id'] . " from Absolutemens.com will be delivered to you soon by our delivery partner. Thank you for shopping with us Team Absolutemens.com";
            $template_id = '1407167151735133556';
            $this->web_model->send_message($otp_message, $phone, $template_id);

            //notification to admin
            $msg = "Order Assigned To Courier";
            $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);

            $this->session->set_tempdata('success_message', 'Status changed successfully.',3);
            // $this->load->view('vendors/orders_daily',$this->data);
            // $this->index();
            redirect('vendors/orders_daily');
        } else {
            $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            // $this->load->view('vendors/orders_daily',$this->data);
            // $this->index();
            redirect('vendors/orders_daily');
        }
    }

  
    public function setLocation($vendor_id) {
        $pickupdate = $this->input->post('selected_date');
        // print_r("HI");
        // print_r($pickupdate);
        $pickup_time = $this->input->post('selected_time');
        $warehouse = $this->input->post('delivery_id');
        $count = $this->input->post('count');
        $url = PICKUP_URL; 
        $testKey = TEST_KEY;
    
        $pickuptime = strtotime($pickup_time); 
        // Data to be sent in the request
        $requestData = array(
            
            'pickup_time' => date("H:i:s", $pickuptime),
            'pickup_date' => date("Y-m-d",strtotime($pickupdate)),
            'pickup_location' => $warehouse,
            'expected_package_count' => intVal($count),
        );
    // $time="18:51:00";
    // $date="2024-02-12";
    // print_r(gettype($pickupdate));
    // print_r(gettype($warehouse));
    // print_r(gettype($count));
    // print_r(gettype($pickuptime));
    // exit;

    
        // $requestData = array(   
        //     "pickup_location"=> "Eswari_store",
        //     "expected_package_count"=>2,
        //     "pickup_date"=>date("Y-m-d", strtotime($date)),
        //     "pickup_time"=> date("H:i:s", $time)
        // );

        // print_r(gettype(date("Y-m-d", strtotime($date))));
    // print_r(gettype(date("H:i:s", $time)));
    // print_r(gettype($count));
    // print_r(gettype($pickuptime));
    // exit;
        // Convert the array to JSON
        $postData = json_encode($requestData);
    
        // Initialize cURL session
        $ch = curl_init($url);
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-type: application/json",
            "Authorization: Token " . $testKey,
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Execute cURL request
        $response = curl_exec($ch);
    
        // Check for cURL errors
        if (curl_errno($ch)) {
            return json_encode(['status' => 'error', 'error' => 'Curl error: ' . curl_error($ch)]);
        }
        // if($response === false) {
        //     // If curl_exec() returns false, an error occurred
        //     echo "cURL Error: " . curl_error($ch);
        // } else {
        //     // Otherwise, the request was successful, and $response contains the response data
        //     echo "Response: " . $response;
        // }
    
        // Close cURL session
       
        curl_close($ch);
        // var_dump($response); // Print the entire response for debugging
        // exit;
        // exit;
    
        // Set Content-Type header for JSON
        header('Content-Type: application/json; charset=utf-8');
        $res = json_decode($response, true);
    
        if (array_key_exists('pickup_id', $res)) {
            $data1 = array(
                'pickup_id' => $res['pickup_id'],
                'vendor_id' => $vendor_id,
                'warehouse_name' => $warehouse,
                'created_at' => date('Y-m-d H:i:s'),
                'pickup_date' => $pickupdate,
                'pickup_time' => $pickuptime,
                'packages_count' => $count,
                'status' => 'active'
            );
        } 
        // print_r($requestData);
  
    if($res['pr_exist']=='1'){
        $this->session->set_tempdata('error_message', "Already pickup request exists for the '".$res['pickup_id']."'",3);
        redirect('vendors/pickuprequests');
    }
    else if($res['pickup_location_name']!=''){
        $this->session->set_tempdata('success_message', 'pick up request created successfully',3);
        $this->db->insert('pickup_table', $data1);
        $msg = "pickup request sent";
       
        
        //sms to customer
        $vendor_qry=$this->db->query("select * from vendor_shop where id='".$vendor_id."'");
        $vendor_qry_res=$vendor_qry->row();
        $phone = $vendor_qry_res->mobile;
        $otp_message = "Dear '".$vendor_qry_res->owner_name."', Your pickup request sent has been confirmed from absolutemens.com. The delivery boy will come to soon.Here are the details. Warehouse name:'".$warehouse."',pick up date:'".$pickupdate."',pickup time:'".$pickuptime."'";
        $template_id = '1407167151675544556';
        $this->web_model->send_message($otp_message, $phone, $template_id);
        // $formattedDate = date("Y-m-d H:i:s");

        $data = array(
            'vendor_id'=>$vendor_id,
            'message' => $otp_message,
            'vendor_read_status' => 0,
            'created_date' => time() 
        );
        
        $this->db->insert('admin_notifications', $data);
        redirect('vendors/pickuprequests');
        
    }
        // Pass data to the view
        // $this->session->set_flashdata('data', $data1);
        redirect('vendors/pickuprequests'); // Redirect to the desired controller/method

    }
    
function shippingLabelGeneration($waybill,$order_id){
  
$apiUrl=SHIPPING_LABEL_URL;
  
$api_key=TEST_KEY;

$pdf="true";
$data=['wbns'=>$waybill,'pdf'=>$pdf];
  
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
  $res=json_decode($response,true);

  curl_close($ch);

//   return $res;

// Check if packages array exists and is not empty
if (isset($res['packages']) && is_array($res['packages']) && !empty($res['packages'])) {
    // Loop through each package in the array
    foreach ($res['packages'] as $package) {
        // Check if 'pdf_download_link' exists for the current package
        if (isset($package['pdf_download_link'])) {
            // $this->load->view('vendors/orders_daily');
            echo '<div>';
            echo '<button class="btn btn btn-success"><a href="' . base_url() . 'vendors/orders_daily/">Back button</a></button>';
            echo '<h4 style="color:#2556B9;background-color:white;width:100%;height:100%;margin:0 auto;align-items:center;text-align:center;">Pdf downloaded successfully</h4>';
           echo '</div>';
            // Create a hidden link with the download attribute and trigger a click
            echo '<a href="' . $package['pdf_download_link'] . '" download style="display: none;" id="pdfDownloadLink"></a>';
            echo '<script>';
            echo 'var pdfDownloadLink = document.getElementById("pdfDownloadLink");';
            echo 'pdfDownloadLink.click();';
           
          
            echo '</script>';
            // $this->index();
            // redirect('vendors/orders_daily');
        } else {
            // Handle the case where 'pdf_download_link' is not present
            echo 'Error: PDF download link not found for a package.';
            // $this->index();
        }
    }
} else {
    // Handle the case where 'packages' array is not present or empty
    echo 'Error: No packages found.';
}
// $this->index();
// $this->load->view('vendors/includes/header');
// $this->load->view('vendors/orders_daily');
// $this->load->view('vendors/includes/footer');

// redirect('vendors/orders_daily');


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
   print_r($response);
     return $response;
   
   }

   function addOrderDetails($order_id, $pickup_id, $session_id,$warehouse_name) {
    $qry = $this->db->query("SELECT * FROM pickup_table WHERE pickup_id = ?", array($pickup_id));
    $qry_res = $qry->row();
    $waybill_qry = $this->db->query("SELECT waybill_generated FROM orders WHERE id = ?", array($order_id));
    $waybill_res = $waybill_qry->row();

    if ($waybill_res->waybill_generated != '') {
        // Decode the existing order_ids array from the 'pickup_table'
        $order_ids = json_decode($qry_res->order_id, true);

        // Update the 'orders' table with the new status
        $ar = array('delivery_boy' => $this->input->get_post('db_id'), 'order_status' => '8');
        $wr = array('id' => $order_id);
        $upd = $this->db->update("orders", $ar, $wr);

        // Add the new order_id to the array
        $order_ids[] = $order_id;

        // Update the 'pickup_table' with the new order_ids array
        $data1 = array(
            'order_id' => json_encode($order_ids)
        );
       
   

        $this->db->where('pickup_id', $pickup_id);
        $ins1 = $this->db->update("pickup_table", $data1);
        $session_ids = json_decode($qry_res->order_array, true);
        // Add new entry with key-value pair
        $session_ids[$session_id] = $waybill_res->waybill_generated;
    
        $data = array(
            'order_array' => json_encode($session_ids),
        );
    

        $this->db->where('pickup_id', $pickup_id);
        $ins = $this->db->update("pickup_table", $data);

        if ($ins && $ins1) {
            $this->session->set_tempdata('success_message', 'Packages count increased.', 3);
        } else {
            $this->session->set_tempdata('error_message', 'Unable to increase count.', 3);
        }
    } else {
        $this->session->set_tempdata('error_message', 'Invalid pickup_id.', 3);
    }

    // Redirect to the appropriate page
    redirect('vendors/pickuprequests');
}


function update_order($order_id,$waybill_generated){

$updated_qry=$this->db->query("select * from order_details where order_id='".$order_id."' and waybill='".$waybill_generated."'");
$updated_qry_res=$updated_qry->row();
// echo "<pre>";
// print_r($order_id);
$data['update_order']=$updated_qry_res;
// exit;

    $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/update_order', $data);

        $this->load->view('vendors/includes/footer');
}

function updateOrderCreation(){
    $waybill=$this->input->post('waybill');
    $shipment_length = floatval($this->input->post('shipment_length'));
    $shipment_width = floatval($this->input->post('shipment_width'));
    $shipment_height = floatval($this->input->post('shipment_height'));
    $weight = floatval($this->input->post('weight'));    
    $mobile_number=$this->input->post('mobile_number');
    $payment_mode=$this->input->post('payment_mode');
    $consignee_name=$this->input->post('consignee_name');
    $address=$this->input->post('address');
    $order_id=$this->input->post('order_id');
    $productdetails=$this->input->post('productdetails');

    $api_key = TEST_KEY; // test key
    $url = SHIPMENT_UPDATE_URL; // test url

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Token ' . $api_key,
        'Accept:application/json'
    );

    $params = array(
        'waybill' => $waybill,
        'shipment_length' => floatval($shipment_length),
        'shipment_width' =>floatval($shipment_width),
        'shipment_height' => floatval($shipment_height),
        'phone' => $mobile_number,
        'weight' => floatval($weight),
        'payment_mode' => $payment_mode,
        'consignee_name' => $consignee_name,
        'address' => $address,
        'product_details' => $productdetails
    );
    $this->db->where('order_id', $order_id);
    $this->db->update('order_details', $params);
   
   
    $json_params = json_encode($params);
   

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }

    curl_close($ch);
    echo $response;
    // var_dump($response);
    // exit;
    // die;

    // Handle $response as needed
    $result = json_decode($response, true);
    
   
    // return $response;
   
     if (isset($result['status']) && $result['status'] === true) {
        // Update order_details table with the data received from the API response
    
        // return json_encode($result);
        echo '@success';
       
    } else {
        // Handle API failure, if needed
        // $result['error'] contains the error message
        // You may want to log or display the error to the user
        echo '@fail';
        // return false;
    }
    
    
    // Check if the API call was successful before updating the database
    // if (isset($result['success']) && $result['success']) {
        // Update order_details table with the data received from the API response
    // Assuming the relevant data is in $result['data']
    // } else {
        // Handle API failure, if needed
        // $result['error'] contains the error message
        // You may want to log or display the error to the user
    // }
}

function order_creation_api(
    $delivery_name,$delievery_address,
    $deliver_pin, $deliver_city,$deliver_state,$deliver_country,$delivery_phone,$order_id,
    $package_type_key,$return_pin,$return_city,$return_add, $return_state,
   $return_country,
    $product_description,$hsn_code,$cod_amount, $total_amount,
    $pickupaddress,$pickup_city,$pickup_state,$pickup_pin,$pickup_contact, 
    $pickup_phone,$pickup_country,$package_count,$length,
    $width,$height,$weight,$mode,$fragile_shipment,$seller_gst_in,$gst
) {
    $headers = array(
        "Content-Type: application/json", 
        "Authorization: Token ".TEST_KEY
    );

   
    $url = SHIPMENT_CREATE_URL;

    $data = array(
        'format' => 'json',
        'data' => json_encode(array(
            'pickup_location' => array(
                'name' => $pickup_contact,
                'add'=> $pickupaddress,
                'city'=> $pickup_city,
                'pin_code'=>$pickup_pin,
                'country'=> $pickup_country,
                'phone'=>$pickup_phone
            ),
            'shipments' => array(
                array(
                    'name'=> $delivery_name,
                    'add'=>  $delievery_address,
                    'pin'=> $deliver_pin,
                    'city'=> $deliver_city,
                    'state'=> $deliver_state,
                    'country'=> $deliver_country,
                    'phone'=> $delivery_phone,
                    'order'=> $order_id,
                    'payment_mode'=> $package_type_key,
                    'return_pin'=>$return_pin,
                    'return_city'=> $return_city,
                    'return_phone'=>'',
                    'return_add'=>$return_add,
                    'return_state'=>$return_state,
                    'return_country'=> $return_country,
                    'products_desc'=> $product_description,
                    'hsn_code'=> $hsn_code,
                    'cod_amount'=> $cod_amount,
                    'order_date'=>null,
                    'total_amount'=> $total_amount,
                    'seller_add'=> '',
                    'seller_name'=> USER_NAME,
                    'seller_inv'=> '',
                    'quantity'=>$package_count,
                    'waybill'=> "",
                    'shipment_length'=>$length,
                    'shipment_width'=>$width,
                    'shipment_height'=>$height,
                    'weight'=>$weight,
                    'seller_gst_tin'=> $seller_gst_in,
                    'shipping_mode'=>$mode,
                    'fragile_shipment'=>$fragile_shipment,
                    'gst'=>$gst


                )
            )
        ))
    );

    $postData = http_build_query($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);

//    $res=json_decode($response,true);

    curl_close($ch);
    return $response;
}


    function shipment_delhivery($ids) {
       
        foreach($ids as $id){
        $tracking_name = 'delhivery';
        $tracking_id_qry=$this->db->query("select waybill_generated from orders where id='".$id."'");
        $tracking_id_qry_res=$tracking_id_qry->row();
        $tracking_id=$tracking_id_qry_res->waybill_generated;
       
        $shipment_status = $this->vendor_model->update_shipment_status($tracking_name, $tracking_id, $id);
        if ($shipment_status) {
            
            $order_details = $this->web_model->orderDetails($id);
//             //notification to admin
            $msg = "Order Shipped";
            $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);
            
//             //sms to customer
            $phone = $order_details['ordersdetails']['mobile'];
            $otp_message ="Dear Customer, Your order from Absolutemens.com has been picked up by our delivery partner. Track the order here: https://delhivery.com/track/package/" . $tracking_id . ". Thank you for shopping with us! Team Absolutemens.com";

            $template_id = '1407167151675544556';
            $this->web_model->send_message($otp_message, $phone, $template_id);

            $coupon_disount = $order_details['ordersdetails']['coupon_disount'];
            $subject = $this->data['order_shipped_invoice']->subject;
            $title = $this->data['order_shipped_invoice']->title;
            $message = $this->data['order_shipped_invoice']->message;
            $footer = $this->data['order_shipped_invoice']->footer;

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
            <span>Track the order here: https://delhivery.com/track/package/'. $tracking_id . '</span>
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
                <div><span>Order status</span> ' . $order_details['ordersdetails']['order_status'] . '</div> 
                <div><span>Tracking ID</span> <b>' . $tracking_id . '</b></div>    
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
                    </tr>
                </thead>
                <tbody>';

            $count = 1;
            foreach ($order_details['ordersdetails']['cartdetails'] as $item) {

                $message .= '<tr>
                            <td class="service">' . $count . '</td>
                            <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                                ' . $item['productname'] . '<br>[';
                    foreach ($item['attributes'] as $attr) {
                        $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . '<br>';
                    }
                    $message .= ']</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                            <td class="desc">' . $item['quantity'] . '</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                        </tr>';
            }
            $message .= '<tr>
                        <td colspan="5">Subtotal</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['sub_total'] . '</td>
                    </tr>';
            if (!empty($coupon_disount)) {
                $message .= '<tr>
                        <td colspan="5">Coupon Discount</td>
                        <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                    </tr>';
            }

            if (!empty($order_details['ordersdetails']['deliveryboy_commission'])) {
                $message .= '<tr>
                        <td colspan="5">Delivery Charge</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['deliveryboy_commission'] . '</td>
                    </tr>';
            }

            if (!empty($order_details['ordersdetails']['gst'])) {
                $message .= '<tr>
                        <td colspan="5">GST</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['gst'] . '</td>
                    </tr>';
            }

            if ($order_details['ordersdetails']['gst'] == "") {
                $gst = 0;
            } else {
                $gst = $order_details['ordersdetails']['gst'];
            }

            $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
            $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
            $final_total = $sub_coupon + $order_boy;

            $message .= '<tr>
                        <td colspan="5" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $final_total . '</td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer>
            ' . $footer . '
        </footer>
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

// Reinitialize the Email library for each email
$this->email->initialize($config1);

$this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
$this->email->to($order_details['ordersdetails']['email']);
$this->email->subject($subject);
$this->email->message($message);
$this->email->send();

// if ($this->email->send()) {
//     $this->session->set_tempdata('success_message', 'Status Changed.',3);
// } else {
//     $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
// }
        } 
    }
        // redirect('vendors/orders_daily');
   
    }

function shipment() {
    $id = $this->input->get_post('id');
    $tracking_name = $this->input->get_post('tracking_name');
    $tracking_id = $this->input->get_post('tracking_id');
    $shipment_status = $this->vendor_model->update_shipment_status($tracking_name, $tracking_id, $id);
    if ($shipment_status) {
        $order_details = $this->web_model->orderDetails($id);
        //notification to admin
        $msg = "Order Shipped";
        $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
        $this->db->insert("admin_notifications", $array);
        
        //sms to customer
        $phone = $order_details['ordersdetails']['mobile'];
        $otp_message = "Dear Customer, Your order from Absolutemens.com has been picked up by our delivery partner. Thank you for shopping with us Team Absolutemens.com";
        $template_id = '1407167151675544556';
        $this->web_model->send_message($otp_message, $phone, $template_id);

        $coupon_disount = $order_details['ordersdetails']['coupon_disount'];
        $subject = $this->data['order_shipped_invoice']->subject;
        $title = $this->data['order_shipped_invoice']->title;
        $message = $this->data['order_shipped_invoice']->message;
        $footer = $this->data['order_shipped_invoice']->footer;

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
            <div><span>Order status</span> ' . $order_details['ordersdetails']['order_status'] . '</div> 
            <div><span>Tracking ID</span> <b>' . $tracking_id . '</b></div>    
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
                </tr>
            </thead>
            <tbody>';

        $count = 1;
        foreach ($order_details['ordersdetails']['cartdetails'] as $item) {

            $message .= '<tr>
                        <td class="service">' . $count . '</td>
                        <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                        <td class="desc">
                            ' . $item['productname'] . '<br>[';
                foreach ($item['attributes'] as $attr) {
                    $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . '<br>';
                }
                $message .= ']</td>
                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                        <td class="desc">' . $item['quantity'] . '</td>
                        <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                    </tr>';
        }
        $message .= '<tr>
                    <td colspan="5">Subtotal</td>
                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['sub_total'] . '</td>
                </tr>';
        if (!empty($coupon_disount)) {
            $message .= '<tr>
                    <td colspan="5">Coupon Discount</td>
                    <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                </tr>';
        }

        if (!empty($order_details['ordersdetails']['deliveryboy_commission'])) {
            $message .= '<tr>
                    <td colspan="5">Delivery Charge</td>
                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['deliveryboy_commission'] . '</td>
                </tr>';
        }

        if (!empty($order_details['ordersdetails']['gst'])) {
            $message .= '<tr>
                    <td colspan="5">GST</td>
                    <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['gst'] . '</td>
                </tr>';
        }

        if ($order_details['ordersdetails']['gst'] == "") {
            $gst = 0;
        } else {
            $gst = $order_details['ordersdetails']['gst'];
        }

        $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
        $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
        $final_total = $sub_coupon + $order_boy;

        $message .= '<tr>
                    <td colspan="5" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $final_total . '</td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer>
        ' . $footer . '
    </footer>
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
        $this->email->to($order_details['ordersdetails']['email']);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('success_message', 'Status Changed .');
            redirect('vendors/orders_daily');
        } else {
            $this->session->set_flashdata('error_message', 'Something Went Wrong.');
            redirect('vendors/orders_daily');
        }
    } else {
        $this->session->set_flashdata('error_message', 'Something Went Wrong.');
        redirect('vendors/orders_daily');
    }
}

    function view_complete_status($id) {
        $status = $this->vendor_model->get_complete_status($id);
        //print_r($id);die;
        if ($status) {
            $order_details = $this->web_model->orderDetails($id);
            //sms send to customer

            $phone = $order_details['ordersdetails']['mobile'];
            $otp_message = "Dear " . str_replace(' ', '', $order_details['ordersdetails']['customer_name']) . ", Your order from Absolutemens.com your order has been successfully delivered . We look forward to serving you again Team Absolutemens.com";
            $template_id = '1407167151718602797';
            $this->web_model->send_message($otp_message, $phone, $template_id);

            //notification to admin
            $msg = "Order Delivered";
            $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);

            $coupon_disount = $order_details['ordersdetails']['coupon_disount'];
            $subject = 'Order Delivered ('.$order_details['ordersdetails']['session_id'].')';
            $title = 'Order Delivered';
            $message = "Dear Customer, Your order with Order id ".$order_details['ordersdetails']['session_id']." has been successfully delivered, hope we have served you well. <br>We are looking forward to serving you again. <br>Thank you, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";
            $footer = $this->data['order_delivered_invoice']->footer;

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
                <div><span>Order status</span> ' . $order_details['ordersdetails']['order_status'] . '</div>
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
                    </tr>
                </thead>
                <tbody>';

            $count = 1;
            foreach ($order_details['ordersdetails']['cartdetails'] as $item) {

                $message .= '<tr>
                            <td class="service">' . $count . '</td>
                            <td class="service"><img src ="' . $item['image'] . '" style="width:50px;height:50px" /></td>
                            <td class="desc">
                                ' . $item['productname'] . '<br>[';
                    foreach ($item['attributes'] as $attr) {
                        $message .= ucfirst($attr['attribute_type']) . ': ' . $attr['attribute_values'] . '<br>';
                    }
                    $message .= ']</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['price'] . '</td>
                            <td class="desc">' . $item['quantity'] . '</td>
                            <td class="desc">' . DEFAULT_CURRENCY . '. ' . $item['total_price'] . '</td>

                        </tr>';
            }
            $message .= '<tr>
                        <td colspan="5">Subtotal</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['sub_total'] . '</td>
                    </tr>';
            if (!empty($coupon_disount)) {
                $message .= '<tr>
                        <td colspan="5">Coupon Discount</td>
                        <td class="total">(' . DEFAULT_CURRENCY . '. ' . $coupon_disount . ')</td>
                    </tr>';
            }

            if (!empty($order_details['ordersdetails']['deliveryboy_commission'])) {
                $message .= '<tr>
                        <td colspan="5">Delivery Charge</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['deliveryboy_commission'] . '</td>
                    </tr>';
            }

            if (!empty($order_details['ordersdetails']['gst'])) {
                $message .= '<tr>
                        <td colspan="5">GST</td>
                        <td class="total">' . DEFAULT_CURRENCY . '. ' . $order_details['ordersdetails']['gst'] . '</td>
                    </tr>';
            }

            if ($order_details['ordersdetails']['gst'] == "") {
                $gst = 0;
            } else {
                $gst = $order_details['ordersdetails']['gst'];
            }

            $sub_coupon = ($order_details['ordersdetails']['sub_total'] - $order_details['ordersdetails']['coupon_disount']);
            $order_boy = ($order_details['ordersdetails']['deliveryboy_commission'] + $gst);
            $final_total = $sub_coupon + $order_boy;

            $message .= '<tr>
                        <td colspan="5" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">' . DEFAULT_CURRENCY . '. ' . $final_total . '</td>
                    </tr>
                </tbody>
            </table>
        </main>
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

            if ($this->email->send()) {
                $this->session->set_tempdata('success_message', 'Status Changed to delivered.',3);
                redirect('vendors/orders_daily');
            } else {
                $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
                redirect('vendors/orders_daily');
            }
        } else {
            $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            redirect('vendors/orders_daily');
        }
    }

    function return() {
        $data['page_name'] = 'return';
        $new_request = $this->input->get_post('type');
        if ($new_request == 'new_request') {
            $data['orders'] = $this->vendor_model->get_vendor_return_product($this->data['vendor_id'], 'new');
        } else {
            $data['orders'] = $this->vendor_model->get_vendor_return_product($this->data['vendor_id']);
        }

        //pr($data['orders']);
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/return_orders', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function return_status($cart_id, $status, $order_id) {
        if ($status == 'accept') {
            $this->common_model->update_record(['cartid' => $cart_id], 'refund_exchange', ['status' => 1]);
            //$this->common_model->update_record(['id' => $order_id], 'orders', ['order_status' => 7]);
            $this->common_model->update_record(['id' => $cart_id], 'cart', ['status' => 1]);
        } else if ($status == 'reject') {
            $this->common_model->update_record(['cartid' => $cart_id], 'refund_exchange', ['status' => 2]);
            //$this->common_model->update_record(['id' => $order_id], 'orders', ['order_status' => 7]);
            $this->common_model->update_record(['id' => $cart_id], 'cart', ['status' => 1]);
        }

        $order_details = $this->web_model->orderDetails($order_id);
        $cart_details = $this->common_model->get_data_row(['id' => $cart_id], 'cart');
        $link_varient = $this->common_model->get_data_row(['id' => $cart_details->variant_id], 'link_variant');
        $attr_jsondata = json_decode($link_varient->jsondata);
        $attribute_type = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_type], 'attributes_title'))->title;
        $attribute_value = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_value], 'attributes_values'))->value;
        $product = $this->common_model->get_data_row(['id' => $link_varient->product_id], 'products');
        $product_image = $this->common_model->get_data_row(['variant_id' => $link_varient->id], 'product_images');
        if ($status == 'accept') {
            $order_status = 'Return Accepted';

            // sms to customer for Accept Return
            $ordrid = $order_details['ordersdetails']['session_id'];
            $mobile_number = $order_details['ordersdetails']['mobile'];
            $message = "Hello, the Return request for order ID " . $ordrid . " is approved, our pickup agent will be collecting it at the delivery address. Team absolutemens.com";
            $template_id = "1407167151617392747";
            $this->web_model->send_message($message, $mobile_number, $template_id);

        } else if ($status == 'reject') {
            $order_status = 'Return Rejected';

            // sms to customer for Reject Return
            $ordrid = $order_details['ordersdetails']['session_id'];
            $mobile_number = $order_details['ordersdetails']['mobile'];
            $message = "Hello, we regret to inform you that your return request for order ID " . $ordrid . " cannot be initiated as it does not meet our return policy. Please refer to our registered email id for more information. Team absolutemens.com";
            $template_id = "1407167151617392747";
            $this->web_model->send_message($message, $mobile_number, $template_id);
        }
    

        //notification to admin
        $msg = "Product " . $order_status;
        $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
        $this->db->insert("admin_notifications", $array);

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
            <h1>[ ' . $title . ' ]</h1>
            <div id="company" class="clearfix">
                <div>' . $order_details['ordersdetails']['customer_name'] . '</div>
                <div><a href="mailto:' . $order_details['ordersdetails']['email'] . '">' . $order_details['ordersdetails']['email'] . '</a></div>
                <div>' . $order_details['ordersdetails']['mobile'] . '</div>
                <div>' . $order_details['ordersdetails']['useraddress'] . '</div>
            </div>
            <div id="project">
                <div><span>Order ID</span> #' . $order_details['ordersdetails']['session_id'] . '</div>
                <div><span>Placed On</span> ' . $order_details['ordersdetails']['created_date'] . '</div>
                <div><span>Payment Status</span> ' . $order_details['ordersdetails']['payment_status'] . '</div>
                <div><span>Payment Method</span> ' . $order_details['ordersdetails']['payment_type'] . '</div>
                <div><span>Order Status</span> ' . $order_status . '</div>
            </div>
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
                            <td class="desc">' . $order_status . '</td>    
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

        if ($this->email->send()) {
            $this->session->set_tempdata('success_message', 'Return status Changed .',3);
            redirect('vendors/orders_daily/return');
        } else {
            $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            redirect('vendors/orders_daily/return');
        }
    }

    function cancel_refund_status($user_id) {
        $status = $this->vendor_model->get_return_cancelstatus($user_id);
        //print_r($id);die;
        if ($status) {
            $this->session->set_tempdata('success_message', 'Refund Successfully',3);
            redirect('vendors/orders_daily/return');
        } else {
            $this->session->set_tempdata('error_message', 'Something Went Wrong',3);
            redirect('vendors/orders_daily/return');
        }
    }

    public function shippingcost($order_id){
  
        $order_details=$this->web_model->orderDetails($order_id);
        $weight=$this->input->post('weightValue');
        $mode=$this->input->post('modeValue');
        $warehouse_name=$this->input->post('delivery_val');
        $dest_pin=$this->input->post('pincode');
        
        $qry_shop = $this->db->query("select * from warehouses where vendor_id='".$order_details['ordersdetails']['vendor_id']."' and warehouse_name='".$warehouse_name."'");
        $result = $qry_shop->row();
        $add = $this->db->query("select * from user_address where id='" . $order_details['ordersdetails']['address_id'] . "'");
        // echo "<pre>";
        $customerdetails = $add->row();
        $origin=$result->pincode;//origin pin
        // echo "<pre>";
        // print_r($dest_pin);
        // exit;
        $apiUrl=SHIPPING_COST_URL;
      $api_key=TEST_KEY;
      $md=$mode;
      $cgm=$weight;
      $o_pin=$origin;
      $d_pin=$dest_pin;
      $ss='DTO';
      
        // Data to be sent in the request
        $data = ['md' => $md,'cgm'=>$cgm,'o_pin'=>$o_pin,'d_pin'=>$d_pin,'ss'=>$ss];
      
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
        $res=json_decode($response,true);
        if($res['error']){
            echo '@error';
            // $this->session->set_tempdata('error_message', 'please provide correct values',3);
        
            
        }
        else{
            print($res[0]['total_amount']);
            // $this->session->set_tempdata('success_message', 'shipping cost calculated',3);
            
        }
        // print_r($res);
        // redirect('vendors/orders_daily');
    //   echo $response;
        // return $response;
      }

      public function pickUp_update($id, $pickup_id, $status) {
        // Define the data to be updated
        $data = array(
            'pickup_id' => $pickup_id,
            'status' => 'completed'
        );
        $this->db->where('id', $id);
        $update = $this->db->update('pickup_table', $data);
        $orders_array_qry = $this->db->query("SELECT * FROM pickup_table WHERE id='" . $id . "' AND pickup_id='" . $pickup_id . "'");
        $order_array_res = $orders_array_qry->row();
        // echo "<pre>";
        $tracking_name='delhivery';
        // $tracking_id=
        if ($order_array_res !== null) { 
            $order_array = json_decode($order_array_res->order_id, true);
        
            if (is_array($order_array) && sizeof($order_array) > 0) {
                // foreach ($order_array as $ids) {
                    // $tracking_id_qry=$this->db->query("select waybill_generated from orders where id='".$ids."'");
                    // $tracking_id_qry_res=$tracking_id_qry->row();
                    // $tracking_id=$tracking_id_qry_res->waybill_generated;
                    // $this->vendor_model->update_shipment_status($tracking_name, $tracking_id, $ids);
                    $this->shipment_delhivery($order_array);
                    // print_r($ids);

                // }
            }
        }
        // exit;
        if ($update) {
            $this->session->set_flashdata('success_message', 'pickup updated successfully');
        } else {
            $this->session->set_flashdata('error_message', 'Something Went Wrong');
        }
        
        redirect('vendors/orders_daily');
    }
    function complete_return($cart_id, $order_id) {
        $mark_complete = $this->common_model->update_record(['id' => $order_id], 'orders', ['order_status' => 7]);
        if ($mark_complete == true) {
            $this->common_model->update_record(['cartid' => $cart_id], 'refund_exchange', ['exchange_completed_date' => time()]);
            $order_details = $this->web_model->orderDetails($order_id);
            $cart_details = $this->common_model->get_data_row(['id' => $cart_id], 'cart');
            $link_varient = $this->common_model->get_data_row(['id' => $cart_details->variant_id], 'link_variant');
            $attr_jsondata = json_decode($link_varient->jsondata);
            $attribute_type = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_type], 'attributes_title'))->title;
            $attribute_value = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_value], 'attributes_values'))->value;
            $product = $this->common_model->get_data_row(['id' => $link_varient->product_id], 'products');
            $product_image = $this->common_model->get_data_row(['variant_id' => $link_varient->id], 'product_images');

            //re-add stock in vendor stock
            $total = $link_varient->stock + $cart_details->quantity;
            $ar = array('varient_id' => $cart_details->variant_id, 'product_id' => $link_varient->product_id, 'quantity' => $cart_details->quantity, 'paid_status' => 'Credit', 'message' => 'Stock added due to product returned', 'total_stock' => $total, 'created_at' => time());
            $ins11 = $this->db->insert("stock_management", $ar);

            if ($ins11) {
                $this->db->update("link_variant", array('stock' => $total), array('id' => $cart_details->variant_id));
            }

            $order_status = 'Completed';
            $admin_msg = 'Return Completed';

            //notification to admin
            $msg = "Product " . $admin_msg;
            $array = array('session_id' => $order_details['ordersdetails']['session_id'], 'vendor_id' => $order_details['ordersdetails']['vendor_id'], 'user_id' => $order_details['ordersdetails']['user_id'], 'order_id' => $order_details['ordersdetails']['id'], 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);

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
            <h1>[ ' . $title . ' ]</h1>
            <div id="company" class="clearfix">
                <div>' . $order_details['ordersdetails']['customer_name'] . '</div>
                <div><a href="mailto:' . $order_details['ordersdetails']['email'] . '">' . $order_details['ordersdetails']['email'] . '</a></div>
                <div>' . $order_details['ordersdetails']['mobile'] . '</div>
                <div>' . $order_details['ordersdetails']['useraddress'] . '</div>
            </div>
            <div id="project">
                <div><span>Order ID</span> #' . $order_details['ordersdetails']['session_id'] . '</div>
                <div><span>Placed On</span> ' . $order_details['ordersdetails']['created_date'] . '</div>
                <div><span>Payment Status</span> ' . $order_details['ordersdetails']['payment_status'] . '</div>
                <div><span>Payment Method</span> ' . $order_details['ordersdetails']['payment_type'] . '</div>
                <div><span>Order Status</span> ' . $order_status . '</div>
            </div>
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
                            <td class="desc">' . $order_status . '</td>    
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

            if ($this->email->send()) {
                $this->session->set_tempdata('success_message', 'Return completed.',3);
                redirect('vendors/orders_daily/return');
            } else {
                $this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
                redirect('vendors/orders_daily/return');
            }
        }
    }

}
