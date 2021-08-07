<?php

namespace Memed\DTO;

use Exception;
use Memed\HTTP\Client;

class Doctor{


    public $external_id;

    public $nome;

    public $sobrenome;

    public $data_nascimento;

    public $email;

    public $sexo;

    public $crm;


    public function _validate()
    {
        if($this->external_id != NULL || $this->nome != NULL || $this->sobrenome != NULL || $this->email != NULL || $this->crm != NULL){
            return true;
        }else{
            return false;
            //throw new Exception('Incomplete Doctor object');
        }
    }

}
