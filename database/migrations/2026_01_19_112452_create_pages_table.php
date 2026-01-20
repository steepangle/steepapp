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
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');                        // BIGSERIAL, PK
            $table->string('slug', 100)->unique();              // URL-friendly identifier
            $table->string('title', 255);                       // Page title
            $table->text('content');                             // Markdown content
            $table->timestampTz('published_at')->nullable();     // When published
            $table->timestampsTz();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
