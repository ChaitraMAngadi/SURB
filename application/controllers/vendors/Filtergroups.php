<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Filtergroups extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['title'] = 'Filter Groups';
        $this->db->order_by('id', 'desc');
        $this->data['filtergroups'] = $this->db->get('filtergroups')->result();
        foreach ($this->data['filtergroups'] as $fg) {
            $fg->categories = $this->cat_list($fg->cat_ids);
        }
//        echo json_encode($this->data['filtergroups']);
//        die;

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/filtergroups', $this->data);
        $this->load->view('vendors/includes/footer');
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

        if ($filtergroup_id != null) {
            $this->db->where('id', $filtergroup_id);
            $this->data['filtergroup'] = $this->db->get('filtergroups')->row();
            $this->data['title'] = 'Update Filter Group';
        } else {
            $this->data['title'] = 'Add Filter Group';
        }
        $this->data['categories'] = $this->db->get('categories')->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_filtergroup', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert() {
        $filter_group_name = $this->input->get_post('filter_group_name');
        $group_values = $this->input->get_post('group_values');
        $status = $this->input->get_post('status');
        $categories = $this->input->get_post('categories');
        $cat_Ids = implode(',', $categories);

        $filtergroup_id = $this->input->get_post('filtergroup_id');
        if (!$filtergroup_id) {
            $data = array(
                'filter_group_name' => $filter_group_name,
                'group_values' => $group_values,
                'cat_ids' => $cat_Ids,
                'status' => $status,
                'created_at' => time()
            );

            $insert_query = $this->db->insert('filtergroups', $data);
            if ($insert_query) {
                redirect('vendors/filtergroups');
                die();
            } else {
                redirect('vendors/filtergroups/add');
                die();
            }
        } else {
            $data = array(
                'filter_group_name' => $filter_group_name,
                'group_values' => $group_values,
                'cat_ids' => $cat_Ids,
                'status' => $status,
                'updated_at' => time()
            );
            $this->db->where('id', $filtergroup_id);
            $insert_query = $this->db->update('filtergroups', $data);
            if ($insert_query) {
                redirect('vendors/filtergroups');
                die();
            } else {
                redirect('vendors/filtergroups/add/');
                die();
            }
        }
    }

}
