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
        Schema::create('temp_chats', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignId('user_id')
                ->constrained('users')
                ->references('id')
                ->cascadeOnDelete();
            $table->string('paired_user_id', 512)->nullable();
            $table->string('chat_room_id', 512)->nullable();
            $table->enum('gender', ['female', 'male', 'other'])->default('other');
            $table->foreignUuid('age_range_uuid')->constrained("age_ranges")->references('uuid')->cascadeOnDelete();
            $table->boolean('looking_for_chat')->default(true);
            $table->json('filters')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_chats');
    }
};
