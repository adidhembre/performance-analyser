<?php

namespace Aditya\PerformanceAnalyser\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        \Log::Info('Before Route...');
        // $route = \Route::current();
        // $data = [
        //     'route' => $route->uri,
        //     'method' => $request->getMethod(),
        //     'parameters' => json_encode($route->parameters),
        //     //'' get parameters as header Referer, user_id etc.
        //     'status' => 0,
        //     'start_time' => Carbon::now(),
        // ];
        // dd($data);
        $response = $next($request);
        
        
        \Log::Info('After Route...');
        return $response;
    }
}
