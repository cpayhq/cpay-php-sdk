<?php

namespace Cpay\Api\Modules;

use Exception;

final class ExternalCall extends BaseApi
{
    public SolanaExternalCall $solana;

    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
        $this->solana = new SolanaExternalCall($config);
    }

    public function read(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/external/read';

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

    public function estimateWrite(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/external/estimateWrite';

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

    public function write(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/external/write';

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
