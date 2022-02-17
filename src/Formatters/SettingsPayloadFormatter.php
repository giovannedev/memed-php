<?php

namespace Memed\Formatters;

use Memed\HTTP\Payload;

class SettingsPayloadFormatter{

    public static function format(Payload $attributes)
    {
        return array(
            'data' => array(
                'type' => 'configuracoes-prescricao',
                'attributes' => $attributes->get()
            ),
        );
    }
}
