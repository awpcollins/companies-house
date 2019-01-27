<?php

namespace App\Providers;

use App\Services\CompaniesHouse;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class CompaniesHouseProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CompaniesHouse::class, function ($app) {
            return new CompaniesHouse(
                $this->getHttpClient()
            );
        });
    }

    private function getHttpClient()
    {
        return new Client([
            'base_uri' => env('COMPANIES_HOUSE_URL'),
            'http_errors' => false,
            'auth' => [env('COMPANIES_HOUSE_KEY'), '']
        ]);
    }
}
