<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');

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
