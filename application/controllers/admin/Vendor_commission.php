<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Vendor_commission extends MY_Controller {
    public $data;
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->load->model("admin_model");
    }

    function index() {

        $this->data['page_name'] = 'vendors_shops';
        $this->data['title'] = 'Vendors/Shops';
        $qry = $this->db->query("SELECT *,SUM(vendor_commission) as tvendorc FROM `orders` where order_status=5 group by vendor_id");
        $this->data['vendor_commissions'] = $qry->result();

       
        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendor_commission', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function categoryDetails($vendor_id) {

        $this->data['page_name'] = 'vendors_shops';
        $this->data['title'] = 'Vendors/Shops';
        $qry = $this->db->query("SELECT * FROM `orders` where vendor_id='".$vendor_id."' and order_status=5");
        $this->data['orders_commission'] = $qry->result();

       
        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/categorywise_report', $this->data);

        $this->load->view('admin/includes/footer');
    }





}

