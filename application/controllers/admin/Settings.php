<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
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
        $this->data['page_name'] = 'settings';
        $this->data['title'] = 'Settings';
        $qry = $this->db->query("select * from admin where id=1");
        $this->data['admin'] = $qry->row();
        $this->data['site'] = $this->db->get('site_settings')->row();
        $this->data['site'] = $this->db->get('site_settings')->row();
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/settings', $this->data);
        $this->load->view('admin/includes/footer');
    }




    function update() {

        $name = $this->input->get_post('name');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
        $share_title = $this->input->get_post('share_title');
        $playstore_userlink = $this->input->get_post('playstore_userlink');
        $playstore_vendorlink = $this->input->get_post('playstore_vendorlink');
        $playstore_dblink = $this->input->get_post('playstore_dblink');
        $address = $this->input->get_post('address');

        $data = array(
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'address' => $address,
            'share_title' => $share_title,
            'playstore_userlink' => $playstore_userlink,
            'playstore_vendorlink' => $playstore_vendorlink,
            'playstore_dblink' => $playstore_dblink
        );

        $insert_query = $this->db->update('admin', $data,array('id'=>1));

        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'profile updated Successfully.',3);
            redirect('admin/settings');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
            redirect('admin/settings');
            die();
        }



    }


    function updatebonucoins()
    {


        $order_amount = $this->input->get_post('order_amount');
        $coins = $this->input->get_post('coins');
        $coinperamount = $this->input->get_post('coinperamount');

        $data = array(
            'order_amount' => $order_amount,
            'coins' => $coins,
            'coinperamount' => $coinperamount
        );

        $insert_query = $this->db->update('admin', $data,array('id'=>1));

        if ($insert_query) {
            $this->session->set_tempdata('bonussuccess_message', 'Bonu Coins updated Successfully.',3);
            redirect('admin/settings');
            die();
        } else {
            $this->session->set_tempdata('bonuserror_message', 'Something went wrong, Please try again.',3);
            redirect('admin/settings');
            die();
        }



    
    }

    function updateradius()
    {


        $distance = $this->input->get_post('distance');

        $data = array(
            'distance' => $distance
        );

        $insert_query = $this->db->update('admin', $data,array('id'=>1));

        if ($insert_query) {
            $this->session->set_tempdata('distsuccess_message', 'Distance updated Successfully.',3);
            redirect('admin/settings');
            die();
        } else {
            $this->session->set_tempdata('bonuserror_message', 'Something went wrong, Please try again.',3);
            redirect('admin/settings');
            die();
        }



    
    }


    function updatereferral()
    {
        $user_refferal_coins = $this->input->get_post('user_refferal_coins');
        $user_register_coins = $this->input->get_post('user_register_coins');

        $data = array(
            'first_order_coins' => $user_refferal_coins,
            'registration_coins'=>$user_register_coins
        );

        $insert_query = $this->db->update('admin', $data,array('id'=>1));

        if ($insert_query) {
            $this->session->set_tempdata('referallsuccess_message', 'Referall updated Successfully.',3);
            redirect('admin/settings');
            die();
        } else {
            $this->session->set_tempdata('referallerror_message', 'Something went wrong, Please try again.',3);
            redirect('admin/settings');
            die();
        }
    }


    function changePassword()
    {
        $oldpassword = $this->input->get_post('oldpassword');
        $newpassword = $this->input->get_post('newpassword');

        $chk = $this->db->query("select * from admin where id=1 and password='".md5($oldpassword)."'");
        if($chk->num_rows()>0)
        {
            $ar = array('password'=>md5($newpassword));
            $wr = array('id'=>1);
            $upd = $this->db->update("admin",$ar,$wr);
            if($upd)
            {
                $this->session->set_tempdata('success_message', 'Password Changed Successfully.',3);
            redirect('admin/settings');
            }
            
        }
        else
        {
            $this->session->set_tempdata('error_message1', 'Old Password Wrong.',3);
            redirect('admin/settings');
        }
    }

function update_social_media() {
    
    $id=$this->input->post('id');
    //print_r($id); die;
    $qry = $this->db->query("select * from site_settings where id='".$id."'");
    $row = $qry->row();    
//    echo "<pre>";
//    print_r($row); die;
    
    
    //echo $this->db->last_query(); die;
    
     if($this->upload_file('logo')!='')
        {
           $logo =$this->upload_file('logo');
        }
        else
        {
            $logo=$row->logo;
        }

        if($this->upload_file('favicon')!='')
        {
            $favicon = $this->upload_file('favicon');
        }
        else
        {
            $favicon=$row->favicon;
        }
    
    $seo_title = $this->input->post('seo_title');
    $seo_keywords = $this->input->post('seo_keywords');
    $seo_description = $this->input->post('seo_description');
    $email = $this->input->post('email');
    $alt_email = $this->input->post('alt_email');
    $getin_receive_mail = $this->input->post('getin_receive_mail');
    $facebook = $this->input->post('facebook');
    $instagram = $this->input->post('instagram');
    $twitter = $this->input->post('twitter');
    $youtube = $this->input->post('youtube');
    $home_video = $this->input->post('video');
    $home_video_status = $this->input->post('home_video_status');
    $stock_limit = $this->input->post('stock_limit');
        $data = array(
            'logo' => $logo,
            'favicon' =>  $favicon,
            'email' => $email,
            'seo_title' => $seo_title,
            'seo_keywords' => $seo_keywords,
            'seo_description' =>$seo_description,
            'email' => $email,
            'alt_email' => $alt_email,
            'getin_receive_mail' => $getin_receive_mail,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'twitter' => $twitter,
            'youtube' => $youtube,
            'home_video' => $home_video,
            'home_video_status' => $home_video_status,
            'stock_limit' => $stock_limit
        );
    $where = array('id', $id);
        $upd_qry = $this->db->update('site_settings', $data,$where);

        if ($upd_qry) {
            $this->session->set_tempdata('success_message', 'Social media Settings updated Successfully.',3);
            redirect('admin/settings');
            die();
        } else {
            $this->session->set_tempdata('error_message', 'Something went wrong, Please try again.',3);
            redirect('admin/settings');
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
            $upload_path1 = "./uploads/images/";
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
            return 'false';
        }
    }
    else
    {
        return '';
    }
    }

  function admin_logs(){

  $data['page_name'] = 'loginlogs';
        $data['title'] = 'loginlogs';
        $qry1 = $this->db->query("select * from admin where id=1");
        $this->data['admin'] = $qry1->row();

        $qry=$this->db->query("select * from logs order by id desc");
        $data['logs']=$qry->result();

        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/admin_logs', $data);
        $this->load->view('admin/includes/footer');
    }

}