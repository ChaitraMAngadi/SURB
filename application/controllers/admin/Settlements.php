<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settlements extends MY_Controller {

    public $data; 

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');
        }
        $this->db->where('name', 'Settlements'); 
        $query = $this->db->get('features');
        $feature = $query->row();
        $role_name = $this->session->userdata('admin_login')['role_name'];
        if ($feature && $feature->status == 0) {
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
           redirect($redirect_url);
            exit();
        }
        
        $features = $this->session->userdata('admin_login')['features'];
        if (!in_array('Settlements', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'settlements';

        $vendor_req = $this->db->query("select * from request_payment order by status asc");
        $this->data['vendor_requests'] = $vendor_req->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/settlements', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add($id) {
        $this->data['page_name'] = 'settlements';
        $this->data['title'] = 'Settlements';

        $chk_vend = $this->db->query("select * from request_payment where id='" . $id . "'");
        $vendor_row = $chk_vend->row();

        $ve = $this->db->query("select * from vendor_shop where id='" . $vendor_row->vendor_id . "'");
        $vendror_data = $ve->row();
        $this->data['shop_name'] = $vendror_data->shop_name;
        $this->data['id'] = $id;
        $this->data['vendor_amount'] = $vendor_row->vendor_amount;
        $this->data['request_amount'] = $vendor_row->request_amount;

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_settlement', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function insert() {
        $id = $this->input->post('id');
        $vendor_amount = $this->input->post('vendor_amount');
        $requested_amount = $this->input->post('requested_amount');
        $mode_payment = $this->input->post('mode_payment');
        $sender_name = $this->input->post('sender_name');
        $receiver_name = $this->input->post('receiver_name');
        $transaction_id = $this->input->post('transaction_id');
        $description = $this->input->post('description');

        if ($this->upload_file('image') != '') {
            $transation_img = $this->upload_file('image');
        } else {
            $transation_img = "";
        }


        $data = array(
            'transaction_id' => $transaction_id,
            'sender_name' => $sender_name,
            'receiver_name' => $receiver_name,
            'mode_payment' => $mode_payment,
            'admin_description' => $description,
            'image' => $transation_img,
            'status' => 1,
            'updated_at' => time()
        );
        $wr = array('id' => $id);
        $insert_query = $this->db->update('request_payment', $data, $wr);
        //echo $this->db->last_query(); die;
        if ($insert_query) {

            $vv = $this->db->query("select * from request_payment where id='" . $id . "'");
            $vendr = $vv->row();

            $gel = $this->db->query("select *  from vendor_payements where vendor_id='" . $vendr->vendor_id . "'");
            $gel_t = $gel->row();

            $total_payment = $gel_t->requested_amount;
            $fin_am = $total_payment + $requested_amount;
            $data1 = array('requested_amount' => $fin_am);
            $wrr1 = array('vendor_id' => $vendr->vendor_id);
            $this->db->update('vendor_payements', $data1, $wrr1);

            $qrr = $this->db->query("select * from vendor_shop where id='" . $vendr->vendor_id . "'");
            $vend_row = $qrr->row();

            $msg = "Payment Request: Admin Settled the amount of Rs. " . $requested_amount . " to " . $vend_row->shop_name;
            $trans_ar = array('sender_name' => 'Admin', 'receiver_name' => $vend_row->shop_name, 'amount' => $requested_amount, 'message' => $msg, 'created_at' => time());
            $this->db->insert('transactions', $trans_ar);

            //notification to admin
            $array = array('vendor_id' => $vend_row->id, 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);

            //sms send to customer
            // $phone = $vend_row->mobile;
            // $otp_message = "Dear vendor " . $vend_row->shop_name . ", you payout from date starting to now is Rs " . $requested_amount . "/-. thank u for being partner to absolutemens. Thanks and Regards Absolute Mens";
            // $template_id = '1407165996064467219';
            // $this->load->model('Web_model');
            // $this->Web_model->send_message($otp_message, $phone, $template_id);

            //send mail for settlement complete
            // $msgg = "Hey, <br>Your payment for the last payment cycle has been settled. <br>The payment will be reflected in your registered bank account within 72 working hours. <br>Please contact your POC for any further information. <br>Thank you, <br>Team <a href='https://absolutemens.com/'>Absolutemens.com</a>";
            // $config1['protocol'] = MAIL_PROTOCOL;
            // $config1['smtp_host'] = MAIL_SMTP_HOST;
            // $config1['smtp_port'] = MAIL_SMTP_PORT;
            // $config1['smtp_timeout'] = '7';
            // $config1['smtp_user'] = MAIL_SMTP_USER;
            // $config1['smtp_pass'] = MAIL_SMTP_PASS;
            // $config1['charset'] = MAIL_CHARSET;
            // $config1['newline'] = "\r\n";
            // $config1['mailtype'] = 'html'; // or html 
            // $config1['validation'] = TRUE; // bool whether to validate email or not      

            // $this->email->initialize($config1);

            // $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
            // $this->email->to($vend_row->email);
            // $this->email->subject('Payment Settlement');
            // $this->email->message($msgg);

            // $this->email->send();

            $this->session->set_tempdata('success_message', 'Settlement added Successfully',3);
            redirect('admin/settlements');
            die();
        } else {
            redirect('admin/settlements/add');
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

    function delete($id) {

        $this->db->where('id', $id);
        if ($this->db->delete('request_payment')) {
            $this->session->set_tempdata('error_message', 'Request Payment Deleted Successfully',3);
            redirect('admin/request_payment');
        } else {
            $this->session->set_tempdata('error_message', 'Unable to delete',3);
            redirect('admin/request_payment');
        }
    }

}
