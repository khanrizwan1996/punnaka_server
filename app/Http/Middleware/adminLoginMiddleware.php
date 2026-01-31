<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminLoginMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        if (!session()->has('adminId')) {
            return redirect('admin/login')->with('error', 'Please login to access admin panel');
        }
        return $next($request);
    }
}
