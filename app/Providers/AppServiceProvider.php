<?php

namespace App\Providers;

use App\Models\Distribucion;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        view()->composer('*', function($view){
            if(auth()->user()){
            $dist = Distribucion::orderBy('nombre')
            ->where('user_id', auth()->user()->id)
            ->paginate(10);
            View::share('distribucionV', $dist);
            }
        });


        Paginator::useBootstrap();
    }
}
