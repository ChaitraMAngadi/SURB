<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Locations'); 
        $query = $this->db->get('features');
        $feature = $query->row();
        $role_name = $this->session->userdata('admin_login')['role_name'];
        if ($feature && $feature->status == 0) {
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
           redirect($redirect_url);
            exit(); // Stop further execution
        }

        $features = $this->session->userdata('admin_login')['features'];
        if (!in_array('Locations', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'locations';
        $this->data['title'] = 'Areas';
        $this->data['show'] = 'true';
        $qry = $this->db->query("select * from areas order by id desc");
        $this->data['locations'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/locations', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add() {


        $this->data['page_name'] = 'locations';
        $this->data['title'] = 'Add Area';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_location', $this->data);
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

    function getpincodes() {
        $city_id = $this->input->post('city_id');
        $this->db->where('city_id', $city_id);
        $query = $this->db->get('pincodes');
        $output = '<option value="">Select Pincode</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->pincode . '">' . $row->pincode . '</option>';
        }
        print_r($output);
        exit;
    }

    function insert() {
        //$shop_id = $this->input->get_post('vendor_id'); 
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');

        $pincode_id = $this->input->get_post('pincode_id');
        $area = $this->input->get_post('area');
        $status = $this->input->get_post('status');

        $chk = $this->db->where('area', trim($area))->get('areas')->num_rows();
        if ($chk > 0) {
            $this->session->set_tempdata('error_message', 'Area already exists',3);
            redirect('admin/locations/add');
            die();
        } else {
            $data = array(
                'state_id' => $state_id,
                'city_id' => $city_id,
                'pincode' => $pincode_id,
                'area' => $area,
                'status' => $status
            );

            $insert_query = $this->db->insert('areas', $data);
            if ($insert_query) {
                $this->session->set_tempdata('success_message', 'Area Added Successfully',3);
                redirect('admin/locations');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong',3);
                redirect('admin/locations/add');
                die();
            }
        }
    }

    function update() {
        $id = $this->input->get_post('lid');
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');

        $pincode_id = $this->input->get_post('pincode_id');
        $area = $this->input->get_post('area');
        $status = $this->input->get_post('status');

        $chk = $this->db->where(['area' => trim($area), 'id !=' => $id])->get('areas')->num_rows();
        if ($chk > 0) {
            $this->session->set_tempdata('error_message', 'Area already exists',3);
            redirect('admin/locations/edit/' . $id);
            die();
        } else {
            $data = array(
                'state_id' => $state_id,
                'city_id' => $city_id,
                'pincode' => $pincode_id,
                'area' => $area,
                'status' => $status
            );
            $wr = array('id' => $id);
            $insert_query = $this->db->update('areas', $data, $wr);
            if ($insert_query) {
                $this->session->set_tempdata('success_message', 'Location Updated Successfully',3);
                redirect('admin/locations');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong',3);
                redirect('admin/locations/edit/' . $id);
                die();
            }
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('areas')) {
            $this->session->set_tempdata('success_message', 'Location Deleted Successfully',3);
            redirect('admin/locations');
        } else {
            $this->session->set_tempdata('error_message', 'Unable to delete',3);
            redirect('admin/locations');
        }
    }

    function edit($id) {
        $qry = $this->db->query("select * from areas where id='" . $id . "'");
        $this->data['location'] = $qry->row();
        $this->data['title'] = 'Edit Area';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/edit_location', $this->data);
        $this->load->view('admin/includes/footer');
    }

}
