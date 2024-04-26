<?php

namespace Cpay\Api\Modules;

use Exception;

final class Transaction extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    public function list(?array $query = []): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/transaction/list';

        $response = $this->sendRequest('GET', $url, [
            'query' => $query,
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
