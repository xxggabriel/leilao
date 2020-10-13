<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Leilao as ModelsLeilao;

class Leilao extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leiloes = ModelsLeilao::orderBy('created_at','desc')->get();
        return view("admin.leilao.index", compact("leiloes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.leilao.create");
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
            "nome"          => "required|max:255",
            "foto"          => "required|max:2500",
            "url"           => "required|max:255",
            "cep"           => "max:255",
            "uf"            => "max:255",
            "cidade"        => "max:255",
            "endereco"      => "max:255",
            "bairro"        => "max:255",
            "numero"        => "max:255",
            "complemento"   => "max:255",
            "localidade"    => "max:255",
            "latitude"      => "max:255",
            "longitude"     => "max:255",
            "status"        => "required|numeric",
        ]);

        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
    
            // Recupera a extensão do arquivo
            $extension = $request->foto->extension();
    
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
    
            // Faz o upload:
            $upload = $request->foto->storeAs('public/leilao', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
    
            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
        }

        $leilao = new ModelsLeilao();
        $leilao->id_user = User::user()->id;
        $leilao->nome = $request->input("nome");
        $leilao->foto = "/leilao/".$nameFile;
        $leilao->url = $request->input("url");
        $leilao->cep = $request->input("cep");
        $leilao->uf = $request->input("uf");
        $leilao->cidade = $request->input("cidade");
        $leilao->endereco = $request->input("endereco");
        $leilao->bairro = $request->input("bairro");
        $leilao->numero = $request->input("numero");
        $leilao->complemento = $request->input("complemento");
        $leilao->localidade = $request->input("localidade");
        $leilao->latitude = $request->input("latitude");
        $leilao->longitude = $request->input("longitude");
        $leilao->status = $request->input("status");
        $result = $leilao->save();

        if(!$result){
            return redirect()->back()->with("error", "Erro ao criar o leilão.");
        }

        return redirect()->route("admin-leilao")->with("message", "Leilão $leilao->nome criado com sucesso");

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
        $leilao = ModelsLeilao::find($id);
        return view("admin.leilao.edit", compact("leilao"));
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
            "nome"          => "required|max:255",
            "foto"          => "max:2500",
            "url"           => "required|max:255",
            "cep"           => "max:255",
            "uf"            => "max:255",
            "cidade"        => "max:255",
            "endereco"      => "max:255",
            "bairro"        => "max:255",
            "numero"        => "max:255",
            "complemento"   => "max:255",
            "localidade"    => "max:255",
            "latitude"      => "max:255",
            "longitude"     => "max:255",
            "status"        => "required|numeric",
        ]);

        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
    
            // Recupera a extensão do arquivo
            $extension = $request->foto->extension();
    
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
    
            // Faz o upload:
            $upload = $request->foto->storeAs('public/leilao', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
    
            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
        }
        $nameFile = $nameFile != null ? "/leilao/".$nameFile : null;
        $leilao = ModelsLeilao::find($id);
        $leilao->id_user = User::user()->id;
        $leilao->nome = $request->input("nome")                 ?? $leilao->nome;
        $leilao->foto = $nameFile                               ?? $leilao->foto;
        $leilao->url = $request->input("url")                   ?? $leilao->url;
        $leilao->cep = $request->input("cep")                   ?? $leilao->cep;
        $leilao->uf = $request->input("uf")                     ?? $leilao->uf;
        $leilao->cidade = $request->input("cidade")             ?? $leilao->cidade;
        $leilao->endereco = $request->input("endereco")         ?? $leilao->endereco;
        $leilao->bairro = $request->input("bairro")             ?? $leilao->bairro;
        $leilao->numero = $request->input("numero")             ?? $leilao->numero;
        $leilao->complemento = $request->input("complemento")   ?? $leilao->complemento;
        $leilao->localidade = $request->input("localidade")     ?? $leilao->localidade;
        $leilao->latitude = $request->input("latitude")         ?? $leilao->latitude;
        $leilao->longitude = $request->input("longitude")       ?? $leilao->longitude;
        $leilao->status = $request->input("status")             ?? $leilao->status;
        $result = $leilao->save();

        if(!$result){
            return redirect()->back()->with("error", "Erro ao atualizar o leilão.");
        }

        return redirect()->route("admin-leilao")->with("message", "Leilão $leilao->nome atualizado com sucesso");
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
