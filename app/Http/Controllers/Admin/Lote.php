<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Leilao;
use App\Models\Lote as ModelsLote;
use App\Http\Controllers\Ultils\ImagemController;

class Lote extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotes = ModelsLote::orderBy('created_at','desc')->get();;
        return view("admin.lote.index", compact("lotes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leiloes = Leilao::all();
        return view("admin.lote.create", compact("leiloes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "id-leilao" => "required",
            "lote" => "required",
            "nome" => "required",
            "url" => "required",
            "foto" => "required",
            "fotos" => "",
            "categoria" => "",
            "data-init" => "required",
            "data-fim" => "required",
            "codigo" => "",
            "lance-inicial" => "",
            "lance-minimo" => "",
            "tipo" => "required",
            "modalidade" => "required",
            "aovivo" => "",
            "descricao" => "",
            "informacoes" => "",
            "visitacao" => "",
            "status" => "required",
        ]);
        
        $loteExiste = ModelsLote::where("id_leilao", $request->input("id-leilao"))->where("lote", $request->input("lote"))->first();
        if($loteExiste){
            return redirect()->back()->with("error", "Erro, numero do lote já existe. Altere o numero do lote!");
        }

        $foto = ImagemController::saveImage($request, "foto", "lote");
        $fotos = ImagemController::saveImages($request, "fotos", "lote");
        $lote = new ModelsLote();
        $lote->id_user          = User::user()->id;
        $lote->id_leilao        = $request->input("id-leilao");
        $lote->lote             = $request->input("lote");
        $lote->nome             = $request->input("nome");
        $lote->url              = $request->input("url");
        $lote->foto             = $foto;
        $lote->fotos            = $fotos;
        $lote->categoria        = $request->input("categoria");
        $lote->data_init        = $request->input("data-init");
        $lote->data_fim         = $request->input("data-fim");
        $lote->codigo           = $request->input("codigo");
        $lote->lance_inicial    = str_replace(",", ".", str_replace(".", "", $request->input("lance-inicial")));
        $lote->lance_minimo     = str_replace(",", ".", str_replace(".", "", $request->input("lance-minimo")));
        $lote->tipo             = $request->input("tipo");
        $lote->modalidade       = $request->input("modalidade");
        $lote->aovivo           = $request->input("aovivo");
        $lote->descricao        = $request->input("descricao");
        $lote->informacoes      = $request->input("informacoes");
        $lote->visitacao        = $request->input("visitacao");
        $lote->status           = $request->input("status");
        $result = $lote->save();

        if(!$result){
            return redirect()->back()->with("error", "Erro ao criar o lote.");
        }

        return redirect()->route("admin-lote")->with("message", "Lote $lote->lote criado com sucesso");
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lote = ModelsLote::find($id);
        $leilao = Leilao::find($lote->id_leilao);
        $nomeLeilao = $leilao->nome;
        return view("admin.lote.edit", compact("lote", "nomeLeilao"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "nome" => "required",
            "url" => "required",
            "lote" => "required",
            "categoria" => "",
            "data-init" => "required",
            "data-fim" => "required",
            "codigo" => "",
            "lance-inicial" => "",
            "lance-minimo" => "",
            "tipo" => "required",
            "modalidade" => "required",
            "aovivo" => "",
            "descricao" => "",
            "informacoes" => "",
            "visitacao" => "",
            "status" => "required",
        ]);
        
        $lote =  ModelsLote::find($id);
        
        if($lote->lote != $request->input("lote")){
            $loteExiste = ModelsLote::where("id_leilao", $lote->id_leilao)->where("lote", $request->input("lote"))->first();
            
            if($loteExiste){
                return redirect()->back()->with("error", "Erro, numero do lote já existe. Altere o numero do lote!");
            }
        }
        $foto                   = ImagemController::saveImage($request, "foto", "lote");
        $fotos                  = ImagemController::saveImages($request, "fotos", "lote");
        $lote->nome             = $request->input("nome")       ?? $lote->nome;
        $lote->url              = $request->input("url")        ?? $lote->url;
        $lote->foto             = $foto ?? $lote->foto;
        $lote->fotos            = $fotos ?? $lote->fotos;
        $lote->lote             = $request->input("lote")       ?? $lote->lote;
        $lote->categoria        = $request->input("categoria")  ?? $lote->categoria;
        $lote->data_init        = $request->input("data-init")  ?? $lote->data_init;
        $lote->data_fim         = $request->input("data-fim")   ?? $lote->data_fim;
        $lote->codigo           = $request->input("codigo")     ?? $lote->codigo;
        $lote->lance_inicial    = str_replace(",", ".", str_replace(".", "", $request->input("lance-inicial"))) ?? $lote->lance_inicial;
        $lote->lance_minimo     = str_replace(",", ".", str_replace(".", "", $request->input("lance-minimo")))  ?? $lote->lance_minimo;
        $lote->tipo             = $request->input("tipo")       ?? $lote->tipo;
        $lote->modalidade       = $request->input("modalidade") ?? $lote->modalidade;
        $lote->aovivo           = $request->input("aovivo")     ?? $lote->aovivo;
        $lote->descricao        = $request->input("descricao")  ?? $lote->descricao;
        $lote->informacoes      = $request->input("informacoes") ?? $lote->informacoes;
        $lote->visitacao        = $request->input("visitacao")  ?? $lote->visitacao;
        $lote->status           = $request->input("status")     ?? $lote->status;
        $result = $lote->save();

        if(!$result){
            return redirect()->back()->with("error", "Erro ao atualizar o lote.");
        }

        return redirect()->route("admin-lote")->with("message", "Lote $lote->lote atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
