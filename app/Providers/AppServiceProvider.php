<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 注册任何应用程序服务。
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     * 引导任何应用程序服务。
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
