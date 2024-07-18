<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_categories extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() {
        $this->data['title'] = 'Sub Categories';
//        $this->db->order_by('id', 'desc');
//        $this->data['categories'] = $this->db->get('categories')->result();
        $this->data['sub_categories'] = $this->db->query('SELECT subcat.*, cat.category_name FROM sub_categories subcat INNER JOIN categories cat ON cat.id = subcat.cat_id order by subcat.id desc')->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/sub_categories', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function add() {
        $this->data['title'] = 'Add Sub Category';
        $this->data['categories'] = $this->db->get('categories')->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_sub_category', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert() {
        $sub_category_name = $this->input->get_post('sub_category_name');
        $description = $this->input->get_post('description');
        $status = $this->input->get_post('status');
        $cat_id = $this->input->get_post('cat_id');

        $config['upload_path'] = './uploads/sub_categories/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5000;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;

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
            $app_image_name = 'no';
        }
        $data = array(
            'sub_category_name' => $sub_category_name,
            'description' => $description,
            'cat_id' => $cat_id,
            'status' => $status,
            'created_at' => time(),
            'app_image' => $app_image_name
        );
        $insert_query = $this->db->insert('sub_categories', $data);
        if ($insert_query) {
            redirect('vendors/sub_categories');
            die();
        } else {
            redirect('vendors/sub_categories/add');
            die();
        }
    }

    function edit_subcategory($sub_catid) {
        $this->data['title'] = 'Edit Sub Category';
        $this->data['categories'] = $this->db->get('categories')->result();
        $this->data['sub_category'] = $this->db->get_where('sub_categories', ['id' => $sub_catid])->row();
        $this->load->view('vendors/includes/header');
        $this->load->view('vendors/edit_sub_category', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function update() {
        $cat_id = $this->input->get_post('cat_id');
        $sub_cat_id = $this->input->get_post('sub_cat_id');
        $sub_category_name = $this->input->get_post('sub_category_name');
        $description = $this->input->get_post('description');
        $status = $this->input->get_post('status');

        $data = array(
            'sub_category_name' => $sub_category_name,
            'description' => $description,
            'cat_id' => $cat_id,
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
            redirect('vendors/sub_categories');
            die();
        } else {
            redirect('vendors/sub_categories/edit_subcategory/' . $sub_cat_id);
            die();
        }
    }

    function delete($subcat_id) {
        $this->db->where('id', $subcat_id);
        if ($this->db->delete('sub_categories')) {
            $this->session->set_tempdata('success_message', 'Sub Category Deleted Successfully',3);
            redirect('vendors/sub_categories');
        } else {
            $this->session->set_tempdata('error_message', 'Unable to delete',3);
            redirect('vendors/sub_categories');
        }
    }


    function viewProducts($cat,$subcat)
    {
        //$this->data['page_name'] = 'products';
        $shop_id = $_SESSION['vendors']['vendor_id'];

            $qry = $this->db->query("select * from products where cat_id='".$cat."' and sub_cat_id='".$subcat."' and shop_id='".$shop_id."'");
            $data = $qry->result();
            foreach ($data as $value) 
            {
                $cat = $this->db->query("select * from categories where id='".$value->cat_id."'");
                $category = $cat->row();
                $value->category_name=$category->category_name;

                $scat = $this->db->query("select * from sub_categories where id='".$value->sub_cat_id."'");
                $subcategory = $scat->row();
                $value->sub_category_name=$subcategory->sub_category_name;

                $shop = $this->db->query("select * from vendor_shop where id='".$value->shop_id."'");
                $shops = $shop->row();
                $value->shop_name=$shops->shop_name;
            }
        $this->data['products'] = $data;

        $shop1 = $this->db->query("select * from vendor_shop where id='".$shop_id."'");
        $shops1 = $shop1->row();

        $this->data['title'] = $shops1->shop_name;
        $this->data['back1'] = 'button1';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/products', $this->data);
        $this->load->view('vendors/includes/footer');
    }

}
