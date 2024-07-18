<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Businesshours extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }

    function index() 
    {
        $data['page_name'] = 'businesshours';
        $shop_id = $_SESSION['vendors']['vendor_id'];

        $qry = $this->db->query("select * from working_hours where vendor_id='".$shop_id."'");
        $data['business_hours'] = $qry->result();
        $this->load->view('vendors/includes/header', $data);
        $this->load->view('vendors/businesshours', $this->data);
        $this->load->view('vendors/includes/footer');
    }


    function addbusiness()
    {
        $data['page_name'] = 'businesshours';
        $this->data['title'] = 'Add Business Hours';

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/addbusinesshours', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function edit($id)
    {
        $qry = $this->db->query("select * from working_hours where id='".$id."'");
        $result = $qry->row();
        $this->data['workingdetails'] = $result;
        $data['page_name'] = 'businesshours';
        $this->data['title'] = 'Edit Business Hours';

        $this->load->view('vendors/includes/header', $this->data);

        $this->load->view('vendors/editbusinesshours', $this->data);

        $this->load->view('vendors/includes/footer');
    }

    function insert()
    {
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $weekname = $this->input->post('weekname');
        $working = $this->input->post('working');
        $open_time = $this->input->post('open_time');
        $closed_time = $this->input->post('closed_time');
        $ar = array('vendor_id'=>$shop_id,'weekname'=>$weekname,'working'=>$working,'open_time'=>$open_time,'closed_time'=>$closed_time);
        $chk = $this->db->query("select * from working_hours where weekname='".$weekname."' and vendor_id='".$shop_id."'");
        if($chk->num_rows()>0)
        {
                    $this->session->set_tempdata('error_message', 'Already assigned the week day',3);
                    redirect('vendors/businesshours/addbusiness');
                    die();
        }
        else
        {
                 $ins = $this->db->insert("working_hours",$ar);
                 if ($ins) 
                 {
                    $this->session->set_tempdata('success_message', 'Business Hours Added Successfully',3);
                    redirect('vendors/businesshours');
                    die();
                } 
                else 
                {
                    $this->session->set_tempdata('error_message', 'Please try again',3);
                    redirect('vendors/businesshours/addbusiness');
                    die();
                }
        }
       
    }

    function update()
    {
        $shop_id = $_SESSION['vendors']['vendor_id'];
        $weekname = $this->input->post('weekname');
        $working = $this->input->post('working');
        $open_time = $this->input->post('open_time');
        $closed_time = $this->input->post('closed_time');
        $bid = $this->input->post('bid');
        $ar = array('vendor_id'=>$shop_id,'weekname'=>$weekname,'working'=>$working,'open_time'=>$open_time,'closed_time'=>$closed_time);
        $wr = array('id'=>$bid);
        $chk = $this->db->query("select * from working_hours where id!='".$bid."' and vendor_id='".$shop_id."' and weekname='".$weekname."'");
        if($chk->num_rows()>0)
        {
                    $this->session->set_tempdata('error_message', 'Already assigned the week day',3);
                    redirect('vendors/businesshours/edit');
                    die();
        }
        else
        {
                 $ins = $this->db->update("working_hours",$ar,$wr);
                 if ($ins) 
                 {
                    $this->session->set_tempdata('success_message', 'Business Hours Updated Successfully',3);
                    redirect('vendors/businesshours');
                    die();
                } 
                else 
                {
                    $this->session->set_tempdata('error_message', 'Please try again',3);
                    redirect('vendors/businesshours/edit/'.$bid);
                    die();
                }
        }
       
    

    }

    function delete($id) 
    {
        $this->db->where('id', $id);
        if ($this->db->delete('working_hours')) {
                $this->session->set_tempdata('success_message', 'Business Hours Deleted Successfully',3);
                redirect('vendors/businesshours');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('vendors/businesshours');
         }
    }

}
