<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //https://stackoverflow.com/questions/40444759/how-to-access-the-nth-item-in-a-laravel-collection
        Collection::macro('getNth', function ($n) {
            return $this->slice($n, 1)->first();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
