<?php

namespace Alitvinenko\GoogleApiBundle\Api;

use Alitvinenko\GoogleApiBundle\Exception\InvalidResponseException;

class Language extends AbstractApi
{
    const LANG_EN = 'en';
    const LANG_RU = 'ru';

    /**
     * @param $q
     * @param string $source
     * @param string $target
     * @return mixed
     * @throws InvalidResponseException
     */
    public function translate($q, $source = self::LANG_EN, $target = self::LANG_RU)
    {
        $params = [
            'source' => $source,
            'target' => $target,
            'q' => $q
        ];

        $response = $this->client->get('/language/translate/v2', $params);
        $data = $response->getResponse();

        if (!isset($data['translations'], $data['translations'][0]['translatedText'])) {
            throw new InvalidResponseException($response->getContent());
        }

        return $data['translations'][0]['translatedText'];
    }
}