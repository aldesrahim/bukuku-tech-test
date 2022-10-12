<?php

namespace App\Console\Commands\ExchangeRate;

use App\Actions\ExchangeRate\DeleteAction;
use Illuminate\Console\Command;

class DeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rate:delete
                            {driver? : Akan menghapus semua file yang tersimpan jika driver tidak ditentukan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus file JSON yang tersimpan.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(DeleteAction $action)
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
            $this->error('Terjadi kesalahan saat menghapus file.');

            return Command::FAILURE;
        }

        $this->info('File berhasil dihapus.');

        return Command::SUCCESS;
    }
}
