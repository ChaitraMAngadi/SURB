<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->load->model("vendor_model");
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'dashboard';
        $this->data['title'] = 'Dashboard';

        $shop_id = $_SESSION['vendors']['vendor_id']; 
        $pro = $this->db->query("select * from products where shop_id='".$shop_id."'");
        $this->data['total_products'] = $pro->num_rows();

        $ord = $this->db->query("select * from orders where vendor_id='".$shop_id."'");
        $this->data['total_orders'] = $ord->num_rows();


        $qry = $this->db->query("select * from admin_comissions where shop_id='".$shop_id."'");
        $category = $qry->num_rows();

        $ord = $this->db->query("select * from orders where vendor_id='".$shop_id."'");
        $total_orders = $ord->num_rows();
        
        $today_orders = [];
        $date=date('Y-m-d');
//
//        $toord = $this->db->query("select * from orders where vendor_id='".$shop_id."' and created_date LIKE '%".$date."%'");
//        $today_orders = $toord->num_rows();
        $all_orders = $this->vendor_model->get_today_orders($shop_id);
        //print_r($all_orders);die;
        foreach($all_orders as $orders){
           $created_at=date('Y-m-d',$orders->created_at); 
          if($date == $created_at){
              array_push($today_orders,$orders);
          }  
        }

        $current_date = date('Y-m-d');
        $qry_daily = $this->db->query("SELECT * 
        FROM `orders` 
        WHERE order_status=2 and vendor_id ='".$shop_id."'and  order_date = '".$current_date."'");
        $qry_daily_count=$qry_daily->num_rows();
        $daily=$qry_daily->result();
        $unit_price = 0;
        if($qry_daily_count>0){
        foreach($daily as $v) {
            $cart_qry = $this->db->query("SELECT * FROM cart WHERE session_id='" . $v->session_id . "' AND vendor_id='" . $v->vendor_id . "'");
            $cart_result = $cart_qry->result();
            
    
            foreach ($cart_result as $cart_value) {
                $link_qry = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value->variant_id . "'");
                $link_row = $link_qry->row();
    
                $prod_qry = $this->db->query("SELECT * FROM products WHERE id='" . $link_row->product_id . "' and shop_id='".$shop_id."'");
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
                // print_r($cart_value->unit_price);
            }
            $vendor_amount = floatval($unit_price - ($gst + $commision))+ $vendor_amount;
            // $unit_price += $cart_value->unit_price;
        }
        }

        if ($qry_daily_count != 0) {
            $this->data['daily_average'] = number_format(($unit_price) / $qry_daily_count, 2);
        } else {
            // Handle division by zero error
            $this->data['daily_average'] = "0"; // Or any other appropriate value or error handling mechanism
        }
        if($unit_price!=0){
            $this->data['daily_sales']= number_format(($unit_price),2);
        }
        else{
            $this->data['daily_sales']=0;
        }
        
        $start_date_w = date('Y-m-d', strtotime('-1 day'));
        $end_date_w = date('Y-m-d',strtotime($start_date_w."-7 days"));
      
        $qry_weekly = $this->db->query("SELECT * FROM `orders` where order_status=2 and vendor_id='".$shop_id."' and order_date between '".$end_date_w."' AND '".$start_date_w."'");
        $qry_weekly_count=$qry_weekly->num_rows();
        // $this->data['orders_commission'] = $qry->result();
        $weekly=$qry_weekly->result();
        $unit_price_week=0;
        if($qry_weekly_count>0){
        foreach($weekly as $vw) {
            $cart_qry_w = $this->db->query("SELECT * FROM cart WHERE session_id='" . $vw->session_id . "' AND vendor_id='" . $vw->vendor_id . "'");
            $cart_result_w = $cart_qry_w->result();
            
    
            foreach ($cart_result_w as $cart_value_w) {
                $link_qry_w = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value_w->variant_id . "'");
                $link_row_w = $link_qry_w->row();
    
                $prod_qry_w = $this->db->query("SELECT * FROM products WHERE id='" . $link_row_w->product_id . "' and shop_id='".$shop_id."'");
                $prod_row_w = $prod_qry_w->row();
    
                $cat_id_w = $prod_row_w->cat_id;
                $sub_cat_id_w = $prod_row_w->sub_cat_id;
    
                $cat_qry_w = $this->db->query("SELECT * FROM categories WHERE id='" . $cat_id_w . "'");
                $cat_row_w = $cat_qry_w->row();
    
                $scat_qry_w = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $sub_cat_id_w . "'");
                $scat_row_w = $scat_qry_w->row();
    
                $cart_vendor_id_w = $cart_value_w->vendor_id;
                if ($sub_cat_id_w) {
                    $find_in_set_w = "AND find_in_set('" . $sub_cat_id_w . "',subcategory_ids)";
                } else {
                    $find_in_set_w = "";
                }
                $adminc_qry_w = $this->db->query("SELECT * FROM admin_comissions WHERE shop_id='" . $cart_vendor_id_w . "' AND cat_id='" . $cat_id_w . "' " . $find_in_set_w . " ");
                $adminc_row_w = $adminc_qry_w->row();
                if ($adminc_row_w->admin_comission != '') {
                    $admin_comission_w = $adminc_row_w->admin_comission;
                } else {
                    $admin_comission_w = 0;
                }
                $commision_w = floatval($cart_value_w->unit_price * $admin_comission_w) / 100;
                $gst_w = ($adminc_row_w->gst * $commision_w) / 100;
                $unit_price_week += $cart_value_w->unit_price;
                // print_r($cart_value->unit_price);
            }
            $vendor_amount_w = floatval($unit_price_week - ($gst_w + $commision_w))+ $vendor_amount_w;
            // $unit_price += $cart_value->unit_price;
        }}

            // print_r($unit_price_week);
            // exit;die;
            if ($qry_weekly_count != 0) {
            $this->data['weekly_average']=number_format(($unit_price_week)/$qry_weekly_count,2);
            }
            else{
                $this->data['weekly_average']="0";
            }

            if($unit_price_week !=0){
                $this->data['weekly_sales']=number_format(($unit_price_week),2);
            }
            else{
                $this->data['weekly_sales']=0;
            }
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d',strtotime($start_date."-1 month "));
          
            $qry_monthly = $this->db->query("SELECT * FROM `orders` where order_status=2 and vendor_id='".$shop_id."' and order_date between '".$end_date."' AND '".$start_date."'");
            $qry_monthly_count = $qry_monthly->num_rows();
            $monthly=$qry_monthly->result();
            $unit_price_month=0;
            if($qry_monthly_count>0){
            foreach($monthly as $vm) {
                $cart_qry_m = $this->db->query("SELECT * FROM cart WHERE session_id='" . $vm->session_id . "' AND vendor_id='" . $vm->vendor_id . "'");
                $cart_result_m = $cart_qry_m->result();
                
        
                foreach ($cart_result_m as $cart_value_m) {
                    $link_qry_m = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value_m->variant_id . "'");
                    $link_row_m = $link_qry_m->row();
        
                    $prod_qry_m = $this->db->query("SELECT * FROM products WHERE id='" . $link_row_m->product_id . "' and shop_id='".$shop_id."'");
                    $prod_row_m = $prod_qry_m->row();
        
                    $cat_id_m = $prod_row_m->cat_id;
                    $sub_cat_id_m = $prod_row_m->sub_cat_id;
        
                    $cat_qry_m = $this->db->query("SELECT * FROM categories WHERE id='" . $cat_id_m . "'");
                    $cat_row_m = $cat_qry_m->row();
        
                    $scat_qry_m = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $sub_cat_id_m . "'");
                    $scat_row_m = $scat_qry_m->row();
        
                    $cart_vendor_id_m = $cart_value_m->vendor_id;
                    if ($sub_cat_id_m) {
                        $find_in_set_m = "AND find_in_set('" . $sub_cat_id_m . "',subcategory_ids)";
                    } else {
                        $find_in_set_m = "";
                    }
                    $adminc_qry_m = $this->db->query("SELECT * FROM admin_comissions WHERE shop_id='" . $cart_vendor_id_m . "' AND cat_id='" . $cat_id_m . "' " . $find_in_set_m . " ");
                    $adminc_row_m = $adminc_qry_m->row();
                    if ($adminc_row_m->admin_comission != '') {
                        $admin_comission_m = $adminc_row_m->admin_comission;
                    } else {
                        $admin_comission_m = 0;
                    }
                    $commision_m = floatval($cart_value_m->unit_price * $admin_comission_m) / 100;
                    $gst_m = ($adminc_row_m->gst * $commision_m) / 100;
                    $unit_price_month += $cart_value_m->unit_price;
                    // print_r($cart_value->unit_price);
                }
                $vendor_amount_m = floatval($unit_price_month - ($gst_m + $commision_m))+ $vendor_amount_m;
                // $unit_price += $cart_value->unit_price;
            }}
            // print_r($unit_price_month);
            if($qry_monthly_count!=0){
            $this->data['monthly_average']=number_format(($unit_price_month)/$qry_monthly_count,2);
            }else{
                $this->data['monthly_average']="0";
            }

            if($unit_price_month!=0){
                $this->data['monthly_sales']=number_format(($unit_price_month),2);
            }
            else{
                $this->data['monthly_sales']=0;
            }
            // exit;die;
            $life_time_qry=$this->db->query("SELECT * FROM `orders` where order_status=2 and vendor_id='".$shop_id."'");
            $life_time_qry_count=$life_time_qry->num_rows();
            $lifetime=$life_time_qry->result();
            $unit_price_life=0;
            if($life_time_qry_count>0){
            foreach($lifetime as $vl) {
                $cart_qry_l = $this->db->query("SELECT * FROM cart WHERE session_id='" . $vl->session_id . "' AND vendor_id='" . $vl->vendor_id . "'");
                $cart_result_l = $cart_qry_l->result();
                
        
                foreach ($cart_result_l as $cart_value_l) {
                    $link_qry_l = $this->db->query("SELECT * FROM link_variant WHERE id='" . $cart_value_l->variant_id . "'");
                    $link_row_l = $link_qry_l->row();
        
                    $prod_qry_l = $this->db->query("SELECT * FROM products WHERE id='" . $link_row_l->product_id . "' and shop_id='".$shop_id."'");
                    $prod_row_l = $prod_qry_l->row();
        
                    $cat_id_l = $prod_row_l->cat_id;
                    $sub_cat_id_l = $prod_row_l->sub_cat_id;
        
                    $cat_qry_l = $this->db->query("SELECT * FROM categories WHERE id='" . $cat_id_l . "'");
                    $cat_row_l = $cat_qry_l->row();
        
                    $scat_qry_l = $this->db->query("SELECT * FROM sub_categories WHERE id='" . $sub_cat_id_l . "'");
                    $scat_row_l = $scat_qry_l->row();
        
                    $cart_vendor_id_l = $cart_value_l->vendor_id;
                    if ($sub_cat_id_l) {
                        $find_in_set_l = "AND find_in_set('" . $sub_cat_id_l . "',subcategory_ids)";
                    } else {
                        $find_in_set_l = "";
                    }
                    $adminc_qry_l = $this->db->query("SELECT * FROM admin_comissions WHERE shop_id='" . $cart_vendor_id_l . "' AND cat_id='" . $cat_id_l . "' " . $find_in_set_l . " ");
                    $adminc_row_l = $adminc_qry_l->row();
                    if ($adminc_row_l->admin_comission != '') {
                        $admin_comission_l = $adminc_row_l->admin_comission;
                    } else {
                        $admin_comission_l = 0;
                    }
                    $commision_l = floatval($cart_value_l->unit_price * $admin_comission_l) / 100;
                    $gst_l = ($adminc_row_l->gst * $commision_l) / 100;
                    $unit_price_life += $cart_value_l->unit_price;
                    // print_r($cart_value->unit_price);
                }
                $vendor_amount_l = floatval($unit_price_life - ($gst_l + $commision_l))+ $vendor_amount_l;
                // $unit_price += $cart_value->unit_price;
            }
            }
            if($life_time_qry_count!=0){
            $this->data['lifetime_average']=number_format(($unit_price_life)/$life_time_qry_count,2);
            }else{
                $this->data['lifetime_average']="0";
            }

            if($unit_price_life!=0){
                $this->data['lifetime_sales']=number_format(($unit_price_life),2);
            }
            else{
                $this->data['lifetime_sales']=0;
            }
        
        //print_r($today_orders);die;

        $pay = $this->db->query("select * from vendor_payements where vendor_id='".$shop_id."'");
        $payment = $pay->row();

        $rp = $this->db->query("select SUM(request_amount) as paid_amount from request_payment where vendor_id='".$shop_id."' and status=1 and payment_status='completed'");
        $rp_payment = $rp->row();

         $prod = $this->db->query("select * from products where shop_id='".$shop_id."'");
         $products = $prod->num_rows();

        // Convert string values to floats (assuming they represent numeric values)
        $total_payment = floatval($payment->total_payment);
        $paid_amount = floatval($rp_payment->paid_amount);

        // Perform the subtraction
        $pending = $total_payment - $paid_amount;

         $this->data['shop_id']=$shop_id;
         $this->data['total_category'] = $category;
         $this->data['today_orders'] = $today_orders;

         $this->data['total_payment'] = $payment->total_payment;
          $this->data['pending'] = $pending;

        $this->data['count_today_orders'] = sizeof($today_orders);
        
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/home', $this->data);
        $this->load->view('vendors/includes/footer');
    }

}
