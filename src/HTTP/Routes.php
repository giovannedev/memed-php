<?php

namespace Memed\HTTP;

class Routes{

    public const DOCTOR_SIGNUP = '/v1/sinapse-prescricao/usuarios';
    public const DOCTOR_RETRIEVE_TOKEN = '/v1/sinapse-prescricao/usuarios/{attribute}';
    public const DOCTOR_UPLOAD_PRINT_SETTINGS = '/v1/opcoes-receituario';

    public static function getRoute($route, $attribute)
    {
        return str_replace('{attribute}', $attribute, constant('self::'.$route));
    }
}
