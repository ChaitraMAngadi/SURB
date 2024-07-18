<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        $this->data['title'] = 'Brands';
        $this->db->order_by('id', 'desc');
        $this->data['brands'] = $this->db->get('attr_brands')->result();

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/brands', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function add($brand_id = null) {
        if ($brand_id) {
            $this->db->where('id', $brand_id);
            $this->data['brand'] = $this->db->get('attr_brands')->row();
            $this->data['title'] = 'Update Brand';
        } else {
            $this->data['title'] = 'Add Brand';
        }

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_brand', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert() {
        $brand_name = $this->input->get_post('brand_name');
        $status = $this->input->get_post('status');

        $brand_id = $this->input->get_post('brand_id');
        if (!$brand_id) {
            $data = array(
                'brand_name' => $brand_name,
                'status' => $status,
                'created_at' => time()
            );

            $insert_query = $this->db->insert('attr_brands', $data);
            if ($insert_query) {
                redirect('vendors/brands');
                die();
            } else {
                redirect('vendors/brands/add');
                die();
            }
        } else {
            $data = array(
                'brand_name' => $brand_name,
                'status' => $status,
            );
            $this->db->where('id', $brand_id);
            $insert_query = $this->db->update('attr_brands', $data);
            if ($insert_query) {
                redirect('vendors/brands');
                die();
            } else {
                redirect('vendors/brands/add/' . $brand_id);
                die();
            }
        }
    }

}
