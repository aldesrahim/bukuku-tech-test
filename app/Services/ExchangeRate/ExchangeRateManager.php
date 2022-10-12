<?php

namespace App\Services\ExchangeRate;

use App\Services\ExchangeRate\Contracts\ExchangeRateDriverInterface;
use App\Services\ExchangeRate\Contracts\ExchangeRateManagerInterface;

class ExchangeRateManager implements ExchangeRateManagerInterface
{
    protected array $drivers;

    protected string $defaultDriver;

    protected ?ExchangeRateDriverInterface $currentDriver = null;

    public function __construct()
    {
        $this->drivers = config('exchange_rate.drivers');
        $this->defaultDriver = config('exchange_rate.default_driver');
    }

    public function getDrivers(): array
    {
        return $this->drivers;
    }

    public function getDefaultDriver(): string
    {
        return $this->defaultDriver;
    }

    public function setDriver($driver): static
    {
        if (! array_key_exists($driver, $this->getDrivers())) {
            throw new \InvalidArgumentException('Driver tidak didukung.');
        }

        $this->currentDriver = app($this->getDrivers()[$driver]);

        return $this;
    }

    public function getCurrentDriver(): ExchangeRateDriverInterface
    {
        if ($this->currentDriver === null) {
            $this->currentDriver = app($this->getDrivers()[$this->getDefaultDriver()]);
        }

        return $this->currentDriver;
    }

    public function get(): array
    {
        return [
            'meta' => $this->getCurrentDriver()->getMeta(),
            'rates' => $this->getCurrentDriver()->getRates(),
        ];
    }
}
