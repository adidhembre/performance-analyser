<?php

namespace Aditya\PerformanceAnalyser\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Aditya\PerformanceAnalyser\Controllers\CollectionController as Listner;

class RouteListner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $collector = new Listner($request);
        $response = $next($request);
        $collector->endLog($response);
        return $response;
    }
}
