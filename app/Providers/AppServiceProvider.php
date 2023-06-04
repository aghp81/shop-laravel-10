<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // برای نمایش دسترسی ها مشترک shop , admin
        Blade::if('admins', function () {
            return auth()->check() && (auth()->user()->is('admin') || auth()->user()->is('shop') );
        });

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->is('admin');
        });

        Blade::if('shop', function () {
            return auth()->check() && auth()->user()->is('shop');
        });

        Blade::if('user', function () {
            return auth()->check() && auth()->user()->is('user');
        });

        // استفاده از صفحه بندی بوت استرپ
        // dd(url()->current()); // url فعلی را می دهد
        // چون در بخش ادمین از tailwindcss استفاده کردیم و در بخش landing از بوت استرپ
        // dd(request()->path()); // مسیر فعلی را می دهد.

        if (strpos(request()->path(), 'landing') === 0) {
            Paginator::useBootstrapFive();
         }
    }
}
