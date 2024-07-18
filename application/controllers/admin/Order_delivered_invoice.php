<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Order_delivered_invoice extends MY_Controller {



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

        $data['page_name'] = 'order_delivered_invoice';
        $data['delivered_invoice'] = $this->admin_model->get_delivered_invoice();
                
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/order_delivered_invoice', $this->data);
        $this->load->view('admin/includes/footer');

    }
    
    function edit($id)
    {
     $this->data['edit']= $this->admin_model->get_edit_delivered($id);
    //print_r($edit);die;
     $this->load->view('admin/includes/header', $data);
     $this->load->view('admin/edit_order_delivered_invoice', $this->data);
     $this->load->view('admin/includes/footer');
    }
    
    function update(){
        
     $data['id']= $this->input->get_post('id');
     $data['subject'] = $this->input->get_post('subject');
     $data['title'] = $this->input->get_post('title');
     $data['message'] = $this->input->get_post('message');
     $data['footer'] = $this->input->get_post('footer');
     $data['updated_at'] = date('Y-m-d');
     
     $update = $this->admin_model->updorder($data);
     //print_r($id);die;
     if($update){
         //$this->session->set_tempdata('status_changed', 'Status Changed .',3);
            redirect('admin/order_delivered_invoice');
     }else{
         //$this->session->set_tempdata('error_message', 'Something Went Wrong.',3);
            redirect('admin/order_delivered_invoice');
     }

    }
    
  

    

}

