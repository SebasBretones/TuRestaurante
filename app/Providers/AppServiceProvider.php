<?php

namespace App\Providers;

use App\Models\Distribucion;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        $dist = Distribucion::orderBy('nombre')->paginate(10);
        View::share('distribucionV', $dist);

        Paginator::useBootstrap();
    }
}
