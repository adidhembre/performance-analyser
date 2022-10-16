<?php

namespace Aditya\PerformanceAnalyser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
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

    /**
     * Register Middlewares
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }

    public function boot()
    {
        $this->registerMiddleware(RouteListner::class);
    }
}