<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends MY_Controller {

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
        $data['page_name'] = 'contact_us';
        $qry=$this->db->query("select * from contact_us order by id desc");
        $data['contact_us']=$qry->result();
        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/contact_us', $data);
        $this->load->view('admin/includes/footer');

    }

     function delete($id) {
        $this->db->where('id', $id);
       $del = $this->db->delete('contact_us');

        //echo$del = $this->db->last_query(); die;
        if($del)
        {
            $this->session->set_tempdata('success_message', 'Contact Deleted Successfully',3);
            redirect('admin/contact_us');
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/contact_us');
        }
    }

    function view($id)
    {
        $data['page_name'] = 'contact_us';
        $qry=$this->db->query("select * from contact_us where id='".$id."'");
        $data['users']=$qry->row();

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/contact_us', $data);
        $this->load->view('admin/includes/footer');
    }



}

