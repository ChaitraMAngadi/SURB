<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visual_merchants extends MY_Controller {
 
    public $data; 
    function __construct() {  
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }      
    } 
    
    function index(){
        $this->data['title'] = 'Visual Merchants';
        $this->db->order_by('id', 'desc');
        $this->data['visual_merchants'] = $this->db->get('visual_merchant')->result();
        foreach ($this->data['visual_merchants'] as $vm){
            $this->db->where('vm_id',$vm->id);
            $shopRow = $this->db->get('vendor_shop')->result();
            if($shopRow){
               $vm->no_of_shops = count($shopRow);     
            }else{
                $vm->no_of_shops = 0;
            }            
        }
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/visual_merchants', $this->data);
        $this->load->view('vendors/includes/footer'); 
    }
    
    function add(){
        $this->data['title'] = 'Add Visual Merchant';
        $this->data['cities'] = $this->db->get('cities')->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_visual_merchant', $this->data);
        $this->load->view('vendors/includes/footer'); 
    }
    function insert(){
        $name = $this->input->get_post('name');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
        $password = $this->input->get_post('password');
        $city = $this->input->get_post('city');
        
        $data = array(
            'name'=> $name,
            'email' => $email, 
            'mobile' => $mobile,
            'password' => md5($password),
            'city'=> $city
        );
        $insert_query = $this->db->insert('visual_merchant', $data);            
        if($insert_query){            
            redirect('vendors/visual_merchants');
            die();
        }else{
            redirect('vendors/visual_merchants/add');
            die();
        }
          
    }
    
    function edit(){
        $this->data['title'] = 'Edit Merchant';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/edit_visual_merchant', $this->data);
        $this->load->view('vendors/includes/footer'); 
    }
}