<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\housetype;

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
        view()->composer('layout.master', function($view) {
            $danh_muc = housetype::all();
            $view->with('danh_muc', $danh_muc);
        });
    }
}
