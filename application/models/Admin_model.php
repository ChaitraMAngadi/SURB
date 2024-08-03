<?php

class Admin_model extends CI_Model {

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

        $this->db->where('email', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('admin');
        if ($query->num_rows() == 1) {

//             $ip = $_SERVER['REMOTE_ADDR'];
//                $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
            //$city = $details->city;
            /* $ip = 'test';
              $city = 'kakinada'; */

            $adm = $this->db->query("select * from admin where id=1");
            $adm_row = $adm->row();

            $to_mail = $adm_row->email;
            $from_email = 'Sector6';
            $site_name = 'Sector6';
//                $email_message = "IP Address : ".$ip." <br>
//                                  City : ".$city." ";
            $this->load->library('email');
            require_once (APPPATH . 'libraries/vendor/autoload.php');
            require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/PHPMailer.php');
            require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/SMTP.php');
            require_once (APPPATH . 'libraries/vendor/phpmailer/phpmailer/src/Exception.php');

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->From = $from_email;
            $mail->FromName = $site_name;
            $mail->addAddress($to_mail);
            $mail->addReplyTo($from_email, "Reply");
            $mail->isHTML(true);
            $mail->Sender = $from_email;
            $mail->Subject = "$site_name Login IP Address";
//                $mail->Body = $email_message;
//                $sucess = $mail->send();


            $data['admin'] = $adm_row->username;
            $data['user_id'] = $adm_row->id;
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip'] = $this->input->ip_address();
            $data['created_at']= date('Y-m-d');
            $this->db->insert('logs', $data);
            
            return $query->row();
        } else {
            return 'false';
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

    public function get_admin_preferences($admin_id) {
        $this->db->select('notification_preferences');
        // die();
        $this->db->from('admin');
        $this->db->where('id', $admin_id);
        $result = $this->db->get()->row();
        // var_dump($result);
      
        return json_decode($result->notification_preferences, true); // Decode preferences from JSON
    }

    // Delete Product
    public function delete_product($id) {
        return $this->db->query("delete from products where id='" . $id . "'");
    }

    // Delete Vendor Admin Comission
    public function delete_vendor_admin_comission($id) {
        return $this->db->query("delete from admin_comissions where id='" . $id . "'");
    }

    function getCities($state_id) {
        $qry = $this->db->query("select * from cities where state_id='" . $state_id . "'");
        $query = $qry->result();
        $output = '<option value="">Select Cities</option>';
        foreach ($query as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->city_name . '</option>';
        }

        print_r($output);
        die;
        // /return $output;
    }

    function getLocation($city_id) {
        $qry = $this->db->query("select * from locations where city_id='" . $city_id . "'");
        $query = $qry->result();
        $output = '<option value="">Select Location</option>';
        foreach ($query as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->location_name . '</option>';
        }

        print_r($output);
        die;
        // /return $output;
    }

//    function get_product_id($pid){
//        //SELECT cart.* FROM cart INNER JOIN link_variant ON cart.variant_id=link_variant.id WHERE link_variant.product_id=65;
//
//        $this->db->select('cart.*');
//        $this->db->from('cart');
//        $this->db->join('link_variant', 'cart.variant_id= link_variant.id');
//        $this->db->where(array('link_variant.product_id' => $pid));
//        $query=  $this->db->get();
//        return $query->result();
//        
//    }
//    
//    function get_whistlist_data($pid){
//        $table = "whish_list";
//        $data = $this->db->where(array("product_id"=>$pid))->get($table)->result();
//        return $data;
//    }

    function UsersData() {
        $usersdata = $this->db->get("users")->result();
        return $usersdata;
    }

    function get_filter_options($id) {
        $table = "filter_options";
        $where = array("filter_id" => $id);
        $data = $this->db->where($where)->get($table)->result();
        return $data;
    }

    function get_edit_filter_options($filter_id) {
        $table = "product_filter";
        $where = array("filter_id" => $filter_id);
        $data = $this->db->where($where)->get($table)->result();
        return $data;
    }

    function get_filter_row($table, $where) {

        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    function get_fiter_data() {
        $table = 'filters';
        //$where = array('product_id'=>$pid);
        $data = $this->db->get($table)->result();
        return $data;
    }

    function get_options($filter_id) {
        $table = "filter_options";
        $where = array("filter_id" => $filter_id);
        $data = $this->db->where($where)->get($table)->result();
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function get_selected_options($pid, $filter_id) {
        $table = 'product_filter';
        $where = array("product_id" => $pid, 'filter_id' => $filter_id);
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    function count_filters($pid, $filter_id) {
        $data = $this->db->where("product_id", $pid)->where("filter_id", $filter_id)->get('product_filter')->num_rows();
        //  echo $this->db->last_query();die;
        return $data;
    }

    function update_filter($pid, $filter_title, $filter_ar) {
        $table = 'product_filter';
        $where = array('product_id' => $pid, 'filter_id' => $filter_title);
        $this->db->set($filter_ar);
        $data = $this->db->where($where)->update($table);
        return $data;
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
        $this->db->set('order_status', '5');
        $data = $this->db->where($where)->update($table);
        //print_r($this->db->last_query()); die;
        return $data;
    }

    function get_delivered_invoice() {
        $table = 'order_delivered_invoice';
        //$where = array('product_id'=>$pid);
        $data = $this->db->get($table)->row();
        //print_r($data);die;
        return $data;
    }

    function get_edit_delivered($id) {
        $table = 'order_delivered_invoice';
        $where = array('id' => $id);
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    public function updorder($data) {

        $query = $this->db->where(['id' => $data['id']])->update('order_delivered_invoice', $data);
        return true;
    }

    function get_refund_invoice() {
        $table = 'order_refund_invoice';
        $data = $this->db->get($table)->row();
        return $data;
    }

    function get_edit_refund($id) {
        $table = 'order_refund_invoice';
        $where = array('id' => $id);
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    } 

    public function updrefund($data) {

        $query = $this->db->where(['id' => $data['id']])->update('order_refund_invoice', $data);
        return true;
    }

    function get_shipped_invoice() {
        $table = 'order_shipped_invoice';
        $data = $this->db->get($table)->row();
        return $data;
    }

    function get_edit_shipped($id) {
        $table = 'order_shipped_invoice';
        $where = array('id' => $id);
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    public function updshipped($data) {

        $query = $this->db->where(['id' => $data['id']])->update('order_shipped_invoice', $data);
        return true;
    }

    function get_canceled_invoice() {
        $table = 'order_cancelled_invoice';
        $data = $this->db->get($table)->row();
        return $data;
    }

    function get_edit_canceled($id) {
        $table = 'order_cancelled_invoice';
        $where = array('id' => $id);
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    public function updcanceled($data) {

        $query = $this->db->where(['id' => $data['id']])->update('order_cancelled_invoice', $data);
        return true;
    }

    function get_placed_invoice() {
        $table = 'order_placed_invoice';
        $data = $this->db->get($table)->row();
        return $data;
    }

    function get_edit_placed($id) {
        $table = 'order_placed_invoice';
        $where = array('id' => $id);
        $this->db->select("*");
        $data = $this->db->where($where)->get($table)->row();
        return $data;
    }

    public function updplaced($data) {

        $query = $this->db->where(['id' => $data['id']])->update('order_placed_invoice', $data);
        return true;
    }

    function check_email($email) {
        $table = 'admin';
        $where = array('email' => $email);
        $data = $this->db->where($where)->get($table)->num_rows();
        return $data;
    }

    function get_admin_password($email) {
        $table = 'admin';
        $where = array('email' => $email);
        $this->db->select("forgot_password");
        $data = $this->db->where($where)->get($table)->row();
        //echo"<pre>";
        //print_r($data);die;
        return $data;
    }
    
    function order_statitics($preferences) {
        $table = 'admin_notifications';
        $this->db->select('*');
    $all_selected = isset($preferences['all']) && $preferences['all'] == 'on';
    $allowed_types = [];

    if (!$all_selected) {
        foreach ($preferences as $key => $value) {
            if ($value == 'on') {
                $allowed_types[] = $key;
            }
        }
    }

    if (!$all_selected && !empty($allowed_types)) {
        $this->db->group_start();  // Group conditions to ensure they are encapsulated correctly
        foreach ($allowed_types as $type) {
            $this->db->or_like('message', $type);  // Check if message contains the keyword
        }
        $this->db->group_end();
    }

    $this->db->order_by('id', 'desc');
    $res = $this->db->get($table)->result();

   
    
        foreach ($res as $row) {
            $row->vendor_data = $this->db->where('id', $row->vendor_id)->get('vendor_shop')->row();
            $row->user_data = $this->db->where('id', $row->user_id)->get('users')->row();
        }
   
        return $res;
    }




    function count_notifications($preferences) {
        $table = 'admin_notifications';
        $this->db->select('COUNT(*) as notification_count');
        $all_selected = isset($preferences['all']) && $preferences['all'] == 'on';
        $allowed_types = [];
    
        if (!$all_selected) {
            foreach ($preferences as $key => $value) {
                if ($value == 'on') {
                    $allowed_types[] = $key;
                }
            }
        }
    
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
    

      function get_view_data_results($table, $where = null) {
        $this->db->select('*');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }
     function get_view_data_row($table, $where = null) {
        $this->db->select('*');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $query = $this->db->get();
        return $query->row();
    }

    function get_count_data($table, $where = null) {
        $data = $this->db->get($table);
        if (!empty($where)) {
            $this->db->where($where);
        }
        if ($data->num_rows() > 0) {
            $result = $data->num_rows();
            return $result;
        }
    }
    public function admin_login_role($username, $password) {
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('app_users');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return "false";
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

}
