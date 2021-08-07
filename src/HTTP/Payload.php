<?php

namespace Memed\HTTP;

class Payload{

    private $payload = array();

    public function set($key, $value)
    {
        $this->payload[$key] = $value;
    }

    public function get()
    {
        return $this->payload;
    }

    public function getJson()
    {
        return json_encode($this->get());
    }

}
