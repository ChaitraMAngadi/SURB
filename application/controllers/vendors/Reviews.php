<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        } 
        $this->db->where('name', 'Reviews');
        $query = $this->db->get('features');
        $feature = $query->row();
        if ($feature && $feature->status == 0) {
            redirect('vendors/dashboard');
            exit(); // Stop further execution
        }
        $this->load->model("vendor_model");
    }

    function index() {
        $vendor_id = $_SESSION['vendors']['vendor_id'];
        $this->data['page_name'] = 'reviews';
        //$qry = $this->db->query("select * from vendor_shop where id='".$_SESSION['vendors']['vendor_id']."'");
        //$data['settings'] = $qry->row();
        $data['reviews'] = $this->vendor_model->get_reviews($vendor_id);
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/reviews', $data);
        $this->load->view('vendors/includes/footer');
    }


}
