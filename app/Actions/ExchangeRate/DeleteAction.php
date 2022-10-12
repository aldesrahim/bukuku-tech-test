<?php

namespace App\Actions\ExchangeRate;

use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class DeleteAction
{
    public function handle($driver = null, $disk = 'exchange-rate')
    {
        $drivers = config('exchange_rate.drivers');
        $storage = Storage::disk($disk);
        $files = collect($storage->files());

        if ($driver === null) {
            return $storage->delete($files->toArray());
        }

        if (! array_key_exists($driver, $drivers)) {
            throw new InvalidArgumentException('Driver tidak didukung.');
        }

        $files = $files->filter(fn ($file) => str_starts_with($file, "{$driver}-rate"));

        return $storage->delete($files->toArray());
    }
}
