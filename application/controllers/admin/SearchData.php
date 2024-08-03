<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SearchData extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            redirect('admin/login');
        }
        $this->db->where('name', 'Search_data'); 
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
        if (!in_array('Search_data', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }

        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'search_data';
        $this->data['title'] = 'search_data';

        $search_qry = $this->db->query("
            SELECT keywords, search_results, created_at, COUNT(*) AS query_count
            FROM search_keywords
            GROUP BY keywords
            ORDER BY created_at DESC
            LIMIT 100
        ");
        $search_qry_res = $search_qry->result();

        $this->data['Searchdata'] = $search_qry_res;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/SearchData', $this->data);
        $this->load->view('admin/includes/footer');
    }
}
