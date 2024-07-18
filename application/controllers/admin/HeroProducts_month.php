<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HeroProducts_month extends MY_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');
        }
        $this->db->where('name', 'Hero_Products');
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
        if (!in_array('Hero_Products', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        // $this->db->where('name', 'Hero_Products');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'HeroProducts_month';
        $this->data['title'] = 'HeroProducts_month';
        $end_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime('-1 month', strtotime($end_date)));
        $qry = $this->db->query("SELECT o.*, 
        p.id AS product_id, 
        p.name AS product_name, 
        total_quantity
 FROM orders o
 INNER JOIN (
     SELECT ci.variant_id, ci.session_id,
            SUM(ci.quantity) AS total_quantity
     FROM cart ci
     INNER JOIN link_variant lv ON ci.variant_id = lv.id
     GROUP BY ci.variant_id, ci.session_id
 ) AS quantities ON quantities.session_id = o.session_id
 INNER JOIN link_variant lv ON quantities.variant_id = lv.id
 INNER JOIN products p ON lv.product_id = p.id
 WHERE o.order_status = 2
   AND o.order_date BETWEEN '$start_date' AND '$end_date'
 ORDER BY total_quantity DESC 
 LIMIT 10
 
 ");
        $result = $qry->result();

      
        
        
        $this->data['orders']=$qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/HeroProducts_month', $this->data);
        $this->load->view('admin/includes/footer');
    }

   

    

}
