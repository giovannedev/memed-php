<?php

namespace Memed;

use Memed\DTO\Doctor;
use Memed\HTTP\Payload;
use Memed\HTTP\Routes;
use Memed\HTTP\Client;
use Exception;

class DoctorToolkit{

    private $http;

    public function __construct(Client $client)
    {
        $this->http = $client;
    }

    public function signupDoctor(Doctor $Doctor)
    {

        if(($Doctor instanceof Doctor) == false || !$Doctor->_validate()){
            throw new Exception('Invalid Doctor object');
        }

        $payload = new Payload();

        foreach($Doctor as $k => $d){
            $payload->set($k, $d);
        }

        $response = $this->http->_makeCall(Routes::DOCTOR_SIGNUP, NULL, $payload, 'POST');

        if($response['statusCode'] <> 200){
            throw new Exception($response['errors'][0]['detail']);
            return false;
        }else{
            return $response['data']['attributes'];
        }

    }

    public function retrieveDoctorToken($attribute)
    {
        $response = $this->http->_makeCall(Routes::getRoute('DOCTOR_RETRIEVE_TOKEN', $attribute));

        return $response['data']['attributes']['token'];
    }

    public function getDoctorInfo($attribute)
    {
        $response = $this->http->_makeCall(Routes::getRoute('DOCTOR_RETRIEVE_TOKEN', $attribute));

        return $response['data']['attributes'];
    }
}
