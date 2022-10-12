<?php

namespace App\Providers;

use App\Helper\DateTransformHelper;
use App\Services\ExchangeRate\Contracts\ExchangeRateManagerInterface;
use App\Services\ExchangeRate\ExchangeRateManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->setLocale();

        $this->app->bind(ExchangeRateManagerInterface::class, ExchangeRateManager::class);
    }

    private function setLocale()
    {
        $locale = DateTransformHelper::getLocaleCode();

        setlocale(LC_ALL, $locale);
        Carbon::setLocale($locale);
    }
}
