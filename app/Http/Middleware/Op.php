<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Op
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth()->user()->role == 'operational head' && Auth()->user()->status === 'activated') {
            return $next($request);
        } else if (Auth()->user()->status === 'deactivated') {
            return redirect()->route('login')->with('deactivated', 'This account has been Deactivated');
        }

        abort(401);   
    }
}
