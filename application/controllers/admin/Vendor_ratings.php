<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class vendor_ratings extends MY_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');
        }
        $this->db->where('name', 'Performance'); 
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
        if (!in_array('Performance', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'vendor_ratings';
        $this->data['title'] = 'vendor_ratings';
    
        $vendor_qry = $this->db->query("
            SELECT vendor_id, product_id, AVG(review) AS average_rating
            FROM user_reviews
            WHERE vendor_id IS NOT NULL AND review > 0
            GROUP BY vendor_id
        ");
        $vendor_qry_res = $vendor_qry->result();
      
        
    
        
    
        $this->data['ratings'] = $vendor_qry_res;
        $this->load->view('admin/includes/header', $this->data);
        // var_dump($vendor_qry_res);
        // die();
        $this->load->view('admin/vendor_ratings', $this->data);
        $this->load->view('admin/includes/footer');
    }
    

   public function topsellingproducts($vendor_id){

            $top_selling_qry=$this->db->query("SELECT 
            o.vendor_id, 
            o.session_id, 
            o.order_status, 
            p.id,p.name
        FROM 
            orders o
        INNER JOIN 
            cart ci ON o.session_id = ci.session_id
        INNER JOIN 
            link_variant lv ON ci.variant_id = lv.id
        INNER JOIN 
            products p ON lv.product_id = p.id
        WHERE 
            o.vendor_id = '$vendor_id' 
            AND o.order_status = 2 
        GROUP BY 
            p.id");

            $top_selling_qry_res=$top_selling_qry->result();
            $this->data['top_selling'] = $top_selling_qry_res;
            
                $this->load->view('admin/includes/header', $this->data);
                $this->load->view('admin/top_selling_sku', $this->data);
                $this->load->view('admin/includes/footer');
     

   }

   public function numberOfOrders($vendor_id){
        $no_of_orders_qry=$this->db->query("SELECT vendor_id, DATE(order_date) AS order_day, COUNT(*) AS orders_count
        FROM orders where vendor_id='".$vendor_id."'
        GROUP BY vendor_id, order_day;
        ");

        $no_of_orders_qry_res=$no_of_orders_qry->result();

        $this->data['no_of_orders_day']=$no_of_orders_qry_res;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/number_of_orders', $this->data);
        $this->load->view('admin/includes/footer');


   }

//    function searchData(){

//     $this->data['page_name'] = 'search_data';
//     $this->data['title'] = 'search_data';
//     // $search_qry= $this->db->query("select * from search_keywords");
//     $search_qry=$this->db->query("SELECT keywords,search_results,created_at, COUNT(*) AS query_count
//     FROM search_keywords
//     GROUP BY keywords
//     ORDER BY created_at DESC
//     LIMIT 100");
//     $search_qry_res=$search_qry->result();

//     $this->data['Searchdata']=$search_qry_res;
//     $this->load->view('admin/includes/header', $this->data);
//     $this->load->view('admin/SearchData', $this->data);
//     $this->load->view('admin/includes/footer');



//    }

    

}
