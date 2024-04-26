<?php

namespace Cpay\Api\Modules;

final class CpaySDKBaseOptions
{
    protected ?string $publicKey;

    protected ?string $privateKey;

    protected ?string $walletId = null;

    protected ?string $passphrase = null;

    protected ?string $token = null;

    protected string $apiUrl = "https://api.cpay.world";

    public function __construct(
        ?string $publicKey = null,
        ?string $privateKey = null,
        ?string $walletId = null,
        ?string $passphrase = null,
        ?string $apiUrl = null
    ) {
        if ($publicKey) {
            $this->publicKey = $publicKey;
        }

        if ($privateKey) {
            $this->privateKey = $privateKey;
        }

        if ($walletId) {
            $this->walletId = $walletId;
        }

        if ($passphrase) {
            $this->passphrase = $passphrase;
        }

        if ($apiUrl) {
            $this->apiUrl = $apiUrl;
        }
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function getWalletId(): ?string
    {
        return $this->walletId;
    }

    public function getPassphrase(): ?string
    {
        return $this->passphrase;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }
}
