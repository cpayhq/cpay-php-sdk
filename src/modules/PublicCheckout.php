<?php

namespace Cpay\Api\Modules;

use Exception;

final class PublicCheckout extends BaseApi
{
    public function __construct(CpaySDKBaseOptions $config)
    {
        parent::__construct($config);
    }

    public function checkoutInfo(string $checkoutIdentifier): ?array
    {
        $url = $this->config->getApiUrl() . "/api/checkout-client/$checkoutIdentifier";

        $response = $this->sendRequest('GET', $url);
        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }

    public function estimateSaleTokenCharge(string $checkoutIdentifier, array $query): array
    {
        $url = $this->config->getApiUrl() . "/api/checkout-client/$checkoutIdentifier/estimate";

        $response = $this->sendRequest('POST', $url, [
            'query' => $query
        ]);
        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }

    private function createCharge(string $checkoutIdentifier, string $type, ?array $query = []): array
    {
        $url = $this->config->getApiUrl() . "/api/checkout-client/$checkoutIdentifier/$type";

        $response = $this->sendRequest('POST', $url, [
            'query' => $query
        ]);
        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }

    public function createChargeByCheckout(string $checkoutIdentifier, ?array $query = []): array
    {
        return $this->createCharge($checkoutIdentifier, 'charge', $query);
    }

    public function createSaleTokenChargeByCheckout(string $checkoutIdentifier, ?array $query = []): array
    {
        return $this->createCharge($checkoutIdentifier, 'saleTokenCharge', $query);
    }

    private function getChargeInfo(string $chargeId, string $type, ?array $query = []): array
    {
        $url = $this->config->getApiUrl() . "/api/checkout-client/$chargeId/$type";

        $params = [];
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

    public function chargeInfo(string $chargeId, ?array $query = []): array
    {
        return $this->getChargeInfo($chargeId, 'charge', $query);
    }

    public function saleTokenChargeInfo(string $chargeId, ?array $query = []): array
    {
        return $this->getChargeInfo($chargeId, 'saleTokenCharge', $query);
    }

    public function updateCustomerDetailByCharge(string $chargeId, array $data): ?array
    {
        $url = $this->config->getApiUrl() . "/api/checkout-client/$chargeId/customerDetails";

        $response = $this->sendRequest('POST', $url, [
            'json' => $data,
        ]);
        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }

    public function createWalletByCharge(string $chargeId, string $currencyId): ?array
    {
        $url = $this->config->getApiUrl() . "/api/checkout-client/$chargeId/wallet/$currencyId";

        $response = $this->sendRequest('POST', $url);
        $result = $this->decodeResponse($response);

        if ($response->getStatusCode() == 200) {
            return $result['data'];
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($result['message']);
        }
    }
}
