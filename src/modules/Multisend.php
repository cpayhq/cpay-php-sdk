<?php

namespace Cpay\Api\Modules;

use Exception;

final class Multisend extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    public function estimateSystemFee(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/multisend/estimateSystemFee';

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

    public function approve(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/multisend/approve';

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

    public function estimateMinerFee(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/multisend/estimateMinerFee';

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

    public function create(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/multisend';

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
}
