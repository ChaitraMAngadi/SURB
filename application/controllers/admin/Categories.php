<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');
        }
        $this->db->where('name', 'Categories'); 
        $query = $this->db->get('features');
        $feature = $query->row();
        $role_name = $this->session->userdata('admin_login')['role_name'];
        if ($feature && $feature->status == 0) {
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
           redirect($redirect_url);
            exit();
        }
        
        $features = $this->session->userdata('admin_login')['features'];
        if (!in_array('Categories', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }
        $this->load->model("admin_model");
    }

    function changeSeoUrl() {
        $qry = $this->db->query("select * from categories");
        $results = $qry->result();
        foreach ($results as $value) {
            $title = $value->id . "-" . $value->category_name;
            $shop_name = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($title))));

            $this->db->update("categories", array('seo_url' => $shop_name), array('id' => $value->id));
        }
    }

    function index() {
        $this->changeSeoUrl();
        $this->data['page_name'] = 'categories';
        $this->data['title'] = 'Categories';

        $this->db->order_by('id', 'desc');

        $this->data['categories'] = $this->db->get('categories')->result();

        foreach ($this->data['categories'] as $cat) {

            $this->db->where('cat_id', $cat->id);

            $subcatRow = $this->db->get('sub_categories')->result();

            if ($subcatRow) {

                $cat->sub_categories = $subcatRow;
            } else {

                $cat->sub_categories = array();
            }

            $questionary = $this->db->where('cat_id', $cat->id)->get('questionaries')->result();
            $cat->other_msg_count = 0;
            foreach ($questionary as $quest) {
                $count_msg = $this->db->where('ques_id', $quest->id)->get('questionary_other_message')->num_rows();
                $cat->other_msg_count = $cat->other_msg_count + $count_msg;
            }
        }

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/categories', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function add() {

        $this->data['title'] = 'Add Category';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_category', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function insert() {

        $category_name = $this->input->get_post('category_name');

        $description = $this->input->get_post('description');

        $status = $this->input->get_post('status');
        $priority = $this->input->get_post('priority');

        /* $config['upload_path'] = './uploads/categories/';

          $config['allowed_types'] = 'gif|jpg|png';

          $config['max_size'] = 2000;

          $config['max_width'] = 1500;

          $config['max_height'] = 1500;

          $this->load->library('upload', $config);


          if ($this->upload->do_upload('app_image')) {

          $imageDetailArray2 = $this->upload->data();

          $app_image_name = $imageDetailArray2['file_name'];

          } else {

          $app_image_name = NULL;

          } */

        $chk = $this->db->like('category_name', $category_name)->get('categories')->num_rows();
        if ($chk == 0) {
            if (!empty($_FILES["app_image"]["name"])) {
                $img_k_image = "Category_" . $i . "_" . date('YmdHis') . ".jpg";
                if (file_exists("./uploads/categories/" . $img_k_image)) {
                    $k_image = $img_k_image;
                } else {
                    move_uploaded_file($_FILES["app_image"]["tmp_name"], "./uploads/categories/" . $img_k_image);
                    $k_image = $img_k_image;
                }
            } else {
                $k_image = "";
            }


            $data = array(
                'category_name' => $category_name,
                'description' => $description,
                'status' => $status,
                'created_at' => time(),
                'app_image' => $k_image,
                'priority' => $priority
            );

            $insert_query = $this->db->insert('categories', $data);

            if ($insert_query) {

                redirect('admin/categories');

                die();
            } else {

                redirect('admin/categories/add');

                die();
            }
        } else {
            $this->session->set_tempdata('error_message', "Category name already exists.",3);
            redirect('admin/categories/add');
        }
    }

    function edit_category($cat_id) {

        $this->data['title'] = 'Edit Category';

        $this->data['category'] = $this->db->get_where('categories', ['id' => $cat_id])->row();

        $this->load->view('admin/includes/header');

        $this->load->view('admin/edit_category', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function update() {

        $cat_id = $this->input->get_post('cat_id');

        $category_name = $this->input->get_post('category_name');

        $description = $this->input->get_post('description');

        $status = $this->input->get_post('status');

        $priority = $this->input->get_post('priority');

        $data = array(
            'category_name' => $category_name,
            'description' => $description,
            'status' => $status,
            'updated_at' => time(),
            'priority' => $priority
        );

        /* $config['upload_path'] = './uploads/categories/';

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

          } */
        $this->db->where('id !=', $cat_id);
        $chk = $this->db->where('category_name', $category_name)->get('categories')->num_rows();

        if ($chk == 0) {
            if (!empty($_FILES["app_image"]["name"])) {
                $img_k_image = "Category_" . date('YmdHis') . ".jpg";

                if (file_exists("./uploads/categories/" . $img_k_image)) {
                    $k_image = $img_k_image;
                } else {
                    move_uploaded_file($_FILES["app_image"]["tmp_name"], "./uploads/categories/" . $img_k_image);
                    $k_image = $img_k_image;
                }
                $data['app_image'] = $k_image;
                $this->db->where('id', $cat_id);
                $update_query = $this->db->update('categories', $data);
            } else {
                $this->db->where('id', $cat_id);
                $update_query = $this->db->update('categories', $data);
            }
            if ($update_query) {
                $this->session->set_tempdata('success_message', "Category updated successfully.",3);
                redirect('admin/categories');

                die();
            } else {
                $this->session->set_tempdata('error_message', "Something went wrong.",3);
                redirect('admin/categories/edit_category/' . $cat_id);

                die();
            }
        } else {
            $this->session->set_tempdata('error_message', "Category name already exists.",3);
            redirect('admin/categories/edit_category/' . $cat_id);
        }
    }

    function delete($cat_id) {

        $check = $this->db->query("select * from products where cat_id='" . $cat_id . "'");

        if ($check->num_rows() > 0) {
            $this->session->set_tempdata('error_message', "Some products are assigned, Unable to delete",3);
            redirect('admin/categories');
        } else {

            $this->db->where('cat_id', $cat_id);

            $subcatFound = $this->db->get('sub_categories')->result();

            if (count($subcatFound) > 0) {

                $this->session->set_tempdata('error_message', 'Some subcategories are assigned, Unable to delete',3);

                redirect('admin/categories');
            } else {

                $this->db->where('id', $cat_id);

                if ($this->db->delete('categories')) {

                    $this->session->set_tempdata('success_message', 'Category Deleted Successfully',3);

                    redirect('admin/categories');
                } else {

                    $this->session->set_tempdata('error_message', 'Unable to delete',3);

                    redirect('admin/categories');
                }
            }
        }
    }

}
