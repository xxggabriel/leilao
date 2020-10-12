<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\User as UserModel;

class User extends Controller
{

    public static function user()
    {
        return json_decode(Cookie::get("admin-login-user"));
        
    }


    public static function username()
    {
        return self::user()->name;
    }
}
