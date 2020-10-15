<?php

namespace App\Http\Middleware;

use App\User;
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
        $admin = session()->get("admin-login-user") ?? Cookie::get('admin-login-user');
        $admin = json_decode($admin);
        
        if($admin){
            $result = User::where("id", $admin->id)->where("login", $admin->login)->first();
                
            if($result){
                return $next($request);
            }
        }
        
        return redirect()->route("admin-login");
    }
}
