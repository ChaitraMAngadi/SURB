<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'Attributes');
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
        if (!in_array('Attributes', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }

        // $this->db->where('name', 'Attributes');
        // $query = $this->db->get('features');
        // $feature = $query->row();
        // if ($feature && $feature->status == 0) {
        //    redirect('admin/login');
        //     exit(); // Stop further execution
        // }

        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'tags';
        $this->data['title'] = 'Tags';
        $this->db->order_by('id', 'desc');
        $this->data['tags'] = $this->db->get('tags')->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/tags', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add($size_id = null) {
        if ($size_id) {
            $this->db->where('id', $size_id);
            $this->data['tags'] = $this->db->get('tags')->row();
            $this->data['title'] = 'Update Tag';
        } else {
            $this->data['title'] = 'Add Tag';
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_tags', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insert() {
        $id = $this->input->get_post('id');
        $title = $this->input->get_post('title');

        if (!$id) {
            $data = array(
                'title' => $title
            );
            $chk = $this->db->query("select * from tags where title='".$title."'");
            if($chk->num_rows()>0)
            {
                $this->session->set_tempdata('error_message', 'Already Exist this Tag',3);
                 redirect('admin/tags/add');
                 die();
            }
            else
            {
                $insert_query = $this->db->insert('tags', $data);
                if ($insert_query) {
                    $this->session->set_tempdata('success_message', 'Tag added successfully',3);
                    redirect('admin/tags');
                    die();
                } else {
                    redirect('admin/tags/add');
                    die();
                }
            }
            
        } else {

            $chk = $this->db->query("select * from tags where id!='".$id."' and title='".$title."'");
            if($chk->num_rows()>0)
            {
                 $this->session->set_tempdata('error_message', 'Already Exist this Tag',3);
                 redirect('admin/tags/add/' . $id);
                 die();
            }
            else
            {
                $data = array(
                    'title' => $title
                );
                $this->db->where('id', $id);
                $insert_query = $this->db->update('tags', $data);
                if ($insert_query) {
                    redirect('admin/tags');
                    die();
                } else {
                    redirect('admin/tags/add/' . $id);
                    die();
                }
            }

            
        }
    }

    function delete($id)
    {  
        $del = $this->db->delete("tags",array('id'=>$id));
        if($del)
        {
            redirect('admin/tags');
        }
    }

}
