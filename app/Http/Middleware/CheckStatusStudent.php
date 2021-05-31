<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatusStudent
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
        if ( auth()->user()->status_id == '1'
             or auth()->user()->status_id == '2'
             or auth()->user()->status_id == '3') {

            return $next($request);

        }
        return response()->json('You do not have access to the information.');
    }
}
