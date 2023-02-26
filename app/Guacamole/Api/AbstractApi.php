<?php

namespace App\Guacamole\Api;

use App\Guacamole\Guacamole;
use GuzzleHttp\Client;

abstract class AbstractApi
{
    protected Client $apiClient;

    public function __construct()
    {
        $this->apiClient = new Client([
            'base_uri' => Guacamole::getUrl()
        ]);
    }
}