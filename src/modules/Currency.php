<?php

namespace Cpay\Api\Modules;

use Exception;

final class Currency extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    /**
     * @param ?int $page
     * @param ?int $limit
     * @return mixed
     * @throws GuzzleException
     */
    public function getCurrencies(?int $page = 1, ?int $limit = 50): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/currency';

        $response = $this->sendRequest('GET', $url, [
            'query' => [
                'page' => $page,
                'limit' => $limit
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->auth(true),
            ]
        ]);

        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }
}
