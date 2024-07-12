<?php

namespace App\Http\Middleware;

use Closure;

class CheckPassword
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
        if ($request->header('api_pass') !== env('API_PASSWORD', 'LYxBhLB5F9m9X37jYjUWU7XBZ')) {
            return response()->json(['message' => 'UnAuthenticated..']);
        }

        return $next($request);
    }
}
