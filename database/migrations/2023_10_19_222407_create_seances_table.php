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
        Schema::create('seances', function (Blueprint $table) {
            $table->id();

            // Date de la première séance
            $table->date('date');

            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('annee_scolaire',40); 
            // $table->json

            // Périodicité de la séance (Annee, Mois, Semaine, Jour)
            $table->enum('periodicite', ['Annee', 'Mois', 'Semaine', 'Jour'])->nullable();

            $table->unsignedBigInteger('code_salle');
            $table->unsignedBigInteger('code_prof');
            $table->unsignedBigInteger('code_matiere');
            $table->unsignedBigInteger('code_group');


            $table->enum('status', [
                'Scheduled',     // Indicates that the session is planned but has not yet occurred.
                'In Progress',   // Indicates that the session is currently ongoing.
                'Completed',     // Indicates that the session has successfully concluded as scheduled.
                'Cancelled',     // Indicates that the session was canceled before or during the scheduled time.
                'Rescheduled',   // Indicates that the session was rescheduled for a different date and time.
                'Postponed',     // Indicates that the session was temporarily delayed but is expected to happen later.
                'No Show'        // Indicates that no participants or attendees showed up for the session.
            ])->default('Scheduled');

            $table->enum('type', [
                'Cours',     // A regular course session.
                'Examen',    // An examination session.
                'Devoir',    // An assignment or homework.
                'Controle',  // A quiz or test.
                'TP',        // A practical work session.
                'TD',        // A theoretical work session.
                'Autre'      // Other types of sessions.
            ])->default('Cours');


            $table->text('notes')->nullable();



            // Clé étrangère vers la table 'salles'
            $table->foreign('code_salle')
                ->references('id')
                ->on('salles')
                ->onDelete('cascade');

            // Clé étrangère vers la table 'profs'
            $table->foreign('code_prof')
                ->references('id')
                ->on('profs')
                ->onDelete('cascade');

            // Clé étrangère vers la table 'matieres'
            $table->foreign('code_matiere')
                ->references('id')
                ->on('matieres')
                ->onDelete('cascade');

            // Clé étrangère vers la table 'groups'
            $table->foreign('code_group')
                ->references('id')
                ->on('groups')
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
        Schema::dropIfExists('seances');
    }
};
