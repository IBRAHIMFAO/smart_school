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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // First name
            $table->string('last_name'); // Last name
            $table->string('first_name_ar')->nullable();
            $table->string('last_name_ar')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('address')->nullable();
            $table->string('cne')->unique(); // CNE
            $table->string('codeRFID')->unique()->nullable(); // Code RFID
            $table->string('cin')->unique()->nullable();; // CIN

            $table->float('monthly_fee'); // Monthly fee


            $table->unsignedBigInteger('code_user');
            $table->foreign('code_user')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('code_group'); // Add the foreign key column
            $table->foreign('code_group')->references('id')->on('groups')->onDelete('cascade');

            $table->unsignedBigInteger('code_tuteur')->nullable();
            $table->foreign('code_tuteur')->references('id')->on('tuteurs')->onDelete('cascade');

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
        Schema::dropIfExists('students');
    }
};
