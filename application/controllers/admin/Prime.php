<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prime extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Prime');
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
        if (!in_array('Prime', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        // $this->db->where('name', 'Prime');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }




        $this->load->model("admin_model");
        $this->load->model("filters_model");
        $this->load->model("vendor_model");
    }

    function index() {

        $this->data['page_name'] = 'prime';

        $qry = $this->db->query("select * from prime_table");
        $result=$qry->result();

        $this->data['prime'] = $result;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/prime', $this->data);
        $this->load->view('admin/includes/footer');
    }
    function addPrime(){
        $this->data['page_name'] = 'addPrime';

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/addPrime', $this->data);
        $this->load->view('admin/includes/footer');
    }
    function delete($id){
        $this->data['page_name'] = 'deletePrime';
        $this->db->where('id', $id);
        $qry=$this->db->delete('prime_table');
        if($qry){
            $this->session->set_tempdata('success_message', 'Deleted successfully',3);
            redirect('admin/prime');
        }
        else{
            $this->session->set_tempdata('error_message', 'Something went wrong! please try again',3);
            redirect('admin/prime');
        }
    }
    function edit($id){
        $this->data['page_name'] = 'editPrime';
        $qry=$this->db->query("select * from prime_table where id='".$id."'");
        $res=$qry->result();
        $this->data['prime'] = $res;
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/updatePrime', $this->data);
        $this->load->view('admin/includes/footer');
    }
    function updatePrime(){
        $name= $this->input->get_post('Name');
        $description =$this->input->get_post('Description');
        $validity=$this->input->get_post('validity_prime');
        $value=$this->input->get_post('value_prime');
        $id=$this->input->get_post('id');
        if (!empty($_FILES["app_image"]["name"])) {
            $img_k_image = "prime_" . date('YmdHis') . ".jpg";
            $upload_path = "./uploads/prime/"; // Specify the upload path
            $k_image = $img_k_image;
            
            // Check if the file already exists
            if (file_exists($upload_path . $img_k_image)) {
                // Remove the existing file
                unlink($upload_path . $img_k_image);
            }
            
            // Move the new file to the upload directory
            move_uploaded_file($_FILES["app_image"]["tmp_name"], $upload_path . $img_k_image);
        } else{
            $k_image="";
        }
        $this->db->where('id',$id);
        $validity = !empty($validity) ? $validity : NULL;
        $array=array(
            'Description'=>$description,
            'Name'=>$name,
            'validity'=>$validity,
            'value'=>$value,
            'image'=>$k_image
        );
        $qry=$this->db->update('prime_table',$array);
        if($qry){
            $this->session->set_tempdata('success_message', 'Prime data updated',3);
            // echo "@success";
            redirect('admin/prime');
        }
        else{
            $this->session->set_tempdata('error_message', 'Prime data not updated',3);
            // echo "@fail";
            redirect('admin/prime');
        }

    }
    
    function save_prime(){
        $name= $this->input->get_post('Name');
        $description =$this->input->get_post('Description');
        $value=$this->input->get_post('value_prime');
        $validity=$this->input->get_post('validity_prime');
        // $image=$this->input->post('app_image');
        if (!empty($_FILES["app_image"]["name"])) {
            $img_k_image = "prime_" . date('YmdHis') . ".jpg";
            $upload_path = "./uploads/prime/"; // Specify the upload path
            $k_image = $img_k_image;
           
            // exit;
            // die;
            if (!file_exists($upload_path . $img_k_image)) {
                move_uploaded_file($_FILES["app_image"]["tmp_name"], $upload_path . $img_k_image);
            }
        } else {
            $k_image = "";
            // $this->session->set_tempdata('error_message', 'Something went wrong, unable to insert image',3);
            // redirect('admin/coupons');
        }
        
        $validity = !empty($validity) ? $validity : NULL;


        $array=array(
            'Description'=>$description,
            'Name'=>$name,
            'value'=>$value,
            'validity'=>$validity,
            'image'=>$k_image
        );
        $qry=$this->db->insert('prime_table',$array);
        if($qry){
            $this->session->set_tempdata('success_message', 'Prime data added',3);
            // echo "@success";
            redirect('admin/prime');
        }
        else{
            $this->session->set_tempdata('error_message', 'Prime data not added',3);
            // echo "@fail";
            redirect('admin/prime');
        }

    }
  
}