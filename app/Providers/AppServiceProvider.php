<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\house;
use App\Models\housetype;
use App\Models\districts;
use App\Models\choosedhouse;

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
    
        view()->composer('layout.master', function($view) {
            $choosedHouse = choosedhouse::all();
            $view->with('choosedHouse', $choosedHouse);
        });

        view()->composer('layout.master', function($view) {
            $house = house::all();
            $view->with('house', $house);
        });

        view()->composer('home.index', function($view) {
            $newHouse = house::select('*')->orderBy('id','desc')->limit(3)->get();
            $view->with('newHouse', $newHouse);
        });

        view()->composer('home.index', function($view) {
            $topHouse = house::select('*')->orderBy('count_view','desc')->limit(3)->get();
            $view->with('topHouse', $topHouse);
        });
        
    }
}
