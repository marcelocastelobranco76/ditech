<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('sala_id')->unsigned()->index();
		    $table->string('descricao',255);	
            $table->foreign('user_id')->references('id')->on('users');	
	        $table->foreign('sala_id')->references('id')->on('salas');
    	    $table->dateTime('hora_inicio');
            $table->dateTime('hora_fim');	
    	    $table->integer('reservado',1);		    
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
        Schema::dropIfExists('reservas');
    }
}
