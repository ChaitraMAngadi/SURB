<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->load->model('Feature_model');
    }

    public function index() {
        $this->data['page_name'] = 'content';
        $this->data['title'] = 'Content';
        $data['features'] = $this->Feature_model->get_features();
        // $this->load->view('admin/includes/header', $this->data);
        $this->load->view('feature_view', $data);
        // $this->load->view('admin/includes/footer');
    }

    public function update() {
        $features = $this->Feature_model->get_features();
        
        foreach ($features as $feature) {
            $status = $this->input->post('feature_' . $feature->id) ? 1 : 0;
            $this->Feature_model->update_feature_status($feature->id, $status);
        }
        
        redirect('admin/feature');
    }
}
