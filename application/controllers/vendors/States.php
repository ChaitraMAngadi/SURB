<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class States extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        $this->data['page_name'] = 'states';
        $this->data['title'] = 'States';
        $this->db->order_by('id', 'desc');
        $this->db->select('st.*, c.country_name');
        $this->db->from('states st');
        $this->db->join('countries c', 'c.id=st.country_id');
        $this->data['states'] = $this->db->get()->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/states', $this->data);
        $this->load->view('vendors/includes/footer');
    }

//    function add() {
//        $this->data['title'] = 'Add City';
//        $this->load->view('vendors/includes/header', $this->data);
//        $this->load->view('vendors/add_city', $this->data);
//        $this->load->view('vendors/includes/footer');
//    }
//
//    function insert() {
//        $city_name = $this->input->get_post('city_name');
//        $data = array(
//            'city_name' => $city_name,
//            'created_at' => time()
//        );
//        $insert_query = $this->db->insert('cities', $data);
//        if ($insert_query) {
//            redirect('vendors/cities');
//            die();
//        } else {
//            redirect('vendors/cities/add');
//            die();
//        }
//    }
//
//    function edit() {
//        $this->data['title'] = 'Edit Merchant';
//        $this->load->view('vendors/includes/header', $this->data);
//        $this->load->view('vendors/edit_visual_merchant', $this->data);
//        $this->load->view('vendors/includes/footer');
//    }
}
