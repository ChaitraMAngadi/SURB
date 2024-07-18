<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Questionary_model extends CI_Model {

    function get_data() {
        $table = "questionaries";
        $this->db->select("*");
        $data = $this->db->get($table)->result();
        return $data;
    }

    function get_other_msg_data($cat_id = null) {
        $table = "questionary_other_message";
        $this->db->select("*");
        $this->db->order_by('id', 'desc');
        $data = $this->db->get($table)->result();
        $final = [];
        foreach ($data as $row) {
            $customer_info = $this->db->where('id', $row->user_id)->get('users')->row();
            $row->customer_name = $customer_info->first_name . ' ' . $customer_info->last_name;
            $row->customer_email = $customer_info->email;
            $row->customer_phone = $customer_info->phone;
            $questionary = $this->db->where('id', $row->ques_id)->get('questionaries')->row();
            $row->question = $questionary->question;
            $row->cat_name = $this->db->where('id', $questionary->cat_id)->get('categories')->row()->category_name;
            $row->sub_cat_name = $this->db->where('id', $questionary->sub_cat_id)->get('sub_categories')->row()->sub_category_name;
            if ($cat_id) {
                if ($cat_id == $questionary->cat_id) {
                    array_push($final, $row);
                }
            } else {
                array_push($final, $row);
            }
        }

        return $final;
    }

    function get_data_row($id) {
        $where = array('id' => $id);
        $table = "questionaries";
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();

        $data->options = $this->db->where(array("ques_id" => $data->id))->get("options")->result();
//             echo $this->db->last_query(); die;
        return $data;
    }

    function get_data_with_condition($id) {
        $where = array('id' => $id);
        $table = "questionaries";
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->result();
        return $data;
    }

    function insertData($array) {
        $table = "questionaries";
        $res = $this->db->insert($table, $array);
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateData($array, $id) {
        $table = "questionaries";
        $where = array('id' => $id);
        $upd = $this->db->update($table, $array, $where);

        //echo $this->db->last_query(); die;
        if ($upd) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // function get_total_record($table,$where=[]){
    //     if(sizeof($where)>0){
    //         $his->db->where($where);
    //     }
    //     return $this->db->get($table)->num_rows();
    // }
    // function count_rows_with_condition($where, $table){
    //     $data = $this->db->where($where)->get($table)->num_rows();
    //       return $data;
    // }

    function delete($parameters) {
        $this->db->where('id', $parameters['id']);
        $this->db->delete('questionaries');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

}
