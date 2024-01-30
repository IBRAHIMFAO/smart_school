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
        Schema::table('ecoles', function (Blueprint $table) {
            $table->unsignedBigInteger('code_annee_scolaire')->after('id');;
            $table->foreign('code_annee_scolaire')
                    ->references('id')
                    ->on('annee_scolaire')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecoles', function (Blueprint $table) {
            $table->dropForeign(['code_annee_scolaire']);
            $table->dropColumn('code_annee_scolaire');
        });
    }
};
