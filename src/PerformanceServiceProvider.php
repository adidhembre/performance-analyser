<?php

namespace Aditya\PerformanceAnalyser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Aditya\PerformanceAnalyser\Middlewares\RouteListner;
use Aditya\PerformanceAnalyser\Console\ClearAnalyser;

class PerformanceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/analyser.php';
        $this->mergeConfigFrom($configPath, 'analyser');
    }

    /**
     * Register Middlewares
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        // $kernel = $this->app[Kernel::class];
        // $kernel->pushMiddleware($middleware);
        $router = $this->app->make(Router::class);
        foreach(config('analyser.middleware_groups') as $g){
            $router->pushMiddlewareToGroup($g, $middleware);
        }
    }


    /**
     * Register Migrations
     *
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function registerCommands()
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                ClearAnalyser::class,
            ]);
        }
    }

    public function boot()
    {
        $this->registerCommands();
        if(config('analyser.enabled')){
            $this->registerMigrations();
            $this->registerMiddleware(RouteListner::class);   
        }
    }
}