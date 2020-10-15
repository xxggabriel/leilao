<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Leilao;
use App\Models\Lote;
use App\User;

class Dashboard extends Controller
{
    public function index()
    {
        $leiloes = Leilao::all();
        $lotes = Lote::all();
        $clientes = User::where("privilegio", 5)->get();
        return view('admin.index', compact("leiloes", "lotes", "clientes"));
    }
}
