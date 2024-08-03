<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login'); 
        }
        $this->db->where('name', 'Users'); 
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
        if (!in_array('Users', $features)) {    
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';
            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); 
        }
        $this->load->model("admin_model");
    }

    function index() {
        $data['page_name'] = 'users';
        $keyword=$this->input->post('keyword');
        
        if ($keyword) {
        $this->db->select('p.id,p.first_name, p.last_name, p.email, p.phone, p.Tag, p.membership, p.plan, p.created_member_date, p.expiry_member_date');
        $this->db->from('users p');
        $this->db->where("(p.id LIKE '%" . $keyword . "%' OR p.first_name LIKE '%" . $keyword . "%' OR p.last_name LIKE '%" . $keyword . "%' OR p.membership LIKE '%" . $keyword . "%' OR p.plan LIKE '%" . $keyword . "%' OR p.email LIKE '%" . $keyword . "%')");
        $this->db->order_by('p.id', 'desc');
        $data['users']= $this->db->get()->result();
        }
        else{
            $qry=$this->db->query("select * from users");
            $data['users']=$qry->result();
        }
       


        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/users', $data);
        $this->load->view('admin/includes/footer');

    }

     function delete($user_id) {
        $this->db->where('id', $user_id);
       $del = $this->db->delete('users');

        //echo$del = $this->db->last_query(); die;
        if($del)
        {
            $this->session->set_tempdata('success_message', 'User Deleted Successfully',3);
            redirect('admin/users');
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/users');
        }
    }

    function edit($user_id){
       $data['page_name'] = 'edit user';
       $qry= $this->db->query("select * from users where id='".$user_id."'");
       $data['users']=$qry->row();

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/editusers', $data);
        $this->load->view('admin/includes/footer');
    }

    function view($user_id)
    {
        $data['page_name'] = 'users';
        $qry=$this->db->query("select * from users where id='".$user_id."'");
        $data['users']=$qry->row();

        $this->load->view('admin/includes/header', $data);

        $this->load->view('admin/viewusers', $data);
        $this->load->view('admin/includes/footer');
    }
    function update(){
        $id=$this->input->post('id');
        $firstname=$this->input->post('firstname');
        $lastname=$this->input->post('lastname');
        $email=$this->input->post('email');
        $phone=$this->input->post('phone');
        $membership=$this->input->post('membership');
        $plan=$this->input->post('plan');
        $tags=$this->input->get_post('tags');
        $tagJson = json_encode($tags);
        $array=array(
            'first_name'=>$firstname,
            'last_name'=>$lastname,
            'email'=>$email,
            'phone'=>$phone,
            'membership'=>$membership,
            'plan'=>$plan,
            'Tag'=>$tagJson,
            'created_member_date' => date("Y-m-d",strtotime($this->input->post('start_date'))),
            'expiry_member_date' => date("Y-m-d",strtotime($this->input->post('expiry_date'))),
        );

        $this->db->where('id', $id);
        $update_query = $this->db->update('users', $array);
        //echo $this->db->last_query(); die;
        if ($update_query) {

            redirect('admin/users');
            die();
        } else {
            redirect('admin/users/edit/' . $id);
            die();
        }
        // print_r($id);
    }



}

