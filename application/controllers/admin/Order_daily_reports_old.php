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
        $this->load->model("admin_model");
    }

    function index() {

        $this->data['page_name'] = 'vendors_shops';
        $this->data['title'] = 'Vendors/Shops';
        $qry = $this->db->query("SELECT * FROM `orders` where order_status=5");
        $this->data['orders_commission'] = $qry->result();

       
        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/order_daily_reports', $this->data);

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
        $qry = $this->db->query("select * from orders where order_status=5 and created_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $data['orders_commission'] = $qry->result();
        
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/order_daily_reports', $this->data);
        $this->load->view('admin/includes/footer');
    }







}

