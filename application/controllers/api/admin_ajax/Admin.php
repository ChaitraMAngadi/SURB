<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("admin_model");
    }

    function get_sub_categories() {
        $cat_id = $this->input->get_post('cat_id');
        $this->db->where('cat_id', $cat_id);
        $sub_catgories_res = $this->db->get('sub_categories')->result();
        if (count($sub_catgories_res) > 0) {
            ?>
            <option value="">Select Sub Category</option>
            <?php
            foreach ($sub_catgories_res as $sub) {
                ?>
                <option value="<?php echo $sub->id; ?>"><?php echo $sub->sub_category_name; ?></option>
                <?php
            }
            die();
        } else {
            ?>
            <option value="">Select Sub Category</option>
            <?php
            die();
        }
    }

    function get_sub_categories_for_questionary() {
        $cat_id = $this->input->get_post('cat_id');
        $sub_catgories_res = $this->common_model->get_data_with_condition(['cat_id' => $cat_id, 'status' => 1], 'sub_categories');
        if (sizeof($sub_catgories_res) > 0) {
            ?>
            <option value="">Select Sub Category</option>
            <?php
            $sub_cat_ids = array_column($sub_catgories_res, 'id');
            $chk_questionary = $this->common_model->get_data_where_in('sub_cat_id', $sub_cat_ids, 'questionaries');
            if (sizeof($chk_questionary) > 0) {
                $sub_cat_ids_in_quest = array_column($chk_questionary, 'sub_cat_id');
                $this->db->where('cat_id', $cat_id);
                $available_sub_cats = $this->common_model->get_data_where_not_in('id', $sub_cat_ids_in_quest, 'sub_categories');
                foreach ($available_sub_cats as $sub) {
                    ?>
                    <option value="<?php echo $sub->id; ?>"><?php echo $sub->sub_category_name; ?></option>
                <?php
                } die();
            }
        } else {
            ?>
            <option value="">Select Sub Category</option>
            <?php
            die();
        }
    }

    function get_cities() {
        $state_id = $this->input->get_post('state_id');
        $this->db->where('state_id', $state_id);
        $locations_res = $this->db->get('cities')->result();
        if (count($locations_res) > 0) {
            ?>
            <option value="">Select Cities</option>
            <?php
            foreach ($locations_res as $loc) {
                ?>
                <option value="<?php echo $loc->id; ?>"><?php echo $loc->city_name; ?></option>
                <?php
            }
            die();
        } else {
            ?>
            <option value="">Select Cities</option>
            <?php
            die();
        }
    }

    function get_city_locations() {
        $city_id = $this->input->get_post('city_id');
        $this->db->where('city_id', $city_id);
        $locations_res = $this->db->get('pincodes')->result();
        if (count($locations_res) > 0) {
            ?>
            <?php
            foreach ($locations_res as $loc) {
                ?>
                <label><input type="checkbox" name="pincodes[]" id="pincodes" value="<?php echo $loc->id; ?>"> &nbsp; <?php echo $loc->pincode; ?> &nbsp; &nbsp;&nbsp; </label>
                <?php
            }
            die();
        } else {
            ?>
            <?php
            die();
        }
    }

    function get_filter_groups() {
        $cat_id = $this->input->get_post('cat_id');
        $this->db->where('find_in_set("' . $cat_id . '", cat_ids) <> 0');
        $filter_groups_res = $this->db->get('filtergroups')->result();
//        echo $this->db->last_query();
//        die();
        if (count($filter_groups_res) > 0) {
            foreach ($filter_groups_res as $f) {
                $list = explode(',', $f->group_values);
                ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= $f->filter_group_name ?>:</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="sub_category" name="sub_cat_id" required>
                                    <option value="">Select <?= $f->filter_group_name ?></option>
                                    <?php
                                    foreach ($list as $l) {
                                        ?>
                                        <option value="1"><?= $l ?></option>
                    <?php
                }
                ?>

                                </select>
                            </div>
                        </div>


                    </div>
                </div>



                <?php
            }
            die();
        } else {

            die();
        }
    }

    function get_stock() {
        $product_id = $this->input->get_post('product_id');
        $stock_data = $this->admin_model->get_table_data_by_value('stock', 'product_id', $product_id);
        if (count($stock_data) > 0) {
            $arr = array('status' => "valid", 'message' => "Records Found", 'data' => $stock_data);
            echo json_encode($arr, JSON_PRETTY_PRINT);
            die;
        } else {
            $arr = array('status' => "invalid", 'message' => "Invalid details");
            echo json_encode($arr, JSON_PRETTY_PRINT);
            die;
        }
    }

}
