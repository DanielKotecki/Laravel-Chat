<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name');
            $table->foreignUuid('source_uuid')
                ->nullable()
                ->constrained('tags')
                ->references('uuid')
                ->cascadeOnDelete();
            $table->foreignId('language_id')
                ->constrained('languages')
                ->references('id')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
