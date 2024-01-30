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
        Schema::create('niveauxscolaires', function (Blueprint $table) {
            $table->id();
            $table->string('label');

            $table->unsignedBigInteger('code_filiere');
            $table->foreign('code_filiere')
            ->references('id')
            ->on('filieres') // Specify the referenced table using 'on()' method
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
        Schema::dropIfExists('niveauxscolaires');
    }
};
