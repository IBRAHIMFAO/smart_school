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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_user');
            // $table->unsignedBigInteger('code_group')->nullable();
            $table->unsignedBigInteger('code_matiere')->nullable();

            $table->string('type'); // To distinguish post types (e.g., 'text', 'image', 'file', 'link')
            $table->text('content')->nullable(); // For text content
            $table->string('file_path')->nullable(); // For file (e.g., Word, PDF) path
            $table->string('image_path')->nullable(); // For multiple image paths (stored as JSON)
            $table->string('link')->nullable(); // For links
            $table->timestamps();

            $table->foreign('code_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('code_matiere')->references('id')->on('matieres')->onDelete('cascade');

            // $table->foreign('code_group')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
