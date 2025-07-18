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
        Schema::create('specification_documents', function (Blueprint $table) {
            $table->id('id_document');
            $table->unsignedBigInteger('id_chat');
            $table->string('version', 20);
            $table->timestamp('created_at');

            $table->foreign('id_chat')->references('id_chat')->on('chats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Specification_Documents');
    }
};
