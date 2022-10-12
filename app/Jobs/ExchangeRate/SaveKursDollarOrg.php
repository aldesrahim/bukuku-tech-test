<?php

namespace App\Jobs\ExchangeRate;

use App\Actions\ExchangeRate\SaveAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SaveKursDollarOrg implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SaveAction $action)
    {
        try {
            $action->handle('kurs-dollar-org');
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['name' => 'save-kurs-dollar-org']);
        }
    }
}
