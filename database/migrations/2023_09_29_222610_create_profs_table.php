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
        Schema::create('profs', function (Blueprint $table) {
            $table->id(); // Identifiant unique du professeur (clé primaire)
            $table->string('first_name'); // Prénom du professeur
            $table->string('last_name'); // Nom de famille du professeur
            $table->string('first_name_ar')->nullable(); // Prénom en arabe (optionnel)
            $table->string('last_name_ar')->nullable(); // Nom de famille en arabe (optionnel)
            $table->integer('hours_worked')->default(0); // Heures travaillées (par défaut à 0)
            $table->date('birthdate')->nullable(); // Date de naissance du professeur (optionnelle)
            $table->string('cin')->unique()->nullable(); // Numéro de CIN (Carte d'identité nationale) unique et optionnel
            $table->string('Doti')->unique()->nullable(); // Numéro de DOTI (Document d'ordre des instituteurs) unique et optionnel
            $table->string('family_status')->nullable(); // Situation de famille du professeur (optionnelle)
            $table->text('address')->nullable(); // Adresse du professeur (optionnelle)

            // Clé étrangère vers la table users pour lier le professeur à un utilisateur
            $table->unsignedBigInteger('code_user');
            $table->foreign('code_user')->references('id')->on('users')->onDelete('cascade');

            // Clé étrangère vers la table departements pour spécifier le département d'affectation

            // $table->unsignedBigInteger('code_departement');
            // $table->foreign('code_departement')->references('id')->on('departements')->onDelete('cascade');

            // Ajoutez d'autres champs ici selon vos besoins

            $table->timestamps(); // Ajoute automatiquement les horodatages created_at et updated_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profs');
    }
};
