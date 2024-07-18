<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pincodes extends MY_Controller {

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
        $this->data['page_name'] = 'pincodes';
        $this->data['show'] = 'true';
        $this->data['title'] = 'Pincodes';
        $qry = $this->db->query("select * from pincodes");
        $this->data['pincodes'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/pincodes', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add() {
        $this->data['page_name'] = 'pincodes';
        $this->data['title'] = 'Add Pincodes';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_pincode', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function getcities() {
        $state_id = $this->input->post('state_id');

        $this->db->where('state_id', $state_id);
        $query = $this->db->get('cities');
        $output = '<option value="">Select Cities</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->city_name . '</option>';
        }
        print_r($output);
        exit;
    }

    function insert() {

        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        $pincode = $this->input->get_post('pincode');
        $status = $this->input->get_post('status');

        $qry = $this->db->query("select * from pincodes where pincode='" . $pincode . "'");
        if ($qry->num_rows() > 0) {
            $this->session->set_tempdata('success_message', 'Pincode already added',3);
            redirect('admin/pincodes/add');
        } else {

            $data = array(
                'state_id' => $state_id,
                'city_id' => $city_id,
                'pincode' => $pincode,
                'status' => $status
            );
            $insert_query = $this->db->insert('pincodes', $data);
            if ($insert_query) {
                $this->session->set_tempdata('success_message', 'Pincode Added Successfully',3);
                redirect('admin/pincodes');
                die();
            } else {
                redirect('admin/pincodes/add');
                die();
            }
        }
    }

    function update() {
        $id = $this->input->get_post('lid');
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        $pincode = $this->input->get_post('pincode');
        $status = $this->input->get_post('status');
        $data = array(
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode,
            'status' => $status
        );
        $wr = array('id' => $id);
        $insert_query = $this->db->update('pincodes', $data, $wr);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Pincode Updated Successfully',3);
            redirect('admin/pincodes');
            die();
        } else {
            redirect('admin/pincodes/edit');
            die();
        }
    }

    function delete($id) {
        $pincode = $this->db->where('id', $id)->get('pincodes')->row()->pincode;

        $this->db->where('id', $id);
        $del = $this->db->delete('pincodes');
        //echo $this->db->last_query(); die;
        if ($del) {
            $this->db->delete('areas', array('pincode' => $pincode));
            $this->session->set_tempdata('success_message', 'Pincode Deleted Successfully',3);
            redirect('admin/pincodes');
        } else {
            $this->session->set_tempdata('error_message', 'Unable to delete',3);
            redirect('admin/pincodes');
        }
    }

    function edit($id) {
        $qry = $this->db->query("select * from pincodes where id='" . $id . "'");
        $this->data['location'] = $qry->row();
        $this->data['title'] = 'Edit City';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/edit_pincode', $this->data);
        $this->load->view('admin/includes/footer');
    }

}
