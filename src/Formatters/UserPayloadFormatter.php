<?php

namespace Memed\Formatters;

use Memed\HTTP\Payload;

class UserPayloadFormatter{

    public static function format(Payload $attributes, $relationships = array())
    {
        return array(
            'data' => array(
                'type' => 'usuarios',
                'attributes' => $attributes->get(),
                'relationships' => $relationships,
            ),
        );
    }
}
