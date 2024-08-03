<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Order_refund_invoice extends MY_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('admin_login')['logged_in'] != true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('admin/login');

        }
        $this->db->where('name', 'Email_invoice'); 
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
        if (!in_array('Email_invoice', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }

        $this->load->model("admin_model");

    }



    function index() {

        $data['page_name'] = 'order_refund_invoice';
        $data['delivered_invoice'] = $this->admin_model->get_refund_invoice();
                
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/order_refund_invoice', $this->data);
        $this->load->view('admin/includes/footer');

    }
    
    function edit($id)
    {
     $this->data['edit']= $this->admin_model->get_edit_refund($id);
    //print_r($edit);die;
     $this->load->view('admin/includes/header', $data);
     $this->load->view('admin/edit_order_refund_invoice', $this->data);
     $this->load->view('admin/includes/footer');
    }
    
    function update(){
        
     $data['id']= $this->input->get_post('id');
     $data['subject'] = $this->input->get_post('subject');
     $data['title'] = $this->input->get_post('title');
     $data['message'] = $this->input->get_post('message');
     $data['footer'] = $this->input->get_post('footer');
     $data['updated_at'] = date('Y-m-d');
     
     $update = $this->admin_model->updrefund($data);
     //print_r($id);die;
     if($update){
         //$this->session->set_tempdata('status_changed', 'Status Changed .',3);
            redirect('admin/order_refund_invoice');
     }else{
         //$this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            redirect('admin/order_refund_invoice');
     }

    }
    
  

    

}

