<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends MY_Controller {

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
        $this->data['page_name'] = 'cities';
        $this->data['title'] = 'Cities';
        $this->data['show'] = 'true';
        $qry = $this->db->query("select * from cities");
        $this->data['cities'] = $qry->result();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/cities', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add() {
        //$this->data['shop_id'] = $shop_id;
        $this->data['title'] = 'Add City';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_city', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function edit($id) {
        $qry = $this->db->query("select * from cities where id='" . $id . "'");
        $this->data['city_row'] = $qry->row();
        $this->data['title'] = 'Edit City';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/edit_city', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert() {
        // $shop_id = $this->input->get_post('shop_id');
        $state_id = $this->input->get_post('state_id');
        $city_name = $this->input->get_post('city_name');
        
        $chk = $this->db->where('city_name', trim($city_name))->get('cities')->num_rows();
        if ($chk > 0) {
            $this->session->set_tempdata('error_message', 'City already exists',3);
            redirect('admin/cities');
            die();
        } else {
            $data = array(
                'state_id' => $state_id,
                'city_name' => $city_name,
                'created_at' => time()
            );
            $insert_query = $this->db->insert('cities', $data);
            if ($insert_query) {
                $this->session->set_tempdata('success_message', 'City Added Successfully',3);
                redirect('admin/cities');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong',3);
                redirect('admin/cities/add');
                die();
            }
        }
    }

    function update() {
        // $shop_id = $this->input->get_post('shop_id');
        $id = $this->input->get_post('cid');
        $state_id = $this->input->get_post('state_id');
        $city_name = $this->input->get_post('city_name');

        $chk = $this->db->where(['city_name' => trim($city_name), 'id !=' => $id])->get('cities')->num_rows();
        if ($chk > 0) {
            $this->session->set_tempdata('error_message', 'City already exists',3);
            redirect('admin/cities/edit/' . $id);
            die();
        } else {
            $data = array(
                'state_id' => $state_id,
                'city_name' => $city_name,
                    //'vendor_id' => $shop_id
            );
            $wr = array('id' => $id);
            $insert_query = $this->db->update('cities', $data, $wr);
            if ($insert_query) {
                $this->session->set_tempdata('success_message', 'City Updated Successfully',3);
                redirect('admin/cities');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong',3);
                redirect('admin/cities/edit/' . $id);
                die();
            }
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('cities')) {
            $this->db->delete('pincodes', array('city_id' => $id));
            $this->db->delete('areas', array('city_id' => $id));
            $this->session->set_tempdata('success_message', 'City Deleted Successfully',3);
            redirect('admin/cities');
        } else {
            $this->session->set_tempdata('error_message', 'Unable to delete',3);
            redirect('admin/cities');
        }
    }

}
