<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Filters_model extends CI_Model {

        function get_data()
        {
            $table = "filters";
            $this->db->select("*");
            //$this->db->order_by('priority', 'asc');
            $data = $this->db->get($table)->result();
            return $data;
        }
        
        function get_data_row($id)
        {
            $where = array('id'=>$id);
            $table = "filters";
            $this->db->select("*");
            
            $data = $this->db->where($where)->get($table)->row();
           
            $data->options = $this->db->where(array("filter_id"=>$data->id))->get("filter_options")->result();
//             echo $this->db->last_query(); die;
            return $data;
        }

        function get_data_with_condition($id)
        {
            $where = array('id'=>$id);
            $table = "filters";
            $this->db->select("*");
            $data = $this->db->where($where)->get($table)->result();
            return $data;
        }

        function insertData($array)
        {
            $table = "filters";
            $res = $this->db->insert($table,$array);
            if($res){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
        function updateData($array,$id)
        {
            $table = "filters";
            $where = array('id'=>$id);
            $upd = $this->db->update($table,$array,$where);
            
            //echo $this->db->last_query(); die;
            if($upd)
            {
                return TRUE;
            }
            else
            {
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
         $this->db->where('id',$parameters['id']);
          $this->db->delete('filters');
          if($this->db->affected_rows() > 0){
          return true;
          } 
    }

        
        
    }     




    