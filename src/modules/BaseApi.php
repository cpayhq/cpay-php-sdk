<?php

namespace Cpay\Api\Modules;

use Exception;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class BaseApi
{
    private Client $client;

    protected ?string $token;

    protected CpaySDKBaseOptions $config;

    public function __construct(CpaySDKBaseOptions $config)
    {
        $this->client = new Client();
        $this->config = $config;
        $this->token = null;
    }

    /**
     * @throws GuzzleException
     */
    protected function auth(bool $checkExistToken = false): ?string
    {
        if ($checkExistToken && $this->token) {
            return $this->token;
        }

        $url = $this->config->getApiUrl() . '/api/public/auth';

        $json = [
            'publicKey' => $this->config->getPublicKey(),
            'privateKey' => $this->config->getPrivateKey(),
        ];

        if ($walletId = $this->config->getWalletId()) {
            $json['walletId'] = $walletId;
        }

        if ($passphrase = $this->config->getPassphrase()) {
            $json['passphrase'] = $passphrase;
        }

        $response = $this->client->request('POST', $url, [
            'json' => $json
        ]);

        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            $this->token = $result['token'];

            return $this->token;
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }

    /**
     * Decode response.
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    protected function decodeResponse(ResponseInterface $response): mixed
    {
        $contents = $response->getBody()->getContents();

        return json_decode($contents, true);
    }

    protected function sendRequest(string $method, string $url, ?array $params = [])
    {
        return $this->client->request($method, $url, $params);
    }
}
