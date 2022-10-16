<?php

namespace Aditya\PerformanceAnalyser;
use Illuminate\Support\ServiceProvider;
use Aditya\PerformanceAnalyser\Middlewares\RouteListner;

class PerformanceServiceProvider extends ServiceProvider
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

    public function boot()
    {
        $this->app->middleware([
            RouteListner::class
        ]);
    }
}