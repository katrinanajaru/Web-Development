<?php

namespace App\Http\Payments;
// use GuzzleHttp\Client;
class MpesaGateway
{

    public function __construct()
    {
        $this->shortcode1 = "600231";
        $this->InitiatorName = "testapi0231"; //shortcode 1
        $this->SecurityCredential  = "Safcom231!"; //shortcode1
        $this->shortcode2 = "600231"; //shortcode 2
        $this->TestMSISDN = "254708374149";
        $this->shortcode = "174379"; //Lipa Na Mpesa Online Shortcode://4037673
        $this->LipaNaMpesaOnlinePassKey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
    }

    public function get_access_token()
    {
        return "here";

        $Consumer_Key = "NFvAmAESuF667Bvleo2o71wbKluPnkfX";
        $Consumer_Secret = "gY4Lg6osipYRIgwA";
        $key_sec = $Consumer_Key . ":" . $Consumer_Secret;
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $headers = ['Content-Type: application/json;charset=UTF-8'];
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $key_sec);



        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;
        return $access_token;
    }



    public function lipaNaMPesaOnlineAPI($phoneNumber, $amount)
    {
        $phoneNumber = intval($phoneNumber);
        $phoneNumber = '254' . $phoneNumber;
        $phoneNumber = $phoneNumber;

        $api_url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
        $access_token = $this->get_access_token();
        $time = date('YmdHis');
        $shortcode = $this->shortcode;
        $LipaNaMpesaOnlinePassKey =   $this->LipaNaMpesaOnlinePassKey;
        $SecurityCredential  = base64_encode($shortcode . $LipaNaMpesaOnlinePassKey . $time);
        $client = new Client();



        $headers = [
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json',
        ];


        $data = [
            "BusinessShortCode" => $shortcode,
            "Password" => $SecurityCredential,
            "Timestamp" => $time,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phoneNumber,
            "PartyB" => $shortcode,
            "PhoneNumber" => $phoneNumber,
            // "CallBackURL" => route('handle_onlinepayment_result_api') ,
            // "QueueTimeOutURL" => "https://peternjeru.co.ke",// route('handle_QueueTimeOutURL') ,
            "CallBackURL" =>  "https://lagaster.org",
            "QueueTimeOutURL" => "https://lagaster.org",

            "AccountReference" => "Deposite to Wallet",
            "TransactionDesc" => "Deposite to Wallet"
        ];

        try {
            $request = $client->request('POST', $api_url, [
                'headers' => $headers,
                'json' => $data,
            ]);
            $response = $request->getBody()->getContents();
            $response = json_decode($response, true);
            return  $response;
        } catch (\Throwable $th) {

            return $th ;
        }

        return $response;
    }



    public function B2C($phoneNumber, $amount)
    {
        $phoneNumber = intval($phoneNumber);
        $phoneNumber = '254' . $phoneNumber;
        $phoneNumber =  $this->TestMSISDN;
        $api_url = "https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest";
        $access_token = $this->get_access_token();
        $InitiatorName =  $this->InitiatorName;
        $time = date('YmdHis');
        $shortcode = $this->shortcode1;
        $LipaNaMpesaOnlinePassKey =  $this->LipaNaMpesaOnlinePassKey;
        $SecurityCredential  = base64_encode($shortcode . $LipaNaMpesaOnlinePassKey . $time);
        $client = new Client();


        $headers = [
            'Host' => 'sandbox.safaricom.co.ke',
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json',
        ];


        $data = [
            "InitiatorName" => $InitiatorName,
            "SecurityCredential" => $SecurityCredential,
            "CommandID" => "BusinessPayment",
            "Amount" => $amount,
            "PartyA" => $shortcode,
            "PartyB" => $phoneNumber,
            "Remarks" => "Withdraw from wallet",
            "QueueTimeOutURL" => "https://togethergloballyup.com/api/handle-timeout" , // route('handle_QueueTimeOutURL'),
            "ResultURL" => "https://togethergloballyup.com/api/handle-result", // route('handle_b2c_api'),
            "Occasion" => " "

        ];

        try {
            $request = $client->request('POST', $api_url, [
                'headers' => $headers,
                'json' => $data,
            ]);
            $response = $request->getBody()->getContents();
            $response = json_decode($response, true);
            return  $response;
        } catch (\Throwable $th) {

            return $th ;
        }
    }


    public function ReversalAPI($transactionId = null, $amount = 0)
    {


        $api_url = "https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request";
        $access_token = $this->get_access_token();
        $time = date('YmdHis');
        $shortcode = $this->shortcode;
        $LipaNaMpesaOnlinePassKey =   $this->LipaNaMpesaOnlinePassKey;
        $SecurityCredential  = base64_encode($shortcode . $LipaNaMpesaOnlinePassKey . $time);
        $client = new Client();



        $headers = [
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json',
        ];

        $data = [
            "Initiator"=>  $this->InitiatorName ,
            "SecurityCredential" =>  $SecurityCredential,
            "CommandID" => "TransactionReversal",
            "TransactionID" => $transactionId,
            "Amount" => $amount,
            "ReceiverParty" => "601426",
            "RecieverIdentifierType" => "4",
            "ResultURL" => "https://lagaster.org/about",
            "QueueTimeOutURL" => "https://lagaster.org/about",
            "Remarks" => "please",
            "Occasion" => "work"
        ];





        // $response =  Http::withHeaders($headers)->post($api_url, $data)->json();

        try {
            $request = $client->request('POST', $api_url, [
                'headers' => $headers,
                'json' => $data,
            ]);
            $response = $request->getBody()->getContents();
            $response = json_decode($response, true);
            return  $response;
        } catch (\Throwable $th) {

            return $th ;
        }

        return $response;
    }




}
