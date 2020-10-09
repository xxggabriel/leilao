<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            

            $table->increments('id');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');

            $table->integer('id_leilao')->unsigned();
            $table->foreign('id_leilao')->references('id')->on('leilaos');

            $table->string('nome');
            $table->string('url');
            $table->string('foto');
            $table->longText('fotos')->nullable(); // Carrocel de imagens, separados por ;.
            $table->integer('views')->default(0);
            $table->string('categoria'); // Carro; Moto; Aviao

            $table->string('data_init');
            $table->string('data_fim');
            $table->string('codigo')->nullalbe();   
            $table->float('lance_inicial');
            
            $table->integer('tipo'); // 1 Recuperados de Financiamento; 2 Precensial; Simuntaneio; 
            $table->integer('modalidade'); // 1 Online; 2 Precensial; Simuntaneio; 
            
            $table->longText('aovivo')->nullable();;
            $table->longText('descricao')->nullable();
            $table->longText('informacoes')->nullable();
            $table->longText('visitacao')->nullable();

            

            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
