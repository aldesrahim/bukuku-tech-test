<?php

return [
    'default_driver' => 'kurs-dollar-org',
    'drivers' => [
        'kurs-dollar-org' => \App\Services\ExchangeRate\Drivers\KursDollarOrgDriver::class,
    ],
    'cron' => '7 * * * *',
];
