<?php

namespace Cpay\Api\Modules;

use Exception;

final class PrivateCheckout extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    /**
     * @param array $query
     * @return mixed
     * @throws GuzzleException
     */
    public function list(?array $query = []): ?array
    {
        $url = $this->config->getApiUrl() . '/api/public/checkout';

        $params = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->auth(true),
            ]
        ];

        if ($query) {
            $params['query'] = $query;
        }

        $response = $this->sendRequest('GET', $url, $params);
        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }

    public function info(string $checkoutId): ?array
    {
        $url = $this->config->getApiUrl() . "/api/public/checkout/$checkoutId";

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

    public function remove(string $checkoutId): ?bool
    {
        $url = $this->config->getApiUrl() . "/api/public/checkout/$checkoutId";

        $response = $this->sendRequest('DELETE', $url, [
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

    private function createCheckout(array $data, string $type): ?array
    {
        $url = $this->config->getApiUrl() . "/api/public/checkout/$type";

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

    private function updateCheckout(string $checoutId, array $data, string $type): ?array
    {
        $url = $this->config->getApiUrl() . sprintf('/api/public/checkout/%s/%s', $checoutId, $type);

        $response = $this->sendRequest('PATCH', $url, [
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

    /**
     * @param array $data
     * @return mixed
     * @throws GuzzleException
     */
    public function donation(array $data): ?array
    {
        return $this->createCheckout($data, 'donation');
    }

    /**
     * @param array $data
     * @return mixed
     * @throws GuzzleException
     */
    public function sale(array $data): ?array
    {
        return $this->createCheckout($data, 'sale');
    }

    /**
     * @param array $data
     * @return mixed
     * @throws GuzzleException
     */
    public function saleToken(array $data): ?array
    {
        return $this->createCheckout($data, 'saleToken');
    }

    /**
     * @param array $data
     * @return mixed
     * @throws GuzzleException
     */
    public function cart(array $data): ?array
    {
        return $this->createCheckout($data, 'cart');
    }

    public function saleTokenEstimateMax(array $data): array
    {
        $url = $this->config->getApiUrl() . '/api/public/checkout/saleToken/estimateMax';

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

    public function updateDonation(string $checkoutId, array $data)
    {
        return $this->updateCheckout($checkoutId, $data, 'donation');
    }

    public function updateSale(string $checkoutId, array $data)
    {
        return $this->updateCheckout($checkoutId, $data, 'sale');
    }

    public function updateSaleToken(string $checkoutId, array $data)
    {
        return $this->updateCheckout($checkoutId, $data, 'saleToken');
    }

    public function updateCart(string $checkoutId, array $data)
    {
        return $this->updateCheckout($checkoutId, $data, 'cart');
    }

    public function chargeList(string $checkoutId, ?array $query = []): array
    {
        $url = $this->config->getApiUrl() . "/api/public/checkout/$checkoutId/charge-list";

        $params = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->auth(true),
            ]
        ];

        if ($query) {
            $params['query'] = $query;
        }

        $response = $this->sendRequest('GET', $url, $params);
        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }
}
