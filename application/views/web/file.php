Hello <?php 
$ch = curl_init();
        // $url="https://staging-express.delhivery.com/c/api/pin-codes/json/?filter_codes=521366";
        // $json = '{
        //     "clientName": "AkhilNA",
        //     "ClientId": "d9-ABSOLUTEMENSCOMFASHI-do-cdp",
        //     "ApiToken": "9e58f31a427be52e9a646befab4504a24098e07f",
        //     "redirectMode": "POST",
        //     "Url": "https://staging-express.delhivery.com",
        //     "pickup":"",
        //     "Gateway URL":"https://staging-express.delhivery.com/",
        //     "AWB URL":"https://staging-express.delhivery.com/waybill/api/bulk/",
        //     "Pincode URL":"https://staging-express.delhivery.com/c/api/pin-codes/"
           
        //   }';
        // $apikey="9e58f31a427be52e9a646befab4504a24098e07f";
        $url="https://staging-express.delhivery.com/c/api/pin-codes/json/?parameters";
        // $url="https://staging-express.delhivery.com/c/api/pin-codes/json/?filter_codes=521366";
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp=curl_exec($ch);
        if($e=curl_exec($ch)){

            echo $e;
        }
        else{
            $decoded =json_decode($resp);
            print_r($decoded);
        }
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json',
        //     'Authorization: Token ' . $this->api_key
        // ));

        // Execute cURL session and get the response
        // $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
        ?>
