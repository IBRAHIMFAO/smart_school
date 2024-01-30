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
        Schema::create('departements', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('code_ecole');
            $table->string('label');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('code_ecole')->references('id')->on('ecoles')->onDelete('cascade');

    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departements');
    }
};
