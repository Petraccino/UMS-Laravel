<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('lastname', 16);
            $table->string('email', 30)->unique();
            $table->string('fiscalcode', 16)->unique();
            $table->string('province', 16);
            $table->string('phone', 20);
            $table->smallInteger('age', false, true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->min(7);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
