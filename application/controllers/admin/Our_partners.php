<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Our_partners extends MY_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            redirect('admin/login');
        }
        $this->db->where('name', 'Partners');
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
        if (!in_array('Partners', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        
        // $this->db->where('name', 'Partners');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }
        $this->load->model("admin_model");
    }

    function index() {

        $this->data['page_name'] = 'our_partners';

        $this->data['title'] = 'Our Partners';
        $qry = $this->db->query("select * from our_partners");
        $this->data['our_partners'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/our_partners', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function add() {
        $this->data['title'] = 'Add Partners';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_partners', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert() {
        $status = $this->input->get_post('status');

        if (!empty($_FILES["image"]["name"])) {
            $image_new = "partner_" . date('YmdHis') . ".jpg";
            if (file_exists("./uploads/our_partners/" . $image_new)) {
                $image = $image_new;
            } else {
                move_uploaded_file($_FILES["image"]["tmp_name"], "./uploads/our_partners/" . $image_new);
                $image = $image_new;
            }
        } else {
            $image = "";
        }

        $data = array(
            'image' => $image,
            'status' => $status,
            'created_at' => time()
        );

        $insert_query = $this->db->insert('our_partners', $data);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Partner added Successfully',3);
            redirect('admin/our_partners');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something Went wrong',3);
            redirect('admin/our_partners/add');
            die();
        }
    }

    function edit($id) {
        $qry = $this->db->query("select * from our_partners where id='" . $id . "'");
        $this->data['our_partners'] = $qry->row();
        $this->data['title'] = 'Edit Partner';
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/edit_partners', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function update() {
        $id = $this->input->get_post('id');
        $status = $this->input->get_post('status');

        if (!empty($_FILES["image"]["name"])) {
            $image_new = "partner_" . date('YmdHis') . ".jpg";
            if (file_exists("./uploads/our_partners/" . $image_new)) {
                $image = $image_new;
            } else {
                move_uploaded_file($_FILES["image"]["tmp_name"], "./uploads/our_partners/" . $image_new);
                $image = $image_new;
            }
        } else {
            $image = "";
        }

        $data = array(
            'status' => $status,
            'updated_at' => time()
        );

        if ($image != null) {
            $data['image'] = $image;
        }

        $insert_query = $this->db->update('our_partners', $data, ['id' => $id]);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Partner updated Successfully',3);
            redirect('admin/our_partners');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something Went wrong',3);
            redirect('admin/our_partners/edit/' . $id);
            die();
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $dlt = $this->db->delete('our_partners');
        if ($dlt) {
            $this->session->set_tempdata('success_message', 'Partner Deleted Successfully',3);
            redirect('admin/our_partners');
        } else {
            $this->session->set_tempdata('error_message', 'Unable to delete',3);
            redirect('admin/our_partners');
        }
    }

}
