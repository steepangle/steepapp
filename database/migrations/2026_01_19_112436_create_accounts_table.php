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
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');                    // BIGSERIAL, PK
            $table->string('tban', 50)->unique();          // Public account number
            $table->string('owner_type', 50);              // 'user' or 'user_group'
            $table->bigInteger('owner_id');                // References user or group
            $table->timestampsTz();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
