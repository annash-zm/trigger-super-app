<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'pendamping') {
                return redirect('/pendamping');
            } else if (Auth::user()->role == 'fasilitator') {
                return redirect('/fasilitator');
            } else if (Auth::user()->role == 'Admin') {
                return redirect('/admin');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
