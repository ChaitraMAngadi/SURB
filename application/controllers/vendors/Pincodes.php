<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pincodes extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }
 function index() {
        $this->data['page_name'] = 'pincodes';
        $this->data['title'] = 'Pincodes';
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $shop = $this->db->query("select * from vendor_shop where id='".$shop_id."'");
         $shop_row =$shop->row();

         $city_id=$shop_row->city_id;

        $qry = $this->db->query("select * from pincodes where shop_id='".$shop_id."'");
        $this->data['pincodes'] = $qry->result();

        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/pincodes', $this->data);
        $this->load->view('vendors/includes/footer');
    }

     function add() {
        $this->data['page_name'] = 'pincodes';
        $this->data['title'] = 'Add Pincodes';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_pincode', $this->data);
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

    function insert() 
    {
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        $pincode = $this->input->get_post('pincode');
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $status = $this->input->get_post('status');
        $data = array(
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode,
            'vendor_id' => $shop_id,
            'status' => $status
        );
        $insert_query = $this->db->insert('pincodes', $data);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Pincode Added Successfully',3);
            redirect('vendors/pincodes');
            die();
        } else {
            redirect('vendors/pincodes/add');
            die();
       }
    }

    function update() 
    {
        $id = $this->input->get_post('lid');
        $state_id = $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        $pincode = $this->input->get_post('pincode');
        $status = $this->input->get_post('status');
        $shop_id = $_SESSION['vendors']['vendor_id'];
        
        $data = array(
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode,
            'vendor_id' => $shop_id,
            'status' => $status
        );
        $wr = array('id'=>$id);
        $insert_query = $this->db->update('pincodes',$data,$wr);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Pincode Updated Successfully',3);
            redirect('vendors/pincodes');
            die();
        } else {
            redirect('vendors/pincodes/edit');
            die();
       }
    }

    function delete($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('pincodes')) {
                $this->session->set_tempdata('success_message', 'Pincode Deleted Successfully',3);
                redirect('vendors/pincodes');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('vendors/pincodes');
         }

    }

function edit($id) {
        $qry = $this->db->query("select * from pincodes where id='".$id."'");
        $this->data['location'] = $qry->row();
        $this->data['title'] = 'Edit City';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/edit_pincode', $this->data);
        $this->load->view('vendors/includes/footer');
    }
}
