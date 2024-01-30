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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();


            $table->enum('payment_type', ['cash', 'visa', 'cheque', 'autre']); // Type de paiement
            $table->enum('status', ['complet', 'partiel', 'en_attente']); // Statut du paiement
            $table->decimal('amount', 10, 2); // Montant du paiement
            $table->decimal('remaining_amount', 10, 2)->nullable(); // Montant restant du paiement
            $table->date('payment_date'); // Date de paiement
            $table->string('payment_description')->nullable(); // Description du paiement
            $table->string('currency')->default('MAD'); // Devise du paiement
            $table->string('payment_month')->nullable(); // Mois du paiement
            $table->string('payment_year')->nullable(); // Année du paiement
            $table->boolean('payment_approval_status')->default(false); // Statut d'approbation du paiement

            $table->unsignedBigInteger('code_student');
            $table->foreign('code_student')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedBigInteger('code_caissier');
            $table->foreign('code_caissier')->references('id')->on('caissiers')->onDelete('cascade');

            $table->unsignedBigInteger('code_ecole');
            $table->foreign('code_ecole')->references('id')->on('ecoles')->onDelete('cascade');

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
        Schema::dropIfExists('payments');
    }
};
