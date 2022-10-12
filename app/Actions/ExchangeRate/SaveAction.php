<?php

namespace App\Actions\ExchangeRate;

use App\Services\ExchangeRate\Contracts\ExchangeRateManagerInterface;
use Illuminate\Support\Facades\Storage;

class SaveAction
{
    public function __construct(
        protected ExchangeRateManagerInterface $exchangeRateManager
    ) {
    }

    public function handle($driver, $disk = 'exchange-rate')
    {
        $data = $this->exchangeRateManager->setDriver($driver)->get();

        $filenameDate = now()->format('d-m-Y--H-i-s');
        $filename = "{$driver}-rate-{$filenameDate}.json";

        return Storage::disk($disk)->put($filename, json_encode($data, JSON_PRETTY_PRINT));
    }
}
