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
        Schema::create('user_group_memberships', function (Blueprint $table) {
            $table->bigIncrements('id');                       // BIGSERIAL, PK
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_group_id')->constrained('user_groups')->cascadeOnDelete();
            $table->string('role', 50)->default('member');    // Role in the group
            $table->timestampsTz();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_group_memberships');
    }
};
