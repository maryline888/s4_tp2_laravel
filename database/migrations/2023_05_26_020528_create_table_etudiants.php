<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Etudiant extends Migration
{
    /*
     
Run the migrations.*
@return void*/
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('nom', 50);
            $table->string('adresse', 250);
            $table->string('phone', 50);
            $table->date('date_naissance');
            $table->integer('ville_id');
            $table->timestamps();

            $table->foreign('id')
                ->references('id')
                ->on('users');

            $table->foreign('ville_id')
                ->references('id')
                ->on('villes');
        });
    }

    /*
     
Reverse the migrations.*
@return void*/
    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
}
