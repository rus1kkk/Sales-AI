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
        Schema::create('chats', function (Blueprint $table) {
            $table->id('id_chat');
            $table->string('model_name');
            $table->string('chat_name');
            $table->enum('chat_status', ['active', 'closed', 'archived']); // TODO: Уточнить значение статусов чата
            $table->timestamp('timestamp');

            $table->foreign('model_name')
                ->references('model_name')
                ->on('models')
                ->onUpdate('cascade')
                ->onDelete('set default'); //   TODO: указать, какая модель по дефолту
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
