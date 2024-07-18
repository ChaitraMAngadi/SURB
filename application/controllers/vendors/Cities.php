    <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends MY_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendors')['vendors_logged_in']!= true) {
            //$this->session->set_tempdata('error', 'Session Timed Out',3);
            redirect('vendors/login');
        }
    }


     function index() {
        $this->data['page_name'] = 'cities';
        $this->data['title'] = 'Cities';

        $shop_id = $_SESSION['vendors']['vendor_id'];
         $shop = $this->db->query("select * from vendor_shop where id='".$shop_id."'");
         $shop_row =$shop->row();

         $city_id=$shop_row->city_id;

        $qry = $this->db->query("select * from cities where id='".$city_id."'");
        $this->data['cities'] = $qry->row();
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/cities', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function add() {
        $this->data['title'] = 'Add City';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/add_city', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function edit($id) {
        $qry = $this->db->query("select * from cities where id='".$id."'");
        $this->data['city_row'] = $qry->row();
        $this->data['title'] = 'Edit City';
        $this->load->view('vendors/includes/header', $this->data);
        $this->load->view('vendors/edit_city', $this->data);
        $this->load->view('vendors/includes/footer');
    }

    function insert() {
        $state_id = $this->input->get_post('state_id');
        $city_name = $this->input->get_post('city_name');
        $data = array(
            'state_id' => $state_id,
            'city_name' => $city_name,
            'created_at' => time()
        );
        $insert_query = $this->db->insert('cities', $data);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'City Added Successfully',3);
            redirect('vendors/cities');
            die();
        } else {
            redirect('vendors/cities/add');
            die();
        }
    }

    function update() {
        $id = $this->input->get_post('cid');
        $state_id = $this->input->get_post('state_id');
        $city_name = $this->input->get_post('city_name');
        $data = array(
            'state_id' => $state_id,
            'city_name' => $city_name
        );
        $wr = array('id'=>$id);
        $insert_query = $this->db->update('cities', $data, $wr);
        if ($insert_query) {
            $this->session->set_tempdata('success_message', 'City Updated Successfully',3);
            redirect('vendors/cities');
            die();
        } else {
            redirect('vendors/cities/add');
            die();
        }
    }


    function delete($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('cities')) {
                $this->session->set_tempdata('success_message', 'City Deleted Successfully',3);
                redirect('vendors/cities');
         } 
         else 
         {
                $this->session->set_tempdata('error_message', 'Unable to delete',3);
                redirect('vendors/cities');
         }

    }




   

}
