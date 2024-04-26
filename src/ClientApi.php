<?php

namespace Cpay\Api;

use Cpay\Api\Modules\CpaySDKBaseOptions;
use Cpay\Api\Modules\Currency;
use Cpay\Api\Modules\ExternalCall;
use Cpay\Api\Modules\Multisend;
use Cpay\Api\Modules\PrivateCheckout;
use Cpay\Api\Modules\PublicCheckout;
use Cpay\Api\Modules\Swap;
use Cpay\Api\Modules\Transaction;
use Cpay\Api\Modules\Wallet;
use Cpay\Api\Modules\Withdrawal;

final class ClientApi
{
    public Wallet $wallet;
    public Currency $currency;
    public PrivateCheckout $privateCheckout;
    public PublicCheckout $publicCheckout;
    public ExternalCall $externalCall;
    public Multisend $multisend;
    public Swap $swap;
    public Transaction $transaction;
    public Withdrawal $withdrawal;

    public function __construct(CpaySDKBaseOptions $config)
    {
        $this->wallet = new Wallet($config);
        $this->currency = new Currency($config);
        $this->privateCheckout = new PrivateCheckout($config);
        $this->publicCheckout = new PublicCheckout($config);
        $this->externalCall = new ExternalCall($config);
        $this->multisend = new Multisend($config);
        $this->swap = new Swap($config);
        $this->transaction = new Transaction($config);
        $this->withdrawal = new Withdrawal($config);
    }
}
