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
        Schema::create('post_group', function (Blueprint $table) {
            
                $table->id();
                $table->unsignedBigInteger('code_post');
                $table->unsignedBigInteger('code_group')->nullable();
                $table->foreign('code_post')->references('id')->on('posts')->onDelete('cascade');
                $table->foreign('code_group')->references('id')->on('groups')->onDelete('cascade');
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
        Schema::dropIfExists('post_group');
    }
};
