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
        Schema::create('caissiers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // First name
            $table->string('last_name'); // Last name
            $table->string('first_name_ar')->nullable();
            $table->string('last_name_ar')->nullable();
            $table->string('NIF')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('cin')->unique()->nullable();; // CIN

            $table->float('salary')->nullable(); // Monthly fee

            $table->unsignedBigInteger('code_user');
            $table->foreign('code_user')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('caissiers');
    }
};
