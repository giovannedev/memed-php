<?php

namespace Memed\HTTP;

use Exception;
use GuzzleHttp\Psr7\Request;
use Memed\DTO\Doctor;
use Memed\HTTP\Payload;
use Memed\Formatters;

class Client
{


    private $apiEndpoint = '';
    private $apiKey;
    private $apiSecret;
    private $disableContentTypeHeader = false;


    public function __construct($endpoint = 'https://integrations.api.memed.com.br')
    {
        $this->apiEndpoint = $endpoint;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;
    }

    private function _validateRequisites()
    {
        if ($this->apiSecret == NULL || $this->apiKey == NULL) {
            throw new Exception('API Key and API Secret must be defined using the appropriate setters.');
        }
    }

    private function disableContentTypeHeader()
    {
        $this->disableContentTypeHeader = true;
    }

    private function _getHeaders($json = true)
    {
        $headers = array(
            'Accept' => 'application/vnd.api+json',
            'Cache-Control' => 'no-cache',
        );

        if(!$this->disableContentTypeHeader){
            $headers['Content-Type'] = 'application/json';
        }
        return $headers;
    }

    public function _makeCall($path = '', array $queryString = NULL, Payload $payload = NULL, $method = 'GET')
    {

        $this->_validateRequisites();

        if($method == 'GET'){
            //$this->disableContentTypeHeader();
        }

        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->apiEndpoint,
            'headers' => $this->_getHeaders(),
            'http_errors' => false
        ]);

        $requestPayload = array();

        if($queryString <> NULL){
            $requestPayload['query'] = $queryString;
        }

        if($payload <> NULL){
            $requestPayload['body'] = json_encode(Formatters\UserPayloadFormatter::format($payload));
        }

        $response = $client->request($method, $path . '?api-key=' . $this->apiKey . '&secret-key=' . $this->apiSecret, $requestPayload);



        $bodyResponse = json_decode((string) $response->getBody(), true);
        $bodyResponse['statusCode'] = $response->getStatusCode();
        return $bodyResponse;
    }
}
