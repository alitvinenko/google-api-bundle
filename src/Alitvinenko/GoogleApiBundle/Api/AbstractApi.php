<?php

namespace Alitvinenko\GoogleApiBundle\Google\Api;

use Alitvinenko\GoogleApiBundle\HttpClient\HttpClient;

abstract class AbstractApi
{
    protected $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }
}