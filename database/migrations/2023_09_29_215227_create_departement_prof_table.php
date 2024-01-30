<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departement_prof', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_prof');
            $table->unsignedBigInteger('code_departement');
            // Ajoutez d'autres colonnes si nécessaire


            // Définition des clés étrangères
            $table->foreign('code_prof')
                ->references('id')
                ->on('profs')
                ->onDelete('cascade');

            $table->foreign('code_departement')
                ->references('id')
                ->on('departements')
                ->onDelete('cascade');
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
        Schema::dropIfExists('departement_prof');
    }
};
