<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->data['shop_id'] = $_SESSION['vendors']['vendor_id'];
        $this->load->model('vendor_model');
    }

    
    function index() {
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $this->data['page_name'] = 'categories';
        $this->data['title'] = 'Categories';

        $qry = $this->db->query("select * from admin_comissions where shop_id='" . $shop_id . "' and status=1");
        $this->data['categories'] = $qry->result();

        foreach ($this->data['categories'] as $cat) {
            $this->db->where('cat_id', $cat->id);
            $subcatRow = $this->db->get('sub_categories')->result();
            if ($subcatRow) {
                $cat->sub_categories = $subcatRow;
            } else {
                $cat->sub_categories = array();
            }
        }
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/categories', $this->data);
        $this->load->view('vendors/includes/footer');
    }
    
    function add() {
        $this->data['title'] = 'Add Category';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_category', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert() {
        $category_name = $this->input->get_post('category_name');
        $description = $this->input->get_post('description');
        $status = $this->input->get_post('status');

        $config['upload_path'] = './uploads/categories/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);
//        if ($this->upload->do_upload('image')) {
//            $imageDetailArray = $this->upload->data();
//            $image_name = $imageDetailArray['file_name'];
//        } else {
//            $image_name = '';
//        }
        if ($this->upload->do_upload('app_image')) {
            $imageDetailArray2 = $this->upload->data();
            $app_image_name = $imageDetailArray2['file_name'];
        } else {
            $app_image_name = NULL;
        }
        $data = array(
            'category_name' => $category_name,
            'description' => $description,
            'status' => $status,
            'created_at' => time(),
            'app_image' => $app_image_name
        );
        $insert_query = $this->db->insert('categories', $data);
        if ($insert_query) {
            redirect('vendors/categories');
            die();
        } else {
            redirect('vendors/categories/add');
            die();
        }
    }

    function edit_category($cat_id) {
        $this->data['title'] = 'Edit Category';
        $this->data['category'] = $this->db->get_where('categories', ['id' => $cat_id])->row();
        $this->load->view('vendors/includes/header');
        $this->load->view('vendors/edit_category', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function update() {
        $cat_id = $this->input->get_post('cat_id');
        $category_name = $this->input->get_post('category_name');
        $description = $this->input->get_post('description');
        $status = $this->input->get_post('status');

        $data = array(
            'category_name' => $category_name,
            'description' => $description,
            'status' => $status,
            'updated_at' => time(),
        );
        if (isset($_FILES['app_image']['name']) && !empty($_FILES['app_image']['name'])) {
            $config['upload_path'] = './uploads/categories/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 5000;
            $config['max_width'] = 3000;
            $config['max_height'] = 3000;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('app_image')) {
                $imageDetailArray2 = $this->upload->data();
                $app_image_name = $imageDetailArray2['file_name'];
            } else {
                $app_image_name = NULL;
            }
            $data['app_image'] = $app_image_name;
        }
        $this->db->where('id', $cat_id);
        $update_query = $this->db->update('categories', $data);
        if ($update_query) {
            redirect('vendors/categories');
            die();
        } else {
            redirect('vendors/categories/edit_category/' . $cat_id);
            die();
        }
    }

    function delete($cat_id) {
        $this->db->where('cat_id', $cat_id);
        $subcatFound = $this->db->get('sub_categories')->result();
        if (count($subcatFound) > 0) {
            $this->session->set_tempdata('error_message', 'Some subcategories are assigned, Unable to delete',3);
            redirect('vendors/categories');
        } else {
            $this->db->where('id', $cat_id);
            if ($this->db->delete('categories')) {
                $this->session->set_tempdata('success_message', 'Category Deleted Successfully',3);
                redirect('vendors/categories');
            } else {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('vendors/categories');
            }
        }
    }

    function viewsubCategory($catid) {
        $shop_id = $this->data['shop_id'];
        $admin_comission = $this->common_model->get_data_row(['cat_id' => $catid, 'shop_id' => $shop_id, 'status' => 1], 'admin_comissions');
        $admin_comission->subcategory_ids = explode(',', $admin_comission->subcategory_ids);
        
        $this->data['admin_comission'] = $admin_comission;

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/sub_categories', $this->data);
        $this->load->view('vendors/includes/footer');
    }

}
