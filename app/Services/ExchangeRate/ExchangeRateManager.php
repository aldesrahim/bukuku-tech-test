<?php

namespace App\Services\ExchangeRate;

use App\Services\ExchangeRate\Contracts\ExchangeRateDriverInterface;

class ExchangeRateManager
{
    protected array $drivers;

    protected string $defaultDriver;

    protected ?ExchangeRateDriverInterface $currentDriver = null;

    public function __construct()
    {
        $this->drivers = config('exchange_rate.drivers');
        $this->defaultDriver = config('exchange_rate.default_driver');
    }

    public function setDriver($driver): static
    {
        if (! array_key_exists($driver, $this->drivers)) {
            $driver = $this->defaultDriver;
        }

        $this->currentDriver = app($this->drivers[$driver]);

        return $this;
    }

    public function getDriver(): ExchangeRateDriverInterface
    {
        if ($this->currentDriver === null) {
            $this->currentDriver = app($this->drivers[$this->defaultDriver]);
        }

        return $this->currentDriver;
    }

    public function get(): array
    {
        return [
            'meta' => $this->getDriver()->getMeta(),
            'rates' => $this->getDriver()->getRates(),
        ];
    }
}
