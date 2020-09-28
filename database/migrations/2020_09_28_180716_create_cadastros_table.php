<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadastrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastros', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');

            $table->string('nome');
            $table->string('sobrenome');
            $table->string('documento');
            $table->string('tipo_documento');
            $table->string('data_nacimento');
            $table->string('email');
            $table->string('telefone')->nullable();
            $table->string('celular');
            $table->string('sexo');

            $table->string('documento_frente')->nullable();
            $table->string('documento_verso')->nullable();
            $table->string('documento_frente_foto')->nullable();
            $table->string('foto')->nullable();
            
            $table->integer('status')->default(1);

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
        Schema::dropIfExists('cadastros');
    }
}
