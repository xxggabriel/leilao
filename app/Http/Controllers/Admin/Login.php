<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\User;


class Login extends Controller
{
    
    public function index()
    {
        return view('admin.login');
    }

    public function store(Request $request)
    {
        $user = User::where('login', $request->input("login"))->first();
        
        if($user){         
            if(password_verify($request->input("password"), $user->password)){
                if($user->privilegio < 5){
                    session(["admin-login" => true]);
                    return redirect()->route("admin-dashboard")->cookie("admin-login-user", $user, 60 * 24 * 15)->cookie("admin-login", $request->input("remember") == "on" ? true : false, 60 * 24 * 15);
                } // É cliente
            }
        }
        return redirect()->back()->with('error', 'Login ou senha inválido(s)');
    }

    public function logout()
    {
        session(["admin-login" => false]);
        Cookie::make('admin-login', false, 0);

        return redirect()->route("admin-login");
    }

}
