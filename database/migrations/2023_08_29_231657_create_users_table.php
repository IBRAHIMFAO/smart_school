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
        Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('fullname');
        $table->enum('gender', ['male', 'female']); // Gender: mascilan or feminan
        $table->string('img')->nullable(); // New field for user image
        $table->string('role'); // New field for user type (admin, directeur, surveillant, student ,tuteur)
        $table->string('phone')->nullable(); // New field for user phone number
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->boolean('is_active')->default(0); // Is active (default: 0)
        $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
