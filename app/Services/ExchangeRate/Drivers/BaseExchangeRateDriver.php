<?php

namespace App\Services\ExchangeRate\Drivers;

use App\Services\ExchangeRate\Contracts\ExchangeRateDriverInterface;
use Goutte\Client;

abstract class BaseExchangeRateDriver implements ExchangeRateDriverInterface
{
    protected Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    abstract public function getMeta(): array;

    abstract public function getRates(): array;
}
