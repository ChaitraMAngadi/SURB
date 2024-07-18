<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Order_weekly_reports extends MY_Controller {
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
        //print_r($vendor_id);die;
        $this->data['page_name'] = 'order_weekly_reports';
        $this->data['title'] = 'Weekly Reports';
        
        //   $start_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime('-1 day'));
          $end_date = date('Y-m-d',strtotime($start_date."-7 days"));
        
        // $qry = $this->db->query("SELECT * FROM `orders` where order_status=5 AND vendor_id='".$vendor_id."' AND created_date between '".$end_date."' AND '".$start_date."'");
        $qry = $this->db->query("SELECT * FROM `orders` where vendor_id='".$vendor_id."'  and order_status=2 and order_date between '".$end_date."' AND '".$start_date."'");
        $this->data['orders_commission'] = $qry->result();
        $this->data['vendor_id']=$vendor_id;
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

        $total_sales_query=$this->db->query("SELECT  c.unit_price
        FROM orders o
        INNER JOIN cart c ON o.session_id = c.session_id
        WHERE o.order_status = 2 
            AND o.vendor_id = '".$vendor_id."' AND o.user_id =c.user_id and o.vendor_id = c.vendor_id
            AND o.order_date between '".$end_date."' AND '".$start_date."'");
        $total_sales_query_res=$total_sales_query->result();
        $total_sales=0;
        foreach($total_sales_query_res as $sale){
            $total_sales += $sale->unit_price;
        }
        $this->data['total_sales']=$total_sales;
        // print_r($result);
        // exit;
                //print_r($this->db->last_query()); die;

       
        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/order_weekly_reports', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function datewiseReport() {
        $vendor_id = $this->session->userdata('vendors')['vendor_id'];
        $start_date = $this->input->get_post('start_date');
        $end_date1 = $this->input->get_post('end_date');
        $end_date = date('Y-m-d', strtotime($end_date1 . ' + 1 days'));
    
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date1;
        $data['title'] = 'Date wise Orders';
        $this->data['vendor_id']=$vendor_id;
        $total_sales_query=$this->db->query("SELECT  c.unit_price
        FROM orders o
        INNER JOIN cart c ON o.session_id = c.session_id
        WHERE o.order_status = 2 
            AND o.vendor_id = '".$vendor_id."' AND o.user_id =c.user_id and o.vendor_id = c.vendor_id
            AND o.order_date between '".$start_date."' AND '".$end_date."'");
        $total_sales_query_res=$total_sales_query->result();
        $total_sales=0;
        foreach($total_sales_query_res as $sale){
            $total_sales += $sale->unit_price;
        }
        $this->data['total_sales']=$total_sales;
        // Execute the query to retrieve orders within the specified date range
        $qry = $this->db->query("SELECT * FROM orders WHERE vendor_id='".$vendor_id."' and order_status=2 and order_date BETWEEN '".$start_date."' AND '".$end_date."'");
        

        // Set the current date to the start date
        $current_date = $start_date;
        
        while ($current_date <= $end_date) {
            // Determine the end of the current week (7 days later)
            $query = "SELECT COUNT(*) AS order_count 
            FROM orders 
            WHERE order_status = 2 and vendor_id='$vendor_id'
            AND order_date = '$current_date'";
  $result = $this->db->query($query)->row();
  
  // Add the count of orders to the salesData array for the current day
//   $data['salesData'][$current_date] = $result->order_count;
$sum_query="
SELECT  SUM(c.unit_price) as unit_price
FROM orders o
INNER JOIN cart c ON o.session_id = c.session_id
WHERE o.order_status = 2 
    AND o.vendor_id = '".$vendor_id."' AND o.user_id =c.user_id and o.vendor_id = c.vendor_id
    AND o.order_date ='".$current_date."'";

$sum_query_res=$this->db->query($sum_query)->row();

$order_count = $result->order_count;
$total_sale=$sum_query_res->unit_price;



// Add the count of orders to the salesData array for the current day
$this->data['salesData'][$current_date] = array(
    'order_count' => $order_count,
    'total_sale' => $total_sale
);
  
  // Move to the next day
  $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
        }
    
        // Check if the query was executed successfully
        if (!$qry) {
            // Handle database error
            $this->load->view('vendors/includes/header', $data);
            $this->load->view('vendors/order_weekly_reports', $this->data);
            $this->load->view('vendors/includes/footer');
            return;
        }
    
        // Check if there are any orders found
        if ($qry->num_rows() == 0) {
            // No orders found, handle accordingly
            $data['orders_commission'] = array(); // Set empty array if no orders found
        } else {
            // Orders found, load the view with the data
            $data['orders_commission'] = $qry->result();
        }
    
        // Load the view only once after all processing
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/order_weekly_reports', $this->data);
        $this->load->view('vendors/includes/footer');
    }
    
    


}

