<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->db->where('name', 'CMS'); 
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
        if (!in_array('CMS', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }
        $this->load->model("admin_model");
    }



    function index() {
        $this->data['page_name'] = 'content';
        $this->data['title'] = 'Content';
        $qry = $this->db->query("select * from content");
        $this->data['content'] = $qry->result();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/content', $this->data);
        $this->load->view('admin/includes/footer');
    }



    function add() {
         $this->data['page_name'] = 'content';
        $this->data['title'] = 'Add Content';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_content', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function insert() {

        $title = $this->input->get_post('title');
        $description = $this->input->get_post('description');
        $status = $this->input->get_post('status');

        $data = array(
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'created_date' => time()

        );

        $insert_query = $this->db->insert('content', $data);

        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Page Added Successfully.',3);
            redirect('admin/content');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
            redirect('admin/content/add');
            die();
        }

    }



    function edit($id) {

        $this->data['title'] = 'Edit Content';

        $this->data['content'] = $this->db->get_where('content', ['id' => $id])->row();

        $this->load->view('admin/includes/header');

        $this->load->view('admin/edit_content', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function update() {
        $id = $this->input->get_post('id');
        $title = $this->input->get_post('title');
        $description = $this->input->get_post('description');
        $status = $this->input->get_post('status');

        $data = array(
            'title' => $title,
            'description' => $description,
            'status' => $status
        );
        $wr = array('id'=>$id);
        $insert_query = $this->db->update('content', $data,$wr);
        if($insert_query) 
        {
            $this->session->set_tempdata('success_message', 'Content Page updated Successfully.',3);
            redirect('admin/content');
            die();
        }
        else 
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
            redirect('admin/content/edit');
            die();
        }

    }



    function delete($id)
    {
        $wr = array('id'=>$id);
        $del = $this->db->delete("content",$wr);
        if($del)
        {
            $this->session->set_tempdata('error_message', 'Content Page deleted Successfully.',3);
            redirect('admin/content');
            die(); 
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
            redirect('admin/content');
            die(); 
        }
        
    }



}

