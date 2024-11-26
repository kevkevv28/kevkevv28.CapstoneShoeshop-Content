<?php

    class PayPal{
        private $clientId;
        private $clientSecretId;
        private $apiEndPoint = PAYPAL_API;

        function __construct($clientId, $clientSecretId){
            $this->clientId = $clientId;
            $this->clientSecretId = $clientSecretId;
        }
    

        function createPayment($amount){
            $ch = curl_init();
            $apiUrl = $this->apiEndPoint . "payments/payment";
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($this->clientId. ':' . $this->clientSecretId)
            );
                $postData=array(
                    'intent' => 'sale',
                    'payer' =>array(
                        'payment_method' => 'paypal'
                    ),
                    'transactions' => array(
                        array(
                        'amount' => array(
                            'total' => $amount,
                            'currency' => 'PHP'
                        ),
                        'description' => 'paypal payment method',
                    )
                    ),
                    'redirect_urls'=>array(
                        'return_url' =>APP_URL. "/success.php",
                        'cancel_url' =>APP_URL. "/cancel.php",
                    )
                    );

                    curl_setopt($ch, CURLOPT_URL, $apiUrl);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    if ($response === false) {
                        echo 'cURL Error: ' . curl_error($ch);
                        curl_close($ch);
                        return null;
                    }
                    curl_close($ch);
                    return json_decode($response, true);
        }

}