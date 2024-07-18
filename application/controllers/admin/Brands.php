<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends CI_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');
        }
        $this->db->where('name', 'Brands');
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
        if (!in_array('Brands', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }

        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'brands';
        $this->data['title'] = 'Brands';

        $this->db->order_by('id', 'desc');

        $this->data['brands'] = $this->db->get('attr_brands')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/brands', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function add($brand_id = null) {

        if ($brand_id) {

            $this->db->where('id', $brand_id);

            $this->data['brand'] = $this->db->get('attr_brands')->row();

            $this->data['title'] = 'Update Brand';
        } else {

            $this->data['title'] = 'Add Brand';
        }



        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_brand', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function insert() {

        $brand_name = $this->input->get_post('brand_name');

        $status = $this->input->get_post('status');

        $brand_id = $this->input->get_post('brand_id');

        if (!$brand_id) {

            $chk = $this->db->where('brand_name', trim($brand_name))->get('attr_brands')->num_rows();
            if ($chk > 0) {
                $this->session->set_tempdata('error_message', 'Brand already exists',3);
                redirect('admin/brands/add');
                die();
            } else {
                $data = array(
                    'brand_name' => $brand_name,
                    'status' => $status,
                    'created_at' => time()
                );

                $insert_query = $this->db->insert('attr_brands', $data);

                if ($insert_query) {
                    $this->session->set_tempdata('success_message', 'Brand Added Successfully',3);
                    redirect('admin/brands');
                    die();
                } else {
                    $this->session->set_tempdata('error_message', 'Something went wrong',3);
                    redirect('admin/brands/add');
                    die();
                }
            }
        } else {
            $chk = $this->db->where(['brand_name' => trim($brand_name), 'id !=' => $brand_id])->get('attr_brands')->num_rows();
            if ($chk > 0) {
                $this->session->set_tempdata('error_message', 'Brand already exists',3);
                redirect('admin/brands/add/' . $brand_id);
                die();
            } else {
                $data = array(
                    'brand_name' => $brand_name,
                    'status' => $status,
                );

                $this->db->where('id', $brand_id);

                $insert_query = $this->db->update('attr_brands', $data);

                if ($insert_query) {
                    $this->session->set_tempdata('success_message', 'Brand Updated Successfully',3);
                    redirect('admin/brands');
                    die();
                } else {
                    $this->session->set_tempdata('error_message', 'Something went wrong',3);
                    redirect('admin/brands/add/' . $brand_id);
                    die();
                }
            }
        }
    }

}
