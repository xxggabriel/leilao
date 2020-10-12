<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class VerifyAdminLogin
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
         
        if(session()->get("admin-login") || Cookie::get('admin-login')){
            return $next($request);
        }
        
        return redirect()->route("admin-login");
    }
}
