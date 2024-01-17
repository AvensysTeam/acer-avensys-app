<?php

namespace App\Http\Middleware;

use Closure;

class CountryRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(env('APP_ENV') == 'production' ){
            if(in_array($request->ipinfo->country,config("services.ipinfo.allowed_countries"))){
                return $next($request);
            }else{
                // Handle access restricted
                return response()->json(['error' => 'Access restricted'], 403);
            }
        }else{
            return $next($request);
        }


    }
}
