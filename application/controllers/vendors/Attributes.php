<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes extends CI_Controller {
//    echo "Hello "; die;
    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
    }

    function index() {
        echo "hii"; die;
        $this->data['title'] = 'Attributes';
        $this->db->order_by('id', 'desc');
        $this->data['colors'] = $this->db->get('attr_colors')->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/attributes', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add($color_id = null) {
        if ($color_id) {
            $this->db->where('id', $color_id);
            $this->data['color'] = $this->db->get('attr_colors')->row();
            $this->data['title'] = 'Update Color';
        } else {
            $this->data['title'] = 'Add Color';
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_color', $this->data);
        $this->load->view('admin/includes/footer');
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
                redirect('admin/colors');
                die();
            } else {
                redirect('admin/colors/add');
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
                redirect('admin/colors');
                die();
            } else {
                redirect('admin/colors/add/' . $color_id);
                die();
            }
        }
    }

}
