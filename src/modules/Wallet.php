<?php

namespace Cpay\Api\Modules;

use Exception;

final class Wallet extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    /**
     * @param string $currencyId
     * @param string $typeWallet
     * @return mixed
     * @throws GuzzleException
     */
    public function create(string $currencyId, string $typeWallet = 'merchant'): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/wallet/' . $currencyId;

        $response = $this->sendRequest('POST', $url, [
            'json' => [
                'typeWallet' => $typeWallet,
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

    public function info(): array
    {
        $url = $this->config->getApiUrl() . '/api/public/wallet';

        $response = $this->sendRequest('GET', $url, [
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

    public function privateKey()
    {
        $url = $this->config->getApiUrl() . '/api/public/wallet/private-key';

        $response = $this->sendRequest('GET', $url, [
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

    public function mnemomic()
    {
        $url = $this->config->getApiUrl() . '/api/public/wallet/mnemonic';

        $response = $this->sendRequest('GET', $url, [
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
