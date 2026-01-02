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
        Schema::create('tag_temp_user_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('temp_chat_uuid')
                ->constrained('temp_chats')
                ->references('uuid')
                ->cascadeOnDelete();
            $table->foreignUuid("tag_uuid")
                ->constrained('tags')
                ->references('uuid')
                 ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_temp_user_pivot');
    }
};
