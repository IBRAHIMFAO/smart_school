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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_payment');
            $table->foreign('code_payment')->references('id')->on('payments')->onDelete('cascade');

            $table->string('numero_facture'); // Numéro de la facture
            $table->date('date_facture'); // Date de la facture
            $table->decimal('montant_total', 10, 2); // Montant total de la facture
            $table->string('devise')->default('MAD'); // Devise de la facture
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
        Schema::dropIfExists('factures');
    }
};
