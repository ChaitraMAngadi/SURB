<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_categories extends MY_Controller {

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
        $this->data['page_name'] = 'sub_categories';
        $this->data['title'] = 'Sub Categories';

//        $this->db->order_by('id', 'desc');
//        $this->data['categories'] = $this->db->get('categories')->result();

        $this->data['sub_categories'] = $this->db->query('SELECT subcat.*, cat.category_name FROM sub_categories subcat INNER JOIN categories cat ON cat.id = subcat.cat_id order by subcat.id desc')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/sub_categories', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function add() {

        $this->data['title'] = 'Add Sub Category';

        $this->data['categories'] = $this->db->where('status',1)->get('categories')->result();
        
        $this->data['cat_id'] = $this->input->get("cat_id");

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_sub_category', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function insert() {

        $sub_category_name = $this->input->get_post('sub_category_name');
        
        $seo_title = make_seo_url($sub_category_name);

        $description = $this->input->get_post('description');

        $status = $this->input->get_post('status');

        $cat_id = $this->input->get_post('cat_id');

        if ($this->input->get_post('brand') != '') {
            $brand = implode(',', $this->input->get_post('brand'));
        } else {
            $brand = '';
        }


        $config['upload_path'] = './uploads/sub_categories/';

        $config['allowed_types'] = 'gif|jpg|png';

        $config['max_size'] = 5000;

        $config['max_width'] = 5000;

        $config['max_height'] = 5000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $imageDetailArray = $this->upload->data();
            $image_name = $imageDetailArray['file_name'];
        } else {
            $image_name = '';
        }

        if ($this->upload->do_upload('app_image')) {

            $imageDetailArray2 = $this->upload->data();

            $app_image_name = $imageDetailArray2['file_name'];
        } else {

            $app_image_name = 'no';
        }

        $data = array(
            'sub_category_name' => $sub_category_name,
            'seo_url' => $seo_title,
            'description' => $description,
            'cat_id' => $cat_id,
            'brand' => $brand,
            'status' => $status,
            'created_at' => time(),
            'app_image' => $app_image_name
        );

        $insert_query = $this->db->insert('sub_categories', $data);

        if ($insert_query) {

            redirect('admin/sub_categories');

            die();
        } else {

            redirect('admin/sub_categories/add');

            die();
        }
    }

    function edit_subcategory($sub_catid) {

        $this->data['title'] = 'Edit Sub Category';

        $this->data['categories'] = $this->db->get('categories')->result();

        $this->data['sub_category'] = $this->db->get_where('sub_categories', ['id' => $sub_catid])->row();

        $this->load->view('admin/includes/header');

        $this->load->view('admin/edit_sub_category', $this->data);

        $this->load->view('admin/includes/footer');

    }

    function update() {

        $cat_id = $this->input->get_post('cat_id');

        $sub_cat_id = $this->input->get_post('sub_cat_id');

        $sub_category_name = $this->input->get_post('sub_category_name');
        
        $seo_title = make_seo_url($sub_category_name);

        $description = $this->input->get_post('description');

        $status = $this->input->get_post('status');

        // $brand = implode(',',$this->input->get_post('brand'));
        if ($this->input->get_post('brand') != '') {
            $brand = implode(',', $this->input->get_post('brand'));
        } else {
            $brand = '';
        }


        $data = array(
            'sub_category_name' => $sub_category_name,
            'seo_url' => $seo_title,
            'description' => $description,
            'cat_id' => $cat_id,
            'brand' => $brand,
            'status' => $status,
            'updated_at' => time(),
        );

        if (isset($_FILES['app_image']['name']) && !empty($_FILES['app_image']['name'])) {

            $config['upload_path'] = './uploads/sub_categories/';

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

        $this->db->where('id', $sub_cat_id);

        $update_query = $this->db->update('sub_categories', $data);

        if ($update_query) {

            redirect('admin/sub_categories');

            die();
        } else {

            redirect('admin/sub_categories/edit_subcategory/' . $sub_cat_id);

            die();
        }
    }

    function delete($subcat_id) {
        $check = $this->db->query("select * from products where sub_cat_id='" . $subcat_id . "'");

        if ($check->num_rows() > 0) {
            $this->session->set_tempdata('error_message', "Some products are assigned, Unable to delete",3);
            redirect('admin/sub_categories');
        } else {
            $this->db->where('id', $subcat_id);
            if ($this->db->delete('sub_categories')) {
                $this->session->set_tempdata('success_message', 'Sub Category Deleted Successfully',3);
                redirect('admin/sub_categories');
            } else {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('admin/sub_categories');
            }
        }
    }

}
