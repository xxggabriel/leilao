<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Leilao;
use App\Models\Lote;

class Dashboard extends Controller
{
    public function index()
    {
        $leiloes = Leilao::all();
        $lotes = Lote::all();
        $clientes = Cliente::all();
        return view('admin.index', compact("leiloes", "lotes", "clientes"));
    }
}
