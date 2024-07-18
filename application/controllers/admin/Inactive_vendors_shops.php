<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Inactive_vendors_shops extends MY_Controller {
    public $data;
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_login')['logged_in'] != true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('admin/login');
        }
        $this->load->model("admin_model");
    }

    function index() {

        $this->data['page_name'] = 'inactive_vendors_shops';
        $this->data['title'] = 'Vendors/Shops';

        $q = $this->input->get_post('q');

        $status = $this->input->get_post('status');

        $city_id = $this->input->get_post('city_id');

        $vm_id = $this->input->get_post('vm_id');

        $cat_id = $this->input->get_post('category_id');

        $deals_of_the_day = $this->input->get_post('deals_of_the_day');

        $this->data['q'] = $q;

        $this->data['status'] = $status;

        $this->data['city_id'] = $city_id;

        $this->data['vm_id'] = $vm_id;

        $this->data['cat_id'] = $cat_id;

        $this->data['deals_of_the_day'] = $deals_of_the_day;

        $this->data['cities'] = $this->admin_model->get_table_data('cities');


        $this->data['categories'] = $this->admin_model->get_table_data('categories');

        $this->db->where('status', 0);
        $this->db->order_by('id', 'desc');
        $this->data['vendor_shops'] = $this->db->get('vendor_shop')->result();

        foreach ($this->data['vendor_shops'] as $v) {
            

            $total_products = $this->db->get_where('products', ['shop_id' => $v->id])->result();

            $v->total_products = count($total_products);

            $total_categories = $this->db->get_where('admin_comissions', ['shop_id' => $v->id])->result();

            $v->total_categories = count($total_categories);
        }

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/inactive_vendors_shops', $this->data);

        $this->load->view('admin/includes/footer');
    }




    function delete($shop_id) {
        /*$this->db->where('id', $shop_id);
       $del = $this->db->delete('vendor_shop');*/

        //echo$del = $this->db->last_query(); die;

       $del = $this->db->update("vendor_shop",array('status'=>1,'delete_status' =>1),array('id' =>$shop_id));
        if($del)
        {
            $this->db->delete('products',array('shop_id'=>$shop_id));
            $this->db->delete('products',array('shop_id'=>$shop_id));
            $this->session->set_tempdata('success_message', 'Shop Deleted Successfully',3);
            redirect('admin/inactive_vendors_shops');
        }
        else
        {
            $this->session->set_tempdata('error_message', 'Something went wrong, Unable to delete',3);
            redirect('admin/inactive_vendors_shops');
        }
    }



    function changeStatus($shop_id,$status)
    {
        $upd = $this->db->update("vendor_shop",array('status' =>$status),array('id' =>$shop_id));
        if($upd)
        {
            $this->session->set_tempdata('success_message', 'Status changes Successfully',3);
            redirect('admin/inactive_vendors_shops');
        }
    }


    function add() {
        
         $this->data['page_name'] = 'inactive_vendors_shops/add';
         
        $this->data['title'] = 'Add Vendor/Shop';

        $this->data['cities'] = $this->db->get('cities')->result();

        $this->data['categories'] = $this->db->get('categories')->result();

        $this->data['visual_merchant'] = $this->db->get('visual_merchant')->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/add_vendor_shop', $this->data);

        $this->load->view('admin/includes/footer');

    }

function send_message($message = "", $mobile_number) {


         $message = urlencode($message);

         $URL = "http://login.smsmoon.com/API/sms.php"; // connecting url 

         $post_fields = ['username' => 'absolutemens', 'password' => 'vizag@123', 'from' => 'absolutemens', 'to' => $mobile_number, 'msg' => $message, 'type' => 1, 'dnd_check' => 0];

         //file_get_contents("http://login.smsmoon.com/API/sms.php?username=colourmoonalerts&password=vizag@123&from=WEBSMS&to=$mobile_number&msg=$message&type=1&dnd_check=0");

         $ch = curl_init();

         curl_setopt($ch, CURLOPT_URL, $URL);

         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

         curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

         curl_exec($ch);

         return true;

      }

      function update()
      {
        $sid = $this->input->get_post('sid');
        $shop_name = $this->input->get_post('shop_name');
        $owner_name = $this->input->get_post('owner_name');
        $description = $this->input->get_post('description');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
       // $password = $this->input->get_post('password');
        $vm_id = $this->input->get_post('vm_id');
        $state_id= $this->input->get_post('state_id');
        $city_id = $this->input->get_post('city_id');
        $address = $this->input->get_post('address');
        //$location_id = $this->input->get_post('location_id');
        $pincode = $this->input->get_post('pincode');
        $latitude = $this->input->get_post('latitude');
        $longitude = $this->input->get_post('longitude');
        $status = 0;

        $delivery_time = $this->input->get_post('delivery_time');
        $min_order_amount = $this->input->get_post('min_order_amount');
        $is_deal_of_the_day = $this->input->get_post('is_deal_of_the_day');
        $deal_start_date = $this->input->get_post('deal_start_date');
        $deal_end_date = $this->input->get_post('deal_end_date');
        $update_status = $this->input->get_post('update_status');


        $pan = $this->input->get_post('pan');
        $aadhar = $this->input->get_post('aadhar');
        $gst_number = $this->input->get_post('gst_number');
        $bankname = $this->input->get_post('bankname');
        $account_no = $this->input->get_post('account_no');
        $accountholder_name = $this->input->get_post('accountholder_name');
        $bank_ifsccode = $this->input->get_post('bank_ifsccode');
        $refferalcode= $this->input->get_post('refferalcode');
        /*$config['upload_path'] = './uploads/shops/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('shop_logo')) 
        {
            $imageDetailArray2 = $this->upload->data();
            $shop_logo = $imageDetailArray2['file_name'];
        }
         else {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
            die();
            $shop_logo = 'default_shop_logo.png';
        }*/


        $qry = $this->db->query("select * from vendor_shop where id='".$sid."'");
        $row = $qry->row();
        if($this->upload_file('shop_image')!='')
        {
            $shop_image = $this->upload_file('shop_image');
        }
        else
        {
            $shop_image = $row->shop_logo;
        }

        if($this->upload_file('shop_logo')!='')
        {
             $shop_logo = $this->upload_file('shop_logo');
        }
        else
        {
             $shop_logo = $row->logo;
        }
        

 $imp_pincode = implode(",", $this->input->get_post('pincodes'));



        $data = array(
            'shop_name' => $shop_name,
            'owner_name' => $owner_name,
            'email' => $email,
            'mobile' => $mobile,
            //'password' => md5($password),
            'shop_logo' => $shop_image,
            'logo' => $shop_logo,
            'address' => $address,
            'state_id' => $state_id,
            'city_id' => $city_id,
            //'location_id'=>$location_id,
            'address'=>$address,
            'pincode' => $pincode,
            'lat' => $latitude,
            'lng' => $longitude,
            'status' =>1,
            'pan'=>$pan,
            'aadhar'=>$aadhar,
            'gst_number'=>$gst_number,
            'bankname'=>$bankname,
            'account_no'=>$account_no,
            'accountholder_name'=>$accountholder_name,
            'bank_ifsccode'=>$bank_ifsccode,
            //'delivery_time'=>$delivery_time,
            'update_status' => $update_status,
            'description' =>$description,
            'refferalcode'=>$refferalcode,
            'min_order_amount' => $this->input->get_post('min_order_amount')
            //'vendor_pincodes'=>$imp_pincode
        );

        if (!$vm_id) {
            unset($data['vm_id']);
        }
        
        
          $insert_query = $this->db->update('vendor_shop', $data,array('id'=>$sid));
        
        

        if ($insert_query) {

            $work_hrs_data = $this->work_hours($this->db->insert_id());

            foreach ($work_hrs_data as $w) {

                $this->db->insert('shop_work_hours', $w);

            }

            $this->session->set_tempdata('success_message', 'Vendor Updated Successfully',3);

            redirect('admin/inactive_vendors_shops');

            die();

        } else {

            $this->session->set_tempdata('error_message', 'Unable to add',3);

            redirect('admin/inactive_vendors_shops/edit');

            die();

        }

    

      }

    function insert() 
    {
        $password = $this->input->get_post('password');



        $shop_image = $this->upload_file('shop_image');
        $shop_logo = $this->upload_file('shop_logo');

        if($this->input->get_post('refferalcode')!='')
        {
            $refferalcode=$this->input->get_post('refferalcode');
        }
        else
        {
            $refferalcode="";
        }

        $imp_pincode = implode(",", $this->input->get_post('pincodes'));

        $data = array(
            'shop_name' => $this->input->get_post('shop_name'),
            'owner_name' => $this->input->get_post('owner_name'),
            'email' => $this->input->get_post('email'),
            'mobile' => $this->input->get_post('mobile'),
            'password' => md5($password),
            'shop_logo' => $shop_image,
            'logo' => $shop_logo,
            'address' => $this->input->get_post('address'),
            'state_id' => $this->input->get_post('state_id'),
            'city_id' => $this->input->get_post('city_id'),
            //'location_id'=>$this->input->get_post('location_id'),
            //'pincode' => $this->input->get_post('pincode'),
            'lat' => $this->input->get_post('latitude'),
            'lng' => $this->input->get_post('longitude'),
            'status' => 0,
            'update_status'=>$this->input->get_post('update_status'),
            //'delivery_time'=>$this->input->get_post('delivery_time'),
            'min_order_amount' => $this->input->get_post('min_order_amount'),
            'created_date'=>date('Y-m-d H:i:s'),
            'description' =>$this->input->get_post('description'),
            'refferalcode'=>$refferalcode,
            //'vendor_pincodes'=>$imp_pincode
        );

        
        $otp_message = 'Your Account created by absolutemens, LINK: '.base_url().'vendors/login  &  USERNAME: '.$this->input->get_post('email').'  & PASSWORD : '.$password;

        /*if($this->send_message($otp_message,$mobile))
        {*/
          $insert_query = $this->db->insert('vendor_shop', $data);

          //echo $this->db->last_query(); die;
        /*}*/

        if ($insert_query) 
        {
            redirect('admin/inactive_vendors_shops');
            die();
        } 
        else 
        {
            $this->session->set_tempdata('error_message', 'Unable to add',3);
            redirect('admin/inactive_vendors_shops/add');
            die();
        }
    }



    private function upload_file($file_name) {
// echo $file_ext = pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);
// die;
            if($_FILES[$file_name]['name']!='')
            {

                if($_FILES[$file_name]["size"]<'5114374')
                {
                    $upload_path1 = "./uploads/shops/";
                    $config1['upload_path'] = $upload_path1;
                    $config1['allowed_types'] = "*";
                    // $config1['allowed_types'] = "*";
                    $config1['max_size'] = "204800000";
                    $img_name1 = strtolower($_FILES[$file_name]['name']);
                    $img_name1 = preg_replace('/[^a-zA-Z0-9\.]/', "_", $img_name1);
                    $config1['file_name'] = date("YmdHis") . rand(0, 9999999) . "_" . $img_name1;
                    $this->load->library('upload', $config1);
                    $this->upload->initialize($config1);
                    $this->upload->do_upload($file_name);
                    $fileDetailArray1 = $this->upload->data();
                    // echo $this->upload->display_errors();
                    // die;
                    return $fileDetailArray1['file_name'];
                }
                else
                {
                    return 'default_shop_logo.png';
                }
            }
            else
            {
                return '';
            }
    }
    



    function edit($id) {
        
        $qry = $this->db->query("select * from vendor_shop where id='".$id."'");
        $row = $qry->row();
        $this->data['vendor_data']=$row;

         $this->data['cities'] = $this->db->get('cities')->result();

        $this->data['categories'] = $this->db->get('categories')->result();

        $this->data['visual_merchant'] = $this->db->get('visual_merchant')->result();

        $this->data['title'] = 'Vendors/Shops';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/edit_vendor_shops', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function manage_categories() {

        $shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) 
        {
            redirect('admin/inactive_vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;

        $this->data['shop_name'] = $this->admin_model->get_table_row('vendor_shop', 'id', $shop_id)->shop_name;

        $this->data['categories'] = $this->admin_model->get_table_data('categories', 'id', 'desc');



        $this->db->select('ad_com.*, c.category_name');

        $this->db->from('admin_comissions ad_com');

        $this->db->join('categories c', 'c.id=ad_com.cat_id');

        $this->db->where('ad_com.shop_id', $shop_id);

        $res = $this->db->get()->result();

        if (count($res) > 0) {

            $this->data['admin_comissions'] = $res;

        }

        $this->data['title'] = 'Manage Categories';

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/vendor_manage_categories', $this->data);

        $this->load->view('admin/includes/footer');

    }


     function manage_locations() {

        /*$shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) 
        {
            redirect('admin/inactive_vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;

       

        $this->data['page_name'] = 'pincodes';
        $this->data['title'] = 'Pincodes';
        $qry = $this->db->query("select * from pincodes where shop_id='".$shop_id."'");
        $this->data['pincodes'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/pincodes', $this->data);
        $this->load->view('admin/includes/footer');*/


$shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) 
        {
            redirect('admin/inactive_vendors_shops/');
            die();
        }
        $this->data['shop_id'] = $shop_id;

        $this->data['page_name'] = 'cities';
        $this->data['title'] = 'Cities';
        $qry = $this->db->query("select * from cities where vendor_id='".$shop_id."'");
        $this->data['cities'] = $qry->result();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/cities', $this->data);
        $this->load->view('admin/includes/footer');

    

    }

    function manage_pincodes() {

        $shop_id = $this->input->get_post('shop_id');

        if (!$shop_id) 
        {
            redirect('admin/inactive_vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;

       

        $this->data['page_name'] = 'pincodes';
        $this->data['title'] = 'Pincodes';
        $qry = $this->db->query("select * from pincodes where shop_id='".$shop_id."'");
        $this->data['pincodes'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/pincodes', $this->data);
        $this->load->view('admin/includes/footer');


    

    }

    function manage_areas() {

        $shop_id = $this->input->get_post('shop_id');
        if (!$shop_id) 
        {
            redirect('admin/inactive_vendors_shops/');
            die();
        }

        $this->data['shop_id'] = $shop_id;

       
        $this->data['page_name'] = 'locations';
        $this->data['title'] = 'Areas';

        $qry = $this->db->query("select * from areas where vendor_id='".$shop_id."'");
        $this->data['locations'] = $qry->result();

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/locations', $this->data);
        $this->load->view('admin/includes/footer');

    

    }



    function insert_cat_comission() {

        $shop_id = $this->input->get_post('shop_id');

        $cat_id = $this->input->get_post('cat_id');
        $sub_categories = $this->input->get_post('sub_categories');
        $subcategory_ids = implode(",", $sub_categories);
        $admin_commission = $this->input->get_post('admin_comission');
        $gst = $this->input->get_post('gst');

        $status = $this->input->get_post('status');



        $this->db->where('cat_id', $cat_id);

        $this->db->where('shop_id', $shop_id);

        $res = $this->db->get('admin_comissions')->result();



        /*if (count($res) > 0) {

            $data = array(

                'admin_comission' => $admin_commission,
                'subcategory_ids' =>$subcategory_ids,
                'gst' =>$gst,
                'status' => $status,
                'updated_at' => time());

            $this->db->where('cat_id', $cat_id);

            $this->db->where('shop_id', $shop_id);

            if ($this->db->update('admin_comissions', $data)) {

                redirect('admin/inactive_vendors_shops/manage_categories?shop_id=' . $shop_id);

                die();

            } else {

                redirect('admin/inactive_vendors_shops/');

                die();

            }

        } else {*/

            $data = array('shop_id' => $shop_id,

                'cat_id' => $cat_id,
                'subcategory_ids' =>$subcategory_ids,
                'admin_comission' => $admin_commission,
                'gst' =>$gst,
                'status' => $status,
                'created_at' => time());

            $insert = $this->db->insert('admin_comissions', $data);
            if ($insert) {
                redirect('admin/inactive_vendors_shops/manage_categories?shop_id=' . $shop_id);
                die();
            } else {
                redirect('admin/inactive_vendors_shops/');
                die();
            }

        //}

    }



    function delete_vendor_admin_comission() {

        $admin_com_id = $this->input->get_post('admin_com_id');

        $shop_id = $this->input->get_post('shop_id');



        if ($this->admin_model->delete_vendor_admin_comission($admin_com_id)) {

            $this->session->set_tempdata('success_message', 'Comission Deleted Successfully',3);

            redirect('admin/inactive_vendors_shops/manage_categories?shop_id=' . $shop_id);

            die();

        } else {

            $this->session->set_tempdata('error_message', 'Unable to delete',3);

            redirect('admin/inactive_vendors_shops/manage_categories?shop_id=' . $shop_id);

            die();

        }

    }






    function manage_shop_banners() {

        $shop_id = $this->input->get_post('shop_id');

        $shop_banners = $this->db->get_where('vendor_shop_banners', ['shop_id' => $shop_id, 'status' => 1])->result();

        $this->data['shop_banners'] = $shop_banners;

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/manage_shop_banners', $this->data);

        $this->load->view('admin/includes/footer');

    }



    function add_shop_banner() {

        $title = $this->input->get_post('title');

    }



    function manage_work_hours($shop_id) {

        $this->data['title'] = 'Edit Shop Work Hours';

        $this->data['work_hours'] = $this->db->get_where('shop_work_hours', ['shop_id' => $shop_id])->result();

        $this->load->view('admin/includes/header', $this->data);

        $this->load->view('admin/manage_work_hours', $this->data);

        $this->load->view('admin/includes/footer');

    }



    private function work_hours($shop_id) {

        $work_hrs_data[] = array(

            'week_name' => 'Monday',

            'is_working_day' => 'Yes',

            'open_time' => '10:00:00',

            'close_time' => '20:00:00',

            'shop_id' => $shop_id,

            'status' => 1

        );

        $work_hrs_data[] = array(

            'week_name' => 'Tuesday',

            'is_working_day' => 'Yes',

            'open_time' => '10:00:00',

            'close_time' => '20:00:00',

            'shop_id' => $shop_id,

            'status' => 1

        );

        $work_hrs_data[] = array(

            'week_name' => 'Wednesday',

            'is_working_day' => 'Yes',

            'open_time' => '10:00',

            'close_time' => '20:00',

            'shop_id' => $shop_id,

            'status' => 1

        );

        $work_hrs_data[] = array(

            'week_name' => 'Thursday',

            'is_working_day' => 'Yes',

            'open_time' => '10:00',

            'close_time' => '20:00',

            'shop_id' => $shop_id,

            'status' => 1

        );

        $work_hrs_data[] = array(

            'week_name' => 'Friday',

            'is_working_day' => 'Yes',

            'open_time' => '10:00',

            'close_time' => '20:00',

            'shop_id' => $shop_id,

            'status' => 1

        );

        $work_hrs_data[] = array(

            'week_name' => 'Saturday',

            'is_working_day' => 'Yes',

            'open_time' => '10:00',

            'close_time' => '20:00',

            'shop_id' => $shop_id,

            'status' => 1

        );

        $work_hrs_data[] = array(

            'week_name' => 'Sunday',

            'is_working_day' => 'Yes',

            'open_time' => '10:00',

            'close_time' => '20:00',

            'shop_id' => $shop_id,

            'status' => 1

        );

        return $work_hrs_data;

    }



}

