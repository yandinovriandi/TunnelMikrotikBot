<?php

namespace App\Services;

class TripayService
{
    public function __construct()
    {
        $this->tripay_api_key = config('tripay.api_key');
        $this->tripay_private_key = config('tripay.private_key');
        $this->tripay_merchant_code = config('tripay.merchant_code');
    }

    public function getPayments()
    {
        $apiKey = $this->tripay_api_key;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;

        return empty($error) ? $response : $error;
    }

    public function requestTransaction($amount, $method)
    {
        $apiKey       = $this->tripay_api_key;
        $privateKey   = $this->tripay_private_key;
        $merchantCode = $this->tripay_merchant_code;

        $inv = 'INV-' . time();
        $user = auth()->user();
        $merchantRef  = $inv;
        $amount       = $amount;

        $data = [
            'method' => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone,
            'order_items'    => [
                [
                    'name'        => 'Topup Saldo',
                    'price'       => $amount,
                    'quantity'    => 1,
                ]
            ],
            'return_url'   => 'http://mangandroid.test/topup/transaksi',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;

        return empty($error) ? $response : $error;
    }

    public function detailsTransaction($reference)
    {

        $apiKey =  $this->tripay_api_key;

        $payload = ['reference' => $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return empty($error) ? $response : $error;
    }
}
