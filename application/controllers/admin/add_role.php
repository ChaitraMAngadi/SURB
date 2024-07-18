<?php

class Add_role extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            redirect('admin/login');
        }
        $this->db->where('name', 'Role');
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
        if (!in_array('Role', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
    
        $this->load->model("admin_model");
        $this->load->model('RoleModel');
        $this->load->model('FeatureModel'); // Using FeatureModel instead of PermissionModel
    }

    public function index() {
        // Fetch only active features for the permissions list
        $data['page_name'] = 'Add_role';
        $data['features'] = $this->FeatureModel->get_active_features();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/create_role', $data);
        $this->load->view('admin/includes/footer');
    }

    public function create_role() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('role_name', 'Role Name', 'required|trim');
        $this->form_validation->set_rules('max_users', 'Max Users', 'required|numeric');
        $this->form_validation->set_rules('features[]', 'Features', 'required');


        if ($this->form_validation->run() == false) {
            // Validation failed, return error message
            $response['success'] = false;
            $response['message'] = validation_errors(); // Get validation errors
        }else{

            $sanitized_role_name = strtolower(trim($this->input->post('role_name', true)));
            // print_r($sanitized_role_name);
           
            // exit();
            $role_name = $this->input->post('role_name', true); // XSS filter enabled
            $max_users = $this->input->post('max_users', true); // XSS filter enabled
            $features = $this->input->post('features', true); // XSS filter enabled

            if ($this->RoleModel->role_exists($sanitized_role_name)) {
                // Role name already exists, return error
                $response['success'] = false;
                $response['message'] = 'Role name already exists. Please choose a different name.';
            }else{
                $role_id = $this->RoleModel->create_role($role_name, $max_users);

                if ($role_id) {
                    // Save role features (permissions)
                    if ($features) {
                        foreach ($features as $feature_id) {
                            $this->RoleModel->assign_feature($role_id, $feature_id);
                        }
                    }
                    // Return success message as JSON response
                    $response['success'] = true;
                    $response['message'] = 'Role created successfully!';
                } else {
                    // Return error message as JSON response
                    $response['success'] = false;
                    $response['message'] = 'Failed to create role. Please try again.';
                }

            }



            
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function list_roles() {
        $data['page_name'] = 'Admin_roles';

        // Fetch all roles with their associated features
        $data['roles'] = $this->RoleModel->get_all_roles_with_features();
        
        // Load the view with the roles and their features
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/admin_roles', $data);
        $this->load->view('admin/includes/footer');
    }
 
    public function edit($role_id) {
        // Load necessary models
        $this->load->model('RoleModel');
        $this->load->model('FeatureModel');
        
        // Fetch role details
        $data['role'] = $this->RoleModel->get_role($role_id);
        
        // Fetch all features
        $data['features'] = $this->FeatureModel->get_active_features();
        
        // Fetch role features
        $data['role_features'] = $this->RoleModel->get_role_features($role_id);
        
        // Load the view
        $data['title'] = 'Edit Role';
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/edit_role', $data);
        $this->load->view('admin/includes/footer');
    }
 
    public function edit_role($role_id) {
        // Load form validation library
        $this->load->library('form_validation');
        
        // Set validation rules
        $this->form_validation->set_rules('role_name', 'Role Name', 'required|trim');
        $this->form_validation->set_rules('max_users', 'Max Users', 'required|numeric');
        $this->form_validation->set_rules('features[]', 'Features', 'required');
    
        if ($this->form_validation->run() == false) {
            // Validation failed, return error message
            $response['success'] = false;
            $response['message'] = validation_errors(); // Get validation errors
        } else {
            // Get sanitized input
            $role_name = $this->input->post('role_name', true); // XSS filter enabled
            $max_users = $this->input->post('max_users', true); // XSS filter enabled
            $features = $this->input->post('features', true); // XSS filter enabled
    
            // Load RoleModel
            $this->load->model('RoleModel');
    
            // Update role details
            $update_successful = $this->RoleModel->update_role($role_id, $role_name, $max_users);
    
            if ($update_successful) {
                // Update role features (permissions)
                $this->RoleModel->clear_features($role_id);
                if ($features) {
                    foreach ($features as $feature_id) {
                        $this->RoleModel->assign_feature($role_id, $feature_id);
                    }
                }
                // Return success message as JSON response
                $response['success'] = true;
                $response['message'] = 'Role updated successfully!';
            } else {
                // Return error message as JSON response
                $response['success'] = false;
                $response['message'] = 'Failed to update role. Please try again.';
            }
        }
    
        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
       
}
