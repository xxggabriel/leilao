<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeilaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leilaos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');

            $table->string('nome');
            $table->string('foto');
            $table->string('url');

            $table->string('cep')->nullalbe();
            $table->string('uf')->nullalbe();
            $table->string('cidade')->nullalbe();
            $table->string('endereco')->nullalbe();
            $table->string('bairro')->nullalbe();
            $table->string('numero')->nullalbe();
            $table->string('complemento')->nullalbe();

            $table->string('localidade')->nullalbe(); // Goiânia; GO
            $table->string('latitude')->nullalbe();
            $table->string('longitude')->nullalbe();
            
            $table->integer('status');
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
        Schema::dropIfExists('leilaos');
    }
}
