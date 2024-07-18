<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Become_vendors extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
    }

    function index() {
        $data['page_name'] = 'become_vendors';
        $qry=$this->db->query("select * from become_a_vendor");
        $data['users']=$qry->result();

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/become_vendors', $data);
        $this->load->view('admin/includes/footer');

    }

     function delete($user_id) {
        $this->db->where('id', $user_id);
       $del = $this->db->delete('become_a_vendor');

        //echo$del = $this->db->last_query(); die;
        if($del)
        {
            $this->session->set_tempdata('success_message', 'Become a Vendor Deleted Successfully',3);
            redirect('admin/become_vendors');
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/become_vendors');
        }
    }

    function view($user_id)
    {
        $data['page_name'] = 'become_vendors';
        $qry=$this->db->query("select * from become_a_vendor where id='".$user_id."'");
        $data['users']=$qry->row();

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/viewusers', $data);
        $this->load->view('admin/includes/footer');
    }



}

