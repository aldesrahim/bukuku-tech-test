<?php

namespace App\Console\Commands\ExchangeRate;

use App\Actions\ExchangeRate\SaveAction;
use Illuminate\Console\Command;

class SaveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rate:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengambil data kurs dari driver yang ditentukan lalu disimpan dalam bentuk file JSON.';

    public function __construct()
    {
        $defaultDriver = config('exchange_rate.default_driver');
        $this->signature = "exchange-rate:save {driver={$defaultDriver}}";

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SaveAction $action)
    {
        $driver = $this->argument('driver');

        try {
            $status = $action->handle($driver);
        } catch (\InvalidArgumentException $e) {
            $this->error($e->getMessage());

            return Command::INVALID;
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }

        if (! $status) {
            $this->error('Terjadi kesalahan saat menyimpan data kurs.');

            return Command::FAILURE;
        }

        $this->info('Data kurs berhasil disimpan.');

        return Command::SUCCESS;
    }
}
