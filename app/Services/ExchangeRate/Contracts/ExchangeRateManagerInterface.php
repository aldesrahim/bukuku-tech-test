<?php

namespace App\Services\ExchangeRate\Contracts;

interface ExchangeRateManagerInterface
{
    public function setDriver($driver): static;

    public function getDrivers(): array;

    public function getDefaultDriver(): string;

    public function getCurrentDriver(): ExchangeRateDriverInterface;

    public function get(): array;
}
