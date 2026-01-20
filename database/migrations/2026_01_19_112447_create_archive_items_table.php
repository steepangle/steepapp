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
        Schema::create('archive_items', function (Blueprint $table) {
            $table->bigIncrements('id');                        // BIGSERIAL, PK
            $table->string('title', 255);                       // Title
            $table->string('file_path', 255);                   // File location on disk
            $table->string('access_level', 50)->default('private'); // Access level
            $table->timestampTz('published_at')->nullable();    // When published
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_items');
    }
};
