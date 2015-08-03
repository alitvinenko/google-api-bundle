<?php

namespace Alitvinenko\GoogleApiBundle\HttpClient;

use Alitvinenko\GoogleApiBundle\Exception\InvalidResponseException;

class Response extends \Buzz\Message\Response
{
    private $arrayResult;

    public function getArrayResult($field = null)
    {
        if (null == $this->arrayResult) {
            $this->arrayResult = json_decode($this->getContent(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidResponseException($this->getContent());
            }
        }

        if (null !== $field) {
            if (null !== $this->arrayResult && isset($this->arrayResult[$field])) {
                return $this->arrayResult[$field];
            }
            return null;
        }

        return $this->arrayResult;
    }

    public function getErrorCode()
    {
        $result = $this->getArrayResult();

        if (!isset($result['error'], $result['error']['code'])) {
            return 0;
        }

        return $result['error']['code'];
    }

    public function getResponse()
    {
        $result = $this->getArrayResult();

        return $result['data'];
    }

    public function isSuccessful()
    {
        if (parent::isSuccessful()) {
            $result = $this->getArrayResult();
            return !array_key_exists('error', $result);
        }

        return false;
    }

    public function getReasonPhrase()
    {
        $response = $this->getArrayResult('error');

        if (array_key_exists('message', $response)) {
            return $response['message'];
        }

        return 'Unknown error';
    }
}