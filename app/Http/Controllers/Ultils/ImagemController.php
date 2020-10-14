<?php

namespace App\Http\Controllers\Ultils;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagemController extends Controller
{
    
    public static function saveImage($request, $nameParam, $path)
    {
        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile($nameParam) && $request->file($nameParam)->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
    
            // Recupera a extensão do arquivo
            $extension = $request->{$nameParam}->extension();
    
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
    
            // Faz o upload:
            $upload = $request->{$nameParam}->storeAs("public/$path", $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
    
            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload ){
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            } else {
                return $path."/". $nameFile;
            }
            
        } else {
            return null;
        }
    }

    public static function saveImages($request, $nameParam, $path)
    {
        $img = "";
        $nameFile = null;
        
        if ($request->hasFile($nameParam)) {
            foreach($request->file($nameParam) as $imagem){
                if($imagem->isValid()){
                    $name = uniqid(date('HisYmd'));            
                    $extension = $imagem->extension();
                    $nameFile = "{$name}.{$extension}";
                    $upload = $imagem->storeAs("public/$path", $nameFile);
                    if ( $upload ){
                        $img .= $path."/". $nameFile.";";
                    }
                }
            }
            
        } else {
            return null;
        }

        return $img;
    }

}
