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
        Schema::create('matieres', function (Blueprint $table) {
                $table->id();
                $table->string('label'); // Nom de la matière
                $table->text('description')->nullable(); // Description de la matière (optionnelle)

                // $table->unsignedBigInteger('code_niveauxscolaire');
                // $table->foreign('code_niveauxscolaire')
                //     ->references('id')
                //     ->on('niveauxscolaires')
                //     ->onDelete('cascade');


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
        Schema::dropIfExists('matieres');
    }
};
