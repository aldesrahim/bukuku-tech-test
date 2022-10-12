<?php

namespace App\Providers;

use App\Helper\DateTransformHelper;
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
    }

    private function setLocale()
    {
        $locale = DateTransformHelper::getLocaleCode();

        setlocale(LC_ALL, $locale);
        Carbon::setLocale($locale);
    }
}
