<?php

namespace App\Http\Middleware;

use App\Utils\Response;
use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    use Response;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('X-API-KEY') != env('API_KEY')){
            return $this->sendFailedResponse([], 'Oops, api key tidak valid', 503);
        }
        return $next($request);
    }
}
