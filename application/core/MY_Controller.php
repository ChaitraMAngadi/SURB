<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class MY_Controller extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        $this->data = array();

        $active_cats = $this->common_model->get_data_with_condition(['status' => 1], 'categories', 'priority', 'asc');
        foreach ($active_cats as $cat) {
            $cat->sub_cats = $this->common_model->get_data_with_condition(['cat_id' => $cat->id, 'status' => 1], 'sub_categories');
            if (sizeof($cat->sub_cats) > 0) {
                foreach($cat->sub_cats as $sub_cat) {
                    $sub_cat->sub_categories = $this->web_model->allSubCategories($cat->seo_url, $sub_cat->id);
                }
            }

//                $product_filters = [];
//                foreach ($products as $row) {
//                    $filters = $this->common_model->get_data_with_condition(['product_id' => $row->id], 'product_filter');
//                    if (sizeof($filters) > 0) {
//                        foreach ($filters as $fil) {
//                            array_push($product_filters, $fil);
//                        }
//                    }
//                }
//                $options = explode(',', (implode(',', (array_column($product_filters, 'filter_options')))));
//                $cat->options = array_unique($options);
        }
      
        $this->data['mega_menu'] = $active_cats;
     

        $this->data['site'] = $this->db->get('site_settings')->row();
        //Email Template
        $this->data['order_placed_invoice'] = $this->db->get('order_placed_invoice')->row();
        $this->data['order_shipped_invoice'] = $this->db->get('order_shipped_invoice')->row();
        $this->data['order_delivered_invoice'] = $this->db->get('order_delivered_invoice')->row();
        $this->data['order_cancelled_invoice'] = $this->db->get('order_cancelled_invoice')->row();
        $this->data['order_refund_invoice'] = $this->db->get('order_refund_invoice')->row();


        // $user_id = $_SESSION['userdata']['user_id'];
        // $session_id = $_SESSION['session_data']['session_id'];
        // if ($user_id == '' || $session_id = '') {
        // $this->session->unset_userdata('session_data');
        // $this->session->unset_userdata('userdata');
        // redirect('web');
        // }

    }

    public function my_view($design_view) {
//        $this->load->view("includes/header", $this->data);
        $this->load->view($design_view);
//        $this->load->view("includes/footer");
    }

    function admin_view($design_view) {
//        $this->load->view("includes/header", $this->data);
//        $this->load->view("admin/menu", $this->data);
        $this->load->view("admin/" . $design_view);
//        $this->load->view("includes/footer");
    }

    function send_mail($to, $subject, $message) {
        $config['protocol'] = MAIL_PROTOCOL;
        $config['smtp_host'] = MAIL_SMTP_HOST;
        $config['smtp_port'] = MAIL_SMTP_PORT;
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = MAIL_SMTP_USER;
        $config['smtp_pass'] = MAIL_SMTP_PASS;
        $config['_smtp_auth'] = TRUE;
        $config['smtp_crypto'] = 'tls';
        $config['charset'] = MAIL_CHARSET;
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from(MAIL_SMTP_USER, $this->data['site']->seo_title);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        $response = $this->email->send();

        return $response;
    }

}
