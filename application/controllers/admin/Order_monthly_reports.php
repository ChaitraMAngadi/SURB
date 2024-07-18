<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Order_monthly_reports extends MY_Controller {
    public $data;
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Sales_report');
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
        if (!in_array('Sales_report', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }

        // $this->db->where('name', 'Sales_report'); 
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }
        $this->load->model("admin_model");
    }

    function index() {

        $this->data['page_name'] = 'order_monthly_reports';
        $this->data['title'] = 'Monthly Reports';
        
          $start_date = date('Y-m-d');
          $end_date = date('Y-m-d',strtotime($start_date."-1 month "));
        
        $qry = $this->db->query("SELECT * FROM `orders` where order_status=2 and order_date between '".$end_date."' AND '".$start_date."'");
        $this->data['orders_commission'] = $qry->result();
        $this->data['salesData'] = [];

        // Loop through each day of the month
        $current_date = $end_date;
        while ($current_date <= $start_date) {
            // Query orders for the current day
            $query = "SELECT COUNT(*) AS order_count 
                      FROM orders 
                      WHERE order_status = 2 
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
            WHERE o.order_status = 2  and o.user_id = c.user_id
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
            and o.user_id= c.user_id 
            AND o.order_date between '".$end_date."' AND '".$start_date."'");
        $total_sales_query_res1=$total_sales_query1->result();
        $total_sales1=0;
        foreach($total_sales_query_res1 as $sale1){
            $total_sales1 += $sale1->unit_price;
        }
        $this->data['total_sales']=$total_sales1;
                //print_r($this->db->last_query()); die;

       
        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/order_monthly_reports', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function datewiseReport()
    {
        $start_date = $this->input->get_post('start_date');
        //$start_date = date('Y-m-d', strtotime($start_date1. ' - 1 days'));
        $end_date1 = $this->input->get_post('end_date');
        $end_date = date('Y-m-d', strtotime($end_date1. ' + 1 days'));
        
        $data['start_date']=$start_date;
        $data['end_date']=$end_date1;
        $data['title'] = 'Date wise Orders';
        $qry = $this->db->query("select * from orders where order_status=2 and order_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $data['orders_commission'] = $qry->result();

        $this->data['salesData'] = []; // Initialize sales data array

        $current_date = date('Y-m-01', strtotime($start_date));
        // $totalSales = 0; // Initialize total sales counter
        
        while ($current_date <= $end_date) {
            // Query orders for the current day
            $query = "SELECT COUNT(*) AS order_count 
                      FROM orders 
                      WHERE order_status = 2 
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
            WHERE o.order_status = 2  and o.user_id = c.user_id
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
                and o.user_id= c.user_id 
                AND o.order_date between '".$start_date."' AND '".$end_date."'");
            $total_sales_query_res=$total_sales_query->result();
            $total_sales=0;
            foreach($total_sales_query_res as $sale){
                $total_sales += $sale->unit_price;
            }
            $this->data['total_sales']=$total_sales;
        
        
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/order_monthly_reports', $this->data);
        $this->load->view('admin/includes/footer');
    }







}

