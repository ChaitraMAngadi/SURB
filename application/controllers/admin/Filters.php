<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Filters extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Filters'); 
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
        if (!in_array('Filters', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }
        $this->load->model("admin_model");
        $this->load->model("filters_model");
        $this->load->model("vendor_model");
    }

    function index() {

        $this->data['page_name'] = 'filters';

        $result = $this->filters_model->get_data();
        $this->data['filters'] = $result;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/filters', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add() {
        $this->data['title'] = 'Add Filters';
        $this->data['categories'] = $this->db->where('status',1)->get('categories')->result();
        $result = $this->filters_model->get_data();
        $this->data['filters'] = $result;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_filters', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert_filter() {
//        echo "<pre>";
//        print_r($this->input->post()); die;
        $cat_id = $this->input->get_post('cat_id');
        $sub_cat_id = $this->input->get_post('sub_cat_id');
        $array = array(
            'title' => $this->input->get_post('title'),
            'cat_id' => $cat_id,
            'sub_cat_id' => implode(',', $sub_cat_id)
        );

        $ins = $this->filters_model->insertData($array);

        if ($ins) {
            $filter_id = $this->db->insert_id();

            $options = $this->input->get_post('options');
            foreach ($options as $option) {
                $table = "filter_options";
                $array = array('filter_id' => $filter_id, 'options' => $option);
                $this->db->insert($table, $array);
                $id = $this->db->insert_id();
                $mix = $id . '-' . $option;
                $seo_url = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($mix))));
                $this->common_model->update_record(['id' => $id], 'filter_options', ['seo_url' => $seo_url]);
            }
            $this->session->set_tempdata('success_message', 'Filters added Successfully',3);
            redirect('admin/filters');
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, please try again',3);
            redirect('admin/filters');
        }
    }

    function edit($id) {

        $this->data['title'] = 'Edit Filters';
        $this->data['categories'] = $this->db->where('status',1)->get('categories')->result();
        $row = $this->filters_model->get_data_row($id);
        $this->data['filters'] = $row;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/edit_filters', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function update_filters() {
        //echo "<pre>"; print_r($this->input->post()); die;
        $id = $this->input->get_post('id');
        $title = $this->input->get_post('title');
        $cat_id = $this->input->get_post('cat_id');
        $sub_cat_id = $this->input->get_post('sub_cat_id');
        $array = array(
            'title' => $title,
            'cat_id' => $cat_id,
            'sub_cat_id' => implode(',', $sub_cat_id)
        );
        $upd = $this->filters_model->updateData($array, $id);

        if ($upd) {
            $filter_id = $this->input->get_post('filter_id');
            $option_data = $this->input->get_post('options');
            
            $removed_opt_ids = array_filter($this->input->get_post('removed_opt_ids'));
            if(sizeof($removed_opt_ids) > 0) {
                foreach ($removed_opt_ids as $id) {
                    $this->db->where('id',$id)->delete('filter_options');
                } 
            }
            // print_r($filter_id);die;

            for ($i = 0; $i < count($option_data); $i++) {

                if ($filter_id[$i] == 0) {
                    $table = "filter_options";
                    $array_option = array('filter_id' => $id, 'options' => $option_data[$i]);
                    $this->db->insert($table, $array_option);
                    $id = $this->db->insert_id();
                    $mix = $id . '-' . $option_data[$i];
                    $seo_url = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($mix))));
                    $this->common_model->update_record(['id' => $id], 'filter_options', ['seo_url' => $seo_url]);
                    //echo $this->db->last_query();   
                } else {
                    $table = "filter_options";
                    $mix = $filter_id[$i] . '-' . $option_data[$i];
                    $seo_url = preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($mix))));
                    $array_data = array('options' => $option_data[$i], 'seo_url' => $seo_url);
                    $where = array('id' => $filter_id[$i]);
                    $this->db->set($array_data);
                    $this->db->where($where);
                    $this->db->update($table);
                }
            }
            //die;
            $this->session->set_tempdata('success_message', 'Filters updated Successfully',3);
            redirect('admin/filters');
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, please try again',3);
            redirect('admin/filters');
        }
    }

    function delete($id) {
        if ((isset($id)) && ($id != '')) {
            $parameters = array();
            $parameters['id'] = $id;

            if ($this->filters_model->delete($parameters)) {

                $this->session->set_tempdata('success_message', "'Deleted Successfully', 'Success'",3);
                redirect('admin/filters');
            } else {
                $this->session->set_tempdata('error_message', "'Please Try Again', 'Error'",3);
                redirect('admin/filters');
            }
        } else {
            redirect('admin/filters');
        }
    }

}
