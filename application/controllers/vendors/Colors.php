<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Colors extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        $this->data['title'] = 'Colors';
        $this->db->order_by('id', 'desc');
        $this->data['colors'] = $this->db->get('attr_colors')->result();

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/colors', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function add($color_id = null) {
        if ($color_id) {
            $this->db->where('id', $color_id);
            $this->data['color'] = $this->db->get('attr_colors')->row();
            $this->data['title'] = 'Update Color';
        } else {
            $this->data['title'] = 'Add Color';
        }

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_color', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert() {
        $color_name = $this->input->get_post('color_name');
        $color_code = $this->input->get_post('color_code');
        $status = $this->input->get_post('status');

        $color_id = $this->input->get_post('color_id');
        if (!$color_id) {
            $data = array(
                'color_name' => $color_name,
                'color_code' => $color_code,
                'status' => $status,
                'created_at' => time()
            );

            $insert_query = $this->db->insert('attr_colors', $data);
            if ($insert_query) {
                redirect('vendors/colors');
                die();
            } else {
                redirect('vendors/colors/add');
                die();
            }
        } else {
            $data = array(
                'color_name' => $color_name,
                'color_code' => $color_code,
                'status' => $status,
            );
            $this->db->where('id', $color_id);
            $insert_query = $this->db->update('attr_colors', $data);
            if ($insert_query) {
                redirect('vendors/colors');
                die();
            } else {
                redirect('vendors/colors/add/' . $color_id);
                die();
            }
        }
    }

}
