<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_order_cronjob extends MY_Controller {

    public $data;

    function __construct() {

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept,Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->db->where('name', 'Cronjob');
        $query = $this->db->get('features');
        $feature = $query->row();
        if ($feature && $feature->status == 0) {
           
            exit(); // Stop further execution
        }
        $this->load->model('web_model');


    }

    function index() {
        $vendors = $this->pending_orders($group_by = 'vendor_id');
        //unique vendors list for pending orders in last 1 hour
        if (sizeof($vendors) > 0) {
            foreach ($vendors as $row) {
                $vendor_details = $this->common_model->get_data_row(['id' => $row->vendor_id], 'vendor_shop');
                for ($i = 2; $i < 4; $i++) {
                    if ($i == 2) {
                        $reminder = 'Assign To Courier';
                        $current_status = 'Confirmed';
                        $next_step = 'Assign To Courier';
                    } else if ($i == 3) {
                        $reminder = 'Waiting For Shipment';
                        $current_status = 'Assigned To Courier';
                        $next_step = 'Proceed For Shipment';
                    }
                    //all pending orders which need action for each vendor (confirmed/assign to courier)
                    $orders = $this->pending_orders($group_by = null, $row->vendor_id, $i);

                    if (sizeof($orders) > 0) {
                        $order_details_list = [];
                        foreach ($orders as $ord) {
                            //$order_details = $this->db->where(['session_id' => $ord->session_id, 'vendor_id' => $ord->vendor_id])->get('orders')->row();
                            $chk = 0;
                            if ($i == 2) {
                                $chk = $this->is_in_assign_courier($row->vendor_id, $ord->session_id);
                            }
                            if ($chk == 0) {
                                $data['ref_id'] = $ord->session_id;
                                $data['current_status'] = $current_status;
                                array_push($order_details_list, $data);
                            }
                        }
                        if (sizeof($order_details_list) > 0) {
//send notification to vendor regarding orders
                            $sub = "Order Reminder: " . $reminder;
                            $msg = "Hey <b>" . $vendor_details->shop_name . "</b>, you have " . sizeof($orders) . " order(s) with order status <b>" . $current_status . "</b> as of now. Please <b>" . $next_step . "</b>.";

                            $html = '<!DOCTYPE html>
<html>
    <head>
        <title>Pending Orders</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  padding: 10px 10px;
                border: 1px solid #ddd;
                text-align: center;
                font-size: 16px;
}

th {
                background-color: #92c9e6;
                color: #ffffff;
            }

tr:nth-child(even){background-color: #f2f2f2}
</style>
    </head>
    <div style="overflow-x:auto;">
    <table>
        <tr>
        <th>S.No</th>
        <th>Reference ID</th>
    </tr>';
                            $count = 1;
                            foreach ($order_details_list as $list) {
                                $html .= '<tr>
                <td>' . $count . '</td>
                <td>' . $list['ref_id'] . '</td>
            </tr>';
                                $count++;
                            }
                            $html .= '</table>
</div>
</body>
</html>';
                            $email_template = $msg . '<br><br>';
                            $email_template .= $html;

                            $array = array('vendor_id' => $row->vendor_id, 'message' => $msg, 'status' => 0, 'created_date' => time());
                            $insert = $this->db->insert("admin_notifications", $array);
                            if ($insert) {
//send email reminder to vendor
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
                                $this->email->to($vendor_details->email);
                                $this->email->subject($sub);
                                $this->email->message($email_template);

                                if ($this->email->send()) {
                                    $this->email->clear(true);
                                    //send email to admin
                                    $sub1 = "Order Reminder For " . $vendor_details->shop_name . ": " . $reminder;
                                    $msg1 = "Hey <b>Admin</b>, " . $vendor_details->shop_name . " have " . sizeof($orders) . " order(s) with order status <b>" . $current_status . "</b> as of now. Need to <b>" . $next_step . "</b>.";

                                    $email_template1 = $msg1 . '<br><br>';
                                    $email_template1 .= $html;

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

                                    $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
                                    $this->email->to($this->data['site']->email);
                                    $this->email->subject($sub1);
                                    $this->email->message($email_template1);

                                    $this->email->send();
                                    $this->email->clear(true);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function pending_orders($group_by = null, $vendor_id = null, $status = null) {
        if ($group_by) {
            $this->db->where('order_status', '2');
            $this->db->or_where('order_status', '3');
            $this->db->group_by($group_by);
        } else if ($vendor_id != null && $status != null) {
            $this->db->where('vendor_id', $vendor_id);
            if ($status == 2) {
                $this->db->where('order_status', '2');
            } else if ($status == 3) {
                $this->db->where('order_status', '3');
            }
        }
        $records = $this->db->get('orders')->result();

        return $records;
    }

    function is_in_assign_courier($vendor_id, $session_id) {
        $this->db->where('vendor_id', $vendor_id);
        $this->db->where('session_id', $session_id);
        $this->db->where('order_status', '3');
        $records = $this->db->get('orders')->num_rows();

        return $records;
    }

//    function get_orders($order_status, $vendor_id) {
//
//        $this->db->where('order_status', $order_status);
//        $this->db->where('vendor_id', $vendor_id);
//        $this->db->order_by('id', 'asc');
//
//        return $this->db->get('orders')->result();
//    }
}
