<?php

namespace Alitvinenko\GoogleApiBundle\HttpClient;

use Buzz\Client\Curl;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Alitvinenko\GoogleApiBundle\Exception\ApiException;

class HttpClient
{
    protected $apiKey;

    protected $host = 'https://www.googleapis.com';

    protected $client;

    /**
     * Api constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function get($method, array $params = [])
    {
        $resource = $this->generateResource($method, $this->prepareData($params));
        $request = $this->createRequest(Request::METHOD_GET, $resource);

        return $this->send($request);
    }

    public function post($method, array $params = [])
    {
        $resource = $this->generateResource($method);

        $request = $this->createRequest(Request::METHOD_POST, $resource);
        $request->addHeader('Content-type: application/json');
        $request->setContent($this->prepareData($params));

        return $this->send($request);
    }

    public function send(RequestInterface $request, MessageInterface $response = null)
    {
        if (is_null($response)) {
            $response = new Response();
        }

        $this->lastRequest = $request;
        $this->lastResponse = $response;

        $client = $this->getClient();
        $client->send($request, $response);

        if (!$response->isSuccessful()) {
            throw new ApiException($response->getReasonPhrase(), $response->getErrorCode());
        }

        return $response;
    }

    /**
     * @param $method
     * @param $resource
     * @return Request
     */
    protected function createRequest($method, $resource)
    {
        return new Request($method, $resource, $this->host);
    }

    protected function getClient()
    {
        if ($this->client) {
            return $this->client;
        }

        $this->client = new Curl();

        return $this->client;
    }

    protected function generateResource($method, array $params = [])
    {
        $resource = $method;

        if ($params) {
            return $resource . '?' . http_build_query($this->prepareData($params));
        }

        return $resource;
    }

    protected function prepareData(array $params = [])
    {
        return array_merge(['key' => $this->apiKey], $params);
    }
}