<?php

class Common_model extends CI_Model {

    function get_data($table, $order_by_column = null, $order_by = null) {
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $data = $this->db->get($table)->result();
        return $data;
    }

    function get_data_row($where, $table, $order_by_column = null, $order_by = null) {
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    function get_data_with_condition($where, $table, $order_by_column = null, $order_by = null) {
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $data = $this->db->where($where)->get($table)->result();

        return $data;
    }

    function get_data_with_condition_one($where, $table, $limit, $start ,$order_by_column = null, $order_by = null) {
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $data = $this->db->where($where)->get($table)->result();

        return $data;
    }


    function get_data_with_condition_row($where, $table, $order_by_column = null, $order_by = null) {
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $data = $this->db->where($where)->get($table)->result();
        
        return $data;
    }

    function get_data_with_limit_offset($where, $table, $limit = null, $start = null, $order_by_column = null, $order_by = null) {
        if (isset($limit) && isset($start)) {
            $this->db->limit($limit, $start);
        }
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $data = $this->db->where($where)->get($table)->result();
        return $data;
    }

    function get_data_where_in($column, $arr, $table, $order_by_column = null, $order_by = null) {
        $this->db->select('*');
        $this->db->where_in($column, $arr);
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $res = $this->db->get($table);
        return $res->result();
    }

    function get_data_where_not_in($column, $arr, $table, $order_by_column = null, $order_by = null) {
        $this->db->select('*');
        $this->db->where_not_in($column, $arr);
        if (isset($order_by_column) && isset($order_by)) {
            $this->db->order_by($order_by_column, $order_by);
        }
        $res = $this->db->get($table);
        return $res->result();
    }

    function count_rows_with_conditions($table, $where) {
        if (sizeof($where) > 0) {
            $this->db->where($where);
        }
        return $this->db->get($table)->num_rows();
    }

    function insert_data_get_id($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update_record($where, $table, $data) {
        $this->db->set($data);
        $this->db->where($where);
        $res = $this->db->update($table);
        return $res;
    }

    function delete_record($where, $table) {
        $data = $this->db->where($where)->delete($table);
        return $data;
    }

    public function apply_filter($product_id, $start_amount, $end_amount, $brand_id, $filter, $option) {
        //price range
        if ($start_amount > 0) {
            $this->db->where(['saleprice >=' => $start_amount, 'stock >' => 0, 'status' => 1]);
        }
        if ($end_amount > $start_amount) {
            $this->db->where(['saleprice <=' => $end_amount, 'stock >' => 0, 'status' => 1]);
        }
        $this->db->where('product_id', $product_id);
        $chk_price = $this->db->get('link_variant')->num_rows();
        // $link_qry=$this->db->query("select * from link_variant where product_id='".$product_id."'");
        // $link_qry_res=$link_qry->result();
        $variant = $this->common_model->get_data_row(['product_id' => $product_id, 'stock >' => 0, 'status' => 1], 'link_variant', 'id', 'desc');
        // ||(($variant->saleprice > $start_amount || $variant->saleprice == $start_amount) &&($variant->saleprice < $end_amount || $variant->saleprice == $end_amount))
        // exit;
        // echo "<pre>";
    //    print_r($variant);
     
    // if(($variant->saleprice > $start_amount || $variant->saleprice == $start_amount) &&($variant->saleprice < $end_amount || $variant->saleprice == $end_amount)){
    //  return 1;
    // }
    // else{
    //  return 0;
    // }
        // foreach($link_qry_res as $var){
        //     // print_r($var);
        //     if($var->saleprice > $start_amount && $var->saleprice < $end_amount){
        //         // print_r($var->saleprice);
        //         return 1;
        //     }
        //     else{
        //         return 0;
        //     }
            
        // }
        
        //brand
        $chk_brand = 0;
        foreach ($brand_id as $id) {
            $count = $this->count_rows_with_conditions('products', ['id' => $product_id, 'brand' => $id]);
            if ($count > 0) {
                $chk_brand++;
            }
        }
        //filter & option
        $chk_filter = 0;
        foreach ($filter as $val) {
            $filter_options = explode(',', (($this->get_data_row(['product_id' => $product_id, 'filter_id' => $val], 'product_filter'))->filter_options));
            $match = array_intersect($option, $filter_options);
            if ($match) {
                $chk_filter++;
            }
        }

        if (!empty($end_amount) && !empty($brand_id) && !empty($filter) && !empty($option)) {
            if (($chk_price > 0) &&  ($chk_brand > 0) && ($chk_filter > 0)&&(($variant->saleprice > $start_amount || $variant->saleprice == $start_amount) &&($variant->saleprice < $end_amount || $variant->saleprice == $end_amount)) || is_object($end_amount) || $end_amount === "[object Object]") {
                return 1;
            } else {
                return 0;
            }
        } else if (!empty($end_amount) && !empty($brand_id) && empty($filter) && empty($option)) {
            if (($chk_price > 0) &&  ($chk_brand > 0)&&(($variant->saleprice > $start_amount || $variant->saleprice == $start_amount) &&($variant->saleprice < $end_amount || $variant->saleprice == $end_amount)) || is_object($end_amount) || $end_amount === "[object Object]") {
                return 1;
            } else {
                return 0;
            }
        } else if (!empty($end_amount) && empty($brand_id) && !empty($filter) && !empty($option)) {
            if (($chk_price > 0) &&  ($chk_filter > 0)&&(($variant->saleprice > $start_amount || $variant->saleprice == $start_amount) &&($variant->saleprice < $end_amount || $variant->saleprice == $end_amount)) || is_object($end_amount) || $end_amount === "[object Object]") {
                return 1;
            } else {
                return 0;
            }
        } else if (empty($end_amount) && !empty($brand_id) && !empty($filter) && !empty($option)) {
            if (($chk_brand > 0) && ($chk_filter > 0)) {
                return 1;
            } else {
                return 0;
            }
        } else if (!empty($end_amount) && empty($brand_id) && empty($filter) && empty($option)) {
            if (($chk_price > 0)&& (($variant->saleprice > $start_amount || $variant->saleprice == $start_amount) &&($variant->saleprice < $end_amount || $variant->saleprice == $end_amount)) || is_object($end_amount) || $end_amount === "[object Object]") {
                return 1;
            } else {
                return 0;
            }
        } else if (empty($end_amount) && !empty($brand_id) && empty($filter) && empty($option)) {
            if ($chk_brand > 0) {
                return 1;
            } else {
                return 0;
            }
        } else if (empty($end_amount) && empty($brand_id) && !empty($filter) && !empty($option)) {
            if ($chk_filter > 0) {
                return 1;
            } else {
                return 0;
            }
        }
    //    else if (is_object($end_amount) || $end_amount === "[object Object]" && empty($brand_id) && empty($filter) && empty($option)&&empty($end_amount)) {
    //         return 0;
    //     }
    }

}
