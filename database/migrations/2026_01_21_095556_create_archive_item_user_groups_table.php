<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('archive_item_user_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archive_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_group_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['archive_item_id', 'user_group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archive_item_user_groups');
    }
};

