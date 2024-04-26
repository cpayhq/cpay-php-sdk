<?php

namespace Cpay\Api\Modules;

use Exception;

final class Swap extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    public function estimate(array $query): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/swap/estimate';

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

    public function bestOffer(array $query): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/swap/best-offer';

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

    public function create(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/swap/create';

        $response = $this->sendRequest('POST', $url, [
            'json' => $data,
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

    public function history(?array $query = []): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/swap/history';

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
