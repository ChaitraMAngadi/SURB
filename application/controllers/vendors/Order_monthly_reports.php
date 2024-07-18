<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_monthly_reports extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->db->where('name', 'Sales_report');
        $query = $this->db->get('features');
        $feature = $query->row();
        if ($feature && $feature->status == 0) {
            redirect('vendors/dashboard');
            exit(); // Stop further execution
        }
        $this->load->model("vendor_model");
    }

    function index() {
        $vendor_id = $this->session->userdata('vendors')['vendor_id'];
        $this->data['page_name'] = 'order_monthly_reports';
        $this->data['title'] = 'Monthly Reports';

        $this->data['till'] = date('Y-m-d');
        $this->data['from'] = date('Y-m-d', strtotime($this->data['till'] . "-1 month "));

        if ($this->input->get()) {
            $start_date = $this->input->get_post('from_date');
            $end_date1 = $this->input->get_post('to_date');
            $end_date = date('Y-m-d', strtotime($end_date1 . ' + 1 days'));
            $this->data['filter_from_dt'] = $start_date;
            $this->data['filter_to_dt'] = $end_date1;
            // $qry = $this->db->query("SELECT * FROM `orders` where order_status=5 AND vendor_id='" . $vendor_id . "' AND created_date between '" . $start_date . "' AND '" . $end_date . "' order by id desc");
            $qry = $this->db->query("SELECT * FROM `orders` where  order_status=2 and vendor_id='" . $vendor_id . "' AND order_date between '" . $start_date . "' AND '" . $end_date . "' order by id desc");
            $this->data['salesData'] = []; // Initialize sales data array

            $current_date = date('Y-m-01', strtotime($start_date));
            // $totalSales = 0; // Initialize total sales counter
            
            while ($current_date <= $end_date) {
                // Query orders for the current day
                $query = "SELECT COUNT(*) AS order_count 
                          FROM orders 
                          WHERE order_status = 2 and vendor_id='$vendor_id'
                          AND DATE(order_date) = '$current_date'";
                $result = $this->db->query($query)->row();
                
                // Get the count of orders for the current day
                $order_count = $result->order_count;
            
                // Add the count of orders to the salesData array for the current day
                // $this->data['salesData'][$current_date] = $order_count;
                $sum_query="
SELECT  SUM(c.unit_price) as unit_price
FROM orders o
INNER JOIN cart c ON o.session_id = c.session_id
WHERE o.order_status = 2 
    AND o.vendor_id = '".$vendor_id."' AND o.user_id =c.user_id and o.vendor_id = c.vendor_id
    AND o.order_date ='".$current_date."'";

$sum_query_res=$this->db->query($sum_query)->row();

// $order_count = $result->order_count;
$total_sale=$sum_query_res->unit_price;



// Add the count of orders to the salesData array for the current day
$this->data['salesData'][$current_date] = array(
    'order_count' => $order_count,
    'total_sale' => $total_sale
);
            
                // Move to the next day
                $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
            }
            
            
            $total_sales_query=$this->db->query("SELECT  c.unit_price
            FROM orders o
            INNER JOIN cart c ON o.session_id = c.session_id
            WHERE o.order_status = 2 
                AND o.vendor_id = '".$vendor_id."' and o.user_id= c.user_id and o.vendor_id=c.vendor_id
                AND o.order_date between '".$start_date."' AND '".$end_date."'");
            $total_sales_query_res=$total_sales_query->result();
            $total_sales=0;
            foreach($total_sales_query_res as $sale){
                $total_sales += $sale->unit_price;
            }
            $this->data['total_sales']=$total_sales;
        } else {
            
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime($start_date . "-1 month "));
            $qry = $this->db->query("SELECT * FROM `orders` where  order_status=2 and vendor_id='" . $vendor_id . "' AND order_date between '" . $end_date . "' AND '" . $start_date. "' order by id desc");
            $current_date = $end_date;
        while ($current_date <= $start_date) {
            // Execute the query to retrieve the count of orders for the current day
            $query = "SELECT COUNT(*) AS Count FROM orders WHERE order_status=2 and vendor_id ='".$vendor_id."' and DATE(order_date) = '".$current_date."'";
            $result = $this->db->query($query)->row();

           
            
            $order_count = $result->Count;
           

        
            // Add the count of orders to the salesData array for the current day
            // $this->data['salesData'][$current_date] = $order_count;
            $sum_query="
SELECT  SUM(c.unit_price) as unit_price
FROM orders o
INNER JOIN cart c ON o.session_id = c.session_id
WHERE o.order_status = 2 
    AND o.vendor_id = '".$vendor_id."' AND o.user_id =c.user_id and o.vendor_id = c.vendor_id
    AND o.order_date ='".$current_date."'";

$sum_query_res=$this->db->query($sum_query)->row();

// $order_count = $result->order_count;
$total_sale=$sum_query_res->unit_price;



// Add the count of orders to the salesData array for the current day
$this->data['salesData'][$current_date] = array(
    'order_count' => $order_count,
    'total_sale' => $total_sale
);
           
        
            // Move to the next day
            $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
        }
            $total_sales_query1=$this->db->query("SELECT  c.unit_price
            FROM orders o
            INNER JOIN cart c ON o.session_id = c.session_id
            WHERE o.order_status = 2 
                AND o.vendor_id = '".$vendor_id."' and o.user_id= c.user_id and o.vendor_id=c.vendor_id
                AND o.order_date between '".$end_date."' AND '".$start_date."'");
            $total_sales_query_res1=$total_sales_query1->result();
            $total_sales1=0;
            foreach($total_sales_query_res1 as $sale1){
                $total_sales1 += $sale1->unit_price;
            }
            $this->data['total_sales']=$total_sales1;
        }

        $this->data['orders_commission'] = $qry->result();
        $this->data['vendor_id']=$vendor_id;

    
        //print_r($this->db->last_query()); die;


        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/order_monthly_reports', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function datewiseReport() {
        $vendor_id = $this->session->userdata('vendors')['vendor_id'];
        $start_date = $this->input->get_post('start_date');
        //$start_date = date('Y-m-d', strtotime($start_date1. ' - 1 days'));
        $end_date1 = $this->input->get_post('end_date');
        $end_date = date('Y-m-d', strtotime($end_date1 . ' + 1 days'));

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date1;
        $data['title'] = 'Date wise Orders';
        // $qry = $this->db->query("select * from orders where order_status=5 and vendor_id='" . $vendor_id . "' and created_date BETWEEN '" . $start_date . "' AND '" . $end_date . "'");
        $qry = $this->db->query("select * from orders where order_status=2 and vendor_id='" . $vendor_id . "' and order_date BETWEEN '" . $start_date . "' AND '" . $end_date . "'");
       
        $data['orders_commission'] = $qry->result();
        $this->data['vendor_id']=$vendor_id;
        $this->data['salesData'] = []; // Initialize sales data array

        $this->data['salesData'] = []; // Initialize sales data array

        $current_date = date('Y-m-01', strtotime($start_date));
        // $totalSales = 0; // Initialize total sales counter
        
        while ($current_date <= $end_date) {
            // Query orders for the current day
            $query = "SELECT COUNT(*) AS order_count 
                      FROM orders 
                      WHERE order_status = 2 and vendor_id='$vendor_id'
                      AND DATE(order_date) = '$current_date'";
            $result = $this->db->query($query)->row();
            
            // Get the count of orders for the current day
            $order_count = $result->order_count;
        
            // Add the count of orders to the salesData array for the current day
            // $this->data['salesData'][$current_date] = $order_count;
            $sum_query="
SELECT  SUM(c.unit_price) as unit_price
FROM orders o
INNER JOIN cart c ON o.session_id = c.session_id
WHERE o.order_status = 2 
    AND o.vendor_id = '".$vendor_id."' AND o.user_id =c.user_id and o.vendor_id = c.vendor_id
    AND o.order_date ='".$current_date."'";

$sum_query_res=$this->db->query($sum_query)->row();

// $order_count = $result->order_count;
$total_sale=$sum_query_res->unit_price;



// Add the count of orders to the salesData array for the current day
$this->data['salesData'][$current_date] = array(
    'order_count' => $order_count,
    'total_sale' => $total_sale
);
        
            // Move to the next day
            $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
        }
        
            
            $total_sales_query=$this->db->query("SELECT  c.unit_price
            FROM orders o
            INNER JOIN cart c ON o.session_id = c.session_id
            WHERE o.order_status = 2 
                AND o.vendor_id = '".$vendor_id."' and o.user_id= c.user_id and o.vendor_id=c.vendor_id
                AND o.order_date between '".$start_date."' AND '".$end_date."'");
            $total_sales_query_res=$total_sales_query->result();
            $total_sales=0;
            foreach($total_sales_query_res as $sale){
                $total_sales += $sale->unit_price;
            }
            $this->data['total_sales']=$total_sales;

        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/order_monthly_reports', $this->data);
        $this->load->view('vendors/includes/footer');
    }

}
