<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(Auth::user()->isAdmin == 1){
            return $next($request);
        }
        return response()->json(['message' => 'You have not admin access'], 403);
    }
}
