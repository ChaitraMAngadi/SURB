<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }
 function index() {
        $this->data['page_name'] = 'locations';
        $this->data['title'] = 'Areas';

         $shop_id = $_SESSION['vendors']['vendor_id'];
         $shop = $this->db->query("select * from vendor_shop where id='".$shop_id."'");
         $shop_row =$shop->row();

         $city_id=$shop_row->city_id;

        $qry = $this->db->query("select * from areas where vendor_id='".$shop_id."'");
        $this->data['locations'] = $qry->result();

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/locations', $this->data);
        $this->load->view('vendors/includes/footer');
    }

     function add() {
        $this->data['page_name'] = 'locations';
        $this->data['title'] = 'Add Area';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_location', $this->data);
        $this->load->view('vendors/includes/footer');
    }


    function getcities()
    {
        $state_id = $this->input->post('state_id');

              $this->db->where('state_id', $state_id);
              $query = $this->db->get('cities');
              $output = '<option value="">Select Cities</option>';
              foreach($query->result() as $row)
              {
               $output .= '<option value="'.$row->id.'">'.$row->city_name.'</option>';
              }
              print_r($output); 
            exit;
    }

     function getpincodes()
    {
            $city_id = $this->input->post('city_id');

              $this->db->where('city_id', $city_id);
              $query = $this->db->get('pincodes');
              $output = '<option value="">Select Pincode</option>';
              foreach($query->result() as $row)
              {
               $output .= '<option value="'.$row->pincode.'">'.$row->pincode.'</option>';
              }
              print_r($output); 
            exit;
    }


    function insert() 
    {
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        
        $pincode_id = $this->input->get_post('pincode_id');
        $area = $this->input->get_post('area');
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $status = $this->input->get_post('status');
        $data = array(
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode_id,
            'area'=>$area,
            'vendor_id'=>$shop_id,
            'status'=>$status
        );
        $insert_query = $this->db->insert('areas', $data);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Area Added Successfully',3);
            redirect('vendors/locations');
            die();
        } else {
            redirect('vendors/locations/add');
            die();
       }
    }

    function update() 
    {
        $id = $this->input->get_post('lid');
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        
        $pincode_id = $this->input->get_post('pincode_id');
        $area = $this->input->get_post('area');
        $shop_id = $_SESSION['vendors']['vendor_id'];
         $status = $this->input->get_post('status');
         
        $data = array(
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode_id,
            'area'=>$area,
            'vendor_id'=>$shop_id,
            'status'=>$status
        );
        $wr = array('id'=>$id);
        $insert_query = $this->db->update('areas',$data,$wr);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Location Updated Successfully',3);
            redirect('vendors/locations');
            die();
        } else {
            redirect('vendors/locations/edit');
            die();
       }
    }

    function delete($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('areas')) {
                $this->session->set_tempdata('success_message', 'Location Deleted Successfully',3);
                redirect('vendors/locations');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('vendors/locations');
         }

    }

function edit($id) {
        $qry = $this->db->query("select * from areas where id='".$id."'");
        $this->data['location'] = $qry->row();
        $this->data['title'] = 'Edit City';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/edit_location', $this->data);
        $this->load->view('vendors/includes/footer');
    }
}
