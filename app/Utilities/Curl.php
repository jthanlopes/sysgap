<?php

namespace App\Utilities;

/**
* 
*/
class Curl
{
  public function post($url, $payload) {
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, $url);
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);    
    curl_close($verify);

    return $response;
  }
}