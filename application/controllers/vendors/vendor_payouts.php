<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



class Vendor_payouts extends MY_Controller {
    public $data;
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->load->model("vendor_model");
    }

    function index() {
        $vendor_id = $this->session->userdata('vendors')['vendor_id'];
        $this->data['page_name'] = 'Vendor_payouts';
        $this->data['title'] = 'Vendor_payouts';
        
        $qry = $this->db->query("select * from orders where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "' and order_status=5");
        $result = $qry->result();
        $vendor_amount = 0;
        foreach($result as $v) {
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
            $vendor_amount = floatval($unit_price - ($gst + $commision))+ $vendor_amount;
        }
        
        // $vendor_amount = 0;
        // foreach ($result as $value) {
        //     $vendor_amount += $value->vendor_commission;
        // }

        $chk_vend = $this->db->query("select * from vendor_payements where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "'");
        if ($chk_vend->num_rows() == 0) {
            // $array = array('vendor_id' => $_SESSION['vendors']['vendor_id'], 'total_payment' => $vendor_amount);
            // $where = array('vendor_id' => $_SESSION['vendors']['vendor_id']);
            // $this->db->update("vendor_payements", $array, $where);
        // } else {
            $array = array('vendor_id' => $_SESSION['vendors']['vendor_id'], 'total_payment' => $vendor_amount);
            $this->db->insert("vendor_payements", $array);
        }
        else{
            $chk_qry=$this->db->query("select * from request_payment where vendor_id ='".$_SESSION['vendors']['vendor_id']."' and payment_status='completed'");
            $chk_qry_res=$chk_qry->result();
            $re=0;
            foreach($chk_qry_res as $res){
                $re += $res->request_amount;
            }
            $array = array('vendor_id' => $_SESSION['vendors']['vendor_id'], 'total_payment' => $vendor_amount,'requested_amount'=>$re);
            $where = array('vendor_id' => $_SESSION['vendors']['vendor_id']);
            $this->db->update("vendor_payements", $array, $where);
        }
        $vendor_row = $chk_vend->row();
        if($vendor_row->requested_amount != ''){
            $requested_amount = floatval($vendor_row->requested_amount);
            $total_payment = floatval($vendor_row->total_payment);
            $this->data['vendor_amount'] = $total_payment - $requested_amount;
        } else {
            $this->data['vendor_amount'] = floatval($vendor_row->total_payment);
        }
        

       

        $vendor_req = $this->db->query("select * from request_payment where vendor_id='" . $_SESSION['vendors']['vendor_id'] . "'and payment_status='completed'");
        $this->data['vendor_requests'] = $vendor_req->result();
        $this->data['orders']=$qry->result();
       
        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/vendor_payouts', $this->data);

        $this->load->view('vendors/includes/footer');
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
        
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/vendor_payouts', $this->data);
        $this->load->view('vendors/includes/footer');
        
        

    }






}