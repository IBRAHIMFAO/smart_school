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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('nom_group',20);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('code_niveauxscolaire'); // Add the foreign key column
            // $table->unsignedBigInteger('code_filiere');
            // $table->unsignedBigInteger('code_seance');


            // Define the foreign key relationship
            $table->foreign('code_niveauxscolaire')
                ->references('id')
                ->on('niveauxscolaires')
                ->onDelete('cascade');

            // Define the foreign key relationship
            // $table->foreign('code_filiere')
            // ->references('id')
            // ->on('filieres') // Specify the referenced table using 'on()' method
            // ->onDelete('cascade');

            // $table->foreign('code_seance')->references('id')->on('seances')->onDelete('cascade');

            // $table->foreign('code_student')
            // ->references('id')
            // ->on('students') // Specify the referenced table using 'on()' method
            // ->onDelete('cascade');


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
        Schema::dropIfExists('groups');
    }
};
