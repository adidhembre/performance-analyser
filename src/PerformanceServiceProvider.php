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

    protected function registerMiddleware($middleware)
    {
        $this->app->middleware([$middleware]);
    }

    public function boot()
    {
        $this->registerMiddleware(RouteListner::class);
    }
}