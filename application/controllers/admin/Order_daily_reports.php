<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Order_daily_reports extends MY_Controller {
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






        $this->load->model("admin_model");
    }

    function index() {

        $this->data['page_name'] = 'order_daily_reports';
        $this->data['title'] = 'Daily Reports';
        $start_date = date('Y-m-d');
        // $end_date = date('Y-m-d',strtotime($start_date."-1 days"));
        // $strtime = strtotime($end_date);
        // pr($start_date);
        $qry = $this->db->query("SELECT * 
        FROM `orders` 
        WHERE order_status=2 and
        order_date = '".$start_date."'
        ORDER BY id DESC");
        $this->data['orders_commission'] = $qry->result();
        $current_date = date('Y-m-d');

        $query = $this->db->query("SELECT COUNT(*) AS Count FROM orders WHERE order_status=2 
        and DATE(order_date) = '".$current_date."' ORDER BY id DESC");
         $total_sales_query=$this->db->query("SELECT  c.unit_price
         FROM orders o
         INNER JOIN cart c ON o.session_id = c.session_id 
         WHERE o.order_status = 2  and o.user_id = c.user_id
             AND o.order_date ='".$current_date."'
         ");
         $total_sales_query_res=$total_sales_query->result();
         $total_sales=0;
         foreach($total_sales_query_res as $sale){
             $total_sales += $sale->unit_price;
         }
         $query_result=$query->row();
         // $this->data['salesData']=$query_result;
         $order_count= $query_result->Count;
        //  $this->data['salesData']["$current_date"] = $order_count;
         $sum_query="
         SELECT SUM(c.unit_price) as unit_price
         FROM orders o
         INNER JOIN cart c ON o.session_id = c.session_id 
         WHERE o.order_status = 2  and o.user_id = c.user_id
             AND o.order_date ='".$current_date."'
         ";

         $sum_query_res=$this->db->query($sum_query)->row();
         
        //  $order_count = $result->Count;
         $total_sale=$sum_query_res->unit_price;
        

     
         // Add the count of orders to the salesData array for the current day
         $this->data['salesData'][$current_date] = array(
             'order_count' => $order_count,
             'total_sale' => $total_sale
         );
         
         $this->data['total_sales']=$total_sales;
        // print_r($this->db->last_query()); die;
       
        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/order_daily_reports', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function datewiseReport()
    {
        $this->data['page_name'] = 'order_daily_reports';
        $this->data['title'] = 'Daily Reports';
        $start_date = $this->input->get_post('start_date');
        //$start_date = date('Y-m-d', strtotime($start_date1. ' - 1 days'));
        $end_date1 = $this->input->get_post('end_date');
        $end_date = date('Y-m-d', strtotime($end_date1. ' + 1 days'));

        $data['start_date']=$start_date;
        $data['end_date']=$end_date1;
        $data['title'] = 'Date wise Orders';
        $qry = $this->db->query("select * from orders where  order_status=2 and order_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->data['orders_commission'] = $qry->result();
        $current_date = $start_date;
        $this->data['salesData'] = []; // Initialize salesData as an array
        // $this->data['total_sales']=[];

        $total_sales_query=$this->db->query("SELECT  c.unit_price
        FROM orders o
        INNER JOIN cart c ON o.session_id = c.session_id
        WHERE o.order_status = 2  and o.user_id = c.user_id
            AND o.order_date BETWEEN '".$start_date."' AND '".$end_date."'
        ");
        $total_sales_query_res=$total_sales_query->result();
        $total_sales=0;
        foreach($total_sales_query_res as $sale){
            $total_sales += $sale->unit_price;
        }
        $this->data['total_sales']=$total_sales;
        // echo "<pre>";
        // print_r($total_sales_query_res);
        // exit;

        while ($current_date <= $end_date) {
            // Execute the query to retrieve the count of orders for the current day
            $query = "SELECT COUNT(*) AS Count FROM orders WHERE order_status=2  and DATE(order_date) = '".$current_date."'";
            $result = $this->db->query($query)->row();

            $sum_query="
            SELECT  SUM(c.unit_price) as unit_price
            FROM orders o
            INNER JOIN cart c ON o.session_id = c.session_id 
            WHERE o.order_status = 2  and o.user_id = c.user_id
                AND o.order_date ='".$current_date."'";

            $sum_query_res=$this->db->query($sum_query)->row();
            
            $order_count = $result->Count;
            $total_sale=$sum_query_res->unit_price;
           

        
            // Add the count of orders to the salesData array for the current day
            $this->data['salesData'][$current_date] = array(
                'order_count' => $order_count,
                'total_sale' => $total_sale
            );
            
        
            // Move to the next day
            $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
        }
        
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/order_daily_reports', $this->data);
        $this->load->view('admin/includes/footer');
    }







}

