<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_attributes extends CI_Controller {

    public $data;

    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Attributes');
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
        if (!in_array('Attributes', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }



        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'manage_attributes';
        $this->data['title'] = 'Manage Attributes';

        $this->db->order_by('id', 'desc');
        $qry = $this->db->query("select * from manage_attributes group by attribute_titleid");

        $this->data['attributes'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/manage_attributes', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function cat_list($cat_ids) {

        $categories_list = array();

        if ($cat_ids) {

            $catArray = explode(',', $cat_ids);

            foreach ($catArray as $cat) {

                $catRow = $this->admin_model->get_table_row('categories', 'id', $cat);

                if ($catRow) {

                    array_push($categories_list, $catRow);
                }
            }
        }

        return $categories_list;
    }

    function add($filtergroup_id = null) {

        $this->data['title'] = 'Add Manage Attributes';
        $this->data['attribute_types'] = $this->db->get('attributes_title')->result();
        $this->data['categories'] = $this->db->get('categories')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_manageattributes', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function edit($a_id) {
        $qry = $this->db->query("select * from manage_attributes where attribute_titleid='" . $a_id . "'");
        $this->data['attributes'] = $qry->row();

        $this->data['title'] = 'Edit Manage Attributes';
        $this->data['attribute_types'] = $this->db->get('attributes_title')->result();
        $this->data['categories'] = $this->db->get('categories')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/edit_manageattributes', $this->data);

        $this->load->view('admin/includes/footer');
    }

    function update() {
        $types = $this->input->post('types');
        $categories = $this->input->post('categories');

        $chk = $this->db->query("select * from manage_attributes where attribute_titleid='" . $types . "'");
        if ($chk->num_rows() > 0) {
            $wr = array('attribute_titleid' => $types);
            $del = $this->db->delete("manage_attributes", $wr);
            if ($del) {
                for ($i = 0; $i < count($categories); $i++) {
                    $data = array(
                        'attribute_titleid' => $types,
                        'categories' => $categories[$i],
                        'updated_date' => time()
                    );
                    $this->db->insert('manage_attributes', $data);
                }
                $this->session->set_tempdata('success_message', 'Attribute Updated Successfully',3);
                redirect('admin/manage_attributes');
            }
        }
    }

    function insert() {

        $types = $this->input->post('types');
        $categories = $this->input->post('categories');
        for ($i = 0; $i < count($categories); $i++) {
            $data = array(
                'attribute_titleid' => $types,
                'categories' => $categories[$i],
                'created_date' => time()
            );
            $insert_query = $this->db->insert('manage_attributes', $data);
        }
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Attributes assigned Successfully',3);
            redirect('admin/manage_attributes');

            die();
        } else {
            $this->session->set_tempdata('error_message', 'Attributes not assigned',3);
            redirect('admin/manage_attributes/add');

            die();
        }
    }

    function delete($id) {
        $qry = $this->db->query("select * from products where cat_id='" . $id . "'");
        if ($qry->num_rows() > 0) {
            $this->session->set_tempdata('error_message', 'Manage attributes for categories: already assigned to products',3);
            redirect('admin/manage_attributes');
        } else {
            $this->db->where('attribute_titleid', $id);
            if ($this->db->delete('manage_attributes')) {
                $this->session->set_tempdata('success_message', 'Manage attribute Deleted Successfully',3);
                redirect('admin/manage_attributes');
            } else {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('admin/manage_attributes');
            }
        }
    }

}
