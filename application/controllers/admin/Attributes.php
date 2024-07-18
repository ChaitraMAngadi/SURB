<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes extends CI_Controller {

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
        $this->load->model("admin_model");
    }

    function index() {
        $this->data['page_name'] = 'attributes';
        $this->data['title'] = 'Attributes';
        $qry = $this->db->query("select * from attributes_title");
        $this->data['attributes'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/attributes', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function add() {

        $this->data['title'] = 'Attributes';
        $qry = $this->db->query("select * from attributes group by category,subcategory");
        $this->data['attributes'] = $qry->result();

        $this->db->order_by('id', 'desc');
        $this->data['colors'] = $this->db->get('attr_colors')->result();

        $this->data['title'] = 'Add Attributes';
        $this->data['categories'] = $this->db->get('categories')->result();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/add_attributes', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function edit($id, $color) {
        $this->data['edit_status'] = $color;
        $qry = $this->db->query("select * from attributes_title where id='" . $id . "'");
        $this->data['attributes'] = $qry->row();

        $this->db->order_by('id', 'desc');
        $this->data['colors'] = $this->db->get('attr_colors')->result();

        $this->data['title'] = 'Update Attributes';

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/edit_attribute', $this->data);
        $this->load->view('admin/includes/footer');
    }

    function insertcolor() {
        $title = $this->input->post('title');

        $chk = $this->db->query("select * from attributes_title where title='" . $title . "'");
        if ($chk->num_rows() > 0) {
            $this->session->set_tempdata('error_message', 'Attribute Type already Exist.',3);
            redirect('admin/attributes/add');
        } else {
            $color_code = $this->input->post('color_code');
            $values = $this->input->post('values');
            $date = time();
            $ins = $this->db->insert('attributes_title', array('title' => $title, 'created_date' => $date));
            $last_id = $this->db->insert_id($ins);

            for ($i = 0; $i < count($values); $i++) {
                $data = array(
                    'attribute_titleid ' => $last_id,
                    'value' => $values[$i],
                    'code' => $color_code[$i]
                );
                $insert_query = $this->db->insert('attributes_values', $data);
            }
            if ($insert_query) {
                redirect('admin/attributes');
                die();
            } else {
                redirect('admin/attributes/add');
                die();
            }
        }
    }

    function insert() {

        $title = $this->input->post('title');

        $chk = $this->db->query("select * from attributes_title where title='" . $title . "'");
        if ($chk->num_rows() > 0) {
            $this->session->set_tempdata('error_message', 'Attribute Type already Exist.',3);
            redirect('admin/attributes/add');
        } else {
            $values = array_values(array_filter($this->input->post('values')));
            $date = time();
            $ins = $this->db->insert('attributes_title', array('title' => $title, 'created_date' => $date));
            $last_id = $this->db->insert_id($ins);

            for ($i = 0; $i < count($values); $i++) {
                $data = array(
                    'attribute_titleid ' => $last_id,
                    'value' => $values[$i]
                );
                $insert_query = $this->db->insert('attributes_values', $data);
            }
            if ($insert_query) {
                $this->session->set_tempdata('success_message', 'Attribute Added Successfully',3);
                redirect('admin/attributes');
                die();
            } else {
                $this->session->set_tempdata('error_message', 'Something went wrong',3);
                redirect('admin/attributes/add');
                die();
            }
        }
    }

    function update() {

        $aid = $this->input->post('aid');
        $title = $this->input->post('title');

        $ins = $this->db->update('attributes_title', array('title' => $title), array('id' => $aid));
        $values = array_values(array_filter($this->input->post('values')));
        $id = array_values(array_filter($this->input->post('id')));
        //print_r($this->input->post()); die;

        for ($i = 0; $i < count($values); $i++) {

            if ($id[$i] == true) {
                $data = array(
                    'value' => $values[$i]
                );
                $wr = array('id' => $id[$i]);
                $insert_query = $this->db->update('attributes_values', $data, $wr);
            } else {
                $data = array(
                    'attribute_titleid ' => $aid,
                    'value' => $values[$i]
                );
                $insert_query = $this->db->insert('attributes_values', $data);
            }
        }
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'Attribute Updated Successfully',3);
            redirect('admin/attributes');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong',3);
            redirect('admin/attributes/edit/' . $aid);
            die();
        }
    }

    function update_color($id) {
        $aid = $this->input->post('aid');
        $title = $this->input->post('title');

        $ins = $this->db->update('attributes_title', array('title' => $title), array('id' => $aid));

        $color_code = $this->input->post('color_code');
        $values = $this->input->post('values');
        $id = $this->input->post('id');
        for ($i = 0; $i < count($id); $i++) {
            $data = array(
                'value' => $values[$i],
                'code' => $color_code[$i]
            );
            $wr = array('id' => $id[$i]);
            $insert_query = $this->db->update('attributes_values', $data, $wr);
        }
        if ($insert_query) {
            redirect('admin/attributes');
            die();
        } else {
            redirect('admin/attributes/edit');
            die();
        }
    }

    function delete($id) {

        $this->db->where('id', $id);

        $qry = $this->db->query("select * from manage_attributes where attribute_titleid='" . $id . "'");
        if ($qry->num_rows() > 0) {
            $this->session->set_tempdata('error_message', 'Attribute deletion: already assigned to manage attributes',3);
            redirect('admin/attributes');
        } else {
            if ($this->db->delete('attributes_title')) {
                $wr = array('attribute_titleid' => $id);
                $this->db->delete('attributes_values', $wr);
                $this->session->set_tempdata('success_message', 'Attribute Deleted Successfully',3);
                redirect('admin/attributes');
            } else {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('admin/attributes');
            }
        }
    }

    function valuedelete($id) {
        $qry = $this->db->query("select * from add_variant where find_in_set('" . $id . "',attribute_values)");
        if ($qry->num_rows() > 0) {
            $this->session->set_tempdata('error_message', 'Attribute deletion: already assigned to Add variants',3);
            redirect('admin/attributes');
        } else {

            $this->db->where('id', $id);
            if ($this->db->delete('attributes_values')) {
                $this->session->set_tempdata('success_message', 'Attribute value Deleted Successfully',3);
                redirect('admin/attributes');
            } else {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('admin/attributes');
            }
        }
    }

}
