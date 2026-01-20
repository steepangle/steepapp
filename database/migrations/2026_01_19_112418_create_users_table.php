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
            $table->bigIncrements('id');                        // BIGSERIAL, PK
            $table->string('a_id', 50)->unique();               // Unique authentication ID
            $table->string('username', 100)->unique();          // Login-friendly name
            $table->string('password_hash', 255);               // Password hash
            $table->string('status', 50)->default('active');    // Status: active, suspended
            $table->timestampsTz();                             // created_at, updated_at with timezone
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
