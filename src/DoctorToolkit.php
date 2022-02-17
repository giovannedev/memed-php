<?php

namespace Memed;

use Memed\DTO\Doctor;
use Memed\HTTP\Payload;
use Memed\HTTP\Routes;
use Memed\HTTP\Client;
use Exception;

class DoctorToolkit{

    private $http;
    private $prescriptionPrintSettings = [
        "indice"                                => 1,
        "ativo"                                 => true,
        "type"                                  => "configuracoes-cabecalho-rodape",
        "mostrar_label_nome_paciente"           => true,
        "mostrar_data"                          => 1,
        "mostrar_cabecalho_rodape_simples"      => 1,
        "mostrar_unidades"                      => true,
        "mostrar_nome_fabricante"               => true,
        "mostrar_label_paciente_especial"       => 1,
        "mostrar_unidades_especial"             => true,
        "mostrar_cabecalho_rodape_especial"     => 1,
    ];

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

        if($response['statusCode'] == 200 || $response['statusCode'] == 201){
            return $response['data']['attributes'];
        }else{
            if($response['errors'][0]['code'] == 'Email'){
                throw new Exception($response['errors'][0]['detail'], 701);
            }else{
                throw new Exception($response['errors'][0]['detail'], 700);
            }
            return false;
        }

    }

    public function retrieveDoctorToken($attribute)
    {
        $response = $this->http->_makeCall(Routes::getRoute('DOCTOR_RETRIEVE_TOKEN', $attribute));

        if(isset($response['errors'])){
            $r['status'] = $response['statusCode'];
            $r['message'] = $response['errors'][0]['detail'];
            return $r;
        }else{
            return $response['data']['attributes']['token'];
        }
    }

    public function getDoctorInfo($attribute)
    {
        $response = $this->http->_makeCall(Routes::getRoute('DOCTOR_RETRIEVE_TOKEN', $attribute));

        if(isset($response['errors'])){
            $r['status'] = $response['statusCode'];
            $r['message'] = $response['errors'][0]['detail'];
            return $r;
        }else{
            return $response['data']['attributes'];
        }

    }

    public function uploadPrescriptionPrintingSettings()
    {
        $payload = new Payload();
        foreach($this->prescriptionPrintSettings as $k => $d){
            $payload->set($k, $d);
        }
        return $this->http->_makeCall(Routes::DOCTOR_UPLOAD_PRINT_SETTINGS, NULL, $payload, 'POST', 'SettingsPayloadFormatter');
    }
}
