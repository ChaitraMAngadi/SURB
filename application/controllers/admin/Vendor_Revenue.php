<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_Revenue extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
         // Initialize $data array
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            redirect('admin/login');
        }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'vendors_Revenue';

        // Fetch data from vendor_shop table
        $qry = $this->db->get('vendor_shop');
        if ($qry->num_rows() > 0) {
            $vendor_revenue = $qry->result();
            foreach ($vendor_revenue as $vendor) {
                // Process each vendor's orders and revenue details
                $this->process_vendor_revenue($vendor);
            }
            $this->data['vendor_revenue'] = $vendor_revenue;
        } else {
            $this->data['vendor_revenue'] = [];
        }

        // Load views
        $this->load->view('admin/includes/header', $this->data);  // Load header
        $this->load->view('admin/vendor_revenue', $this->data);  // Load the view
        $this->load->view('admin/includes/footer');  // Load footer
    }

    function process_vendor_revenue(&$vendor) {

        // Fetch and calculate admin commission
        $this->db->select_sum('admin_commission');
        $this->db->where('vendor_id', $vendor->id);
        $qry = $this->db->get('orders');
        $admin_commission = $qry->row()->admin_commission ?? 0;

        // Calculate GST
        $gst = $admin_commission * 0.18;

        // Fetch and calculate vendor commission
        $this->db->select_sum('vendor_commission');
        $this->db->where('vendor_id', $vendor->id);
        $qry = $this->db->get('orders');
        $vendor_commission = $qry->row()->vendor_commission ?? 0;

        // Fetch and calculate total vendor revenue
        $this->db->select_sum('sub_total');
        $this->db->where('vendor_id', $vendor->id);
        $qry = $this->db->get('orders');
        $total_vendor_revenue = $qry->row()->sub_total ?? 0;

        // Fetch and calculate deliveryboy commission
        $this->db->select_sum('deliveryboy_commission');
        $this->db->where('vendor_id', $vendor->id);
        $qry = $this->db->get('orders');
        $deliveryboy_commission = $qry->row()->deliveryboy_commission ?? 0;

        // Fetch ship_cost
        $this->db->select('delivery_partner');
        $this->db->where('id', $vendor->id);
        $qry = $this->db->get('vendor_shop');
        $order_details = $qry->row();
        $delivery_partner = $order_details->delivery_partner ?? '';

        // Calculate total payouts
        if ($delivery_partner == 'self') {
            $total_payouts = $total_vendor_revenue - $gst - $admin_commission + $deliveryboy_commission;
        } else {
            $total_payouts = $total_vendor_revenue - $gst - $admin_commission;
        }

        $this->db->select('requested_amount');
        $this->db->where('vendor_id', $vendor->id);
        $qry = $this->db->get('vendor_payements');
        $payouts = $qry->row()->requested_amount ?? 0;



        // Add the revenue details to the vendor object
        $vendor->admin_commission = (float)$admin_commission;
        $vendor->gst = (float)$gst;
        $vendor->vendor_commission = (float)$vendor_commission;
        $vendor->total_vendor_revenue = (float)$total_vendor_revenue;
        $vendor->deliveryboy_commission = (float)$deliveryboy_commission;
        $vendor->total_payouts = (float)$total_payouts;
        $vendor->delivery_partner = $delivery_partner;
        $vendor->payouts=(float)$payouts;
    }
}
?>
