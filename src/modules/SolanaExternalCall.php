<?php

namespace Cpay\Api\Modules;

use Exception;

final class SolanaExternalCall extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    public function mintNft(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/external/mint-solana-nft';

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

    public function estimateMintNft(array $data): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/external/mint-solana-nft/estimate';

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
