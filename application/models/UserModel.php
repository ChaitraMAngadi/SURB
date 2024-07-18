<?php

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function create_user($name, $email, $password, $role_id) {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role_id' => $role_id
        ];
        return $this->db->insert('app_users', $data);
    }

    public function get_user_by_email($email) {
        $query = $this->db->get_where('app_users', ['email' => $email]);
        return $query->row();
    }
    public function email_exists($email) {
        $query = $this->db->get_where('app_users', ['email' => $email]);
        return $query->num_rows() > 0;
    }
    public function get_all_users_with_roles() {
        $this->db->select('app_users.*, roles.role_name');
        $this->db->from('app_users');
        $this->db->join('roles', 'app_users.role_id = roles.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_user($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('app_users');
        return $query->row();
    }
    
    public function update_user($user_id, $update_data) {
        $this->db->where('id', $user_id);
        return $this->db->update('app_users', $update_data);
    }
    public function email_exists_exceptuser($email, $exclude_user_id = null) {
        $this->db->where('email', $email);
        if ($exclude_user_id) {
            $this->db->where('id !=', $exclude_user_id);
        }
        $query = $this->db->get('app_users');
        return $query->num_rows() > 0;
    }
    public function delete_user($user_id) {
        // Delete user by ID
        $this->db->where('id', $user_id);
        return $this->db->delete('app_users');
    }
    public function get_user_by_id($user_id) {
        $this->db->select('*');
        $this->db->from('app_users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
    
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function get_user_features($role_id) {
        $this->db->select('features.name');
        $this->db->from('role_features');
        $this->db->join('features', 'features.id = role_features.feature_id');
        $this->db->where('role_features.role_id', $role_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'name');
        } else {
            return [];
        }
    }
    public function get_role_name_by_id($role_id) {
        $this->db->select('role_name'); // Select the role_name field
        $this->db->from('roles');
        $this->db->where('id', $role_id);
        $query = $this->db->get();
    
        if ($query->num_rows() == 1) {
            return $query->row()->role_name; // Return the role_name field
        } else {
            return '';
        }
    }
          
}
