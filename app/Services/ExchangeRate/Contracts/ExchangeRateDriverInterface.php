<?php

namespace App\Services\ExchangeRate\Contracts;

interface ExchangeRateDriverInterface
{
    public function getMeta(): array;

    public function getRates(): array;
}
