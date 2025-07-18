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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_chat');
            $table->unsignedBigInteger('id_user');
            $table->text('message_text');
            $table->enum('message_type', ['user', 'system', 'ai']); // TODO: Уточнить значения типов сообщения
            $table->timestamp('timestamp');

            $table->foreign('id_chat')->references('id_chat')->on('chats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
