<?php

namespace Cpay\Api\Modules;

use Exception;

final class Withdrawal extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    public function token(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/withdrawal';

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

    public function nft(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/withdrawal/nft';

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

    public function internal(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/withdrawal/internal';

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

    public function estimateFee(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/transaction/fee';

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

    public function estimateNftFee(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/transaction/feeNft';

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

    public function estimateMax(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/withdrawal/estimate-max';

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
