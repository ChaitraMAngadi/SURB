<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Coupons extends CI_Controller {



    public $data;



    function __construct() {

        parent::__construct();

        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {

            //$this->session->set_tempdata('error', 'Session Timed Out',3);

            redirect('vendors/login');

        }

    }



    function index() {
        $this->data['page_name'] = 'coupons';

        $qry = $this->db->query("select * from coupon_codes where shop_id='".$_SESSION['vendors']['vendor_id']."'");
        $data['coupons'] = $qry->result();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/coupons', $data);
        $this->load->view('vendors/includes/footer');
    }



    function add() {
        $this->data['page_name'] = 'coupons';
        $this->data['title'] = 'Add Coupon';

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/addcoupon', $this->data);

        $this->load->view('vendors/includes/footer');

    }



    function insert() {
        $data = array(
            'shop_id'=>$_SESSION['vendors']['vendor_id'],
            'coupon_code' => $this->input->post('coupon_code'),
            'percentage' => $this->input->post('percentage'),
            'start_date' => date("Y-m-d",strtotime($this->input->post('start_date'))),
            'expiry_date' => date("Y-m-d",strtotime($this->input->post('expiry_date'))),
            'maximum_amount' => $this->input->post('maximum_amount'),
            'description' => $this->input->post('description'),
            'utilization' => $this->input->post('utilization'),
            'minimum_order_amount'=> $this->input->post('minimum_order_amount')
        );
        if(strtotime($this->input->post('start_date')) > strtotime($this->input->post('expiry_date'))){
            $this->session->set_tempdata('error_message', 'expiry date can not be less than start date',3);
            redirect('vendors/coupons/add');

            die();

        } else {
            
            $insert_query = $this->db->insert('coupon_codes', $data);
            if ($insert_query) {
            redirect('vendors/coupons');

            die();

        }

    }
    }



    function edit($id) {
        $this->data['page_name'] = 'coupons';
        $this->data['title'] = 'Edit Coupons';

        $data['coupons'] = $this->db->get_where('coupon_codes', ['id' => $id])->row();

        $this->load->view('vendors/includes/header');

        $this->load->view('vendors/editcoupon', $data);

        $this->load->view('vendors/includes/footer');

    }



    function update() {
        $id=$this->input->post('id');


       

        $data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'percentage' => $this->input->post('percentage'),
            'start_date' => date("Y-m-d",strtotime($this->input->post('start_date'))),
            'expiry_date' => date("Y-m-d",strtotime($this->input->post('expiry_date'))),
            'maximum_amount' => $this->input->post('maximum_amount'),
            'description' => $this->input->post('description'),
            'utilization' => $this->input->post('utilization'),
            'minimum_order_amount'=> $this->input->post('minimum_order_amount')
        );

        $this->db->where('id', $id);
        $update_query = $this->db->update('coupon_codes', $data);
        //echo $this->db->last_query(); die;
        if ($update_query) {

            redirect('vendors/coupons');
            die();
        } else {
            redirect('vendors/coupons/edit/' . $id);
            die();
        }

    }




    function delete($id) 
    {
        $this->db->where('id', $id);
        if ($this->db->delete('coupon_codes')) {
                $this->session->set_tempdata('success_message', 'Coupon Deleted Successfully',3);
                redirect('vendors/coupons');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('vendors/coupons');
         }
    }



}

