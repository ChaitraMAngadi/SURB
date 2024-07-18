<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Request_payment extends CI_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('vendors/login');
        }
        $this->load->model('vendor_model');
    }

    function index() {
        $this->data['page_name'] = 'request_payment';

        $qry = $this->db->query("select * from orders where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "' and order_status=5");
        $result = $qry->result();
        $vendor_amount = 0;
        foreach ($result as $value) {
            $vendor_amount += $value->vendor_commission;
        }

        $chk_vend = $this->db->query("select * from vendor_payements where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "'");
        if ($chk_vend->num_rows() > 0) {
            $array = array('vendor_id' => $_SESSION['vendors']['vendor_id'], 'total_payment' => $vendor_amount);
            $where = array('vendor_id' => $_SESSION['vendors']['vendor_id']);
            $this->db->update("vendor_payements", $array, $where);
        } else {
            $array = array('vendor_id' => $_SESSION['vendors']['vendor_id'], 'total_payment' => $vendor_amount);
            $this->db->insert("vendor_payements", $array);
        }
        $vendor_row = $chk_vend->row();

        $this->data['vendor_amount'] = $vendor_row->total_payment - $vendor_row->requested_amount;

        $vendor_req = $this->db->query("select * from request_payment where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "'");
        $this->data['vendor_requests'] = $vendor_req->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/request_payment', $data);
        $this->load->view('vendors/includes/footer');
    }

    function add() {
        $this->data['page_name'] = 'request_payment';
        $this->data['title'] = 'Request Payment';
        //echo "select * from vendor_payements where vendor_id='".$_SESSION['vendors']['vendor_id']."'"; die;
        $chk_vend = $this->db->query("select * from vendor_payements where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "'");
        $vendor_row = $chk_vend->row();
        if ($vendor_row->total_payment > $vendor_row->requested_amount) {
            $this->data['vendor_amount'] = $vendor_row->total_payment - $vendor_row->requested_amount;
        }
        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/addpayment', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function insert() {

        //print_r($this->input->post()); die; 
        $qry = $this->db->query("select * from vendor_payements where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "'");
        $row = $qry->row();
        $t_price = floor($row->total_payment - $row->requested_amount);

        $vendor_amount = $this->input->post('vendor_amount');

        $requested_amount = $this->input->post('requested_amount');
        if ($requested_amount > 0) {

            $chek_qry = $this->db->query("SELECT sum(request_amount) as total_requested_amount FROM `request_payment` WHERE vendor_id='" . $_SESSION['vendors']['vendor_id'] . "' AND status = 0");
            $requqested_row = $chek_qry->row();
            $total_requested_amount = $requqested_row->total_requested_amount + $requested_amount;

            if ($t_price >= $total_requested_amount) {
                $description = $this->input->post('description');

                $data = array(
                    'vendor_id' => $_SESSION['vendors']['vendor_id'],
                    'request_amount' => $requested_amount,
                    'vendor_amount' => $vendor_amount,
                    'description' => $description,
                    'created_at' => time()
                );

                $insert_query = $this->db->insert('request_payment', $data);
                //echo $this->db->last_query(); die;
                if ($insert_query) {
                    $qrr = $this->db->query("select * from vendor_shop where id='" . $_SESSION['vendors']['vendor_id'] . "'");
                    $vend_row = $qrr->row();

                    $msg = "Payment Request: " . $vend_row->shop_name . " requested amount Rs. " . $requested_amount;
                    $trans_ar = array('sender_name' => $vend_row->shop_name, 'receiver_name' => 'Admin', 'amount' => $requested_amount, 'message' => $msg, 'created_at' => time());
                    $this->db->insert('transactions', $trans_ar);

                    //notification to admin
                    $array = array('vendor_id' => $vend_row->id, 'message' => $msg, 'status' => 0, 'created_date' => time());
                    $this->db->insert("admin_notifications", $array);

                    $this->session->set_tempdata('success_message', 'Request sent Successfully',3);
                    redirect('vendors/request_payment');
                    die();
                } else {
                    redirect('vendors/request_payment/add');
                    die();
                }
            } else {
                $this->session->set_tempdata('error_message', 'Please check your Total Amount and Requested Amount',3);
                redirect('vendors/request_payment/add');
            }
        } else {
            $this->session->set_tempdata('error_message', 'Please Enter minimum amount',3);
            redirect('vendors/request_payment/add');
        }
    }

    function delete($id) {
        $requested_amount = $this->db->where('id', $id)->get('request_payment')->row()->request_amount;
        $this->db->where('id', $id);
        if ($this->db->delete('request_payment')) {
            //notification to admin
            $qrr = $this->db->query("select * from vendor_shop where id='" . $_SESSION['vendors']['vendor_id'] . "'");
            $vend_row = $qrr->row();

            $msg = "Payment Request: " . $vend_row->shop_name . " has cancelled the payment request of amount Rs. " . $requested_amount;
            $array = array('vendor_id' => $vend_row->id, 'message' => $msg, 'status' => 0, 'created_date' => time());
            $this->db->insert("admin_notifications", $array);

            $this->session->set_tempdata('error_message', 'Requested Payment Deleted Successfully',3);
            redirect('vendors/request_payment');
        } else {
            $this->session->set_tempdata('error_message', 'Requested Payment Deleted Successfully',3);
            redirect('vendors/request_payment');
        }
    }

}
