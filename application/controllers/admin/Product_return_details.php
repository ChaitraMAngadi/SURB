<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_return_details extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Return');
        $query = $this->db->get('features');
        $feature = $query->row();
        $role_name = $this->session->userdata('admin_login')['role_name'];
        if ($feature && $feature->status == 0) {
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
           redirect($redirect_url);
            exit(); // Stop further execution
        }

        $features = $this->session->userdata('admin_login')['features'];
        if (!in_array('Return', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        // $this->db->where('name', 'Return');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }

        $this->load->model("admin_model");
        $this->load->model('web_model');
    }

    function index() {
        $this->data['page_name'] = 'product_return_details';
        $this->db->order_by('id', 'desc');
        $this->db->order_by('admin_accept', 'asc');
        $refund_exchange = $this->db->get('refund_exchange');
        $this->data['refund_details'] = $refund_exchange->result();

        //$this->$data['refund_details'] = $this->Admin_model->refundDetails();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/product_return_details', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function return_status($status, $id) {
        if ($status == 'accept') {
            $this->common_model->update_record(['id' => $id], 'refund_exchange', ['admin_accept' => 1]);
            $this->session->set_tempdata('success_message', 'Return accepted',3);
        } else if ($status == 'reject') {

           $this->common_model->update_record(['id' => $id], 'refund_exchange', ['admin_accept' => 2]);
           $this->session->set_tempdata('success_message', 'Return rejected',3);
           

             $refund_exchange = $this->common_model->get_data_row(['id' => $id], 'refund_exchange');
             $cart_details = $this->common_model->get_data_row(['id' => $refund_exchange->cartid], 'cart');
             $ordersid = $this->common_model->get_data_row(['session_id' => $refund_exchange->session_id], 'orders');

             $order_id = $ordersid->id;
             $order_details = $this->web_model->orderDetails($order_id);

             $link_varient = $this->common_model->get_data_row(['id' => $cart_details->variant_id], 'link_variant');
             $attr_jsondata = json_decode($link_varient->jsondata);
             $attribute_type = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_type], 'attributes_title'))->title;
             $attribute_value = ($this->common_model->get_data_row(['id' => $attr_jsondata[0]->attribute_value], 'attributes_values'))->value;
             $product = $this->common_model->get_data_row(['id' => $link_varient->product_id], 'products');
             $product_image = $this->common_model->get_data_row(['variant_id' => $link_varient->id], 'product_images');
                // print_r($link_varient);die;

            // sms to customer for Reject Return
             $ordrid = $order_details['ordersdetails']['session_id'];
            $mobile_number = $order_details['ordersdetails']['mobile'];
            $message = "Hello, we regret to inform you that your return request for order ID " . $ordrid . " cannot be initiated as it does not meet our return policy. Please refer to our registered email id for more information. Team absolutemens.com";
            $template_id = "1407167151617392747";
            $this->web_model->send_message($message, $mobile_number, $template_id);

             $order_status = 'Return Rejected';
             $msg = "Product " . $order_status;

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
        $this->email->send();
    

        }
        //create notification
        $refund_exchange = $this->db->where('id', $id)->get('refund_exchange')->row();
        $msg = "Return request ".$status."ed by admin";

        $array = array('session_id' => $refund_exchange->session_id, 'vendor_id' => $refund_exchange->vendor_id, 'message' => $msg, 'status' => 0, 'created_date' => time());
        $this->db->insert("admin_notifications", $array);

        redirect('admin/product_return_details');
    }

}
