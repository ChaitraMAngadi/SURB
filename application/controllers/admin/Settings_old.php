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

        $data = array(
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
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
            $ar = array('password'=>md5($newpassword),'forgot_password'=>$newpassword);
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

}

