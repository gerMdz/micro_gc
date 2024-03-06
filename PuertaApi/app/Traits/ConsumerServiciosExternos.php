<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumerServiciosExternos
{
    public function realizarRequest($metodo, $requestUrl, $formParams = [], $headers = []):string
    {
           $client = new Client([
               'base_uri' => $this->baseUri,
           ]);

           if(isset($this->secret)) {
               $headers['Authorization'] = $this->secret;
           }

           $response = $client->request($metodo, $requestUrl, [
               'form_params' => $formParams,
               'headers' => $headers
           ] );

           return $response->getBody()->getContents();
    }
}
