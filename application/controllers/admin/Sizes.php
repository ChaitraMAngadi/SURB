<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sizes extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
    }

    function index() {
        $this->data['title'] = 'Sizes';
        $this->db->order_by('id', 'desc');
        $this->data['sizes'] = $this->db->get('attr_sizes')->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/sizes', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add($size_id = null) {
        if ($size_id) {
            $this->db->where('id', $size_id);
            $this->data['size'] = $this->db->get('attr_sizes')->row();
            $this->data['title'] = 'Update Size';
        } else {
            $this->data['title'] = 'Add Size';
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_size', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert() {
        $size = $this->input->get_post('size');
        $status = $this->input->get_post('status');

        $size_id = $this->input->get_post('size_id');
        if (!$size_id) {
            $data = array(
                'size' => $size,
                'status' => $status,
                'created_at' => time()
            );

            $insert_query = $this->db->insert('attr_sizes', $data);
            if ($insert_query) {
                redirect('admin/sizes');
                die();
            } else {
                redirect('admin/sizes/add');
                die();
            }
        } else {
            $data = array(
                'size' => $size,
                'status' => $status
            );
            $this->db->where('id', $size_id);
            $insert_query = $this->db->update('attr_sizes', $data);
            if ($insert_query) {
                redirect('admin/sizes');
                die();
            } else {
                redirect('admin/sizes/add/' . $size_id);
                die();
            }
        }
    }

}
