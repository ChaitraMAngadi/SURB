<?php

class Add_user extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            redirect('admin/login');
        }
        $this->db->where('name', 'App_user'); 
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
        if (!in_array('App_user', $features)) {
            // Redirect to login or an access denied page
           
            $redirect_url = ($role_name === 'Admin') ? 'admin/login' : 'admin/login_role';

            $this->session->set_tempdata('error_message', 'Access Denied. You do not have permission to access this feature.', 3);
            redirect($redirect_url);
            exit(); // Stop further execution
        }
        $this->load->model("admin_model");
        $this->load->model('UserModel');
        $this->load->model('RoleModel');
        $this->load->model('FeatureModel'); // Using FeatureModel instead of PermissionModel
    }

    // Entry point for creating a user
    public function index() {
        $data['roles'] = $this->RoleModel->get_all_roles();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/create_user', $data);
        $this->load->view('admin/includes/footer');
    }

    public function store_user() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]|trim');
        $this->form_validation->set_rules('role_id', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            // Validation failed, return error message
            $response['success'] = false;
            $response['message'] = validation_errors(); // Get validation errors
        } else {
            $name = trim($this->input->post('name', true));
            $email = trim($this->input->post('email', true));
            $password = password_hash(trim($this->input->post('password', true)), PASSWORD_BCRYPT);
            $role_id = $this->input->post('role_id', true); // XSS filter enabled
            if ($this->UserModel->email_exists($email)) {
                // Email already exists, return error
                $response['success'] = false;
                $response['message'] = 'Email already exists. Please choose a different email.';
            } else {
                if ($this->RoleModel->can_assign_role($role_id)){
                    $user_id = $this->UserModel->create_user($name, $email, $password, $role_id);

                    if ($user_id) {
                        // Return success message as JSON response
                        $this->RoleModel->reduce_role_max_users($role_id);

                        $response['success'] = true;
                        $response['message'] = 'User created successfully!';
                    } else {
                        // Return error message as JSON response
                        $response['success'] = false;
                        $response['message'] = 'Failed to create user. Please try again.';
                    }
                }else {
                    // Max users limit reached for the role, return error
                    $response['success'] = false;
                    $response['message'] = 'Max users limit reached for the selected role.';
                }
            
        }
    }
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    public function list_users() {
        $data['page_name'] = 'Admin_users';
    
        // Fetch all users with their associated roles
        $data['users'] = $this->UserModel->get_all_users_with_roles();
    
        // Load the view with the users and their roles
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/admin_users', $data);
        $this->load->view('admin/includes/footer');
    }
    public function edit($user_id) {
        // Load necessary models
        $this->load->model('UserModel');
        $this->load->model('RoleModel');
        
        // Fetch user details
        $data['user'] = $this->UserModel->get_user($user_id);
        
        // Fetch all roles
        $data['roles'] = $this->RoleModel->get_all_roles();
        
        // Load the view
        $data['title'] = 'Edit User';
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('admin/includes/footer');
    }
    public function edit_user($user_id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('role_id', 'Role', 'required|numeric');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]');
        // $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'matches[password]|trim');
    
        if ($this->form_validation->run() == false) {
            // Validation failed, return error message
            $errors = validation_errors();
            $errors = str_replace(array('<p>', '</p>'), '', $errors);
            $response['success'] = false;
            $response['message'] = $errors; // Get validation errors
        } else {
            // Get sanitized input
            $name = $this->input->post('name', true); // XSS filter enabled
            $email = $this->input->post('email', true); // XSS filter enabled
            $role_id = $this->input->post('role_id', true); // XSS filter enabled
            $password = $this->input->post('password', true); // XSS filter enabled
    
            // Load UserModel
            $this->load->model('UserModel');
    
            // Check if the user exists
            $user = $this->UserModel->get_user($user_id);
            if (!$user) {
                // User not found
                $response['success'] = false;
                $response['message'] = 'User not found.';
            } else {
                // Check if the updated email already exists for another user
                if ($this->UserModel->email_exists_exceptuser($email, $user_id)) {
                    // Email already exists, return error
                    $response['success'] = false;
                    $response['message'] = 'Email already exists. Please choose a different email.';
                } else {
                    // Update user details
                    $update_data = array(
                        'name' => $name,
                        'email' => $email,
                        'role_id' => $role_id,
                    );
    
                    if (!empty($password)) {
                        // If password is provided, hash it and include in update data
                        $update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
                    }
    
                    // Perform the update
                    $update_successful = $this->UserModel->update_user($user_id, $update_data);
    
                    if ($update_successful) {
                        // Return success message as JSON response
                        $response['success'] = true;
                        $response['message'] = 'User updated successfully!';
                    } else {
                        // Return error message as JSON response
                        $response['success'] = false;
                        $response['message'] = 'Failed to update user. Please try again.';
                    }
                }
            }
        }
    
        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function delete_user($user_id) {
        // Load UserModel
        $this->load->model('UserModel');
    
        // Check if user exists
        $user = $this->UserModel->get_user_by_id($user_id);
        if ($user) {
            // Delete user
            $delete_successful = $this->UserModel->delete_user($user_id);
            if ($delete_successful) {
                $response['success'] = true;
                $response['message'] = 'User deleted successfully!';
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to delete user. Please try again.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'User not found.';
        }
    
        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    
}
