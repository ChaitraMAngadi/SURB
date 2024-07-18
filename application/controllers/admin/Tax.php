<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
    }

    function index() {
        $this->data['page_name'] = 'tax';
        $this->data['title'] = 'Tax Management';
        $this->db->order_by('id', 'desc');
        $this->data['tax'] = $this->db->get('tax')->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/tax', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add($tax_id = null) {
        if ($tax_id) {
            $this->db->where('id', $tax_id);
            $this->data['tax'] = $this->db->get('tax')->row();
            $this->data['title'] = 'Update Tax';
        } else {
            $this->data['title'] = 'Add Tax';
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_tax', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert() {
        $id = $this->input->get_post('id');
        $title = $this->input->get_post('title');
        $amount = $this->input->get_post('amount');
        $type = $this->input->get_post('type');

        if (!$id) {
            $data = array(
                'title' => $title,
                'type' => $type,
                'amount' => $amount
            );
            $chk = $this->db->query("select * from tax where title='".$title."'");
            if($chk->num_rows()>0)
            {
                $this->session->set_tempdata('error_message', 'Already Exist this Tax',3);
                 redirect('admin/tax/add');
                 die();
            }
            else
            {
                $insert_query = $this->db->insert('tax', $data);
                if ($insert_query) {
                    $this->session->set_tempdata('success_message', 'Tax added successfully',3);
                    redirect('admin/tax');
                    die();
                } else {
                    redirect('admin/tax/add');
                    die();
                }
            }
            
        } else {

            $chk = $this->db->query("select * from tax where id!='".$id."' and title='".$title."'");
            if($chk->num_rows()>0)
            {
                 $this->session->set_tempdata('error_message', 'Already Exist this Tax',3);
                 redirect('admin/tax/add/' . $id);
                 die();
            }
            else
            {
                $data = array(
                    'title' => $title,
                    'type' => $type,
                    'amount' => $amount
                );
                $this->db->where('id', $id);
                $insert_query = $this->db->update('tax', $data);
                if ($insert_query) {
                    $this->session->set_tempdata('success_message', 'Tax updated successfully',3);
                    redirect('admin/tax');
                    die();
                } else {
                    redirect('admin/tax/add/' . $id);
                    die();
                }
            }

            
        }
    }

    function delete($id)
    {  
        $del = $this->db->delete("tax",array('id'=>$id));
        if($del)
        {
            $this->session->set_tempdata('success_message', 'Deleted successfully',3);
            redirect('admin/tax');
        }
    }

}
