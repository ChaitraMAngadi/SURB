<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// application/controllers/YourController.php
class DelhiveryController extends CI_Controller {
   
    function checkpincode($pincode){
       

$apiUrl = 'https://staging-express.delhivery.com/c/api/pin-codes/json/';
// $pincode = '520001';
$bearerToken = '81b46fee5028f79840ab568b7bf88a65ec6d67ea';

// Data to be sent in the request
$data = ['filter_codes' => $pincode];

// cURL setup
$ch = curl_init($apiUrl . '?' . http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $bearerToken
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    // Output the API response
    return $response;
}

// Close cURL session
curl_close($ch);

       }
       function checkPincodeServiceability(){
        $pincode=$_POST['pincode'];
        // print_r($_POST['pincode']);
        if($_POST['pincode']!=''){
           $res= $this->checkpincode($pincode);
        //    echo "<pre>";
           $delivery_data = json_decode($res, true);
           $delivery_pin=$delivery_data['delivery_codes'][0]['postal_code']['pin'];

        //    print_r($delivery_pin);
           if($pincode == $delivery_pin){
            $stringData = "This product is deliverable";

            // Pass data to the view
            $data['stringData'] = $stringData;
            // $this->load->view('web/product_view');
           }
           else{
            $stringData = "This product is not deliverable";

            // Pass data to the view
            $data['stringData'] = $stringData;
            // $this->load->view('web/product_view');
           }
            // echo "</pre>";

        }
        else{
            echo "null values not allowed";

        }
        $this->load->view("web/includes/header_styles", $data);
        $this->load->view('web/product_view.php', $data);
        $this->load->view("web/includes/footer", $data);
       }
}

