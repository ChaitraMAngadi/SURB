<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Filters extends REST_Controller {

    public function __construct() { 
      header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    
        parent::__construct();
        
        //load user model
        $this->load->model('user');
        //$this->load->library('email'); 
        
    }

    public function dofilters_post() {
      
        $qry = $this->db->query("select * from link_variant");
        $result = $qry->result();
        foreach ($result as $value) 
        {

          $jsondata = json_decode($value->jsondata); 
          $attr_id=[];
          $attribute_value=[];
          foreach ($jsondata as $js_val) 
          {
              $attr_id[]=$js_val->attribute_type;
              
              $attribute_value[]=$js_val->attribute_value;  
          }
              $a_id = implode(",", $attr_id);
              $a_value = implode(",", $attribute_value);
            $ar = array('attribute_ids'=>$a_id,'attribute_values'=>$a_value);
            $wr = array('id'=>$value->id);
           $this->db->update("link_variant",$ar,$wr);
        }
    }
}



?>