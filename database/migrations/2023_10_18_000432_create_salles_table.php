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
        Schema::create('salles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('code_pavilion');
            $table->foreign('code_pavilion')->references('id')->on('pavilions')->onDelete('cascade');

            $table->string('label');
            $table->text('description')->nullable();
            $table->enum('status', ['salle', 'atelier', 'salle informatique']);
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
        Schema::dropIfExists('salles');
    }
};
