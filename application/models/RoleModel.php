<?php

class RoleModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    public function create_role($role_name, $max_users) {
        $data = [
            'role_name' => $role_name,
            'max_users' => $max_users
        ];
        $this->db->insert('roles', $data);
        return $this->db->insert_id();
    }

    public function assign_feature($role_id, $feature_id) {
        $data = [
            'role_id' => $role_id,
            'feature_id' => $feature_id
        ];
        $this->db->insert('role_features', $data);
    }

    public function get_all_roles_with_features() {
       
        $this->db->select('roles.id, roles.role_name, roles.max_users, GROUP_CONCAT(features.name SEPARATOR ", ") as features');
        $this->db->from('roles');
        $this->db->join('role_features', 'roles.id = role_features.role_id', 'left');
        $this->db->join('features', 'role_features.feature_id = features.id', 'left');
        $this->db->group_by('roles.id');
        $query = $this->db->get();
        return $query->result();
    }


    public function role_exists($role_name) {
    
    $this->db->select('id');
    $this->db->from('roles');
    $this->db->where('LOWER(TRIM(role_name))', strtolower(trim($role_name))); // Case-insensitive and trimmed comparison
    $query = $this->db->get();

    return $query->num_rows() > 0;
}

public function update_role($role_id, $role_name, $max_users) {
    $data = array(
        'role_name' => $role_name,
        'max_users' => $max_users,
    );

    $this->db->where('id', $role_id);
    return $this->db->update('roles', $data);
}
public function clear_features($role_id) {
    $this->db->where('role_id', $role_id);
    $this->db->delete('role_features');
}
public function get_role($role_id) {
    $this->db->where('id', $role_id);
    return $this->db->get('roles')->row();
}
public function get_role_features($role_id) {
    $this->db->select('feature_id');
    $this->db->where('role_id', $role_id);
    $result = $this->db->get('role_features')->result_array();
    
    return array_column($result, 'feature_id');
}
public function get_all_roles() {
    $query = $this->db->get('roles');
    return $query->result();
}
public function can_assign_role($role_id) {
    $this->db->select('max_users');
    $this->db->from('roles');
    $this->db->where('id', $role_id);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        $row = $query->row();
        return $row->max_users > 0;
    }
    return false;
}

public function reduce_role_max_users($role_id) {
    $this->db->set('max_users', 'max_users-1', FALSE);
    $this->db->where('id', $role_id);
    return $this->db->update('roles');
}    
}
