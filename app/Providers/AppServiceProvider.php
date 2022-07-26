<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
class AppServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\\Http\\Controllers';
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
        Carbon::serializeUsing(function ($carbon) {
            return $carbon->format('Y-m-d H:i:s');
        });

        Schema::defaultStringLength(191);
        //
    }
}
