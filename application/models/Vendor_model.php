<?php

class Vendor_model extends CI_Model {

    public $table = 'admin';
    public $logs = 'logs';
    public $ip_check = 'ip_check';
    public $banners = 'banners';
    public $services = 'services';

    function __construct() {

        //load the parent constructor

        parent::__construct();
    }

    public function ip_checking($ip) {
        $this->db->where('ip', $ip);
        $ipcheck = $this->db->get('ipcheck');
        return $ipcheck->row();
    }

    public function ip_insert($ip, $date) {
        $data['date1'] = date('d-m-Y h:i:s');
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $this->db->insert('ipcheck', $data);
        // return $query->row();
    }

    public function admin_login($username, $password) {
        $this->db->where('mobile', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('vendor_shop');
        //echo $this->db->last_query(); die;
        if ($query->num_rows() == 1) {
            $data['admin'] = 'vendors';
            $data['date'] = date('d-m-Y h:i:s');
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
            //$this->db->insert('logs', $data);
            return $query->row();
        } else {
            return false;
        }
    }

    public function verify_password_by_user_id($id, $password) {

        return $this->db->get_where('admin', ['id' => $id, 'password' => $password])->num_rows();
    }

    public function set_password_by_user_id($id, $new_password) {

        $this->db->set('password', $new_password);
        $this->db->where('id', $id);
        return $this->db->update('admin');
    }

    // Get all table rows order by
    public function get_table_data($table_name, $order_col = null, $order_val = null) {
        if ($order_col && $order_val) {
            $this->db->order_by($order_col, $order_val);
        }
        return $this->db->get($table_name)->result();
    }

    // Get row
    public function get_table_row($table_name, $col_name, $val) {
        $this->db->where($col_name, $val);
        return $this->db->get($table_name)->row();
    }

    // Get rows of where clause
    public function get_table_data_by_value($table_name, $col_name, $val) {
        $this->db->order_by('id', 'desc');
        $this->db->where($col_name, $val);
        return $this->db->get($table_name)->result();
    }

    public function get_table_rows_count($table_name) {
        return $this->db->get($table_name)->num_rows();
    }

    // Delete Product
    public function delete_product($id) {
        return $this->db->query("delete from products where id='" . $id . "'");
    }

    // Delete Vendor Admin Comission
    public function delete_vendor_admin_comission($id) {
        return $this->db->query("delete from admin_comissions where id='" . $id . "'");
    }

    function subcategories($cid, $shop_id, $type = null) {

        $qry = $this->db->query("select * from sub_categories where cat_id='" . $cid . "' and status=1");
        $query = $qry->result();
        $output = '<option value="">Select SubCategories</option>';
        foreach ($query as $row) {
            if ($type == 'edit') {
                $output .= '<option value="' . $row->id . '">' . $row->sub_category_name . '</option>';
            } else {
                $qry = $this->db->query("SELECT * FROM `admin_comissions` where cat_id='" . $cid . "' and shop_id='" . $shop_id . "' and find_in_set(subcategory_ids,'" . $row->id . "')");
                if ($qry->num_rows() > 0) {
                    
                } else {
                    $output .= '<option value="' . $row->id . '">' . $row->sub_category_name . '</option>';
                }
            }
        }

        print_r($output);
        die;
        // /return $output;
    }

    function get_questionary_subcategory($cid, $shop_id, $type = null){
        $qry = $this->db->query("select * from sub_categories where cat_id='" . $cid . "' and status=1");
        $query = $qry->result();
        $output = '<option value="">Select SubCategories</option>';
        foreach ($query as $row) {
            if ($type == 'edit') {
                $output .= '<option value="' . $row->id . '">' . $row->sub_category_name . '</option>';
            } else {
                $chk = $this->db->get_where('questionaries',['sub_cat_id'=>$row->id])->num_rows();
                if($chk <= 0){
                    $qry = $this->db->query("SELECT * FROM `admin_comissions` where cat_id='" . $cid . "' and shop_id='" . $shop_id . "' and find_in_set(subcategory_ids,'" . $row->id . "')");
                    if ($qry->num_rows() > 0) {
                        
                    } else {
                        $output .= '<option value="' . $row->id . '">' . $row->sub_category_name . '</option>';
                    }
                }
                
            }
        }

        print_r($output);
        die;
    }

    function subcategoriesforproducts($cid, $shop_id) {
        $qry = $this->db->query("select * from sub_categories where cat_id='" . $cid . "'");
        $query = $qry->result();
        $output = '<option value="">Select Sub-category</option>';
        foreach ($query as $row) {
            $qry = $this->db->query("SELECT * FROM `admin_comissions` where cat_id='" . $cid . "' and shop_id='" . $shop_id . "' and find_in_set('" . $row->id . "',subcategory_ids)");
            if ($qry->num_rows() > 0) {
                $output .= '<option value="' . $row->id . '">' . ucwords($row->sub_category_name) . '</option>';
            }
        }

        print_r($output);
        die;
        //print_r($output_data); die;
        // /return $output;
    }

    function getQuestion($cid, $subcatid = null) {
        if(empty($subcatid)) {
        $question = $this->db->where(array("cat_id" => $cid))->get("questionaries")->result();
        } else {
         $question = $this->db->where(array("sub_cat_id" => $subcatid))->get("questionaries")->result();   
        }

        $output = '<option value="">Select Questionary</option>';
        if (count($question) > 0) {
            foreach ($question as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->question . '</option>';
            }
        }
        print_r($output);
        die;
    }

    function getOption($quesid) {
        $option = $this->db->where(array("ques_id" => $quesid))->get("options")->result();

        $output = '<option value="">Select Option</option>';
        if (count($option) > 0) {
            foreach ($option as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->option . '</option>';
            }
        }
        print_r($output);
        die;
    }

    function getFilters($cid, $subcatid = null) {
        if(empty($subcatid)) {
        $filters = $this->db->where(array("cat_id" => $cid))->get("filters")->result();
        } else {
         $this->db->where("find_in_set($subcatid, sub_cat_id)");
         $filters = $this->db->get("filters")->result(); 
        }
        $output = [];
        if (count($filters) > 0) {
            foreach ($filters as $row) {
                $output[] = '<div class="form-group filter">
                        <label class="col-sm-2 control-label">Filter: </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="filter[]" onchange="getFilterOptions(this)">
                            <option value="">Select Filter</option>
                            <option value="' . $row->id . '">' . $row->title . '</option>
                            </select>
                        </div>
                    </div>
                    <div id="' . $row->id . '"></div>';
            }
        }

        echo json_encode($output);
        die;
    }

    function getFilterOption($filter_id) {
        $option = $this->db->where(array("filter_id" => $filter_id))->get("filter_options")->result();

        $output = '<option value="">Select Filter Option</option>';
        if (count($option) > 0) {
            foreach ($option as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->options . '</option>';
            }
        }
        print_r($output);
        die;
    }

    function getAttributes($category, $subcatid) {

        $qry = $this->db->query("select * from attributes where category='" . $category . "' and subcategory='" . $subcatid . "' group by title");
        $query = $qry->result();
        $output = '<option value="">Select Attribute Title</option>';
        foreach ($query as $row) {
            $output .= '<option value="' . $row->title . '">' . $row->title . '</option>';
        }

        print_r($output);
        die;
    }

    function getAttributesvalues($category, $subcatid, $title) {
        $qry = $this->db->query("select * from attributes where category='" . $category . "' and subcategory='" . $subcatid . "' and title='" . $title . "' order by value asc");
        $query = $qry->result();
        $output = '<option value="">Select Attribute Values</option>';
        foreach ($query as $row) {
            $output .= '<option value="' . $row->value . '">' . $row->value . '</option>';
        }

        print_r($output);
        die;
    }

    function getAttributeValues($type_id) {
        $qry = $this->db->query("select * from attributes_values where attribute_titleid='" . $type_id . "' order by id asc");
        $query = $qry->result();
        $output = '<option value="">Select Attribute Values</option>';
        foreach ($query as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->value . '</option>';
        }

        print_r($output);
        die;
    }

    function saverecords($data) {

        print_r($data);
        die;
        $this->db->set($data);
        $response = $this->db->insert("products");
        if ($response) {
            return true;
        } else {
            return false;
        }
    }
    public function get_vendor_preferences($vendor_id) {
        $this->db->select('notification_preferences');
        $this->db->from('vendor_shop');
        $this->db->where('id', $vendor_id);
        $result = $this->db->get()->row();
        return json_decode($result->notification_preferences, true); // Decode preferences from JSON
    }

    function get_accept_status($id) {
        $table = "orders";
        $where = array("id" => $id);
        $this->db->set('order_status', '2');
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function get_cencel_status($id) {
        $table = "orders";
        $where = array("id" => $id);
        $this->db->set('order_status', '6');
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function update_shipment_status($tracking_name, $tracking_id, $id) {
        $table = "orders";
        $where = array("id" => $id);
        $this->db->set(array("order_status" => 4, "tracking_name" => $tracking_name, "tracking_id" => $tracking_id));
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function get_complete_status($id) {
        $table = "orders";
        $where = array("id" => $id);
        $this->db->set(['order_status' => 5, 'payment_status' => 1]);
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function get_view_filters($id) {

        $table = 'product_filter';
        $where = array('product_id' => $id);
        $this->db->where($where);

        $data = $this->db->get($table)->result();
        //print_r($data);die;
        return $data;
    }

    function get_data_row($table, $where) {

        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    function get_today_orders($shop_id) {
        $table = 'orders';
        $date_start = strtotime(date('Y-m-d 00:00:00'));
        $date_end = strtotime(date('Y-m-d 23:59:59'));
        $where = array("vendor_id" => $shop_id, "created_at >=" => $date_start, 'created_at <=' => $date_end, 'order_status >' => 1);
        $this->db->select("*");
        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        $data = $this->db->get($table)->result();
        //print_r($data);die;
        return $data;
    }


    function count_notifications($vendor_id, $preferences) {
        $table = 'admin_notifications';
        $this->db->select('COUNT(*) as notification_count');
        $this->db->where('vendor_id', $vendor_id);
        $this->db->where('vendor_read_status', 0);
        $all_selected = isset($preferences['all']) && $preferences['all'] == 'on';
        $allowed_types = [];
    
        if (!$all_selected) {
            foreach ($preferences as $key => $value) {
                if ($value == 'on') {
                    $allowed_types[] = $key;
                }
            }
        }
    
        // Apply filtering based on allowed types if 'all' is not selected
        if (!$all_selected && !empty($allowed_types)) {
            $this->db->group_start();  // Group conditions to ensure they are encapsulated correctly
            foreach ($allowed_types as $type) {
                $this->db->or_like('message', $type);  // Check if message contains the keyword
            }
            $this->db->group_end();
        }
    
        $res = $this->db->get($table)->row();
        
        return $res->notification_count;
    }

    function get_today_orders1($shop_id) {
        $table = 'orders';
        $date_start = date('Y-m-d');
        
        $where = array("vendor_id" => $shop_id, "order_date" => $date_start, 'order_status >' => 1);
        $this->db->select("*");
        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        $data = $this->db->get($table)->result();
        //print_r($data);die;
        return $data;
    }

    function get_return_product() {
        $table = 'refund_exchange';
        //$where = array('vendor_id'=>$shop_id);
        $this->db->select("*");
        $data = $this->db->get($table)->result();
        //print_r($data);die;
        return $data;
    }

    function get_vendor_return_product($vendor_id, $type=null) {
        $table = 'refund_exchange';
        if($type == null) {
        $this->db->order_by('id','desc');
        $where = array('vendor_id' => $vendor_id, 'admin_accept' => 1);
        } else if($type == 'new') {
           $this->db->order_by('status','asc');
           $where = array('vendor_id' => $vendor_id, 'status' => 0, 'admin_accept' => 1); 
        }
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->result();
        //print_r($data);die;
        return $data;
    }

    function get_return_status($user_id) {
        $table = "orders";
        $where = array("user_id" => $user_id);
        $this->db->set('order_status', '7');
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function update_refund_status($user_id) {
        $table = "refund_exchange";
        $where = array("user_id" => $user_id);
        $this->db->set('status', '1');
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function get_return_cancelstatus($user_id) {
        $table = "orders";
        $where = array("user_id" => $user_id);
        $this->db->set('order_status', '6');
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function get_reviews($vendor_id) {
        $table = 'user_reviews';
        //$where = array('vendor_id'=>$shop_id);
        $this->db->select("*");
        $data = $this->db->where(array("vendor_id" => $vendor_id))->get($table)->result();
        //print_r($data);die;
        return $data;
    }

    function getbrands($subcatid) {
        $table = 'sub_categories';
        $where = array('id' => $subcatid);
        $this->db->select("*");
        $data = explode(',', $this->db->where($where)->get($table)->row()->brand);

        $output = '<option value="">Select Brand</option>';
        foreach ($data as $row) {
            $qry = $this->db->get_where('attr_brands', ['id' => $row])->row();
            //$brand = $qry->row();
            $output .= '<option value="' . $qry->id . '">' . $qry->brand_name . '</option>';
        }

        print_r($output);
        die;
        //print_r($data);die;
        return $data;
    }

    function check_email($email) {
        $table = 'vendor_shop';
        $where = array('email' => $email);
        $data = $this->db->where($where)->get($table)->num_rows();
        return $data;
    }

    function get_vendor_password($email) {
        $table = 'vendor_shop';
        $where = array('email' => $email);
        $this->db->select("forgot_password");
        $data = $this->db->where($where)->get($table)->row();
        //echo"<pre>";
        //print_r($data);die;
        return $data;
    }
    
    function order_statitics($vendor_id,$preferences) {
        $table = 'admin_notifications';
        $this->db->select('*');
        $this->db->where('vendor_id', $vendor_id);
        $this->db->where('vendor_read_status', 0);
        $this->db->order_by('id','desc');
        $res = $this->db->get($table)->result();
        $all_selected = isset($preferences['all']) && $preferences['all'] == 'on';
    $allowed_types = [];

    if (!$all_selected) {
        foreach ($preferences as $key => $value) {
            if ($value == 'on') {
                $allowed_types[] = $key;
            }
        }
    }

    // Apply filtering based on allowed types if 'all' is not selected
    if (!$all_selected && !empty($allowed_types)) {
        $filtered_res = [];
        foreach ($res as $row) {
            foreach ($allowed_types as $type) {
                if (stripos($row->message, $type) !== false) {
                    $filtered_res[] = $row;
                    break; // If one type matches, no need to check further
                }
            }
        }
        $res = $filtered_res;
    }

        
        foreach($res as $row) {
            $row->user_data = $this->db->where('id',$row->user_id)->get('users')->row();
        }
        
        return $res;
    }

}

?>