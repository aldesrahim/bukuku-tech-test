<?php

namespace App\Console\Commands\ExchangeRate;

use Illuminate\Console\Command;

class ListDriversCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rate:list-drivers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menampilkan seluruh driver kurs yang tesedia.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $drivers = config('exchange_rate.drivers');
        $rows = [];

        foreach ($drivers as $driver => $className) {
            $rows[] = [
                $driver,
                $className,
            ];
        }

        $this->table(['driver', 'class'], $rows);
        $this->info('Default driver: '.config('exchange_rate.default_driver'));

        return Command::SUCCESS;
    }
}
